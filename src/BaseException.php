<?php
namespace Kirugan\VKApi;

class BaseException extends \Exception
{
    private $params;

    public function setRequestParams(array $params)
    {
        $this->params = $params;
    }

    public function getRequestParams()
    {
        return $this->params;
    }
}