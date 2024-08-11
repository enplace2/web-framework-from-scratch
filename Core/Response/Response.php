<?php

namespace Core\Response;
class Response
{
    protected $content;
    protected int $status;
    protected array $headers = [];

    public function __construct($content = '', int $status = 200, array $headers = [])
    {
        $this->content = $content;
        $this->status = $status;
        $this->headers = $headers;
    }

    /**
     * Sets the header value on the Response instance for a given key value pair
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function header(string $key, string $value): Response
    {
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * Handles sending the response by setting the status code, headers, and echoing the content
     * @return void
     */
    public function send(): void
    {
        http_response_code($this->status);

        foreach ($this->headers as $header => $value) {
            header("$header: $value");
        }

        echo $this->content;
        exit;
    }

    /**
     * Json encodes content and sets the content type header to 'application/json'
     *
     * @param $data
     * @param int $status
     * @param array $headers
     * @return Response
     */
    public static function json($data, int $status = 200, array $headers = []): Response
    {
        $instance = new self(json_encode($data), $status, $headers);
        $instance->header('Content-Type', 'application/json');
        return $instance;
    }
}
