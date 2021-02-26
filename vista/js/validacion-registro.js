var form  = document.getElementsByTagName('form')[0];
var nombre = document.getElementById('usnombre');
//var nombre_error = document.getElementById('nombre_mensaje_error');
var apellido = document.getElementById('usapellido');
//var apellido_error = document.getElementById('apellido_mensaje_error');
var nik = document.getElementById('uslogin');
//var nik_error = document.getElementById('nik_mensaje_error');
var clave = document.getElementById('usclave');
var clave_error = document.getElementById('pass_mensaje_error');

form.addEventListener('submit', function (event) {
	if(nombre.validity.valueMissing) {
		//nombre_error.textContent = 'Debe ingresar su nombre';
		event.preventDefault();
		//nombre_error.className = 'error active';
	}// else{
		//nombre_error.className = 'sin_error';
	//}
	if(apellido.validity.valueMissing) {
		//apellido_error.textContent = 'Debe ingresar su apellido';
		event.preventDefault();
		//apellido_error.className = 'error active';
	} //else {
		//apellido_error.className = 'sin_error';
	//}
	if(nik.validity.valueMissing){
		//nik_error.textContent ='debe elegir un nik';
		event.preventDefault();
		//nik_error.className = 'error active';
	} //else {
		//nik_error.className = 'sin_error';
	//}
	if(clave.validity.valueMissing){
		//clave_error.textContent ='debe generar el clave';
		event.preventDefault();
		//clave_error.className = 'error active';
	} //else {
		//clave_error.className = 'sin_error';
	//}
});

//nombre.addEventListener('change', function(event){
// 	if(nombre.validity.valueMissing){
// 		nombre_error.textContent = 'Debe ingresar un nombre';
//		nombre_error.className = 'error active';
// 	} else{
// 		nombre_error.className = 'sin_error';
// 	}
//});

//apellido.addEventListener('change', function(event){
// 	if(apellido.validity.valueMissing){
// 		apellido_error.textContent = 'Debe ingresar un apellido';
//		apellido_error.className = 'error active';
// 	} else{
// 		apellido_error.className = 'sin_error';
// 	}
//});

//nik.addEventListener('change', function(event){
// 	if(nik.validity.valueMissing){
// 		nik_error.textContent = 'Debe ingresar un nik';
//		nik_error.className = 'error active';
// 	} else{
// 		nik_error.className = 'sin_error';
// 	}
//});


clave.addEventListener('input', function (event) {
	if(!clave.validity.valueMissing){
		//let reDebil = /([a-zA-Z]{1,6}|\d{1,6})/;
		let reFuerte= /[^a-zA-Z0-9]/;

		if(clave.value.length>6){
			//console.log("entre en longitud");
			if(reFuerte.test(clave.value)){
				clave_error.textContent = 'La clave ingresada es fuerte';
				clave_error.className = 'tipo_clave_registro tipo_clave_fuerte';
			} else {
				clave_error.textContent = 'La clave ingresada es normal';
				clave_error.className = 'tipo_clave_registro tipo_clave_normal';

			}
		} else {
			clave_error.textContent = 'La clave ingresada es debil';
			clave_error.className = 'tipo_clave_registro tipo_clave_debil';
		}

	} else {
		//clave_error.textContent = '';
		clave_error.className = 'sin_error';
	}
});

