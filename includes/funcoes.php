<?php

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
		$tamanho = 1;
		$extras = "multiple";
	}
	
	return campo_select("modelo", "modelo", $tmp, true, $tamanho, $valores, $extras);
}

function campo_select($nome, $identificador, $opcoes, $opcao_vazia = true, $tamanho = 1, $valores = array(), $extras = null) {
	/*
	uso da funcao
	$opcoes tem é uma matriz com ao menos duas colunas
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