<?php
require_once('Models/SightingsDataSet.php');

//Displays ALL reported pet sightings

class SightingsController {
    public $view;

    public function __construct() {
        $this->view = new stdClass();
        $this->view->pageTitle = 'All Sightings';

        //default sort order is by date listed
        $sort = $_GET['sort'] ?? 'dateReported DESC';

        $sightingsDataSet = new SightingsDataSet();
        $this->view->sightingsDataSet = $sightingsDataSet->fetchAllSightings($sort);

        //Load view for view file
        $view = $this->view;
        require_once('Views/sightings.phtml');
    }
}
?>