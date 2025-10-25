<?php
require_once 'Database.php';

class AssignmentDataSet
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // 🔹 Get all assignments (sorted by date)
    public function getAllAssignments()
    {
        $sql = 'SELECT * FROM assignments ORDER BY due_date ASC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Add a new assignment (with optional brief)
    public function addAssignment($module, $title, $description, $due_date, $status = 'To Do', $brief = null)
    {
        $sql = 'INSERT INTO assignments (module, title, description, due_date, status, brief)
                VALUES (:module, :title, :description, :due_date, :status, :brief)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':module' => $module,
            ':title' => $title,
            ':description' => $description,
            ':due_date' => $due_date,
            ':status' => $status,
            ':brief' => $brief
        ]);
    }

    // 🔹 Get one assignment by ID
    public function getAssignmentById($id)
    {
        $sql = 'SELECT * FROM assignments WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Update assignment (with optional brief)
    public function updateAssignment($id, $module, $title, $description, $due_date, $status, $brief = null)
    {
        $sql = 'UPDATE assignments 
                SET module = :module, title = :title, description = :description,
                    due_date = :due_date, status = :status, brief = :brief
                WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':module' => $module,
            ':title' => $title,
            ':description' => $description,
            ':due_date' => $due_date,
            ':status' => $status,
            ':brief' => $brief,
            ':id' => $id
        ]);
    }

    // 🔹 Delete assignment
    public function deleteAssignment($id)
    {
        $sql = 'DELETE FROM assignments WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}