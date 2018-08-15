<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['default_controller'] = 'general/dashboard';

// Inicio
$route['login'] = 'login/login';
$route['logout'] = 'login/logout';

//Dashboard
$route['dashboard'] = 'general/dashboard';

//Clientes
$route['clientes'] = 'cliente/index';
$route['clientes/ver-cliente/(:num)'] = 'cliente/verCliente/$1';
$route['clientes/agregar-cliente'] = 'cliente/agregarCliente';
$route['clientes/editar-cliente/(:num)'] = 'cliente/editarCliente/$1';
$route['clientes/remover-cliente/(:num)'] = 'cliente/removerCliente/$1';

//Proveedores
$route['proveedores'] = 'proveedor/index';
$route['proveedores/agregar-proveedor'] = 'proveedor/agregarProveedor';
$route['proveedores/ver-proveedor/(:num)'] = 'proveedor/verProveedor/$1';
$route['proveedores/editar-proveedor/(:num)'] = 'proveedor/editarProveedor/$1';
$route['proveedores/remover-proveedor/(:num)'] = 'proveedor/removerProveedor/$1';


//Proyectos
$route['proyectos'] = 'proyecto/index';
$route['proyectos/agregar-proyecto'] = 'proyecto/agregarProyecto';
$route['proyectos/ver-proyecto/(:num)'] = 'proyecto/verProyecto/$1';
$route['proyectos/editar-proyecto/(:num)'] = 'proyecto/editarProyecto/$1';
$route['proyectos/remover-proyecto/(:num)'] = 'proyecto/removerProyecto/$1';
$route['proyectos/extensiones/(:num)'] = 'proyecto/verExtensionesProyecto/$1';
$route['proyectos/extensiones/(:num)/agregar-extension'] = 'proyecto/agregarExtensionProyecto/$1';
$route['proyectos/extensiones/(:num)/editar-extension/(:num)'] = 'proyecto/editarExtensionProyecto/$1/$2';
$route['proyectos/extensiones/tipos-orden-cambio'] = 'proyecto/verTiposOrdenCambio';
$route['proyectos/extensiones/agregar-tipo-orden-cambio'] = 'proyecto/agregarTipoOrdenCambio';
$route['proyectos/extensiones/editar-tipo-orden-cambio/(:num)'] = 'proyecto/editarTipoOrdenCambio/$1';
$route['proyectos/gastos/(:num)'] = 'proyecto/verGastosProyecto/$1';
$route['proyectos/gastos/(:num)/agregar-gasto'] = 'proyecto/agregarGastoProyecto/$1/';
$route['proyectos/gastos/(:num)/editar-gasto/(:num)'] = 'proyecto/editarGastoProyecto/$1/$2';
$route['proyectos/colaboradores/(:num)'] = 'proyecto/verColaboradores/$1';
$route['proyectos/colaboradores/(:num)/editar-colaboradores'] = 'proyecto/editarColaboradores/$1/';
$route['proyectos/colaboradores/(:num)/registrar-tiempo-colaboradores'] = 'proyecto/registrarTiemposColaboradores/$1';


//Reportes
$route['reportes'] = 'reporte/index';
$route['reportes/proyectos-general'] = 'reporte/reporteProyectosGeneral';
$route['reportes/proyecto-especifico'] = 'reporte/reporteProyectoEspecifico';
$route['reportes/proyecto-especifico/(:num)'] = 'reporte/generarReporteProyectoEspecifico/$1';
$route['reportes/horas-por-trabajador'] = 'reporte/reporteHorasPorTrabajador';
$route['reportes/horas-por-trabajador/(:num)'] = 'reporte/reporteHorasPorTrabajadorDetalle/$1';
$route['reportes/horas-por-proyecto'] = 'reporte/reporteHorasPorProyecto';
$route['reportes/horas-por-proyecto/(:num)'] = 'reporte/reporteHorasPorProyectoDetalle/$1';
$route['reportes/gastos-materiales'] = 'reporte/reporteGastosMaterialesPorProyecto';
$route['reportes/gastos-materiales/(:num)'] = 'reporte/reporteGastosMaterialesPorProyectoDetalle/$1';

//Usuarios
$route['usuarios'] = 'usuario/index';
$route['usuarios/ver-usuario/(:num)'] = 'usuario/verUsuario/$1';
$route['usuarios/agregar-usuario'] = 'usuario/agregarUsuario';
$route['usuarios/editar-usuario/(:num)'] = 'usuario/editarUsuario/$1';
$route['usuarios/remover-usuario/(:num)'] = 'usuario/removerUsuario/$1';


//Colaboradores
$route['colaboradores'] = 'colaborador/index';
$route['colaboradores/ver-colaborador/(:num)'] = 'colaborador/verColaborador/$1';
$route['colaboradores/agregar-colaborador'] = 'colaborador/agregarColaborador';
$route['colaboradores/editar-colaborador/(:num)'] = 'colaborador/editarColaborador/$1';
$route['colaboradores/remover-colaborador/(:num)'] = 'colaborador/removerColaborador/$1';

//Puestos de trabajo
$route['colaboradores/puestos-trabajo'] = 'colaborador/verPuestos';
$route['colaboradores/agregar-puesto-trabajo'] = 'colaborador/agregarPuestoTrabajo';
$route['colaboradores/editar-puesto-trabajo/(:num)'] = 'colaborador/editarPuestoTrabajo/$1';


//$route['registro-admin'] = 'usuario/registro_admin';

//Errores
$route['acceso-denegado'] = 'general/errorPermisoDenegado';