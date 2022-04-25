<?php 

// insere usuario
function bd_insert_usuario($nome, $email, $senha, $admin = 0) {
	global $conn;

	// senha codificada
	$hash_senha = hash("sha256", $senha, false);
	try {
		$sql = "
		insert into usuarios 
			(nome, email, senha, admin) 
		values
			(:nome, :email, :hash_senha, :admin)
		";
		$stmt = $conn->prepare($sql);
		// referencias pdo_param e outras constantes pdo
		// https://www.php.net/manual/pt_BR/pdo.constants.php
		$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':hash_senha', $hash_senha, PDO::PARAM_STR);
		$stmt->bindParam(':admin', $admin, PDO::PARAM_INT);
		$stmt->execute();

	} catch(PDOException $e) {
		die( 'ERROR: ' . $e->getMessage());
	}

}

function bd_verifica_email_senha($email, $senha) {
	global $conn;

	// senha codificada
	$hash_senha = hash("sha256", $senha, false);
	try {
		// referencia sha256/php
		// usar sha2/256 no php permite não variar a forma de 
		// verificar a senha com a criptografica com diferentes bancos
		// https://www.php.net/manual/pt_BR/function.hash.php
		$sql = "
		SELECT idusuario 
		FROM usuarios 
		where 
			email = :email 
			and senha = :senha";
		$stmt = $conn->prepare($sql);
		// referencias pdo_param e outras constantes pdo
		// https://www.php.net/manual/pt_BR/pdo.constants.php
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':senha', $hash_senha, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();

	} catch(PDOException $e) {
		die( 'ERROR: ' . $e->getMessage());
	}

}

// busca usuario por email para ver se email ja nao é usado
function bd_verifica_email_jaexiste($email) {
	global $conn;

	try {
		$sql = "
		SELECT idusuario 
		FROM usuarios 
		where 
			email = :email";
		$stmt = $conn->prepare($sql);
		// referencias pdo_param e outras constantes pdo
		// https://www.php.net/manual/pt_BR/pdo.constants.php
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();

	} catch(PDOException $e) {
		die( 'ERROR: ' . $e->getMessage());
	}

}

?>