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
$route['empleado/prestamos_empleado'] = 'empleado/prestamos_empleado';
$route['empleado/detalles_prestamo'] = 'empleado/detalles_prestamo';
$route['empleado/password'] = 'empleado/password';
$route['admin/verify'] = 'administrador/verify';
$route['admin/password'] = 'administrador/password';
$route['admin/actualizar_usuario'] = 'administrador/actualizar_usuario';
$route['admin/detalles_usuario/(:any)'] = 'administrador/detalles_usuario';
$route['admin/detalles_usuario'] = 'administrador/detalles_usuario';
$route['admin/consultar_usuario'] = 'administrador/consultar_usuario';
$route['admin/eliminar_articulo'] = 'administrador/eliminar_articulo';
$route['admin/view_img/(:any)/(:any)'] = 'administrador/view_img';
$route['admin/editar_articulo'] = 'administrador/editar_articulo';
$route['admin/editar_articulo/(:any)'] = 'administrador/editar_articulo';
$route['admin/detalles_articulo'] = 'administrador/detalles_articulo';
$route['admin/detalles_prestamo'] = 'administrador/detalles_prestamo';
$route['admin/detalles_articulo/(:any)'] = 'administrador/detalles_articulo';
$route['admin/registrar_prestamo_temp'] = 'administrador/registrar_prestamo_temp';
$route['admin/registrar_prestamo_perm'] = 'administrador/registrar_prestamo_perm';
$route['admin/consultar_articulo'] = 'administrador/consultar_articulo';
$route['admin/consultar_prestamo'] = 'administrador/consultar_prestamo';
$route['admin/registrar_articulo'] = 'administrador/registrar_articulo';
$route['user/logout'] = 'user/logout';
$route['soporte'] = 'soporte/menu';
$route['empleado'] = 'empleado/menu';
$route['admin'] = 'administrador/menu';
$route['user/login'] = 'user/login';
$route['user'] = 'user/$1';
$route['default_controller'] = 'user';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
