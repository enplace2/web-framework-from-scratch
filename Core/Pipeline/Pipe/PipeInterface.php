<?php

namespace Core\Pipeline\Pipe;

use Closure;

interface PipeInterface
{
    public function handle(Closure $next);
}