<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Blog TW - Articolo";
$templateParams["nome"] = "singolo-articoli.php";
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["categorie"] = $dbh->getCategories();

$idArticolo = -1;
if(isset($_GET["id"])) {
    $idArticolo = $_GET["id"];
}
$templateParams["articolo"] = $dbh->getPostByID($idArticolo);

require("template/base.php");

?>