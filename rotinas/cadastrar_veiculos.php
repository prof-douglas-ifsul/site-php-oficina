<?php

require_once("../includes/config.php");
require_once("../includes/bd.php");
require_once("../includes/fabricantes.php");
require_once("../includes/funcoes.php");

$fabricantes = bd_select_fabricantes();

$modelos = [
	["Fiat", ["palio", "Palio"]]
	,["Fiat", ["cronos", "Cronos"]]
	,["VW", ["nivus", "Nivus"]]
	,["VW", ["fusca", "Fusca"]]
	,["GM", ["cobalt", "Cobalt"]]
	,["GM", ["onix", "Onix"]]
	,["Hyundai", ["hb20", "Hyundai HB20"]]
	,["Hyundai", ["i30", "Hyundai i30"]]
	,["Honda", ["civic", "Honda Civic"]]
	,["Honda", ["fit", "Honda Fit"]]
];

$template = file_get_contents(TPL_HOME);

$formulario = file_get_contents(TPL_FORM_VEICULOS);
$formulario = str_replace("<!--campo_select_fabricante-->", html_campo_select_fabricante($fabricantes), $formulario);
$formulario = str_replace("<!--campo_select_modelo-->", campo_select_modelo($modelos), $formulario);

$template = str_replace("<!--conteudo-->", $formulario, $template);

echo $template;

?>
