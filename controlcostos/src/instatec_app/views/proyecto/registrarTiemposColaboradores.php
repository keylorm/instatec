<script src="<?=base_url()?>src/instatec_pub/js/proyecto.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>proyectos">Proyectos</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/ver-proyecto/<?=$proyecto['proyecto_id']?>">Ver proyecto</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto['proyecto_id']?>">Colaboradores</a>
	</li>
	<li class="breadcrumb-item active">Registrar tiempo laborado</li>
</ol>

<h1 class="text-center">Colaboradores</h1>
<hr>

<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Registrar tiempo laborado</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-primary" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto['proyecto_id']?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a colaboradores</a></div>
</div>


<div class="page-content" ng-controller="registrarTiempoColaboradoresController" ng-cloak ng-init="proyecto_id='<?=$proyecto['proyecto_id']?>'; <?=(isset($fecha_gasto))?'fecha_gasto=\''.$fecha_gasto.'\';':''?> consultarTiempos();">
	<?php 
		if(validation_errors()){ ?>
    		<div class="alert alert-danger alert-dismissable"><?php echo validation_errors(); ?></div>
    <?php 
		} 

		if(isset($msg)){
			foreach ($msg as $kmsg => $vmsg) { ?>
				<div class="alert alert-<?=$vmsg['tipo']?> alert-dismissable"><?=$vmsg['texto']?></div>
			<?php
			}
		}

    ?>
    <div class="card mb-3">
        <div class="card-header">
            Fecha de registro</div>
        <div class="card-body">
            <form id="filtroColaborador">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="colaborador_nuevo_id">Fecha:</label>							
                            <input type="text" name="fecha_gasto" ng-model="fecha_gasto" class="form-control datepicker"   data-date-end-date="0d" id="fecha_gasto" aria-describedby="fechaRegistroHelp" >
                            <small id="fechaRegistroHelp" class="form-text text-muted">Seleccione la fecha en la cual desea registrar o ver los tiempos laborados.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <button  class="btn btn-primary form-submit" ng-click="consultarTiempos()">Buscar</button>
                    </div>
                    
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-12">
                        <div class="alert alert-{{resultado_type}}" ng-if="resultado_insert!==''">{{resultado_insert}}</div>     
                    </div>
                </div>
            </form>

            
        </div>
    </div>
    

    <div class="card mb-3" >
        <div class="card-header">
            Horas laboradas</div>
        <div class="card-body">
            <div class="loader text-center" ng-if="loader==true">
                <img src="<?=base_url()?>/src/instatec_pub/images/ajax-loader.gif" alt="" class="loader-ajax">
            </div>
            <div ng-if="loader===false">
                <form id="tablaColaboradorHoras" action="" method="POST">
                    <input type="hidden" name="fecha_registro_gasto" value="{{fecha_gasto}}" />
                    <div class="table-espaciado"  ng-if="colaboradores_proyecto!==false" >
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>                                
                                        <th>Nombre</th>                                			
                                        <th>Puesto</th>	                                	
                                        <th>Horas normales</th> 
                                        <th>Horas extra</th>                                
                                    </tr>
                                </thead>
                                
                                <tfoot>
                                    <tr>
                                        <td colspan="4"><button  class="float-right btn btn-primary form-submit" type="submit" >Guardar</button></td>
                                    </tr>
                                </tfoot>
                                
                                <tbody>
                                    <tr ng-repeat="colaborador in colaboradores_proyecto" ng-class="{'text-danger': colaborador.colaborador_costo_hora_id===null && colaborador.estado_costo===null}">
                                        <td >{{colaborador.nombre + ' ' +colaborador.apellidos}} <span ng-if="colaborador.colaborador_costo_hora_id===null && colaborador.estado_costo===null">* <br>(Colaborador con datos incompletos)</span></td>                               
                                        <td>{{colaborador.puesto}}</td>
                                        <td> 
                                        <?php if($rol_id==1 || $rol_id==2){ ?>
                                            <input type="number" step="0.05" pattern="^\d+(?:\.\d{1,2})?$" ng-if="colaborador.colaborador_costo_hora_id!==null && colaborador.estado_costo!==null" {{(colaborador.cantidad_horas!==undefined) ? 'value="'+colaborador.cantidad_horas+'"' : 'value="0"'}} ng-value="{{(colaborador.cantidad_horas!==undefined) ? colaborador.cantidad_horas : '0'}}" class="form-control" name="horas_colaborador[{{colaborador.colaborador_id}}]">
                                        <?php }else if($rol_id==3){ ?>
                                            <input ng-if="today==true && colaborador.colaborador_costo_hora_id!==null && colaborador.estado_costo!==null" type="number" step="0.05" pattern="^\d+(?:\.\d{1,2})?$" {{(colaborador.cantidad_horas!==undefined) ? 'value="'+colaborador.cantidad_horas+'"' : 'value="0"'}} ng-value="{{(colaborador.cantidad_horas!==undefined) ? colaborador.cantidad_horas : '0'}}" class="form-control" name="horas_colaborador[{{colaborador.colaborador_id}}]">
                                            <span ng-if="today==false">{{colaborador.cantidad_horas}}</span>
                                        <?php } ?>
                                        </td>
                                        <td> 
                                        <?php if($rol_id==1 || $rol_id==2){ ?>
                                            <input type="number" step="0.05" pattern="^\d+(?:\.\d{1,2})?$" ng-if="colaborador.colaborador_costo_hora_id!==null && colaborador.estado_costo!==null" {{(colaborador.cantidad_horas_extra!==undefined) ? 'value="'+colaborador.cantidad_horas_extra+'"' : 'value="0"'}} ng-value="{{(colaborador.cantidad_horas_extra!==undefined) ? colaborador.cantidad_horas_extra : '0'}}" class="form-control" name="horas_extra_colaborador[{{colaborador.colaborador_id}}]">
                                        <?php }else if($rol_id==3){ ?>
                                            <input ng-if="today==true && colaborador.colaborador_costo_hora_id!==null && colaborador.estado_costo!==null" type="number" step="0.05" pattern="^\d+(?:\.\d{1,2})?$" {{(colaborador.cantidad_horas_extra!==undefined) ? 'value="'+colaborador.cantidad_horas_extra : 'value="0"'}} ng-value="{{(colaborador.cantidad_horas_extra!==undefined) ? colaborador.cantidad_horas_extra : '0'}}" class="form-control" name="horas_extra_colaborador[{{colaborador.colaborador_id}}]">
                                            <span ng-if="today==false">{{colaborador.cantidad_horas_extra}}</span>
                                        <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </form>
            
            </div>

            
            <p ng-if="colaboradores_proyecto===false" class="text-center table-espaciado">No hay colaboradores asignados aún</p>
	    </div>
    </div>
</div>
