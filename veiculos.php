<?php

$fabricantes = array("Fiat", "VW", "GM", "Hyundai","Honda");

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

function campo_select_fabricante($fabricantes) {

	$tmp = array();
	foreach($fabricantes as $fabricante) {
		$tmp[] = [strtolower($fabricante), $fabricante];
	}
	
	return campo_select("fabricante", "fabricante", $tmp, true);

}

function campo_select_modelo($modelos) {
	
	return campo_select_modelo_com_valor($modelos, array());
}

function campo_select_modelo_com_valor($modelos, $valores) {
	
	$tmp = array();
	foreach($modelos as $modelo) {
		$tmp[] = [$modelo[1][0], $modelo[1][1], $modelo[0]];
	}
	$tamanho = 1;
	$extras = "";
	if (count($valores) > 1) {
		$tamanho = 10;
		$extras = "multiple";
	}
	
	return campo_select("modelo", "modelo", $tmp, true, $tamanho, $valores, $extras);
}

function campo_select($nome, $identificador, $opcoes, $opcao_vazia = true, $tamanho = 1, $valores = array(), $extras = null) {
	/*
	uso da funcao
	$opcoes é uma matriz com ao menos duas colunas
	[0] = value do option
	[1] = descricacao do option
	[2] (opcional) = grupo dos options
	*/
	if (!is_array($opcoes)) {
		die("parametro \$opcoes de campo_select nao e array");
	}
	$grupos = false;
	if (count($opcoes) > 0) {
		if (is_array($opcoes[0])) {
			if (count($opcoes[0]) < 2) {
				die("matriz \$opcoes precisa ter elemento que sejam vetores com ao menos duas colunas/elementos");
			}
			if (count($opcoes[0]) >= 3) {
				$grupos = true;
			}
		} else {
			die("o primeiro elemento de \$opcoes precisa ser um vetor de ao menos duas colunas/elementos");
		}
	}
	// padroniza valores default como array
	if (!is_array($valores)) {
		$valores = array($valores);
	}
	// inicio da construcao do select
	$html = "<select name=\"$nome\" id=\"$identificador\"";
	if ($tamanho > 1) {
		$html .= " size=\"$tamanho\"";
	}
	if (!is_null($extras)) {
		$html .= " $extras";
	}
	$html .= ">\r\n";
	if ($opcao_vazia) {
		$html .= "<option>- selecione -</option>\r\n";
	}
	$grupo_ant = "";
	foreach($opcoes as $opcao) {
		if ($grupos) {
			if ($grupo_ant != $opcao[2]) {
				if ($grupo_ant != "") {
					$html .= "</OPTGROUP>\n";
				}
				$html .= "<OPTGROUP label=\"$opcao[2]\">\n";
			}
		}
		$html .= "<option value=\"" . $opcao[0] . "\"";
		if (in_array($opcao[0], $valores)) {
			$html .= " selected";
		}
		$html .= ">" . $opcao[1] . "</option>\r\n";
		if ($grupos) {
			$grupo_ant = $opcao[2];
		}
	}
	if ($grupos) {
		if ($grupo_ant != "") {
			$html .= "</OPTGROUP>\n";
		}
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
<label for="id_teste1">novo select
<?php
//function campo_select($nome, $identificador, $opcoes, $opcao_vazia = true, $tamanho = 1, $valores = array(), $extras = null) {

echo campo_select("teste1", "id_teste1", [[1, "opção 1", 100, "bla bla bla"], [2, "opção 2", 100, "ble ble"], [3, "opção 3", 200, "blu blu"]], true, 1, [2,3], "multiple");
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
