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
	<li class="breadcrumb-item active">Proveedores</li>
</ol>

<h1 class="text-center">Materiales del proyecto</h1>
<hr>

<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de proveedores</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-secondary" href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a materiales</a></div>
</div>


<div class="page-content" ng-controller="editarProveedoresMaterialesProyectoController" ng-cloak ng-init="proyecto_id='<?=$proyecto->proyecto_id?>'; consultarMateriales();">
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
  
    <div class="listado-materiales">
        
        <div class="table-espaciado"  ng-if="materiales_iniciales_proyecto!==false" >
            <h3 class="text-center mb-3">Lista inicial de materiales</h3>
            <?php if (isset($material_actualizado)){
                if ($material_actualizado == 1) { ?>
                    <div class="alert alert-success"><p>Material actualizado con éxito.</p></div>
                <?php } else { ?>
                    <div class="alert alert-danger"><p>Hubo un problema al actualizar el material.</p></div>
                <?php }
            } ?>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="buscar_inicial_material">Buscar material:</label>
                        <input ng-model="buscar_inicial_material" class="form-control" id="buscar_inicial_material" type="text" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="buscar_inicial_material_codigo">Buscar material por código:</label>
                        <input ng-model="buscar_inicial_material_codigo" class="form-control" id="buscar_inicial_material_codigo" type="text" />
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th class="d-md-none">Acciones</th>
                            <th>Material</th>
                            <th>Cantidad</th>
                            <th>Proveedor</th>
                            <th>Costo total</th>
                            <th>Impuesto</th>
                            <th class="d-none d-md-table-cell">Acciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr ng-repeat="material in materiales_iniciales_proyecto | filter:{material: buscar_inicial_material, material_codigo: buscar_inicial_material_codigo}">
                            <td class="d-md-none">
                                <button ng-if="editar_proveedor[material.proyecto_material_id]===false" ng-click="habilitarEdicionMaterial(material.proyecto_material_id)" class="btn btn-primary btn-sm mb-1">
                                    <i class="fa fa-fw fa-edit"></i>
                                </button>
                                <button ng-if="editar_proveedor[material.proyecto_material_id]===true" ng-click="actualizarMaterial(material.proyecto_material_id)" class="btn btn-success btn-sm mb-1">
                                    <i class="fa fa-fw fa-check" ng-show="guardando[material.proyecto_material_id]===false"></i><i class="fa fa-fw fa-spinner" ng-show="guardando[material.proyecto_material_id]===true"></i>
                                </button>
                                <button ng-if="editar_proveedor[material.proyecto_material_id]===true" ng-click="cancelarEdicionMaterial(material.proyecto_material_id)" class="btn btn-sm btn-danger mb-1">
                                    <i class="fa fa-fw fa-ban"></i>
                                </button>
                            </td>
                            <td>{{material.material + ' (' + material.material_codigo + ')'}}<br /><span class="font-italic">{{material.comentario}}</span></td>
                            <td>{{material.cantidad + ' ' + material.material_unidad}}</td>
                            <td>
                                <div class="edit-container row" ng-show="editar_proveedor[material.proyecto_material_id]===true">
                                    <div class="col-12">
                                        <select class="form-control chosen-select" chosen data-placeholder="Seleccione un proveedor..." id="proveedor_id" ng-model="proveedor_id[material.proyecto_material_id]" >
                                            <?php foreach($proveedores as $kproveedor => $vproveedor){ ?>
                                                <option ng-value="<?=$vproveedor->proveedor_id?>" value="<?=$vproveedor->proveedor_id?>"><?=@$vproveedor->nombre_proveedor?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                     <div ng-show="mensaje_error[material.proyecto_material_id].error_proveedor !== undefined" class="col-12 mt-2">
                                         <div class="alert alert-danger">
                                             {{mensaje_error[material.proyecto_material_id].error_proveedor}}
                                         </div>
                                     </div>
                                </div>
                                {{(editar_proveedor[material.proyecto_material_id] === false && material.nombre_proveedor !== null)?material.nombre_proveedor:''}}
                            </td>
                            <td>
                                <div class="edit-container row" ng-show="editar_proveedor[material.proyecto_material_id]===true">
                                    <div class="col-4">
                                        <select class="form-control" ng-model="moneda_id[material.proyecto_material_id]" ng-change="inputMask()" aria-describedby="tigoGastoHelp">
                                            <?php if(isset($monedas)){
                                                    foreach ($monedas as $kmoneda => $vmoneda) { ?>
                                                        <option value="<?=$vmoneda->moneda_id?>" ng-value="<?=$vmoneda->moneda_id?>"><?=$vmoneda->simbolo?></option>
                                            <?php   }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" ng-class="{ 'input-money-mask': moneda_id[material.proyecto_material_id]==1, 'input-money-mask-colones': moneda_id[material.proyecto_material_id]==2 }" aria-describedby="valorExtensionHelp" ng-model="precio[material.proyecto_material_id]">
                                    </div>
                                     <div ng-show="mensaje_error[material.proyecto_material_id].error_precio !== undefined" class="col-12 mt-2">
                                         <div class="alert alert-danger">
                                             {{mensaje_error[material.proyecto_material_id].error_precio}}
                                         </div>
                                     </div>
                                </div>
                                {{(editar_proveedor[material.proyecto_material_id] === false && material.precio !== null)?((material.simbolo !== null)?material.simbolo:'')+' '+material.precio:''}}
                            </td>
                            <td>
                                <div class="edit-container row" ng-show="editar_proveedor[material.proyecto_material_id]===true">
                                    <div ng-class="{'col-6':tiene_impuesto[material.proyecto_material_id] == 1, 'col-12':tiene_impuesto[material.proyecto_material_id] == 0}">
                                        <select class="form-control" ng-model="tiene_impuesto[material.proyecto_material_id]" aria-describedby="tieneImpuestoHelp">
                                            <option value="0" ng-value="0" selected="selected">No</option>
                                            <option value="1" ng-value="1">Si</option>
                                        </select>
                                    </div>
                                    <div class="col-6" ng-show="tiene_impuesto[material.proyecto_material_id] == 1">
                                        <input  type="number"  step="0.05" pattern="^\d+(?:\.\d{1,2})?$"  class="form-control" aria-describedby="valorExtensionHelp" ng-model="impuesto[material.proyecto_material_id]">
                                    </div>
                                     <div ng-show="mensaje_error[material.proyecto_material_id].error_impuesto !== undefined" class="col-12 mt-2">
                                        <div class="alert alert-danger">
                                            {{mensaje_error[material.proyecto_material_id].error_impuesto}}
                                        </div>
                                    </div>
                                </div>
                                {{(editar_proveedor[material.proyecto_material_id] === false && material.impuesto !== null)?material.impuesto+' %':''}}
                            </td>
                            <td class="d-none d-md-table-cell"> 
                                <button ng-if="editar_proveedor[material.proyecto_material_id]===false" ng-click="habilitarEdicionMaterial(material.proyecto_material_id)" class="btn btn-primary btn-sm mb-1">
                                    <i class="fa fa-fw fa-edit"></i>
                                </button>
                                <button ng-if="editar_proveedor[material.proyecto_material_id]===true" ng-click="actualizarMaterial(material.proyecto_material_id)" class="btn btn-success btn-sm mb-1">
                                    <i class="fa fa-fw fa-check" ng-show="guardando[material.proyecto_material_id]===false"></i><i class="fa fa-fw fa-spinner" ng-show="guardando[material.proyecto_material_id]===true"></i>
                                </button>
                                <button ng-if="editar_proveedor[material.proyecto_material_id]===true" ng-click="cancelarEdicionMaterial(material.proyecto_material_id)" class="btn btn-sm btn-danger mb-1">
                                    <i class="fa fa-fw fa-ban"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>

    
        <p ng-if="materiales_iniciales_proyecto===false" class="text-center table-espaciado">No hay materiales asignados aún</p>
    </div>

    <div class="listado-materiales" ng-if="materiales_extensiones_proyecto!==false">
        <h3 class="text-center mb-3">Lista de extensiones de materiales</h3>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="buscar_extension_material">Buscar material:</label>
                    <input ng-model="buscar_extension_material" class="form-control" id="buscar_extension_material" type="text" />
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="buscar_extension_material_codigo">Buscar material por código:</label>
                    <input ng-model="buscar_extension_material_codigo" class="form-control" id="buscar_extension_material_codigo" type="text" />
                </div>
            </div>
        </div>
        <div class="table-espaciado" >
            <div class="table-responsive">
                <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th class="d-md-none">Acciones</th>
                            <th>Material</th>
                            <th>Cantidad</th>
                            <th>Proveedor</th>
                            <th>Costo total</th>
                            <th>Impuesto</th>
                            <th class="d-none d-md-table-cell">Acciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr ng-repeat="material_extension in materiales_extensiones_proyecto | filter:{material: buscar_extension_material, material_codigo: buscar_extension_material_codigo}">
                            <td class="d-md-none">
                                <button ng-if="editar_proveedor[material_extension.proyecto_material_id]===false" ng-click="habilitarEdicionMaterial(material_extension.proyecto_material_id)" class="btn btn-primary btn-sm mb-1">
                                    <i class="fa fa-fw fa-edit"></i>
                                </button>
                                <button ng-if="editar_proveedor[material_extension.proyecto_material_id]===true" ng-click="actualizarMaterial(material_extension.proyecto_material_id)" class="btn btn-success btn-sm mb-1">
                                    <i class="fa fa-fw fa-check" ng-show="guardando[material_extension.proyecto_material_id]===false"></i><i class="fa fa-fw fa-spinner" ng-show="guardando[material_extension.proyecto_material_id]===true"></i>
                                </button>
                                <button ng-if="editar_proveedor[material_extension.proyecto_material_id]===true" ng-click="cancelarEdicionMaterial(material_extension.proyecto_material_id)" class="btn btn-sm btn-danger mb-1">
                                    <i class="fa fa-fw fa-ban"></i>
                                </button>
                            </td>
                            <td>{{material_extension.material + ' (' + material_extension.material_codigo + ')'}}<br /><span class="font-italic">{{material_extension.comentario}}</span></td>
                            <td>{{material_extension.cantidad + ' ' + material_extension.material_unidad}}</td>
                            <td>
                                <div class="edit-container row" ng-show="editar_proveedor[material_extension.proyecto_material_id]===true">
                                    <div class="col-12">
                                        <select class="form-control chosen-select" chosen data-placeholder="Seleccione un proveedor..." id="proveedor_id" ng-model="proveedor_id[material_extension.proyecto_material_id]" >
                                            <?php foreach($proveedores as $kproveedor => $vproveedor){ ?>
                                                <option ng-value="<?=$vproveedor->proveedor_id?>" value="<?=$vproveedor->proveedor_id?>"><?=@$vproveedor->nombre_proveedor?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div ng-show="mensaje_error[material_extension.proyecto_material_id].error_proveedor !== undefined" class=" col-12 mt-2">
                                        <div class="alert alert-danger">
                                            {{mensaje_error[material_extension.proyecto_material_id].error_proveedor}}
                                        </div>
                                    </div>
                                </div>
                                {{(editar_proveedor[material_extension.proyecto_material_id]===false && material_extension.nombre_proveedor !== null)?material_extension.nombre_proveedor:''}}
                            </td>
                            <td>
                                <div class="edit-container row" ng-show="editar_proveedor[material_extension.proyecto_material_id]===true">
                                    <div class="col-4">
                                        <select class="form-control" ng-model="moneda_id[material_extension.proyecto_material_id]" ng-change="inputMask()" aria-describedby="tigoGastoHelp">
                                            <?php if(isset($monedas)){
                                                    foreach ($monedas as $kmoneda => $vmoneda) { ?>
                                                        <option value="<?=$vmoneda->moneda_id?>" ng-value="<?=$vmoneda->moneda_id?>"><?=$vmoneda->simbolo?></option>
                                            <?php   }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" ng-class="{ 'input-money-mask': moneda_id[material_extension.proyecto_material_id]==1, 'input-money-mask-colones': moneda_id[material_extension.proyecto_material_id]==2 }" aria-describedby="valorExtensionHelp" ng-model="precio[material_extension.proyecto_material_id]">
                                    </div>
                                    <div ng-show="mensaje_error[material_extension.proyecto_material_id].error_precio !== undefined" class="col-12 mt-2">
                                        <div class="alert alert-danger">
                                            {{mensaje_error[material_extension.proyecto_material_id].error_precio}}
                                        </div>
                                    </div>
                                </div>
                                {{(editar_proveedor[material_extension.proyecto_material_id] === false && material_extension.precio !== null)?((material_extension.simbolo !== null)?material_extension.simbolo:'')+' '+material_extension.precio:''}}
                            </td>
                            <td>
                                <div class="edit-container row" ng-show="editar_proveedor[material_extension.proyecto_material_id]===true">
                                    <div ng-class="{'col-6':tiene_impuesto[material_extension.proyecto_material_id] == 1, 'col-12':tiene_impuesto[material_extension.proyecto_material_id] == 0}">
                                        <select class="form-control" ng-model="tiene_impuesto[material_extension.proyecto_material_id]" aria-describedby="tieneImpuestoHelp">
                                            <option value="1" ng-value="1" selected="selected">Si</option>
                                            <option value="0" ng-value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-6" ng-show="tiene_impuesto[material_extension.proyecto_material_id] == 1">
                                        <input  type="number"  step="0.05" pattern="^\d+(?:\.\d{1,2})?$"  class="form-control"  aria-describedby="valorExtensionHelp" ng-model="impuesto[material_extension.proyecto_material_id]">
                                    </div>
                                    <div ng-show="mensaje_error[material_extension.proyecto_material_id].error_impuesto !== undefined" class="col-12 mt-2">
                                        <div class="alert alert-danger">{{mensaje_error[material_extension.proyecto_material_id].error_impuesto}}</div>
                                    </div>
                                </div>
                                {{(editar_proveedor[material_extension.proyecto_material_id] === false && material_extension.impuesto !== null)?material_extension.impuesto+' %':''}}
                            </td>
                            <td class="d-none d-md-table-cell"> 
                                <button ng-if="editar_proveedor[material_extension.proyecto_material_id]===false" ng-click="habilitarEdicionMaterial(material_extension.proyecto_material_id)" class="btn btn-primary btn-sm mb-1">
                                    <i class="fa fa-fw fa-edit"></i>
                                </button>
                                <button ng-if="editar_proveedor[material_extension.proyecto_material_id]===true" ng-click="actualizarMaterial(material_extension.proyecto_material_id)" class="btn btn-success btn-sm mb-1">
                                    <i class="fa fa-fw fa-check" ng-show="guardando[material_extension.proyecto_material_id]===false"></i><i class="fa fa-fw fa-spinner" ng-show="guardando[material_extension.proyecto_material_id]===true"></i>
                                </button>
                                <button ng-if="editar_proveedor[material_extension.proyecto_material_id]===true" ng-click="cancelarEdicionMaterial(material_extension.proyecto_material_id)" class="btn btn-sm btn-danger mb-1">
                                    <i class="fa fa-fw fa-ban"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>

    
        <p ng-if="materiales_extensiones_proyecto===false" class="text-center table-espaciado">No hay extensiones de materiales aún</p>
    </div>
</div>
