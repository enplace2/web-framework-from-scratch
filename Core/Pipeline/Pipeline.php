<?php
namespace Core\Pipeline;
use Closure;

class Pipeline
{
    private Closure $target;
    private array $pipes;

    private mixed $result = "";

    public function run(Closure $target): static
    {
        $this->target = $target;
        return $this;
    }

    public function through(array $pipes): static
    {
        $this->pipes = $pipes;
        return $this;
    }

    public function send(): static
    {
        $stack = $this->buildPipeline();
        $this->result =  $stack();
        return $this;
    }

    public function buildPipeline(): Closure
    {
        $stack = $this->target;
        foreach (array_reverse($this->pipes) as $pipe) {
            $stack = function () use ($pipe, $stack) {
                (new $pipe())->handle($stack);
            };
        }
        return $stack;
    }

    public function then(Closure $handler)
    {
        return $handler($this->result);
    }
}