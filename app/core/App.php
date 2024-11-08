<?php

class App
{
    private $controller = 'Home';
    private $method = 'index';

    private function SplitURL()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode('/', $URL);
        return $URL;
    }

    public function LoadController()
    {
        $URL = $this->SplitURL();

        $filename = "../app/controllers/" . ucfirst($URL[0]) . ".php";
        if (file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($URL[0]);
        } else {
            $filename = "../app/controllers/" . ucfirst($URL[0])."/".ucfirst($URL[0]) . ".php";
            if (file_exists($filename)) {
                require $filename;
                $this->controller = ucfirst($URL[0]);
            } else {
                $filename = "../app/controllers/_404.php";
                require $filename;
                $this->controller = '_404';
            }
            
        }

        $this->controller = new $this->controller;
        call_user_func_array([$this->controller, $this->method], []);
    }
}
