<?php
require_once("../includes/config.php");
require_once("../includes/funcoes.php");
$template = file_get_contents(TPL_HOME);
$formulario = file_get_contents(TPL_FORM_SERVICOS);
$formulario = str_replace("<!--campo_textarea_resumo-->", campo_textarea("resumo_do_servico", "resumo_do_servico", $texto = "", $linhas = 4, $colunas = 20), $formulario);
$template = str_replace("<!--conteudo-->", $formulario, $template);
echo $template;
?>
