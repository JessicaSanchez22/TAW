<nav>
	<ul>
		<li><a href="index.php">Inicio</a></li>
		<!-- Pra navegar al URL podemos hacerlo mediante la variable GET, la cual la toma del URL, se representa por el simbolo "?"-->
		<li><a href="index.php?action=ingresar">Ingreso</a></li>

		<!--SELECT de MAESTROS-->
		<select onchange="location='index.php?action='+this.value">
			<option>Maestros</option>
			<option value="maestros">Mostrar maestros</a></option>
			<option value="registroMaestro">Registrar maestro</a></option>
		</select>
		
		<!--SELECT de ALUMNOS-->
		<select onchange="location='index.php?action='+this.value">
			<option>Alumnos</option>
			<option value="alumnos">Mostrar alumnos</a></option>
			<option value="registroAlumno">Registrar alumnos</a></option>
		</select>

		<!--Select de CARRERAS-->
		<select onchange="location='index.php?action='+this.value">
			<option>Carreras</option>
			<option value="carreras">Mostrar carreras</a></option>
			<option value="registroCarrera">Registrar carrera</a></option>
		</select>

		<!--SELECT DE TUTORIAS-->
		<select onchange="location='index.php?action='+this.value">
			<option>Tutorias</option>
			<option value="tutorias">Mostrar tutorias</a></option>
			<option value="registroTutorias">Registrar tutoria</a></option>
		</select>
		
		<li><a href="index.php?action=salir">Salir</a></li>
	</ul>
</nav>