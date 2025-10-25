<?php
session_start();

//Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: index.php');
    exit;
}

//Determine which page to show
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

//Whitelist of allowed pages (security)
$allowedPages = [
    'home',
    'pets',
    'login',
    'createListing',
    'editPet',
    'reportSighting',
    'viewSightings',
    'about'
];

//Load shared controller
require_once 'Controllers/PetController.php';
$petController = new PetController();
$view = new stdClass();

//routing (swtich-case)
switch ($page) {
    case 'login':
        require_once 'Controllers/LoginController.php';
        $controller = new LoginController();
        $view->message = $controller->message ?? null;
        require_once 'Views/login.phtml';
        break;

    case 'createListing':
        require_once 'Controllers/CreateListingController.php';
        $controller = new CreateListingController();
        $view->message = $controller->message ?? null;
        require_once 'Views/createListing.phtml';
        break;

    case 'home':
        require_once 'Controllers/PetController.php';
        $petController = new PetController();
        $view = new stdClass();
        $view->recentPets = $petController->getRecentPets(3); // latest 3 pets
        require_once 'Views/home.phtml';
        break;

    case 'pets':
        $view->petsDataSet = $petController->petsDataSet;
        require_once 'Views/pets.phtml';
        break;

    case 'editPet':
        require_once 'Controllers/EditPetController.php';
        $controller = new EditPetController();
        $view->petData = $controller->petData ?? null;
        $view->message = $controller->message ?? null;
        require_once 'Views/editPet.phtml';
        break;


    case 'deletePet':
        require_once 'Controllers/DeletePetController.php';
        $controller = new DeletePetController();
        $view->message = $controller->message ?? null;
        require_once 'Views/pets.phtml';
        break;

    case 'reportSighting':
        require_once 'Controllers/ReportSightingController.php';
        $controller = new ReportSightingController();
        $view->message = $controller->message ?? null;
        require_once 'Views/reportSighting.phtml';
        break;

    case 'viewSightings':
        require_once 'Controllers/ViewSightingsController.php';
        $controller = new ViewSightingsController();
        $view->sightingsDataSet = $controller->sightingsDataSet;
        require_once 'Views/viewSightings.phtml';
        break;

    case 'about':
        require_once 'Views/about.phtml';
        break;

    case 'manageListings':
        require_once 'Controllers/ManageListingsController.php';
        new ManageListingsController();
        break;

    case 'editSighting':
        require_once 'Controllers/EditSightingController.php';
        new EditSightingController();
        break;

    case 'deleteSighting':
        require_once 'Controllers/DeleteSightingController.php';
        new DeleteSightingController();
        break;

    case 'manageSightings':
        require_once 'Controllers/ManageSightingsController.php';
        $controller = new ManageSightingsController();
        break;

    case 'sightings':
        require_once 'Controllers/SightingsController.php';
        $controller = new SightingsController();
        break;

}
?>
