<?php if($loggedin){ ?>
<!-- Navigation-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
		<a class="navbar-brand" href="<?=base_url()?>">Instatec CR</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
		  <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
		    <li class="nav-item" >
		      <a class="nav-link" href="<?=base_url()?>">
		        <i class="fa fa-fw fa-dashboard"></i>
		        <span class="nav-link-text">Inicio</span>
		      </a>
		    </li>
				<?php if(isset($permisos['proyecto']['list'])){ ?>
					<li class="nav-item" >
						<a class="nav-link" href="<?=base_url()?>proyectos">
							<i class="fa fa-fw fa-area-chart"></i>
							<span class="nav-link-text">Proyectos</span>
						</a>
					</li>
				<?php } ?>
		    <?php if(isset($permisos['cliente']['list'])){ ?>
			    <li class="nav-item" >
			      <a class="nav-link" href="<?=base_url()?>clientes">
			        <i class="fa fa-fw fa-handshake-o"></i>
			        <span class="nav-link-text">Clientes</span>
			      </a>
			    </li>
			<?php } ?>
			<?php if(isset($permisos['proveedor']['list'])){ ?>
			    <li class="nav-item" >
			      <a class="nav-link" href="<?=base_url()?>proveedores">
			        <i class="fa fa-fw fa-shopping-bag"></i>
			        <span class="nav-link-text">Proveedores</span>
			      </a>
			    </li>
			<?php } ?>
			<?php if(isset($permisos['reporte']['list'])){ ?>				
			    <li class="nav-item" >
			      <a class="nav-link" href="<?=base_url()?>reportes">
			        <i class="fa fa-fw fa-table"></i>
			        <span class="nav-link-text">Reportes</span>
			      </a>
			    </li>
			<?php } ?>
			<?php if(isset($permisos['colaborador']['list'])){ ?>
				<li class="nav-item" >
			      <a class="nav-link" href="<?=base_url()?>colaboradores">
			        <i class="fa fa-fw fa-sitemap"></i>
			        <span class="nav-link-text">Colaboradores</span>
			      </a>
			    </li>
		    <?php } ?>
			<?php if(isset($permisos['usuario']['list'])){ ?>
				<li class="nav-item" >
			      <a class="nav-link" href="<?=base_url()?>usuarios">
			        <i class="fa fa-fw fa-users"></i>
			        <span class="nav-link-text">Usuarios</span>
			      </a>
			    </li>
		    <?php } ?>
		    <?php if(isset($permisos['configuracion']['list'])){ ?>
				<li class="nav-item" >
					<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
						<i class="fa fa-fw fa-cog"></i>
						<span class="nav-link-text">Configuración</span>
					</a>
					<ul class="sidenav-second-level collapse" id="collapseComponents">
						<li>
							<a href="<?=base_url()?>colaboradores/puestos-trabajo">Puestos de trabajo</a>
						</li>
						<li>
							<a href="<?=base_url()?>proyectos/extensiones/tipos-orden-cambio">Tipos de orden de cambio</a>
						</li>
					</ul>
			    </li>
		    <?php } ?>

		  </ul>
		  <ul class="navbar-nav sidenav-toggler">
		    <li class="nav-item">
		      <a class="nav-link text-center" id="sidenavToggler">
		        <i class="fa fa-fw fa-angle-left"></i>
		      </a>
		    </li>
		  </ul>
		  <ul class="navbar-nav ml-auto">		    
		    <li class="nav-item">
		      <a class="nav-link" href="<?=base_url()?>logout">
		        <i class="fa fa-fw fa-sign-out"></i>Cerrar sesión</a>
		    </li>
		  </ul>
		</div>
	</nav>
	<!--<a class="menu-toggle icon-menu" data-toggle="collapse" href="#menu" aria-expanded="false" aria-controls="collapseExample"></a>
	<nav id="menu" class="collapse">
		<ul class="nav justify-content-center">
			<li class="nav-item"><a class="nav-link" href="<?=base_url()?>dashboard">Inicio</a></li>
			<li class="nav-item"><a class="nav-link" href="<?=base_url()?>proyectos">Proyectos</a></li>
			<?php if(isset($rol_id) && $rol_id=='1'){ ?>
				<li class="nav-item"><a class="nav-link" href="<?=base_url()?>clientes">Clientes</a></li>
				<li class="nav-item"><a class="nav-link" href="<?=base_url()?>proveedores">Proveedores</a></li>
				<li class="nav-item"><a class="nav-link" href="<?=base_url()?>reportes">Reportes</a></li>
			<?php } ?>
			<li class="nav-item"><a class="nav-link" href="<?=base_url()?>logout">Cerrar Sesión</a></li>
		</ul>
	</nav>-->

<?php } ?>