<?php

namespace Core\SessionHandlers;
use Core\Database\Database;
use SessionHandlerInterface;

class DatabaseSessionHandler implements SessionHandlerInterface
{
    protected Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * @inheritDoc
     *
     * No action needed for database sessions.
     * This method must be implemented to satisfy SessionHandlerInterface,
     * but its purpose (opening a file) is not relevant for database storage.
     *
     * @param string $path Ignored. The path where sessions are stored.
     * @param string $name Ignored. The name of the session.
     * @return bool Always returns true to indicate success.
     */
    public function open(string $path, string $name): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     *
     * No action needed for database sessions.
     * This method must be implemented to satisfy SessionHandlerInterface,
     * but its purpose (closing a file) is not relevant for database storage.
     *
     * @param string $path Ignored. The path where sessions are stored.
     * @param string $name Ignored. The name of the session.
     * @return bool Always returns true to indicate success.
     */
    public function close():bool
    {
        return true;
    }

    /**
     * Fetch the session from the database and return the data column
     * @inheritDoc
     */
    public function read(string $id):string
    {
        $row = $this->db->fetch("SELECT data FROM sessions WHERE id = :id", ["id"=>$id]);
        return $row ? $row['data'] : '';
    }

    /**
     * Save the session to the database. Get the user id from the session and the ip address
     * @inheritDoc
     */
    public function write($id, $data): bool
    {
        $userId = null;
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? null;

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
        }
        $result = $this->db->query(
            "INSERT INTO sessions (id, user_id, ip_address, data, last_activity) 
         VALUES (?, ?, ?, ?, ?) 
         ON DUPLICATE KEY UPDATE 
            user_id = VALUES(user_id),
            ip_address = VALUES(ip_address),
            data = VALUES(data), 
            last_activity = VALUES(last_activity)",
            [$id, $userId, $ipAddress, $data, time()]
        );

        return $result !== false;
    }

    /**
     * @inheritDoc
     *
     * Deletes the session data from the database for the given session ID.
     *
     * @param string $id The session ID.
     * @return bool Returns true on success or false on failure.
     */
    public function destroy(string $id): bool
    {
        $result = $this->db->query(
            "DELETE FROM sessions WHERE id = ?",
            [$id]
        );

        return $result !== false;
    }

    /**
     * Clean up old sessions. This still uses the php default method of
     * probabilistic garbage collection, since we will not cover setting up a
     * cron job here.
     * @inheritDoc
     */
    public function gc(int $max_lifetime): int|false
    {
        try {
            $old = time() - $max_lifetime;

            $result = $this->db->query(
                "DELETE FROM sessions WHERE last_activity < ?",
                [$old]
            );

            if ($result === false) {
                return false;
            }

            return $result->rowCount();
        } catch (\Exception $e) {
            error_log("Error in session garbage collection: " . $e->getMessage());
            return false;
        }
    }



}