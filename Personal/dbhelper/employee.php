<?php

class Employee {
    public $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getDepartments() {
        $query = "SELECT Id, Name FROM departmanlar";
        return $this->db->query($query);
    }

    public function getTitles() {
        $query = "SELECT Id, TitleName FROM titles";
        return $this->db->query($query);
    }

    public function getEmployees() {
        $query = "SELECT calisanlar.Id, calisanlar.Name, calisanlar.Surname, calisanlar.Birthday, calisanlar.TitleId, calisanlar.PhoneNo, calisanlar.AddDate, calisanlar.UpdateDateTime, titles.TitleName AS TitleName, departmanlar.Name AS DepartmentName 
                  FROM calisanlar 
                  JOIN titles ON calisanlar.TitleId = titles.Id 
                  JOIN departmanlar ON calisanlar.DepartmentId = departmanlar.Id
                  WHERE calisanlar.IsActive = 1";
        return $this->db->query($query);
    }

    public function getEmployeeById($id) {
        $query = "SELECT * FROM calisanlar WHERE Id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id); 
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addEmployee($name, $surname, $birthday, $titleId, $departmentId, $phoneNo) {
        $query = "INSERT INTO calisanlar (Name, Surname, Birthday, TitleId, DepartmentId, PhoneNo, AddDate, UpdateDateTime) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssisi", $name, $surname, $birthday, $titleId, $departmentId, $phoneNo);
        return $stmt->execute();
    }

    public function updateEmployee($id, $name, $surname, $birthday, $titleId, $departmentId, $phoneNo) {
        $query = "UPDATE calisanlar SET Name = ?, Surname = ?, Birthday = ?, TitleId = ?, DepartmentId = ?, PhoneNo = ?, UpdateDateTime = NOW() WHERE Id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssissi", $name, $surname, $birthday, $titleId, $departmentId, $phoneNo, $id);
        return $stmt->execute();
    }

    public function deleteEmployee($id) {
        $query = "UPDATE calisanlar SET IsActive = 0 WHERE Id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>

