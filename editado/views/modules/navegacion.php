<nav>
	<ul>
		<li><a href="index.php">Inicio</a></li>
		<!-- Pra navegar al URL podemos hacerlo mediante la variable GET, la cual la toma del URL, se representa por el simbolo "?"-->
		<li><a href="index.php?action=ingresar">Ingreso</a></li>
		<li><a href="index.php?action=maestros">Maestros</a></li>
		<li><a href="index.php?action=alumnos">Alumnos</a></li>
		<!--Select de CARRERAS-->
		<select onchange="location='index.php?action='+this.value">
			<option>Carreras</option>
			<option value="carreras">Mostrar carreras</a></option>
			<option value="registroCarrera">Registrar carrera</a></option>
		</select>

		<li><a href="index.php?action=registroAlumno">Registro de alumnos</a></li>
		<li><a href="index.php?action=registroMaestro">Registro de maestros</a></li>
		<!--SELECT DE TUTORIAS-->
		<select onchange="location='index.php?action='+this.value">
			<option>Tutorias</option>
			<option value="tutorias">Mostrar tutorias</a></option>
			<option value="registroTutorias">Registrar tutoria</a></option>
		</select>
		
		<li><a href="index.php?action=salir">Salir</a></li>
	</ul>
</nav>