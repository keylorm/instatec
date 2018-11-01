<?php 
$get_data = $this->input->get();
extract($get_data);
 ?>
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
		<a href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>">Materiales</a>
	</li>
	<li class="breadcrumb-item active">Editar colaboradores</li>
</ol>

<h1 class="text-center">Materiales requeridos en el proyecto</h1>
<hr>

<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Editar lista de materiales</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-secondary" href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a materiales</a></div>
</div>


<div class="page-content" ng-controller="editarMaterialesProyectoController" ng-cloak ng-init="proyecto_id='<?=$proyecto->proyecto_id?>'; consultarMateriales();">
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
            Lista de materiales</div>
        <div class="card-body">
            <form id="editarMaterialesProyecto" class="form-validation" method="post" action="">
                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                    <button type="button" class="btn" ng-class="{'btn-primary': agregar_material==false, 'btn-outline-primary': agregar_material==true}" ng-click="habilitarFormMaterialExistente()"><i class="fa fa-fw fa-list"></i> Existente</button>
                    <button type="button" class="btn" ng-class="{'btn-outline-primary': agregar_material==false, 'btn-primary': agregar_material==true}" ng-click="habilitarFormMaterialNuevo()"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</button>                
                </div>
                <div ng-show="agregar_material == false" class="row">
                    <div class="form-group col-12 col-md-4">
                        <div class="form-group">
                            <label for="material_id">Material:</label>							
                            <select ng-class="{'skip-validation': agregar_material==true}" class="form-control  select-required  chosen-select" chosen data-placeholder="Seleccione un material..." name="material_id" id="material_id" ng-model="material_id" aria-describedby="colaboradorHelp"  required="required">
                                <option value=""></option>
                                
                                <?php foreach($materiales as $kmaterial => $vmaterial){ ?>
                                    <option ng-value="<?=$vmaterial->material_id?>" value="<?=$vmaterial->material_id?>"><?='('.@$vmaterial->material_codigo.') - '.@$vmaterial->material?></option>
                                <?php } ?>
                            </select>
                            <small id="colaboradorHelp" class="form-text text-muted">Busque el material que desea agregar al proyecto.</small>
                        </div>
                        
                    </div>
                </div>
                 <div ng-show="agregar_material == true" class="row">
                    <div class="form-group col-12 col-md-4">
                        <label for="material">Nombre del material *</label>
                        <input type="text" name="material" ng-class="{'skip-validation': agregar_material==false}" class="form-control input-required" id="material" aria-describedby="materialHelp" value="<?=(isset($post_data['material']))?$post_data['material']:''?>" >
                        <small id="materialHelp" class="form-text text-muted">Ingrese el nombre del material.<br/>
                        </small>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="material_codigo">Código del material *</label>
                        <input type="text" name="material_codigo" ng-class="{'skip-validation': agregar_material==false}" class="form-control input-required" id="material_codigo" aria-describedby="material_codigoHelp" value="<?=(isset($post_data['material_codigo']))?$post_data['material_codigo']:''?>" >
                        <small id="material_codigoHelp" class="form-text text-muted">Ingrese el código del material.<br/>
                        </small>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-12 col-md-4">
                        <label for="cantidad">Cantidad del material *</label>
                        <input type="number" step="0.05" pattern="^\d+(?:\.\d{1,2})?$" name="cantidad" class="form-control input-required" id="cantidad" aria-describedby="cantidadHelp" value="<?=(isset($post_data['cantidad']))?$post_data['cantidad']:''?>" >
                        <small id="cantidadHelp" class="form-text text-muted">Ingrese la cantidad del material.<br/>
                        </small>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="material_unidad_id">Unidad de medida del material *</label>
                        <select class="form-control  select-required  chosen-select" chosen data-placeholder="Seleccione una unidad..." name="material_unidad_id" id="material_unidad_id" ng-model="material_unidad_id" aria-describedby="colaboradorHelp" required="required" >
                        <option value=""></option>
                        
                            <?php foreach($material_unidades as $kmaterial_unidad => $vmaterial_unidad){ ?>
                                <option ng-value="<?=$vmaterial_unidad->material_unidad_id?>" value="<?=$vmaterial_unidad->material_unidad_id?>"><?=@$vmaterial_unidad->material_unidad?></option>
                            <?php } ?>
                        </select>
                        <small id="colaboradorHelp" class="form-text text-muted">Seleccione la unidad de medida de este material.</small>
                        
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="comentario">Comentarios</label>
                        <textarea class="form-control" name="comentario" id="comentario" aria-describedby="comentarioHelp"></textarea>
                        <small id="comentarioHelp" class="form-text text-muted">Ingrese cualquier comentario adicional sobre este material</small>
                        
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label>Agregar como:</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="tipo_relacion" id="tipo_relacion1" value="1" checked>
                                Material estimado incialmente
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="tipo_relacion" id="tipo_relacion2" value="2">
                                Extensión de material
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <input type="hidden" name="agregar_material" ng-model="agregar_material" value="{{agregar_material}}">
                        <button  class="btn btn-primary form-submit">Agregar</button>
                    </div>
                    
                </div>
                <?php if (isset($respuesta_relacion)) { ?>
                    <div class="row mb-3 mt-3">
                        <div class="col-12">
                            <div class="alert alert-<?=$respuesta_relacion['result']['tipo']?>"><?=$respuesta_relacion['result']['texto']?></div>     
                        </div>
                    </div>
                <?php } ?>
                
            </form>
               

            
        </div>
    </div>

  
    <div class="card mb-3" id="materiales_proyecto">
        <div class="card-header">
            Materiales iniciales del proyecto</div>
        <div class="card-body">
            <div class="listado-materiales">
                
                <h3 class="text-center mb-3">Lista inicial de materiales</h3>
                <?php if (isset($material_actualizado)){
                    if ($material_actualizado == 1) { ?>
                        <div class="alert alert-success"><p>Material actualizado con éxito.</p></div>
                    <?php } else { ?>
                        <div class="alert alert-danger"><p>Hubo un problema al actualizar el material.</p></div>
                    <?php }
                } ?>
                <div class="table-espaciado"  ng-if="materiales_iniciales_proyecto!==false" >
                    <div class="table-responsive">
                        <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="d-md-none">Acciones</th>
                                    <th>Material</th>                   
                                    <th>Código</th>
                                    <th>Cantidad</th>   
                                    <th>Detalle o comentario</th>
                                    <th class="d-none d-md-table-cell">Acciones</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr ng-repeat="material in materiales_iniciales_proyecto | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
                                    <td class="d-md-none">
                                        <button ng-if="material.estado_registro==1 && editar_cantidad[material.proyecto_material_id]===false" ng-click="habilitarEdicionMaterial(material.proyecto_material_id)" class="btn btn-primary btn-sm mb-1">
                                            <i class="fa fa-fw fa-edit"></i>
                                        </button>
                                        <button ng-if="material.estado_registro==1 && editar_cantidad[material.proyecto_material_id]===true" ng-click="actualizarMaterial(material.proyecto_material_id)" class="btn btn-success btn-sm mb-1">
                                            <i class="fa fa-fw fa-check" ng-show="guardando[material.proyecto_material_id]===false"></i><i class="fa fa-fw fa-spinner" ng-show="guardando[material.proyecto_material_id]===true"></i>
                                        </button>
                                        <button ng-if="material.estado_registro==1 && editar_cantidad[material.proyecto_material_id]===true" ng-click="cancelarEdicionMaterial(material.proyecto_material_id)" class="btn btn-sm btn-danger mb-1">
                                            <i class="fa fa-fw fa-ban"></i>
                                        </button>
                                        <button ng-show="material.estado_registro==0 && editar_cantidad[material.proyecto_material_id]===false" class="btn btn-sm mb-1 btn-success" ng-click="addRow(material.proyecto_material_id)"><i class="fa fa-fw fa-check"></i></button>
                                        <a ng-show="material.estado_registro==1 && editar_cantidad[material.proyecto_material_id]===false" class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal1{{material.proyecto_material_id}}"><i class="fa fa-fw fa-ban"></i></a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal1{{material.proyecto_material_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar a este material del proyecto?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Al quitar al material del proyecto ya no podrá utilizarlo para agregar gastos o generar cotizaciones.
                                                <br><br>
                                                Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
                                                <br><input ng-model="confirm_delete" type="text">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(material.proyecto_material_id)"><i class="fa fa-fw fa-trash-o"></i> Desactivar</button>
                                            </div>
                                            </div>
                                            </div>
                                        </div>
                
                                    </td>
                                    <td>{{material.material}}</td>
                                    <td>{{material.material_codigo}}</td>
                                    <td>
                                        <div class="edit-container row" ng-show="editar_cantidad[material.proyecto_material_id]===true">
                                            <div class="col-12 col-md-6">
                                                <input type="number" step="0.05" pattern="^\d+(?:\.\d{1,2})?$" ng-model="proyecto_material_cantidad[material.proyecto_material_id]" class="form-control" /> 
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select class="form-control chosen-select" chosen data-placeholder="Seleccione una unidad..." id="material_unidad_id" ng-model="proyecto_material_unidad[material.proyecto_material_id]" >
                                                    <?php foreach($material_unidades as $kmaterial_unidad => $vmaterial_unidad){ ?>
                                                        <option ng-value="<?=$vmaterial_unidad->material_unidad_id?>" value="<?=$vmaterial_unidad->material_unidad_id?>"><?=@$vmaterial_unidad->material_unidad?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        {{(editar_cantidad[material.proyecto_material_id]===false)?material.cantidad+' ('+material.material_unidad+')':''}}
                                    </td>
                                    <td>
                                        <div class="edit-container" ng-show="editar_cantidad[material.proyecto_material_id]===true">
                                            <textarea ng-model="proyecto_material_comentario[material.proyecto_material_id]" class="form-control"> </textarea>
                                            </div>
                                        </div>
                                        {{(editar_cantidad[material.proyecto_material_id]===false)?material.comentario:''}}
                                    </td>
                                    <td class="d-none d-md-table-cell"> 
                                        <button ng-if="material.estado_registro==1 && editar_cantidad[material.proyecto_material_id]===false" ng-click="habilitarEdicionMaterial(material.proyecto_material_id)" class="btn btn-primary btn-sm mb-1">
                                            <i class="fa fa-fw fa-edit"></i>
                                        </button>
                                        <button ng-if="material.estado_registro==1 && editar_cantidad[material.proyecto_material_id]===true" ng-click="actualizarMaterial(material.proyecto_material_id)" class="btn btn-success btn-sm mb-1">
                                            <i class="fa fa-fw fa-check" ng-show="guardando[material.proyecto_material_id]===false"></i><i class="fa fa-fw fa-spinner" ng-show="guardando[material.proyecto_material_id]===true"></i>
                                        </button>
                                        <button ng-if="material.estado_registro==1 && editar_cantidad[material.proyecto_material_id]===true" ng-click="cancelarEdicionMaterial(material.proyecto_material_id)" class="btn btn-sm btn-danger mb-1">
                                            <i class="fa fa-fw fa-ban"></i>
                                        </button>
                                        <button ng-show="material.estado_registro=='0' && editar_cantidad[material.proyecto_material_id]===false" class="btn btn-sm mb-1 btn-success" ng-click="addRow(material.proyecto_material_id)">Activar</button>
                                        <a ng-show="material.estado_registro==1 && editar_cantidad[material.proyecto_material_id]===false" class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal2{{material.proyecto_material_id}}">Desact.</a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal2{{material.proyecto_material_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar a este material del proyecto?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Al quitar al material del proyecto ya no podrá utilizarlo para agregar gastos o generar cotizaciones.
                                                    <br><br>
                                                    Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
                                                    <br><input ng-model="confirm_delete" type="text">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button ng-disabled="confirm_delete!='eliminar'" type="button" class="btn btn-danger" ng-click="borrarRow(material.proyecto_material_id)"><i class="fa fa-fw fa-trash-o"></i> Desactivar</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>

            
                <p ng-if="materiales_iniciales_proyecto===false" class="text-center table-espaciado">No hay materiales asignados aún</p>
            </div>
	    </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Extensiones de materiales del proyecto</div>
        <div class="card-body">
            <div class="listado-materiales">
                <h3 class="text-center mb-3">Lista de extensiones de materiales</h3>
                <div class="table-espaciado"  ng-if="materiales_extensiones_proyecto!==false" >
                    <div class="table-responsive">
                        <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="d-md-none">Acciones</th>
                                    <th>Material</th>                   
                                    <th>Código</th>
                                    <th>Cantidad</th>
                                    <th>Detalle o comentario</th> 
                                    <th class="d-none d-md-table-cell">Acciones</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr ng-repeat="material_extension in materiales_extensiones_proyecto | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
                                    <td class="d-md-none">
                                        <button ng-if="material_extension.estado_registro==1 && editar_cantidad[material_extension.proyecto_material_id]===false" ng-click="habilitarEdicionMaterial(material_extension.proyecto_material_id)" class="btn btn-primary btn-sm mb-1">
                                            <i class="fa fa-fw fa-edit"></i>
                                        </button>
                                        <button ng-if="material_extension.estado_registro==1 && editar_cantidad[material_extension.proyecto_material_id]===true" ng-click="actualizarMaterial(material_extension.proyecto_material_id)" class="btn btn-success btn-sm mb-1">
                                            <i class="fa fa-fw fa-check" ng-show="guardando[material_extension.proyecto_material_id]===false"></i><i class="fa fa-fw fa-spinner" ng-show="guardando[material_extension.proyecto_material_id]===true"></i>
                                        </button>
                                        <button ng-if="material_extension.estado_registro==1 && editar_cantidad[material_extension.proyecto_material_id]===true" ng-click="cancelarEdicionMaterial(material_extension.proyecto_material_id)" class="btn btn-sm btn-danger mb-1">
                                            <i class="fa fa-fw fa-ban"></i>
                                        </button>
                                        <button ng-show="material_extension.estado_registro==0 && editar_cantidad[material_extension.proyecto_material_id]===false" class="btn btn-sm mb-1 btn-success" ng-click="addRow(material_extension.proyecto_material_id)"><i class="fa fa-fw fa-check"></i></button>
                                        <a ng-show="material_extension.estado_registro==1 && editar_cantidad[material_extension.proyecto_material_id]===false" class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal1{{material_extension.proyecto_material_id}}"><i class="fa fa-fw fa-ban"></i></a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal1{{material_extension.proyecto_material_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar a este material del proyecto?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Al quitar al material del proyecto ya no podrá utilizarlo para agregar gastos o generar cotizaciones.
                                                <br><br>
                                                Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
                                                <br><input ng-model="confirm_delete" type="text">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(material_extension.proyecto_material_id)"><i class="fa fa-fw fa-trash-o"></i> Desactivar</button>
                                            </div>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{material_extension.material}}</td>
                                    <td>{{material_extension.material_codigo}}</td>
                                    <td>
                                        <div class="edit-container row" ng-show="editar_cantidad[material_extension.proyecto_material_id]===true">
                                            <div class="col-12 col-md-6">
                                                <input  type="number" step="0.05" pattern="^\d+(?:\.\d{1,2})?$" name="cantidad" ng-model="proyecto_material_cantidad[material_extension.proyecto_material_id]" class="form-control"/>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select  class="form-control chosen-select" chosen data-placeholder="Seleccione una unidad..." id="material_unidad_id" ng-model="proyecto_material_unidad[material_extension.proyecto_material_id]" >
                                                    <?php foreach($material_unidades as $kmaterial_unidad => $vmaterial_unidad){ ?>
                                                        <option ng-value="<?=$vmaterial_unidad->material_unidad_id?>" value="<?=$vmaterial_unidad->material_unidad_id?>"><?=@$vmaterial_unidad->material_unidad?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        {{(editar_cantidad[material_extension.proyecto_material_id]===false)?material_extension.cantidad+' ('+material_extension.material_unidad+')':''}}
                                    </td>
                                    <td>
                                        <div class="edit-container" ng-show="editar_cantidad[material_extension.proyecto_material_id]===true">
                                            <textarea ng-model="proyecto_material_comentario[material_extension.proyecto_material_id]" class="form-control"> </textarea>
                                            </div>
                                        </div>
                                        {{(editar_cantidad[material_extension.proyecto_material_id]===false)?material_extension.comentario:''}}
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <button ng-if="material_extension.estado_registro==1 && editar_cantidad[material_extension.proyecto_material_id]===false" ng-click="habilitarEdicionMaterial(material_extension.proyecto_material_id)" class="btn btn-primary btn-sm mb-1">
                                            <i class="fa fa-fw fa-edit"></i>
                                        </button>
                                        <button ng-if="material_extension.estado_registro==1 && editar_cantidad[material_extension.proyecto_material_id]===true" ng-click="actualizarMaterial(material_extension.proyecto_material_id)" class="btn btn-success btn-sm mb-1">
                                            <i class="fa fa-fw fa-check" ng-show="guardando[material_extension.proyecto_material_id]===false"></i><i class="fa fa-fw fa-spinner" ng-show="guardando[material_extension.proyecto_material_id]===true"></i>
                                        </button>
                                        <button ng-if="material_extension.estado_registro==1 && editar_cantidad[material_extension.proyecto_material_id]===true" ng-click="cancelarEdicionMaterial(material_extension.proyecto_material_id)" class="btn btn-sm btn-danger mb-1">
                                            <i class="fa fa-fw fa-ban"></i>
                                        </button>
                                        <button ng-show="material_extension.estado_registro==0  && editar_cantidad[material_extension.proyecto_material_id]===false" class="btn btn-sm mb-1 btn-success" ng-click="addRow(material_extension.proyecto_material_id)">Activar</button>
                                        <a ng-show="material_extension.estado_registro==1  && editar_cantidad[material_extension.proyecto_material_id]===false" class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal2{{material_extension.proyecto_material_id}}">Desact.</a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal2{{material_extension.proyecto_material_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar a este material del proyecto?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Al quitar al material del proyecto ya no podrá utilizarlo para agregar gastos o generar cotizaciones.
                                                    <br><br>
                                                    Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
                                                    <br><input ng-model="confirm_delete" type="text">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button ng-disabled="confirm_delete!='eliminar'" type="button" class="btn btn-danger" ng-click="borrarRow(material_extension.proyecto_material_id)"><i class="fa fa-fw fa-trash-o"></i> Desactivar</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>

            
                <p ng-if="materiales_extensiones_proyecto===false" class="text-center table-espaciado">No hay extensiones de materiales aún</p>
            </div>
        </div>
    </div>
</div>
