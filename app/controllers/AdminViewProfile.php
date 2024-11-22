<?php

class AdminViewProfile{
    use Controller;
    public function index(){
        // echo "This is Home Controller";
        

        $this->view('AdminViewProfile');
    }
    
}