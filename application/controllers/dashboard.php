<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$this->data['breadcrumb'] = '
			<li><a href="'.base_url($this->data['controller']).'">'.ucfirst(str_replace('_',' ',$this->data['controller'])).'</a></li>
		';
	}
	
	public function index()
	{
		if($this->data['user_access_read']==true){
			$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">'.ucfirst(str_replace('_',' ',$this->data['method'])).'</li>';
			$this->render($this->data);
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}
	
}