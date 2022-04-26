<?php

require_once("../includes/session.php");
require_once("../includes/config.php");
require_once("../includes/bd.php");
require_once("../includes/funcoes.php");
require_once("../includes/fabricantes.php");

$template = html_template(TPL_INTERNA);
$tbl_fabricantes = html_table_fabricantes();
$template = str_replace("<!--conteudo-->", $tbl_fabricantes, $template);

echo $template;

?>
