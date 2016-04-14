<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$this->data['breadcrumb'] = '
			<li><a href="javascript:void(0)">Pengaturan</a></li>
			<li><a href="'.base_url($this->data['controller']).'">Pengguna</a></li>
		';
	}
	
	public function index($offset=0)
	{
		if($this->data['user_access_read']==true){
			$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">'.ucfirst(str_replace('_',' ',$this->data['method'])).'</li>';
			if($this->input->server('REQUEST_METHOD')=='POST'){
				$data = $this->input->post($this->data['controller']);
				$this->data['search'] = array(
					'SEARCH_BY' => $data['SEARCH_BY']
				);
			}
			$perpage = 10;
			$params = array(0, 0, "", (isset($this->data['search']['SEARCH_BY']) ? $this->data['search']['SEARCH_BY'] : ""));
			$pagination = array(
				'base_url' => base_url($this->data['controller'].'/'.$this->data['method']),
				'total_rows' => sizeof($this->call_sp("sel_USERS", $params)),
				'per_page' => $perpage,
				'num_links' => 3,
				'uri_segment' => 3
			);
			$params = array($perpage, $offset, "", (isset($this->data['search']['SEARCH_BY']) ? $this->data['search']['SEARCH_BY'] : ""));
			$this->data['lists'] = $this->call_sp("sel_USERS", $params);
			$this->data['pagination'] = $this->paging($pagination);
			$this->render($this->data);
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}
	
	public function create()
	{
		if($this->data['user_access_create']==true){
			if($this->input->server('REQUEST_METHOD')=='POST'){
				$data = $this->input->post($this->data['controller']);
				if($data['PASSWORD'] == $data['CONFIRM_PASSWORD']){
					$params = array(
						$data['USER_PERMISSIONS'],
						$data['NAME'],
						$data['EMAIL'],
						$data['USERNAME'],
						$data['PASSWORD']
					);
					$this->call_sp("ins_USERS", $params);
					if(sizeof($this->error)==0){
						$this->set_message('success', 'Data telah disimpan.');
						redirect(base_url($this->data['controller']));
					}else{
						$this->set_message('error', $this->error['message']);
						redirect(base_url($this->data['controller'].'/'.$this->data['method']));
					}
				}else{
					$this->set_message("warning", "Kata sandi tidak cocok, silakan coba lagi.");
					redirect(base_url($this->data['controller'].'/'.$this->data['method']));
				}
			}else{
				$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">Tambah</li>';
				$this->data['user_permission_lists'] = $this->call_sp("sel_USER_PERMISSIONS", array(0,0,"",""));
				$this->render($this->data);
			}
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}
	
	public function edit()
	{
		if($this->data['user_access_update']==true){
			if($this->input->server('REQUEST_METHOD')=='POST'){
				$data = $this->input->post($this->data['controller']);
				$users = $this->call_sp("sel_USERS", array(0,0,$data['ID'],""));
				if(md5($data['OLD_PASSWORD']) == $users[0]->PASSWORD && $data['PASSWORD'] == $data['CONFIRM_PASSWORD']){
					$params = array(
						$data['ID'],
						$data['USER_PERMISSIONS'],
						$data['NAME'],
						$data['EMAIL'],
						$data['USERNAME']
					);
					$this->call_sp("upd_USERS", $params);
					$params = array(
						$data['ID'],
						$data['PASSWORD']
					);
					$this->call_sp("upd_CHANGE_PASSWORD", $params);
					if(sizeof($this->error)==0){
						$this->set_message('success', 'Data telah diubah.');
						redirect(base_url($this->data['controller']));
					}else{
						$this->set_message('error', $this->error['message']);
						redirect(base_url($this->data['controller'].'/'.$this->data['method']));
					}
				}elseif($data['OLD_PASSWORD'] == ""){
					$params = array(
						$data['ID'],
						$data['USER_PERMISSIONS'],
						$data['NAME'],
						$data['EMAIL'],
						$data['USERNAME']
					);
					$this->call_sp("upd_USERS", $params);
					if(sizeof($this->error)==0){
						$this->set_message('success', 'Data telah diubah.');
						redirect(base_url($this->data['controller']));
					}else{
						$this->set_message('error', $this->error['message']);
						redirect(base_url($this->data['controller'].'/'.$this->data['method']));
					}
				}else{
					$this->set_message("warning", "Kata sandi tidak cocok, silakan coba lagi.");
					redirect(base_url($this->data['controller'].'/'.$this->data['method']));
				}
			}else{
				empty($this->uri->segment(3)) ? redirect(base_url($this->data['controller'])) : $id = $this->uri->segment(3);
				$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">Ubah</li>';
				$this->data['user_permission_lists'] = $this->call_sp("sel_USER_PERMISSIONS", array(0,0,"",""));
				$this->data['edit'] = $this->call_sp("sel_USERS", array(0,0,$id,""));
				$this->data['edit'] = $this->data['edit'][0];
				$this->render($this->data);
			}
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}
	
	public function delete()
	{
		if($this->data['user_access_delete']==true){
			if($this->input->server('REQUEST_METHOD')=='POST'){
				$data = $this->input->post($this->data['controller']);
				foreach($data['DEL'] as $del){
					$this->call_sp("del_USERS", array($del));
				}
			}else{
				$del = $this->uri->segment(3);
				$this->call_sp("del_USERS", array($del));
			}
			if(sizeof($this->error)==0){
				$this->set_message('success', 'Data telah dihapus.');
				redirect(base_url($this->data['controller']));
			}else{
				$this->set_message('error', $this->error['message']);
				redirect(base_url($this->data['controller'].'/'.$this->data['method']));
			}
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}
	
}