<?php


class Pharmacist {
    use Model;

    protected $table = "pharmacists";

    protected $Allowedcolumns = [
        'pharmacist_id',
        'slmcNo'
        
        
    ];

    public function findAlldata()
    {

        $query = "SELECT u.*, p.*
                  FROM users u
                  INNER JOIN pharmacists p ON u.user_id = p.pharmacist_id;";

        return $this->query($query);
    }

    
    public function searchPharmacists($searchTerm) {
        $query = "SELECT u.*, p.*
                  FROM users u
                  INNER JOIN pharmacists p ON u.user_id = p.pharmacist_id
                  WHERE u.firstName LIKE :term 
                     OR u.lastName LIKE :term 
                     OR p.slmcNo LIKE :term";
        $data = ['term' => "%$searchTerm%"];
        return $this->query($query, $data);
    }

    public function getPharmacistsCount() {
        $query = "SELECT COUNT(*) AS pharmacists_count FROM pharmacists;";
        $result = $this->query($query);
        return $result[0]['pharmacists_count'] ?? 0;
    }

}