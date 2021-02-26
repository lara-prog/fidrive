var form  = document.getElementsByTagName('form')[0];
var usuario = document.getElementById('usuario_ACE');
var usuario_error = document.getElementById('usuario_mensaje_error');
var descripcion = document.getElementById('acedescripcion');
var descripcion_error = document.getElementById('descripcion_mensaje_error');

usuario.addEventListener('change', function(event){
	console.log('usuario val');
 	if(usuario.validity.valueMissing){
 		usuario_error.textContent = 'Debe elegir un usuario';
		usuario_error.className = 'error active';
 	} else{
 		usuario_error.className = 'sin_error';
 	}
});

descripcion.addEventListener('input', function(event){
	console.log('validacion de descripcion');
	if(!descripcion.value){
		descripcion_error.textContent = 'Debe ingresar una descripcion';
		descripcion_error.className = 'error active';
	} else {
		descripcion_error.className = 'sin_error';
	}
});

form.addEventListener('submit', function (event) {
	console.log("estoy dentro formmm");
	if(descripcion.validity.valueMissing) {
		event.preventDefault();
		descripcion_error.textContent = 'Debe ingresar una descripcion';
		descripcion_error.className = 'error active';
	} else {
		descripcion_error.className = 'sin_error';
	}

	if(usuario.validity.valueMissing){
		event.preventDefault();
		usuario_error.textContent="Debe seleccionar un usuario";
		usuario_error.className = 'error active';
	} else {
		usuario_error.className = 'sin_error';
	}

});