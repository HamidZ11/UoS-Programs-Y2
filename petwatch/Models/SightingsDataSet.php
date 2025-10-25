<?php
require_once 'Database/Database.php';

//Handles all DB queries related to pet sightings
class SightingsDataSet {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance(); //Connects to DB
    }

    // Fetch all sightings (for All Sightings page)
    public function fetchAllSightings($sort = 'dateReported DESC') {
        // Only allow these columns to prevent SQL injection
        $allowedSorts = ['dateReported DESC', 'dateReported ASC', 'petName ASC', 'petName DESC'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'dateReported DESC';
        }

        $sql = "SELECT s.*, 
                   p.name AS petName, 
                   u.username AS reporterName
            FROM sightings s
            LEFT JOIN pets p ON s.petID = p.petID
            LEFT JOIN users u ON s.userID = u.userID
            ORDER BY $sort";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Get all sightings created by a specific user
    public function getSightingsByUser($userID) {
        $sql = "SELECT s.*, p.name AS petName
                FROM sightings s
                LEFT JOIN pets p ON s.petID = p.petID
                WHERE s.userID = :userID
                ORDER BY s.dateReported DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>