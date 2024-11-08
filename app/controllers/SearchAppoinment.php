<?php

class SearchAppoinment {
    use Controller;
    public function index(){
        // echo "This is Home Controller";
        $this->view('searchappoinment');
    }
    
}