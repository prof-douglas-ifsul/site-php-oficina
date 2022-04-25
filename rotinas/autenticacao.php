<?php

require_once("../includes/config.php");
require_once("../includes/bd.php");
require_once("../includes/funcoes.php");

$template = html_template(TPL_EXTERNA);
$formulario = file_get_contents(TPL_FORM_AUTENTICACAO);
$formulario = str_replace("<!--formulario_usuario-->", "Autenticação", $formulario);
$formulario = str_replace("--form_acao--", "action=\"login.php\"", $formulario);
$template = str_replace("<!--conteudo-->", $formulario, $template);

echo $template;

?>
