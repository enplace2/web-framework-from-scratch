<?php

namespace Core\Response;
class Response
{
    protected mixed $content;
    protected int $status;
    protected array $headers = [];

    public function __construct($content = '', int $status = 200, array $headers = [])
    {
        $this->content = $content;
        $this->status = $status;
        $this->headers = $headers;
    }

    public function header(string $key, string $value): Response
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function send(): void
    {
        http_response_code($this->status);

        foreach ($this->headers as $header => $value) {
            header("$header: $value");
        }

        echo $this->content;
        exit;
    }

    public static function json(mixed $data, int $status = 200, array $headers = []): Response
    {
        $instance = new self(json_encode($data), $status, $headers);
        $instance->header('Content-Type', 'application/json');
        return $instance;
    }
}
