<?php
session_start();

require_once 'Controllers/AssignmentController.php';

$controller = new AssignmentController();

// Determine what action to perform
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'add':
        $controller->add();
        break;

    case 'edit':
        if ($id) {
            $controller->edit($id);
        } else {
            header('Location: index.php');
        }
        break;

    case 'delete':
        if ($id) {
            $controller->delete($id);
        } else {
            header('Location: index.php');
        }
        break;

    default:
        $controller->index();
        break;
}