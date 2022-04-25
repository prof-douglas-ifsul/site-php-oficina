<?php

$fabricantes = array("Ford", "VW", "GM", "Hyundai", "Honda", "BMW");

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

//var_dump($modelos);

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
<select name="fabricante" id="fabricante">
<option>- selecione -</option>
<option value="<?php echo strtolower($fabricantes[0]);?>"><?php echo $fabricantes[0];?></option>
<?php

echo "<option value=\"" . strtolower($fabricantes[1]) . "\">$fabricantes[1]</option>\r\n";
$opt = "<option value='" . strtolower($fabricantes[2]). "'>$fabricantes[2]</option>\r\n";
echo $opt;
echo "<option value='";
echo strtolower($fabricantes[3]);
echo "'>$fabricantes[3]</option>\r\n";

$opt = "<option value=\"#valor#\">#descricao#</option>\r\n";
$opt = str_replace("#valor#", strtolower($fabricantes[4]), $opt);
$opt = str_replace("#descricao#", $fabricantes[4], $opt);
echo $opt;

?>
</select>
</label>
<BR/>
<label for="modelo">Modelo
<select name="modelo" id="modelo">
<option>- selecione -</option>
<optgroup label="Fiat">
<option value="palio">Palio</option>
<option value="cronos">Cronos</option>
</optgroup>
<optgroup label="VW">
<option value="nivus">Nivus</option>
<option value="fusca">Fusca</option>
</optgroup>
<optgroup label="GM">
<option value="cobalt">Cobalt</option>
<option value="onix">Onix</option>
</optgroup>
<optgroup label="Hyundai">
<option value="hb20">Hyundai HB20</option>
<option value="i30">Hyundai i30</option>
</optgroup>
<optgroup label="Honda">
<option value="civic">Honda Civic</option>
<option value="fit">Honda Fit</option>
</optgroup>
</select>
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
