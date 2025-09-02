<?php

namespace app;

class Config
{
    public $data;

    public function __construct()
    {
        $this->data = include ROOT . '/config.php';
    }
}
