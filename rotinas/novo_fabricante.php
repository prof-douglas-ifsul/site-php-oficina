<?php

require_once("../includes/config.php");
require_once("../includes/bd.php");
require_once("../includes/funcoes.php");

$template = html_template(TPL_INTERNA);
$formulario = file_get_contents(TPL_FORM_FABRICANTES);
$template = str_replace("<!--conteudo-->", $formulario, $template);

echo $template;

?>
