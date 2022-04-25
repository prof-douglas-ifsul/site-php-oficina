<?php

require_once("../includes/config.php");
require_once("../includes/bd.php");
require_once("../includes/fabricantes.php");


// primeiro sanitiza / limpa
$nome_curto = filter_var(trim($_POST['nome_curto']), FILTER_SANITIZE_STRING);
$nome = filter_var(trim($_POST['nome']), FILTER_SANITIZE_STRING);

// cadastra novo fabricante
echo bd_insert_fabricante($nome_curto, $nome);

// encaminha para lista de fabricantes
header("Location: lista_fabricantes.php");

?>
