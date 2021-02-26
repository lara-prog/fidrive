</main>
</div>
</div>
<!-- MD5 -->
<script type="text/javascript">
	function habilitarBoton(){
		document.getElementById("boton").disabled = false;
	}

	function md5link(){
		var nombre = document.getElementById('acnombre').value;
		link = md5(nombre);
		document.getElementById('aclinkacceso').value = link;
		document.getElementById("boton").disabled = false;
	}
	function md5pass() {
		var clave = document.getElementById('usclave').value;
		hash = md5(clave);
		document.getElementById('usclave').value=hash;
		document.getElementById("boton").disabled = false;
	}
</script>
<script src="http://www.myersdaily.org/joseph/javascript/md5.js"></script>


<footer class="footer mt-auto py-3 " style="margin-top: 40px">
	<?php
	if($sesion->sesionActiva()&&$sesion->validar()) {
		echo'<div class="container" style="color:white;">
		<p>created by Lara Galaz </p>
		<p><a href="#">Back to top</a></p>
		</div>';
	}
	?>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper/popper.min.js"></script>
<script src="../js/bootstrap/bootstrap.min.js"></script>

</body>
</html>