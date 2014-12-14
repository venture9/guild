<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

// ajax
$route[ 'ajax' ] = "";
$route[ 'ajax/designer-info-update' ] = "ajax/designer_info_update";
$route[ 'ajax/costumer-info-update' ] = "ajax/costumer_info_update";
$route[ 'ajax/costumer-create-project' ] = "ajax/costumer_create_project";

// routes for Designer
$route[ 'designer' ] = "designer";
$route[ 'designer/upload/catalog' ] = "designer/upload_catalog";
$route[ 'designer/do_upload' ] = "designer/do_upload";
$route[ 'designer/add/item' ] = "designer/add_item";
$route[ 'designer/add_designer' ] = "designer/add_designer";
$route[ 'designer/do_upload_images' ] = 'designer/do_upload_images';
$route[ 'designer/update/(:num)'] = 'designer/update/$1';

// routes for Costumer
$route[ 'costumer' ] = "costumer";


// routes for Costumers

// routes for Main
$route[ 'signup' ] = "main/signup";
$route[ 'signin' ] = "main/signin";
$route[ 'login' ] = "main/login";
$route[ 'logout' ] = "main/logout";
$route[ 'key-gen' ] = "main/key_gen";
$route[ 'key-result' ] = "main/key_result";

// routes for Upload
$route[ 'upload' ] = 'upload';
$route[ 'upload/do_upload' ] = 'upload/do_upload';

$route['default_controller'] = "main";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */