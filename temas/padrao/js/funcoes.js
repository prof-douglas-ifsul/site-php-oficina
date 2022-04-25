function configura_formulario_novo_usuario() {
	var divs = document.getElementsByClassName("campo_novo_usuario");
	document.getElementById("id_nome").removeAttribute("disabled");
	document.getElementById("id_confsenha").removeAttribute("disabled");
	for(var i = 0; i < divs.length; i++){
        divs[i].style.display = "block"; 
    }
}