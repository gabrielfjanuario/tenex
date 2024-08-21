<?php
require_once __DIR__.'/../Helpers/Utils.php';

class BaseController
{
    protected function view(array $res =[])
    {
        header('Content-Type: application/json');
        echo json_encode($res);
        return;
    }

    protected function error(string $message, int $httpCode = 400)
    {
        http_response_code($httpCode);
        echo json_encode(['message' => $message]);
        return;
    }
}
