<?php 

$bd_host = "localhost";
$sgbd = "sqlite";
$base_de_dados = "oficina";
$bd_usuario = "";
$bd_senha = "";

switch ($sgbd) {
    case "mysql":
		try {
			$dsn_mysql = "mysql:host=".$bd_host.";dbname=".$base_de_dados;
			$conn = new PDO($dsn_mysql, $bd_usuario, $bd_senha);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			die('ERROR: ' . $e->getMessage());
		}
        break;
    case "pgsql":
		try {
			$dsn_pgsql = "pgsql:host=$bd_host;port=5432;dbname=$base_de_dados;";
			// make a database connection
			$conn = new PDO(
				$dsn_pgsql,
				$bd_usuario,
				$bd_senha,
				[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
			);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
        break;
    case "sqlite":

		$conn = new PDO('sqlite:../sqlite/oficina.db');
		// Set errormode to exceptions
		$conn->setAttribute(PDO::ATTR_ERRMODE, 
									PDO::ERRMODE_EXCEPTION);
							
        break;
}

?>