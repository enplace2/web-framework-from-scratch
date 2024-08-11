<?php

use Core\Response\Response;

/**
 * A global function for interacting with the Response class
 * @param $content
 * @param int $status
 * @param array $headers
 * @return Response
 */
function response($content = '', int $status = 200, array $headers = []): Response
{
    return new Response($content, $status, $headers);
}