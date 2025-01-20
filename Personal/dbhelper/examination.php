<?php

class Examination {
    private $conn;
    private $table_name = "muayenekayit";

    public $id;
    public $worker_id;
    public $examination_date;
    public $examination_type_id;
    public $results;
    public $add_date;
    public $update_date_time;
    public $is_active;

    public $db;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->mysqli; 
    }

    public function readAll() {
        $query = "SELECT mk.Id, mk.WorkerId, mk.ExaminationDate, mt.TypeName AS ExaminationTypeId, mk.Results, mk.AddDate, mk.UpdateDateTime, c.Name, c.Surname 
                  FROM " . $this->table_name . " mk 
                  JOIN calisanlar c ON mk.WorkerId = c.Id 
                  JOIN muayene_turleri mt ON mk.ExaminationTypeId = mt.Id 
                  WHERE mk.IsActive = 1";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $result = $stmt->get_result(); 
        
        return $result;
    }

    public function readOne($id) {
        $query = "SELECT mk.Id, mk.WorkerId, mk.ExaminationDate, mk.ExaminationTypeId, mk.Results, mk.AddDate, mk.UpdateDateTime, c.Name, c.Surname 
                  FROM " . $this->table_name . " mk 
                  JOIN calisanlar c ON mk.WorkerId = c.Id 
                  WHERE mk.Id = ? LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $stmt->close();
        
        return $result;
    }

    public function update($id, $workerId, $examinationDate, $examinationTypeId, $results) {
        $query = "UPDATE muayenekayit SET WorkerId = ?, ExaminationDate = ?, ExaminationTypeId = ?, Results = ?, UpdateDateTime = NOW() WHERE Id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isssi", $workerId, $examinationDate, $examinationTypeId, $results, $id);
    
        return $stmt->execute();
    }

    public function create($worker_id, $examination_date, $examination_type_id, $results) {
        $query = "INSERT INTO " . $this->table_name . " (WorkerId, ExaminationDate, ExaminationTypeId, Results, AddDate, UpdateDateTime, IsActive) 
                  VALUES (?, ?, ?, ?, NOW(), NOW(), 1)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isss", $worker_id, $examination_date, $examination_type_id, $results);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "UPDATE muayenekayit SET IsActive = 0 WHERE Id = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            echo "SQL prepare error: " . $this->conn->error;
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;  
        } else {
            return false;
        }
    }

    public function getAllWorkers() {
        $query = "SELECT Id, Name, Surname FROM calisanlar WHERE IsActive = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getAllExaminationTypes() {
        $query = "SELECT Id, TypeName FROM muayene_turleri";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
