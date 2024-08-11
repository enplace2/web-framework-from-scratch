<?php

use Core\Response\Response;

function response($content = '', int $status = 200, array $headers = []): Response
{
    return new Response($content, $status, $headers);
}