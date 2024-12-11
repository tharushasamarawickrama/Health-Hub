<?php

class ViewAllRecepProfile  {
    use Controller;
    public function index(){
        
        $receptionist=new Receptionist;
        $data=$receptionist->findAlldata();
        // print_r($data[0]['firstName']);
        foreach ($data as &$key) { // Use reference to modify the original array
            $user = new User();
            $arr['user_id'] = $key['user_id'];
            $data1 = $user->first($arr);
            
            if ($data1) { // Check if user data is found
                $key = array_merge($key, $data1); // Merge data1 into key
            }
        }
        unset($key);

        $this->view('ViewAllRecepProfile',$data);
    }

    public function delete(){
        $id=$_GET['id'];
        $receptionist=new Receptionist;
        if($receptionist->delete($id,$id_column='receptionist_id')){
            redirect('ViewAllRecepProfile');
        }

    }
    
}


?>