<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Instatec CR - Aprobación de Orden de Cambio - <?=$proyecto['nombre_proyecto']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=base_url()?>src/instatec_pub/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="<?=base_url()?>src/instatec_pub/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>src/instatec_pub/css/public.css" />	
    
    <script>
        var BASE_URL = "<?=base_url()?>";
    </script>
    <script src="<?=base_url()?>src/instatec_pub/js/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="<?=base_url()?>src/instatec_pub/js/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="<?=base_url()?>src/instatec_pub/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>	
    <script src="<?=base_url()?>src/instatec_pub/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>src/instatec_pub/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url()?>src/instatec_pub/js/angular.min.js"></script>
    <script src="<?=base_url()?>src/instatec_pub/js/jquery-ui.min.js"></script>
    <script src="<?=base_url()?>src/instatec_pub/js/jquery.maskMoney.min.js"></script>
    <script src="<?=base_url()?>src/instatec_pub/js/publico.js"></script>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="py-4">
                <div class="text-center">
                    <img src="<?=base_url()?>src/instatec_pub/images/logo.jpg" alt="">
                </div>
            </div>
        </div>
    </header>
    <div class="main-content"  ng-cloak ng-controller="comprobacionOrdenCambioCliente" ng-init="proyecto_id=<?=$proyecto['proyecto_id']?>;proyecto_valor_oferta_id=<?=$proyecto_extension['proyecto_valor_oferta_id']?>; <?=((isset($proyecto_extension['tiene_impuesto']))?'tiene_impuesto='.$proyecto_extension['tiene_impuesto'].';':'')?> consultarExtensionCambiosProyecto();">
        <div class="container">
            <div class="info-proyecto mt-5">
                <div class="card mb-3">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Aprobación de Orden de Cambio</h1>
                        <p class="text-justify">Bienvenido a la plataforma de aprobación de Órdenes de Cambio para proyectos de Instalaciones Tecnológicas INSTATEC S.A.</p>
                        <?php if ($proyecto_extension['proyecto_valor_oferta_extension_estado_id'] == 1) { ?>
                            <p class="text-justify">Se ha solicitado un cambio en el proyecto<?=$proyecto['nombre_proyecto']?>  y es necesaria su aprobación para proceder.</p>
                            <p class="text-justify">Haga click en el botón "Aprobar" para iniciar con la orden de cambio.</p>
                            <p class="text-justify">En caso de ser rechazada, favor indicarnos el motivo.</p>
                        <?php } else  if ($proyecto_extension['proyecto_valor_oferta_extension_estado_id'] == 3) { ?>
                            <p class="text-justify">Esta orden de cambio ya fue rechazada de su parte y no es necesaria ninguna otra acción.</p>
                        
                        <?php } else { ?>
                            <p class="text-justify">Esta orden de cambio ya fue aprobada de su parte y no es necesaria ninguna otra acción.</p>
                        <?php } ?>
                        <p class="text-justify">Cualquier duda o consulta puede contactar a <?=$proyecto['nombre'].' '.$proyecto['apellidos']?> al teléfono <a href="tel:+<?=$proyecto['telefono']?>"><?=$proyecto['telefono']?></a> o al correo <a href="mailto:<?=$proyecto['correo_electronico']?>"><?=$proyecto['correo_electronico']?></a></p>                    
                        <p>¡Muchas gracias!</p>
                    </div>    
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        Informacion de proyecto
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <p><strong>Cliente: </strong><?=$proyecto['nombre_cliente']?></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><strong>Proyecto: </strong><?=$proyecto['nombre_proyecto']?></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><strong>Orden de Cambio #: </strong><?=$proyecto_extension['proyecto_valor_oferta_id']?></p>
                            <!--</div>
                            <div class="col-12 col-md-6">
                                <p><strong>Estado de orden de Cambio: </strong><?=$proyecto_extension['proyecto_valor_oferta_extension_estado']?></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><strong>Jefe de proyecto: </strong><?=$proyecto['nombre'].' '.$proyecto['apellidos']?></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><strong>Teléfono de Jefe de proyecto: </strong><?=$proyecto['telefono']?></p>
                            </div>-->
                        </div>
                    </div>    
                </div>
                

                <div class="card mb-3">
                    <div class="card-header">
                        Lista de cambios
                    </div>
                    <div class="card-body">
                        <div class="cambios-content">
                            <div ng-if="cambios!==false" class="table-espaciado">
                                <p class="d-block d-md-none">Desplace hacia la derecha o izquierda la tabla para observar toda la información</p>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Cantidad</th>
                                                <th>Tipo</th>
                                                <th>Detalle</th>
                                                <th>Descripción</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="cambio-item" ng-repeat="cambio in cambios">
                                                <td>{{cambio.cantidad + ' ' + cambio.proyecto_valor_oferta_extension_unidad}}</td>
                                                <td>{{cambio.proyecto_valor_oferta_extension_tipo}}</td>
                                                <td>{{cambio.lamina_arquitectonica}}</td>
                                                <tD>{{cambio.descripcion}}</td>
                                                <td>{{(cambio.tipo_operacion==2)?'-':''}} {{cambio.total | currency}}</td>
                                                
                                            </tr>						
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-8"></div>
                                    <div class="col-12 col-md-4">
                                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <tr>
                                                <td><strong>Subtotal:</strong></td>
                                                <td>{{cambios_totales.subtotal | currency}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Impuestos:</strong></td>
                                                <td>{{cambios_totales.impuesto | currency}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total:</strong></td>
                                                <td>{{cambios_totales.total | currency}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>

                            
                            <p ng-if="cambios===false" class="text-center table-espaciado">No hay cambios registrados aún<br>
                                <a class="btn btn-primary mt-4" href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/<?=$proyecto_extension['proyecto_valor_oferta_id']?>/agregar-cambio" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar cambio</a>
                            </p>
                        </div>
                    </div>    
                </div>

                <?php if ($proyecto_extension['proyecto_valor_oferta_extension_estado_id'] == 1) { ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            Aprobación
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                </div>
                                <div class="col-12 col-md-3 text-center">
                                    <button  class="form-submit btn btn-success mb-2" ng-class="{'btn-loading-success': bloqueo_button_aprobar}" ng-disabled="bloqueo_button_aprobar" ng-click="aprobarOrden();"><i class="fa fa-check"></i> Aprobar</button>
                                </div>
                                <div class="col-12 col-md-3 text-center">
                                    <button  class="form-submit btn btn-danger mb-2" ng-click="habilitarTextboxCancelar();"><i class="fa fa-times"></i> Cancelar</button>
                                </div>
                                <div class="col-12 col-md-3">
                                    
                                </div>
                            </div>
                            <div class="row mt-4" ng-show="show_comentarios==true">
                                <div class="col-12">
                                    <div ng-show="error_formulario==true" class="alert alert-danger">Por favor complete el campo de comentarios para saber la razón exacta por la cual está cancelando esta orden de cambio.</div>
                                    <div class="form-group">
                                        <label for="comentarios">Comentarios</label>
                                        <textarea name="comentarios" ng-model="comentarios" id="comentarios" class="form-control" rows="5" aria-describedby="comentariosHelp"></textarea>
                                        <small id="comentariosHelp" class="form-text text-muted">Por favor indíquenos las razones por las cuales rechaza esta orden de cambio.</small>
                                    </div>
                                    <button ng-class="{'btn-loading-danger': bloqueo_button_cancelar}" ng-disabled="bloqueo_button_cancelar" ng-click="enviarCancelacion()" class="btn btn-danger">Enviar cancelación</button>
                                </div>
                            </div>
                        </div>    
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
    <footer class="footer">

    </footer>
</body>
</html>