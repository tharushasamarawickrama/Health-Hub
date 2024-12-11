<?php

class ViewAllPharmProfile  {
    use Controller;
    public function index(){
       
        $pharmacist=new Pharmacist;
        $data=$pharmacist->findAlldata();
        
        foreach ($data as &$key) { // Use reference to modify the original array
            $user = new User();
            $arr['user_id'] = $key['user_id'];
            $data1 = $user->first($arr);
            
            if ($data1) { // Check if user data is found
                $key = array_merge($key, $data1); // Merge data1 into key
            }
        }
        unset($key);

        $this->view('ViewAllPharmProfile',$data);
    }

    public function delete(){
        $id=$_GET['id'];
        $pharmacist=new Pharmacist;
        if($pharmacist->delete($id,$id_column='pharmacist_id')){
            redirect('ViewAllPharmProfile');
        }

    }
    
}


?>