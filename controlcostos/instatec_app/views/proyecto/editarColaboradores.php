<script src="<?=base_url()?>instatec_pub/js/proyecto.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>proyectos">Proyectos</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/ver-proyecto/<?=$proyecto->proyecto_id?>">Ver proyecto</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto->proyecto_id?>">Colaboradores</a>
	</li>
	<li class="breadcrumb-item active">Editar colaboradores</li>
</ol>

<h1 class="text-center">Colaboradores asignados al proyecto</h1>
<hr>

<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Editar colaboradores</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-primary" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a colaboradores</a></div>
</div>


<div class="page-content" ng-controller="editarProyectoColaboradoresController" ng-cloak ng-init="proyecto_id='<?=$proyecto->proyecto_id?>'; consultarColaboradores();">
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
            Lista de colaboradores general</div>
        <div class="card-body">
            <form id="agregarColaborador">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="colaborador_nuevo_id">Colaborador:</label>							
                            <select class="form-control  select-required" chosen data-placeholder="Seleccione un colaborador..." name="colaborador_nuevo_id" id="colaborador_nuevo_id" ng-model="colaborador_nuevo_id" aria-describedby="colaboradorHelp" required="required">
                                <option value=""></option>
                                
                                <?php foreach($colaboradores as $kcolaborador => $vcolaborador){ ?>
                                    <option ng-value="<?=$vcolaborador->colaborador_id?>" value="<?=$vcolaborador->colaborador_id?>"><?=@$vcolaborador->nombre.' '.@$vcolaborador->apellidos?></option>
                                <?php } ?>
                            </select>
                            <small id="colaboradorHelp" class="form-text text-muted">Busque el colaborador que desea agregar al proyecto.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <button  class="btn btn-primary form-submit" ng-click="agregarColaboradorNuevo()">Agregar</button>
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

  
    <div class="card mb-3">
        <div class="card-header">
            Colaboradores ligados al proyecto</div>
        <div class="card-body">
            <div class="table-espaciado"  ng-if="colaboradores_proyecto!==false" >
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <?php if($rol_id==1){ ?>
                                    <th class="d-md-none">Acciones</th>
                                <?php } ?>
                                <th>Nombre</th>
                                <?php if($rol_id==1 || $rol_id==2){ ?>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                <?php } ?>						
                                <th>Puesto</th>	
                                <?php if($rol_id==1){ ?>	
                                    <th class="d-none d-md-table-cell">Acciones</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr ng-repeat="colaborador in colaboradores_proyecto | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
                                <?php if($rol_id==1){ ?>
                                    <td class="d-md-none">
                                        <div ng-if="colaborador.tipo_relacion!=1">
                                            <a class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal1{{colaborador.colaborador_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal1{{colaborador.colaborador_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar a este colaborador del proyecto?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Al quitar al colaborador del proyecto ya no podrá asignarle más tiempo de trabajo. Podrá agregarlo nuevamente más adelante si desea.
                                                    <br><br>
                                                    Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
                                                    <br><input ng-model="confirm_delete" type="text">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(colaborador.colaborador_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
                                                </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                
                                    </td>
                                <?php } ?>
                                <td>{{colaborador.nombre + ' ' +colaborador.apellidos}}</td>
                                <?php if($rol_id==1 || $rol_id==2){ ?>
                                    <td>{{colaborador.telefono}}</td>
                                    <td>{{colaborador.correo_electronico}}</td>
                                <?php } ?>
                                <td>{{colaborador.puesto}}</td>
                                
                                <?php if($rol_id==1){ ?>
                                    <td class="d-none d-md-table-cell"> 
                                        <div ng-if="colaborador.tipo_relacion!=1">
                                            <a class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal2{{colaborador.colaborador_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal2{{colaborador.colaborador_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar a este colaborador del proyecto?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Al quitar al colaborador del proyecto ya no podrá asignarle más tiempo de trabajo. Podrá agregarlo nuevamente más adelante si desea.
                                                    <br><br>
                                                    Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
                                                    <br><input ng-model="confirm_delete" type="text">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button ng-disabled="confirm_delete!='eliminar'" type="button" class="btn btn-danger" ng-click="borrarRow(colaborador.colaborador_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
            </div>

        
            <p ng-if="colaboradores_proyecto===false" class="text-center table-espaciado">No hay colaboradores asignados aún</p>
	    </div>
    </div>
</div>
