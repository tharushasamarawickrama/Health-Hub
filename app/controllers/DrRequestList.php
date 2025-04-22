<?php

class DrRequestList  {
    use Controller;
    public function index(){
        
        $dr_request=new dr_request;
        $data=$dr_request->findAlldata();
        
        
        $this->view('DrRequestList',$data);
    }

    public function delete(){
        $id=$_GET['id'];
        $dr_request=new dr_request;
        
        if($dr_request->delete($id,$id_column='req_id') ){
            redirect('DrRequestList');
            
        }
        
        

    }
    
}


?>