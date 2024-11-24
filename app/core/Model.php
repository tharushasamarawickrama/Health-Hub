<?php

trait Model {
    use Database;
    // protected $table = 'users';
    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "desc";
    protected $order_column = "id";
    public $errors = [];

    public function findAll(){
       
        $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
       
        return $this->query($query);
    } 
    public function where($data, $data_not=[]){
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        foreach($keys as $key){
            $query .= $key . " = :" .$key . " && ";
        }
        foreach($keys_not as $key){
            $query .= $key . " != :" .$key . " && ";
        }

        $query = trim($query, " && ");
        $query .= "order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
        $data = array_merge($data,$data_not);
        return $this->query($query, $data);
    } 
    public function first($data, $data_not=[]){
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        foreach($keys as $key){
            $query .= $key . " = :" .$key . " && ";
        }
        foreach($keys_not as $key){
            $query .= $key . " != :" .$key . " && ";
        }

        $query = trim($query, " && ");
        $query .= " limit $this->limit offset $this->offset";
        $data = array_merge($data,$data_not);
        $result=  $this->query($query, $data);
        if($result)
            return $result[0];
        return false;
    } 
    // public function insert($data){

    //     if(!empty($this->Allowedcolumns)){
    //         foreach($data as $key => $value){
    //             if(!in_array($key,$this->Allowedcolumns)){
    //                 unset($data[$key]);
    //             }
    //         }
    //     }
    //     $keys = array_keys($data);
    //     $query = "insert into  $this->table (".implode(",",$keys).") values(:".implode(",:",$keys).")";
        
    //     $this->query($query, $data);
    //     return false;

    // }  

    public function insert($data) {
        // Check if prescription_id exists in the prescriptions table
        if (isset($data['prescription_id'])) {
            $prescriptionId = $data['prescription_id'];
    
            // Query to check if the prescription_id exists
            $query = "SELECT COUNT(*) as count FROM prescriptions WHERE prescription_id = :prescription_id";
            $result = $this->query($query, ['prescription_id' => $prescriptionId]);
    
            // If the prescription_id doesn't exist, return false
            if ($result && $result[0]['count'] == 0) {
                $this->errors[] = "Invalid prescription_id: $prescriptionId does not exist.";
                
                return false; // Stop the insert operation if the prescription_id is invalid
            }
        }
    
        // Proceed with the insert if prescription_id is valid
        if (!empty($this->Allowedcolumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->Allowedcolumns)) {
                    unset($data[$key]);
                }
            }
        }
    
        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (" . implode(",", $keys) . ") VALUES (:" . implode(", :", $keys) . ")";
        
        return $this->query($query, $data);
    }
    

    public function update($id, $data, $id_column = 'id') {
        // Filter out any keys that are not in Allowedcolumns
        if (!empty($this->Allowedcolumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->Allowedcolumns)) {
                    unset($data[$key]);
                }
            }
        }
    
        // Get the keys of the data array
        $keys = array_keys($data);
    
        // Build the update query dynamically
        $query = "UPDATE $this->table SET ";
        foreach ($keys as $key) {
            $query .= $key . " = :$key, ";
        }
    
        // Trim the trailing comma and add WHERE clause
        $query = rtrim($query, ", ");
        $query .= " WHERE $id_column = :$id_column";
    
        // Add the id to the data array for the WHERE condition
        $data[$id_column] = $id;
    
        // Execute the query
        return $this->query($query, $data);
    }
    

    public function delete($id, $id_column = 'id'){
       $data[$id_column] = $id;
       
        $query = "delete from $this->table where $id_column = :$id_column";
        
        $this->query($query, $data);
        return false;
    } 
}