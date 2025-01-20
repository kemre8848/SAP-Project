<?php

class Certificate extends Database{
    private $table_name = "sertifikalar";

    public function getAllWorkers() {
        $query = "SELECT Id, Name, Surname FROM calisanlar WHERE IsActive = 1";
        $result = $this->mysqli->query($query);
        return $result;
    }

    public function getAllCertificateTypes() {
        $query = "SELECT Id, CertificateName FROM sertifikaturleri";
        $result = $this->mysqli->query($query);
        return $result;
    }

    public function createCertificate($workerId, $certificateNameId) {
        $addDate = date('Y-m-d H:i:s');
        $updateDateTime = $addDate;

        $query = "INSERT INTO $this->table_name (WorkerId, CertificateNameId, AddDate, UpdateDateTime, IsActive) 
                  VALUES (?, ?, ?, ?, 1)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiss", $workerId, $certificateNameId, $addDate, $updateDateTime);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllCertificates() {
        $query = "SELECT s.Id, c.Name, c.Surname, st.CertificateName, s.AddDate, s.UpdateDateTime 
        FROM sertifikalar s 
        JOIN calisanlar c ON s.WorkerId = c.Id 
        JOIN sertifikaturleri st ON s.CertificateNameId = st.Id 
        WHERE s.IsActive = 1";
        $result = $this->mysqli->query($query);
        return $result;
    }

    public function getAllCertificatesK() {
        $query = "SELECT s.Id, c.Name, c.Surname, st.CertificateName, s.AddDate, s.UpdateDateTime 
                  FROM sertifikalar s 
                  JOIN calisanlar c ON s.WorkerId = c.Id 
                  JOIN sertifikaturleri st ON s.CertificateNameId = st.Id 
                  WHERE s.IsActive = 1 AND c.TitleId = 2";
        $result = $this->mysqli->query($query);
        return $result;
    }

    public function getCertificateById($id) {
        $query = "SELECT s.Id, s.WorkerId, s.CertificateNameId,st.CertificateName, s.AddDate, s.UpdateDateTime, c.Name, c.Surname 
                  FROM $this->table_name s 
                  JOIN calisanlar c ON s.WorkerId = c.Id
                  JOIN sertifikaturleri st ON s.CertificateNameId = st.Id  
                  WHERE s.Id = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $certificate = $result->fetch_assoc();
            return $certificate;
        } else {
            return null;
        }
    }

    public function updateCertificate($id, $workerId, $certificateNameId) {
        $updateDateTime = date('Y-m-d H:i:s');

        $query = "UPDATE $this->table_name SET WorkerId=?, CertificateNameId=?, UpdateDateTime=? WHERE Id=?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("iisi", $workerId, $certificateNameId, $updateDateTime, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCertificate($id) {
        $query = "UPDATE $this->table_name SET IsActive = 0 WHERE Id = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
