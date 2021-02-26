var form  = document.getElementsByTagName('form')[0];
var contrasena = document.getElementById('usclave');
var usuario = document.getElementById('uslogin');
var contrasena_error = document.getElementById('contrasena_mensaje_error');
var usuario_error = document.getElementById('usuario_mensaje_error');

form.addEventListener('submit', function(event){
	if(contrasena.validity.valid){
		valor = contrasena.value;
		clave = CryptoJS.MD5(valor);
		document.getElementById('contrasena').value = clave;
		console.log(clave.toString());
		contrasena_error.innerHTML = '';
		contrasena_error.className = 'sin_error';
	} else {
		contrasena_error.textContent ='debe ingresar su contrasena';
		event.preventDefault();
		contrasena_error.className ='error';
	}
	if(usuario.validity.valid){
		usuario_error.innerHTML = '';
		usuario_error.className = 'sin_error';
	} else {
		usuario_error.textContent ='debe elegir su usuario';
		event.preventDefault();
		usuario_error.className = 'error active';
	}
});

contrasena.addEventListener('change', function (event){
	if(contrasena.validity.valid){
		contrasena_error.innerHTML = '';
		contrasena_error.className = 'sin_error';
	} else {
		contrasena_error.textContent ='debe ingresar su contrasena';
		contrasena_error.className ='error';
	}
});

usuario.addEventListener('change', function (event){
	if(usuario.validity.valid){
		usuario_error.innerHTML = '';
		usuario_error.className = 'sin_error';
	} else {
		usuario_error.textContent ='debe ingresar su usuario';
		usuario_error.className ='error';
	}
});
