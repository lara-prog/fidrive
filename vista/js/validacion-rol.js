var form  = document.getElementsByTagName('form')[0];
var nombrerol = document.getElementById('rolnombre');
var rol_error = document.getElementById('rol_mensaje_error');

nombrerol.addEventListener('change', function (event){
	if(nombrerol.validity.valid){
		rol_error.innerHTML = '';
		rol_error.className = 'sin_error';
	} else {
		rol_error.textContent ='debe ingresar un rol';
		rol_error.className ='error';
	}
});

form.addEventListener('submit', function (event) {
	if(nombre.validity.valueMissing) {
		showErrorRol();
		event.preventDefault();
	}
	if(usuario.validity.valueMissing){
		rol_error.textContent ='debe ingresar un rol';
		event.preventDefault();
		rol_error.className = 'error active';
	} else {
		rol_error.className = 'sin_error';
	}

});



function showErrorRol() {
	if(nombre.validity.valueMissing) {
		rol_error.textContent = 'Debe ingresar un rol';
	}
	nombre_error.className = 'error active';
}
