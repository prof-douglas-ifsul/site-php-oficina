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

function html_campo_select_fabricante($fabricantes) {

	$tmp = array();
	foreach($fabricantes as $fabricante) {
		$tmp[] = [strtolower($fabricante[0]), $fabricante[1]];
	}
	
	return campo_select("fabricante", "fabricante", $tmp, true);

}

?>