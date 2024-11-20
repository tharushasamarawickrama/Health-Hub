<?php

class Home {
    use Controller;
    public function index(){
        $user = new User;
        //$arr['UserId'] = 1;
        // $arr['Title'] = "Mr";
        // $arr['FirstName'] = "Thisara";
        // $arr['LastName'] = "Perera";
        // $arr['Email'] = "kusal@gmail.com";
        // $arr['PhoneNumber'] = "0712781899";
        // $arr['Gender'] = "male";
        // $arr['NIC'] = "200612457895";
        // $arr['Password'] = "kusal1234";
        // $arr['Address'] = "colombo";
        // $arr['Age'] = "28";
        
        $result = $user->findAll();
        show($result);
        $this->view('home');
    }

    
    
}


