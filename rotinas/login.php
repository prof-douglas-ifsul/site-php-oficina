<?php

require_once("../includes/config.php");
require_once("../includes/bd.php");
require_once("../includes/usuarios.php");

// referencia sanitização de variaveis em php
// https://www.php.net/manual/pt_BR/filter.examples.sanitization.php
// filter_var retorna o valor limpo ou false

// primeiro sanitiza / limpa
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$senha = filter_var(trim($_POST['senha']), FILTER_SANITIZE_STRING);

// e entao valida - email
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

// operador === verifica valor e tipo 
// no caso é buscado saber se o filter_var falhou em algum dos parametros
if ($email === false || $senha === false) {
	die("Parâmetros esperados não fornecidos");
}

// array - vazio se nao correspondem email e senha
$usuario = bd_verifica_email_senha($email, $senha);

if (count($usuario) > 0) {
	header("Location: inicial.php");
} else {
	header("Location: autenticacao.php");
}

?>
