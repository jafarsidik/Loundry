<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_permissions extends MY_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$this->data['breadcrumb'] = '
			<li><a href="javascript:void(0)">Pengaturan</a></li>
			<li><a href="'.base_url($this->data['controller']).'">Group Pengguna</a></li>
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
				'total_rows' => sizeof($this->call_sp("sel_USER_PERMISSIONS", $params)),
				'per_page' => $perpage,
				'num_links' => 3,
				'uri_segment' => 3
			);
			$params = array($perpage, $offset, "", (isset($this->data['search']['SEARCH_BY']) ? $this->data['search']['SEARCH_BY'] : ""));
			$this->data['lists'] = $this->call_sp("sel_USER_PERMISSIONS", $params);
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
				/* INSERT USER PERMISSIONS */
				$params = array(
					$data['NAME'],
					$data['DESC']
				);
				$result = $this->call_sp("ins_USER_PERMISSIONS", $params);
				/* INSERT USER PERMISSION ACCESS */
				$read_lists = array();
				$create_lists = array();
				$edit_lists = array();
				$delete_lists = array();
				foreach($data['READ'] as $read){ $read_lists[] = $read; }
				foreach($data['CREATE'] as $create){ $create_lists[] = $create; }
				foreach($data['EDIT'] as $edit){ $edit_lists[] = $edit; }
				foreach($data['DELETE'] as $delete){ $delete_lists[] = $delete; }
				$module_function_lists = $this->call_sp("sel_MODULE_FUNCTIONS");
				foreach($module_function_lists as $l){
					in_array($l->MODULE_FUNCTION_ID, $read_lists) ? $read = 1 : $read = 0;
					in_array($l->MODULE_FUNCTION_ID, $create_lists) ? $create = 1 : $create = 0;
					in_array($l->MODULE_FUNCTION_ID, $edit_lists) ? $edit = 1 : $edit = 0;
					in_array($l->MODULE_FUNCTION_ID, $delete_lists) ? $delete = 1 : $delete = 0;
					$params = array(
						$result[0]->LAST_ID,
						$l->MODULE_FUNCTION_ID,
						$read,
						$create,
						$edit,
						$delete
					);
					$this->call_sp("ins_USER_PERMISSION_ACCESS", $params);
				}
				if(sizeof($this->error)==0){
					$this->set_message('success', 'Data telah disimpan.');
					redirect(base_url($this->data['controller']));
				}else{
					$this->set_message('error', $this->error['message']);
					redirect(base_url($this->data['controller'].'/'.$this->data['method']));
				}
			}else{
				$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">Tambah</li>';
				$this->data['module_lists'] = $this->call_sp("sel_MODULES");
				$this->data['module_function_lists'] = $this->call_sp("sel_MODULE_FUNCTIONS");
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
				/* UPDATE USER PERMISSIONS */
				$params = array(
					$data['ID'],
					$data['NAME'],
					$data['DESC']
				);
				$this->call_sp("upd_USER_PERMISSIONS", $params);
				/* DELETE USER PERMISSION ACCESS */
				$this->call_sp("del_USER_PERMISSION_ACCESS", array($data['ID']));
				/* INSERT USER PERMISSION ACCESS */
				$read_lists = array();
				$create_lists = array();
				$edit_lists = array();
				$delete_lists = array();
				foreach($data['READ'] as $read){ $read_lists[] = $read; }
				foreach($data['CREATE'] as $create){ $create_lists[] = $create; }
				foreach($data['EDIT'] as $edit){ $edit_lists[] = $edit; }
				foreach($data['DELETE'] as $delete){ $delete_lists[] = $delete; }
				$module_function_lists = $this->call_sp("sel_MODULE_FUNCTIONS");
				foreach($module_function_lists as $l){
					in_array($l->MODULE_FUNCTION_ID, $read_lists) ? $read = 1 : $read = 0;
					in_array($l->MODULE_FUNCTION_ID, $create_lists) ? $create = 1 : $create = 0;
					in_array($l->MODULE_FUNCTION_ID, $edit_lists) ? $edit = 1 : $edit = 0;
					in_array($l->MODULE_FUNCTION_ID, $delete_lists) ? $delete = 1 : $delete = 0;
					$params = array(
						$data['ID'],
						$l->MODULE_FUNCTION_ID,
						$read,
						$create,
						$edit,
						$delete
					);
					$this->call_sp("ins_USER_PERMISSION_ACCESS", $params);
				}
				if(sizeof($this->error)==0){
					$this->set_message('success', 'Data telah diubah.');
					redirect(base_url($this->data['controller']));
				}else{
					$this->set_message('error', $this->error['message']);
					redirect(base_url($this->data['controller'].'/'.$this->data['method']));
				}
			}else{
				empty($this->uri->segment(3)) ? redirect(base_url($this->data['controller'])) : $id = $this->uri->segment(3);
				$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">Ubah</li>';
				$this->data['module_lists'] = $this->call_sp("sel_MODULES");
				$this->data['module_function_lists'] = $this->call_sp("sel_MODULE_FUNCTIONS");
				$this->data['edit'] = $this->call_sp("sel_USER_PERMISSIONS", array(0,0,$id,""));
				$this->data['edit'] = $this->data['edit'][0];
				$this->data['permission_access_lists'] = $this->call_sp("sel_USER_PERMISSION_ACCESS", array($this->data['edit']->PERMISSION_ID));
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
					$this->call_sp("del_USER_PERMISSIONS", array($del));
				}
			}else{
				$del = $this->uri->segment(3);
				$this->call_sp("del_USER_PERMISSIONS", array($del));
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