<?php 

function bd_select_modelos($id = null, $idfabricante = null) {
	global $conn;

	try {
		$sql = "SELECT * FROM modelos";
		$where = "";
		if (!is_null($id) || !is_null($idfabricante)) {
			$sql .= " where ";
		}
		if (!is_null($id)) {
			$where = "idmodelo = :id";
		}
		if (!is_null($idfabricante)) {
			if ($where != "") {
				$where .= " and ";
			}
			$where .= "idfabricante = :idfabricante";
		}
		$sql .= $where;
		$stmt = $conn->prepare($sql);
		if (!is_null($id)) {
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		}
		if (!is_null($idfabricante)) {
			$stmt->bindParam(':idfabricante', $idfabricante, PDO::PARAM_INT);
		}
		$stmt->execute();
		return $stmt->fetchAll();

	} catch(PDOException $e) {
		die( 'ERROR: ' . $e->getMessage());
	}

}

function html_campo_select_modelos($fabricantes) {

	$tmp = array();
	foreach($fabricantes as $fabricante) {
		$tmp[] = [strtolower($fabricante[0]), $fabricante[1]];
	}
	
	return campo_select("fabricante", "fabricante", $tmp, true);

}

?>