<?php

require_once("../includes/config.php");
require_once("../includes/bd.php");
require_once("../includes/funcoes.php");

$template = html_template(TPL_INTERNA);
//$formulario = file_get_contents(TPL_FORM_AUTENTICACAO);
$template = str_replace("<!--conteudo-->", "Seja bem-vindo", $template);

echo $template;

?>
