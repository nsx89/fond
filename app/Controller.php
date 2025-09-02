<?php

namespace app;

abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function access(): bool
    {
        return true;
    }

    public function __invoke(...$params)
    {
        if ($this->access()) {
            $this->handle(...$params);
        }
        else {
            die('Нет доступа');
        }

        return true;
    }

    abstract protected function handle(...$params);
}
