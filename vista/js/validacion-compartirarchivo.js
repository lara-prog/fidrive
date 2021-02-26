var form  = document.getElementsByTagName('form')[0];
var elemento = document.getElementById("content");
var sicheck = document.getElementById("sicheck");
var nocheck = document.getElementById("nocheck");

var clave = document.getElementById('acprotegidoclave');
var clave_error = document.getElementById('clave_mensaje_error');

var cantDescargas = document.getElementById('accantidaddescarga');
var cantDescargas_error = document.getElementById('cantidadDescargas_mensaje_error');

var cantDias = document.getElementById('dias');
var dias_error = document.getElementById('dias_mensaje_error');

var link =document.getElementById("aclinkacceso");
var link_error = document.getElementById('link_mensaje_error');
var boton = document.getElementById('boton_link');

var usuario = document.getElementById("usuarioACE");
var usuario_error = document.getElementById('usuario_mensaje_error');




form.addEventListener('submit', function (event) {
	if(cantDescargas.validity.valueMissing) {
		cantDescargas_error.textContent = 'Debe ingresar un numero minimo = 1';
		event.preventDefault();
		cantDescargas_error.className = 'error active';
	} else{
		cantDescargas_error.className = 'sin_error';
	}
	if(cantDias.validity.valueMissing) {
		dias_error.textContent = 'Debe ingresar un numero minimo = 1';
		event.preventDefault();
		dias_error.className = 'error active';
	} else {
		dias_error.className = 'sin_error';
	}
	if(usuario.validity.valueMissing){
		usuario_error.textContent ='debe elegir un usuario';
		event.preventDefault();
		usuario_error.className = 'error active';
	} else {
		usuario_error.className = 'sin_error';
	}
	if(link.validity.valueMissing){
		link_error.textContent ='debe generar el link';
		event.preventDefault();
		link_error.className = 'error active';
	} else {
		link_error.className = 'sin_error';
	}
});

cantDias.addEventListener('input', function (event) {
	if(!cantDias.validity.valueMissing){
		dias_error.innerHTML = '';
		dias_error.className = 'sin_error';
	} else {
		dias_error.textContent = 'Debe ingresar una valor';
		dias_error.className = 'error active';
	}
});

cantDescargas.addEventListener('input', function (event) {
	if(!cantDescargas.validity.valueMissing){
		cantDescargas_error.innerHTML = '';
		cantDescargas_error.className = 'sin_error';
	} else {
		cantDescargas_error.textContent = 'Debe ingresar una valor';
		cantDescargas_error.className = 'error active';
	}
});

sicheck.addEventListener('change', function(event){
	elemento.style.display='';
});

nocheck.addEventListener('change', function(event){
	elemento.style.display='none';
});

clave.addEventListener('input', function (event) {
	if(!clave.validity.valueMissing){
		//let reDebil = /([a-zA-Z]{1,6}|\d{1,6})/;
		let reFuerte= /[^a-zA-Z0-9]/;

		if(clave.value.length>6){
			//console.log("entre en longitud");
			if(reFuerte.test(clave.value)){
				clave_error.textContent = 'La clave ingresada es fuerte';
				clave_error.className = 'tipo_clave tipo_clave_fuerte active';
			} else {
				clave_error.textContent = 'La clave ingresada es normal';
				clave_error.className = 'tipo_clave tipo_clave_normal active';

			}
		} else {
			clave_error.textContent = 'La clave ingresada es debil';
			clave_error.className = 'tipo_clave tipo_clave_debil active';
		}

	} else {
		clave_error.textContent = 'Debe ingresar una clave';
		clave_error.className = 'error active';
	}
});

usuario.addEventListener('change', function(event){
 	if(usuario.validity.valueMissing){
 		usuario_error.textContent = 'Debe elegir un usuario';
		usuario_error.className = 'error active';
 	} else{
 		usuario_error.className = 'sin_error';
 	}
});


//boton.addEventListener('click', function(event){
//	var numero = Math.floor(Math.random() * (45 - 10)) + 10;
//	var contenido = "9007199254740991";

//	var cadena="";
//	var hash="";

//	if(cantDescargas.value!=null && cantDias.value!=null) {
//		cadena += numero+cantDescargas+cantDias;
//	} else {
//		cadena +=numero+contenido;
//	}

//	console.log(cadena);

//	for(i=0; i < cadena.length; i++){
//		hash += cadena.charCodeAt(i).toString();
//	}
//	link.value=hash;
//});