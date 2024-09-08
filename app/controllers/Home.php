<?php

class Home extends Controller{
    public function index(){
        echo "This is Home Controller";
        $this->view('home');
    }
}

