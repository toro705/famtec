<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Constantes personalizadas */

define('GOOGLE_API_KEY', '');

define('CARPETA_CMS','cms');
define('CARPETA_RECURSOS','resources');
define('CARPETA_RECURSOS_FILES','files');
define('CARPETA_RECURSOS_IMAGES','images');
define('CARPETA_RECURSOS_GALLERIES','galleries');

define('BASE_URL',	'http://'.$_SERVER["SERVER_NAME"].'/'.CARPETA_CMS.'/');
define('BASE_PATH', BASEPATH.'../../');

define('RESOURCES_URL', 	BASE_URL.CARPETA_RECURSOS.'/');
define('RESOURCES_PATH',  	BASE_PATH.CARPETA_RECURSOS.'/');

define('FILES_RESOURCES_PATH',  	RESOURCES_PATH.CARPETA_RECURSOS_FILES.'/');
define('IMAGES_RESOURCES_PATH', 	RESOURCES_PATH.CARPETA_RECURSOS_IMAGES.'/');
define('GALLERIES_RESOURCES_PATH', 	RESOURCES_PATH.CARPETA_RECURSOS_GALLERIES.'/');

define('FILES_RESOURCES_URL',  		RESOURCES_URL.CARPETA_RECURSOS_FILES.'/');
define('IMAGES_RESOURCES_URL', 		RESOURCES_URL.CARPETA_RECURSOS_IMAGES.'/');
define('GALLERIES_RESOURCES_URL', 	RESOURCES_URL.CARPETA_RECURSOS_GALLERIES.'/');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */
