<?php
require_once 'Models/PetDataSet.php';

//Handles displaying and filtering pets

class PetController {
    public $petsDataSet;

    public function __construct() {
        $dataSet = new PetDataSet();

        //Filters and Sorting
        $keyword = $_GET['search'] ?? '';
        $status = $_GET['status'] ?? '';
        $type = $_GET['type'] ?? '';
        $minAge = $_GET['minAge'] ?? '';
        $maxAge = $_GET['maxAge'] ?? '';
        $sort = $_GET['sort'] ?? 'dateAdded DESC';

        //Pagination - only 10 listings per page
        $page = isset($_GET['pageNum']) ? (int)$_GET['pageNum'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $this->petsDataSet = $dataSet->searchPets($keyword, $status, $type, $minAge, $maxAge, $limit, $offset, $sort);
    }

    //Get latest pets (for homepage)
    public function getRecentPets($limit = 3) {
        $dataSet = new PetDataSet();
        return $dataSet->getRecentPets($limit);
    }
}
?>
