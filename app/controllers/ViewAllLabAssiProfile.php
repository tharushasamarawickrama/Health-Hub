<?php

class ViewAllLabAssiProfile  {
    use Controller;
    public function index(){
        
        $labassistant=new LabAssistant;
        $data=$labassistant->findAlldata();
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
        $this->view('ViewAllLabAssiProfile',$data);
    }
    public function delete(){
        $id=$_GET['id'];
        $labassistant=new LabAssistant;
        if($labassistant->delete($id,$id_column='lab_assistant_id')){
            redirect('ViewAllLabAssiProfile');
        }

    }
    
}


?>