<nav class="nav1">
	<ul>
		<li><a href="index.php">Registro</a></li>
		<!-- Pra navegar al URL podemos hacerlo mediante la variable GET, la cual la toma del URL, se representa por el simbolo "?"-->
		<li><a href="index.php?action=ingresar">Ingreso</a></li>
		<li><a href="index.php?action=usuarios">Usuarios</a></li>
		<select id="select" onchange="location='index.php?action='+this.value">
			<option>Productos</option>
			<option value="productos">Mostrar productos</a></option>
			<option value="registroProductos">Registrar productos</a></option>
		</select>
		<li><a href="index.php?action=productos">Productos</a></li>
		<li><a href="index.php?action=salir">Salir</a></li>
</nav>