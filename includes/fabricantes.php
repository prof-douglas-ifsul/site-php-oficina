<?php 

function bd_select_fabricantes($id = null) {
	global $conn;

	try {
		$sql = "SELECT * FROM fabricantes";
		if (!is_null($id)) {
			$sql .= " where idfabricante = :id";
		}
		$stmt = $conn->prepare($sql);
		if (!is_null($id)) {
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		}
		$stmt->execute();
		return $stmt->fetchAll();

	} catch(PDOException $e) {
		die( 'ERROR: ' . $e->getMessage());
	}

}

function bd_insert_fabricante($nome_curto, $nome) {
	global $conn;
	$id = 0;

	try {
		$sql = "INSERT INTO fabricantes (nome_curto, nome)";
		$sql .= "VALUES (:nome_curto, :nome)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':nome_curto', $nome_curto, PDO::PARAM_STR);
		$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
		$stmt->execute();
		return $conn->lastInsertId();

	} catch(PDOException $e) {
		die( 'ERROR: ' . $e->getMessage());
	}

}

function html_campo_select_fabricante($fabricantes) {

	$tmp = array();
	foreach($fabricantes as $fabricante) {
		$tmp[] = [strtolower($fabricante[0]), $fabricante[1]];
	}
	
	return campo_select("fabricante", "fabricante", $tmp, true, $tamanho = 1, $valores = array(), $extras = "onchange=\"sendRequest('teste', 'inicial.php');\"");

}

function html_table_fabricantes() {

	$html = "<h4>Lista de fabricantes</h4>\n";
	$html .= "<hr/>\n";

	if ($fabricantes = bd_select_fabricantes()) {
		$html .= "<TABLE>\n";
		$html .= "<TR>\n";
		$html .= "<TH>ID</TH>\n";
		$html .= "<TH>Nome Curto</TH>\n";
		$html .= "<TH>Nome</TH>\n";
		$html .= "<TH colspan=\"2\">Operações</TH>\n";
		$html .= "</TR>\n";
		foreach($fabricantes as $id => $fabricante) {
			$html .= "<TR>\n";
			$html .= "<TD>{$fabricante['idfabricante']}</TD>\n";
			$html .= "<TD>{$fabricante['nome_curto']}</TD>\n";
			$html .= "<TD>{$fabricante['nome']}</TD>\n";
			$html .= "<TD><a href=\"alterar_fabricante.php?id={$fabricante['idfabricante']}\">Alterar</a></TD>\n";
			$html .= "<TD>Excluir</TD>\n";
			$html .= "</TR>\n";
		}
		$html .= "</TABLE>\n";
	} else {
		$html = "<p>Nenhum registro de fabricante encontrado</p>\n";
	}
	return $html;

}

?>