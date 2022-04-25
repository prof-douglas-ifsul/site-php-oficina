<?php

// Inicia uma nova sessão ou resume uma sessão existente
session_start();

// verifica se a sessão para usuario 
// não está configurada - ou deixou de existir
if (!isset($_SESSION['usuario']))
{
	session_destroy();
	header("Location: logout.php");
}

?>