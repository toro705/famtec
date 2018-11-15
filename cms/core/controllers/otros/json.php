<?php

class Json extends CI_Controller {
	
	var $modules;

	function index()
	{
        echo "Nothing to view here";
    }
    
    function __construct(){
		
		parent::Controller();
		
		$this->modules = array();

		$junkFiles = array('.','..','gallery_ajax.php','json.php','login.php','home.php');
		
		if ($handle = opendir('core/controllers/')) {
			while (false !== ($file = readdir($handle))) {
				if (!in_array($file,$junkFiles)){
					$module = str_replace('.php','',$file);
					$this->modules[] = $module;
				}
			}
			closedir($handle);
		}
		
		
	}

	function requestModules(){
		
		//$user = 'admin';
		//$password = '21232f297a57a5a743894a0e4a801fc3';
		
		if(isset($_POST['user']) && isset($_POST['password'])){
		
			$user = $this->input->post('user');
			$password = $this->input->post('password');

			$modules = array();
			
			foreach($this->modules as $key){
				
				$module_data = json_decode($this->requestModule($key,$user,$password));
				
				$modules[] = array('key'=>$key, 'data'=>$module_data);
			}
			
		
			$data = array(
							'modules'=>$modules,			
							'result'=>array('status'=>'success', 'msg'=>'')
					);
		
		}else{
			$data = array('modules'=>array(), 'result'=>array('status'=>'auth_error', 'msg'=>'Error de autentificacion'));
		}
		
		echo json_encode($data);
	}
	
	function requestModule($key,$user,$password){
		
		$ch = curl_init('http://dev.duckmanito.com.ar/phpcrud/index.php?c='.$key.'&m=jsonGetConfig&digest=1');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, $user.':'.$password);

		return curl_exec($ch);
	}
	
	
}
?>
