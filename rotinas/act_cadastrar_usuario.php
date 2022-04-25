<?php

require_once("../includes/config.php");
require_once("../includes/bd.php");
require_once("../includes/usuarios.php");


// primeiro sanitiza / limpa
$nome = filter_var(trim($_POST['nome']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$senha = filter_var(trim($_POST['senha']), FILTER_SANITIZE_STRING);
$confsenha = filter_var(trim($_POST['confsenha']), FILTER_SANITIZE_STRING);

// e entao valida - email
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

// operador === verifica valor e tipo 
// no caso é buscado saber se o filter_var falhou em algum dos parametros
if ($email === false || $senha === false) 
{
	die("Parâmetros esperados não fornecidos");
}

if ($senha !== $confsenha) 
{
	die("Falha na confirmação de senha");
}

// array - vazio se nao existe email cadastrado
$usuario = bd_verifica_email_jaexiste($email);
if (count($usuario) > 0) {
	die("Este e-mail já está cadastrado");
} 

// cadastra novo usuario
bd_insert_usuario($nome, $email, $senha);

// encaminha para login
header("Location: autenticacao.php");

?>
