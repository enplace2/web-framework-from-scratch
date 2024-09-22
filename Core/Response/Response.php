<?php

namespace Core\Response;

class Response
{
    protected mixed $content;
    protected int $status;
    protected array $headers = [];

    public function __construct($content = '', int $status = 200, array $headers = [])
    {
        $this->setContent($content);
        $this->status = $status;
        $this->headers = $headers;
    }

    public static function make($data): Response
    {
        if ($data instanceof Response) {
            return $data;
        } elseif (is_string($data)) {
            return new static($data);
        } else {
            return static::json($data);
        }
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

    public static function json($data, int $status = 200, array $headers = []): Response
    {
        $instance = new self($data, $status, $headers);
        $instance->header('Content-Type', 'application/json');
        return $instance;
    }

    public function setContent($content): void
    {
        if (is_array($content) || is_object($content)) {
            $this->content = json_encode($content);
            $this->header('Content-Type', 'application/json');
        } else {
            $this->content = $content;
        }
    }

    public function content()
    {
        return $this->content;
    }
}