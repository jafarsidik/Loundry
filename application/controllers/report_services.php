<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_services extends MY_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$this->data['breadcrumb'] = '
			<li><a href="javascript:void(0)">Laporan</a></li>
			<li><a href="'.base_url($this->data['controller']).'">Laporan Daftar Layanan</a></li>
		';
	}
	
	public function index()
	{
		if($this->data['user_access_read']==true){
			$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">'.ucfirst(str_replace('_',' ',$this->data['method'])).'</li>';
			$this->data['service_category_lists'] = $this->call_sp("sel_SERVICE_CATEGORIES", array(0,0,"",""));
			$this->render($this->data);
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}
	
	public function reports()
	{
		if($this->data['user_access_read']==true){
			$this->data['cari'] = $this->input->get('cari');
			$this->data['category'] = $this->input->get('category');
			$this->data['min'] = $this->input->get('min');
			$this->data['max'] = $this->input->get('max');
			$this->data['lists'] = $this->call_sp("sel_SERVICES", array(0,0,"",$this->data['cari']));
			$this->data['title'] = "Laporan Daftar Layanan";
			$this->render_prints($this->data);
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}
	
}