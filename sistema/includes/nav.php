<nav>
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li class="principal">
					<a href="convenio.php">Convenio Entidades</a>
				</li>
				<?php
				if($_SESSION['idrol']==1 || $_SESSION['idrol']==2){
					echo "
					
					<li >
					<a href=\"lista_citas.php\">Copagos</a>
				</li>
				
				";}
				
				
				if($_SESSION['idrol']==1 || $_SESSION['idrol']==3){
					echo "
					<li >
					<a href=\"lista_admisiones.php\">Admisiones</a>
					 
				</li>
				<li>
					<a href=\"\">Contigencia</a>
						<ul>
							<li><a href=\"listaContingencia.php\">Pacientes Contigencia</a></li>
							
					";
				}
				
				
				if($_SESSION['idrol']==1){
					echo "
					<li><a href=\"graficos.php\">Estadistica</a></li>
					</ul> 
					</li>
					<li >
					<a href=\"instructivo.php\">Instructivo</a>
				</li>
					<li class=\"derecha\">
					<a href=\"\">Administrador</a>
						<ul>
							<li><a href=\"lista_empleados.php\">Lista Empleados</a></li>
							<li><a href=\"lista_entidades.php\">Lista Entidades</a></li>
							<li><a href=\"lista_estudios.php\">Lista Estudios</a></li>
							<li><a href=\"eliminar_citas.php\">Eliminar Citas</a></li>
							<li><a href=\"menu.php\">Editar Menú</a></li>
						</ul> 
					</li>
					";
				}
			    ?>

					<!-- <li class="principal">
					<a href="lista_citas.php">Citas</a>
					 <ul>
						<li><a href="#">Nuevo Cliente</a></li>
						<li><a href="#">Lista de Clientes</a></li>
					</ul> 
				</li> -->
			</ul>
		</nav>