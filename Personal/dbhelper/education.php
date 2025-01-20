<?php
class Education {
    private $conn;
    private $table_name = "egitimler";
    
    public function __construct($db) {
        $this->conn = $db;
    }
    

    public function createEducation($workerId, $educationId, $educationDate) {
        $addDate = date('Y-m-d H:i:s');
        $updateDateTime = $addDate;
        $isActive = 1;

        $query = "INSERT INTO " . $this->table_name . " (WorkerId, EducationId, EducationDate, AddDate, UpdateDateTime, IsActive) 
                  VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iisssi", $workerId, $educationId, $educationDate, $addDate, $updateDateTime, $isActive);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllEducations() {
        $query = "SELECT eg.Id, eg.WorkerId, eg.EducationId, eg.EducationDate, eg.AddDate, eg.UpdateDateTime, 
                         c.Name, c.Surname, et.EducationName 
                  FROM " . $this->table_name . " eg 
                  JOIN calisanlar c ON eg.WorkerId = c.Id 
                  JOIN egitimturleri et ON eg.EducationId = et.Id 
                  WHERE eg.IsActive = 1";

        $result = $this->conn->query($query);
        return $result;
    }

    public function getEducationById($id) {
        $query = "SELECT eg.Id, eg.WorkerId, eg.EducationId, eg.EducationDate, eg.UpdateDateTime, 
                         c.Name, c.Surname, et.EducationName 
                  FROM " . $this->table_name . " eg 
                  JOIN calisanlar c ON eg.WorkerId = c.Id 
                  JOIN egitimturleri et ON eg.EducationId = et.Id 
                  WHERE eg.Id = ? AND eg.IsActive = 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateEducation($id, $workerId, $educationId, $educationDate) {
        $updateDateTime = date('Y-m-d H:i:s');

        $query = "UPDATE " . $this->table_name . " 
                  SET WorkerId = ?, EducationId = ?, EducationDate = ?, UpdateDateTime = ? 
                  WHERE Id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iissi", $workerId, $educationId, $educationDate, $updateDateTime, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEducation($id) {
        $query = "UPDATE " . $this->table_name . " 
                  SET IsActive = 0 
                  WHERE Id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllWorkers() {
        $query = "SELECT Id, Name, Surname 
                  FROM calisanlar 
                  WHERE TitleId = 2 AND IsActive = 1";
        $result = $this->conn->query($query);
        return $result;
    }

    public function getAllEducationTypes() {
        $query = "SELECT Id, EducationName 
                  FROM egitimturleri";
        $result = $this->conn->query($query);
        return $result;
    }
}
?>