<?php

trait Controller
{
    public function view($name, $data = [],$data2=[])
    {
        if(!empty($data))
            extract($data);
        
        if(!empty($data2))
            extract($data2);

        // if(!empty($data2)){
        //     $seconddata = $data2;
        // }
        

        $filename = "../app/views/" . $name . ".view.php";
        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename = "../app/views/404.view.php";
            require $filename;
        }
    }

    
}
