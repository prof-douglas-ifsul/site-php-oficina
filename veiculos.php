<?php

$fabricantes = array("Fiat", "VW", "GM", "Hyundai","Honda");

var_dump($fabricantes);

$modelos = [
	["Fiat", ["palio", "Palio"]]
	,["Fiat", ["cronos", "Cronos"]]
	,["VW", ["nivus", "Nivus"]]
	,["VW", ["fusca", "Fusca"]]
	,["GM", ["cobalt", "Cobalt"]]
	,["GM", ["onix", "Onix"]]
	,["Hyundai", ["hb20", "Hyundai HB20"]]
	,["Hyundai", ["i30", "Hyundai i30"]]
	,["Honda", ["civic", "Honda Civic"]]
	,["Honda", ["fit", "Honda Fit"]]
];

var_dump($modelos);

function campo_select_fabricante($fabricantes) {
	$html = "<select name=\"fabricante\" id=\"fabricante\">\r\n";
	$html .= "<option>- selecione -</option>\r\n";
	foreach($fabricantes as $fabricante) {
		$html .= "<option value=\"" . strtolower($fabricante) . "\">$fabricante</option>\r\n";
	}
	$html .= "</select>\r\n";
	return $html;
}

function campo_select_modelo($modelos) {
	$html = "<select name=\"modelo\" id=\"modelo\">\r\n";
	$html .= "<option>- selecione -</option>\r\n";
	$fabricante_ant = "";
	foreach($modelos as $modelo) {
		if ($fabricante_ant != $modelo[0]) {
			if ($fabricante_ant != "") {
				$html .= "</OPTGROUP>\n";
			}
			$html .= "<OPTGROUP label=\"$modelo[0]\">\n";
        }
		$html .= "<option value=\"" . $modelo[1][0] . "\">" . $modelo[1][1] . "</option>\r\n";
		$fabricante_ant = $modelo[0];
	}
	if ($fabricante_ant != "") {
		$html .= "</OPTGROUP>\n";
	}
	$html .= "</select>\r\n";
	return $html;
}

?>
<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro de veículos</title>
</head>
<body>
<h4>Cadastro de veículos</h4>
<hr/>
<form>
<label for="placa">Placa
<input type="text" name="placa" id="placa" maxlength="15" size="15">
</label>
<BR/>

<label for="fabricante">Fabricante
<?php
echo campo_select_fabricante($fabricantes);
?>
</label>
<BR/>
<label for="modelo">Modelo
<?php
echo campo_select_modelo($modelos);
?>
</label>
<BR/>
<label for="descricao">Descrição
<input type="text" name="descricao" id="descricao" maxlength="150" size="50">
</label>
<HR/>
<button type="submit">Cadastrar</button>
<button type="reset">Cancelar</button>
</form>
</body>
</html>
