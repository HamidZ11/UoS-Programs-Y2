<?php
require_once 'Models/AssignmentDataSet.php';

class AssignmentController
{
    private $assignmentDataSet;

    public function __construct()
    {
        $this->assignmentDataSet = new AssignmentDataSet();
    }

    // 🔹 Show all assignments
    public function index()
    {
        $assignments = $this->assignmentDataSet->getAllAssignments();
        require 'Views/assignments.phtml';
    }

    // 🔹 Add new assignment
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $module = $_POST['module'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $due_date = $_POST['due_date'];
            $status = $_POST['status'];
            $briefPath = null;

            if (isset($_FILES['brief']) && $_FILES['brief']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = uniqid() . '_' . basename($_FILES['brief']['name']);
                $targetFile = $uploadDir . $fileName;
                move_uploaded_file($_FILES['brief']['tmp_name'], $targetFile);
                $briefPath = $targetFile;
            }

            $this->assignmentDataSet->addAssignment($module, $title, $description, $due_date, $status, $briefPath);
            header('Location: index.php');
            exit;
        } else {
            require 'Views/addAssignment.phtml';
        }
    }

    // 🔹 Edit existing assignment
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $module = $_POST['module'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $due_date = $_POST['due_date'];
            $status = $_POST['status'];
            $briefPath = null;

            if (isset($_FILES['brief']) && $_FILES['brief']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = uniqid() . '_' . basename($_FILES['brief']['name']);
                $targetFile = $uploadDir . $fileName;
                move_uploaded_file($_FILES['brief']['tmp_name'], $targetFile);
                $briefPath = $targetFile;
            }

            $this->assignmentDataSet->updateAssignment($id, $module, $title, $description, $due_date, $status, $briefPath);
            header('Location: index.php');
            exit;
        } else {
            $assignment = $this->assignmentDataSet->getAssignmentById($id);
            require 'Views/editAssignment.phtml';
        }
    }

    // 🔹 Delete assignment
    public function delete($id)
    {
        $this->assignmentDataSet->deleteAssignment($id);
        header('Location: index.php');
        exit;
    }
}