function configura_formulario_novo_usuario() {
	var divs = document.getElementsByClassName("campo_novo_usuario");
	document.getElementById("id_nome").removeAttribute("disabled");
	document.getElementById("id_confsenha").removeAttribute("disabled");
	for(var i = 0; i < divs.length; i++){
        divs[i].style.display = "block"; 
    }
}


function retornoAjax(idDestino, objRetorno) {
	console.log(idDestino);
	console.log(objRetorno);
}

// referencia
// https://www.quirksmode.org/js/xmlhttp.html

function sendRequest(target,url,callback,postData) {
    var req = createXMLHTTPObject();
	console.log(req);
    if (!req) return;
    var method = (postData) ? "POST" : "GET";
	console.log(method);
    req.open(method,url,true);
    //req.setRequestHeader('User-Agent','XMLHTTP/1.0');
    if (postData)
        req.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    req.onreadystatechange = function () {
        if (req.readyState != 4) return;
        if (req.status != 200 && req.status != 304) {
//          alert('HTTP error ' + req.status);
            return;
        }
        callback(target, req);
    }
    if (req.readyState == 4) return;
    req.send(postData);
}

var XMLHttpFactories = [
    function () {return new XMLHttpRequest()},
    function () {return new ActiveXObject("Msxml2.XMLHTTP")},
    function () {return new ActiveXObject("Msxml3.XMLHTTP")},
    function () {return new ActiveXObject("Microsoft.XMLHTTP")}
];

function createXMLHTTPObject() {
    var xmlhttp = false;
    for (var i=0;i<XMLHttpFactories.length;i++) {
        try {
            xmlhttp = XMLHttpFactories[i]();
        }
        catch (e) {
            continue;
        }
        break;
    }
    return xmlhttp;
}
