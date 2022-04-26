<?php

require_once("../includes/session.php");
require_once("../includes/config.php");
require_once("../includes/bd.php");
require_once("../includes/fabricantes.php");

$id = $_GET['id'];

bd_delete_fabricante($id);

// encaminha para lista de fabricantes
header("Location: lista_fabricantes.php");

?>
