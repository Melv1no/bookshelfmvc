<link rel="stylesheet" href="assets/css/index.css">
<?php
/**
 * idnex.php page d'index
 * @author Melvin OLIVET
 * @since 16/04/2022
 */
require("controllers/controller.php");

if (isset($_GET["page"]) && !empty($_GET["page"])) {
    $page = htmlspecialchars($_GET["page"]);
    displayViews($page);
}
if (isset($_GET['action'])){
    actions();
}