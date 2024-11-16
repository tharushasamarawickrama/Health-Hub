<?php

class Channel {
    use Controller;
    public function index(){
        // echo "This is Home Controller";
        $this->view('channel');
    }
    
}