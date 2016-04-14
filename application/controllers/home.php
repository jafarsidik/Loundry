<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$this->data['breadcrumb'] = '
			<li><a href="'.base_url($this->data['controller']).'">'.ucfirst(str_replace('_',' ',$this->data['controller'])).'</a></li>
		';
	}
	
	public function index()
	{
		$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">'.ucfirst(str_replace('_',' ',$this->data['method'])).'</li>';
		$this->render($this->data, "index", "frontpage");
	}
	
	public function signin()
	{
		if($this->session->userdata('current_user')==false){
			if($this->input->server('REQUEST_METHOD')=='POST'){
				$data = $this->input->post($this->data['controller']);
				$current_user = $this->call_sp("sel_SIGNIN", array($data['USERNAME'], $data['PASSWORD']));
				if(sizeof($this->error)==0){
					if(sizeof($current_user) > 0){
						$this->session->set_userdata('current_user', $current_user[0]);
						$this->set_message("success", "Anda berhasil masuk.");
						$this->data['current_user'] = $this->session->userdata('current_user');
						if($this->data['current_user']->PERMISSION_ID==1 || $this->data['current_user']->PERMISSION_ID==2){
							redirect(base_url('dashboard'));
						}elseif($this->data['current_user']->PERMISSION_ID==3 || $this->data['current_user']->PERMISSION_ID==4){
							redirect(base_url());
						}
					}else{
						$this->set_message("error", "Nama Pengguna atau Kata Sandi tidak valid.");
						redirect(base_url());
					}
				}else{
					$this->set_message("error", $this->error['message']);
					redirect(base_url());
				}
			}else{
				$this->render($this->data, "index", "frontpage");
			}
		}else{
			$this->set_message("info", "Anda login sebagai : ".$this->data['current_user']->USER_NAME.".");
			redirect(base_url('dashboard'));
		}
	}
	
	public function signout()
	{
		if($this->data['user_access_read']==true){
			$this->session->unset_userdata('current_user');
			$this->set_message("success", "Anda berhasil keluar.");
			redirect(base_url());
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}
	
	public function signup()
	{
		if($this->session->userdata('current_user')==false){
			if($this->input->server('REQUEST_METHOD')=='POST'){
				$data = $this->input->post($this->data['controller']);
				if($data['PASSWORD'] == $data['CONFIRM_PASSWORD']){
					$params = array(
						3,
						$data['NAME'],
						$data['EMAIL'],
						$data['USERNAME'],
						$data['PASSWORD']
					);
					$this->call_sp("ins_USERS", $params);
					$result = $this->call_sp("LAST_ID_USERS");
					$params = array(
						3,
						$result[0]->LAST_ID,
						NULL,
						$data['NAME'],
						$data['ADDRESS'],
						$data['PHONE'],
						$data['EMAIL']
					);
					$this->call_sp("ins_CUSTOMERS", $params);
					if(sizeof($this->error)==0){
						$this->set_message("success", "Akun anda berhasil dibuat.");
						redirect(base_url($this->data['controller']));
					}else{
						$this->set_message("error", $this->error['message']);
						redirect(base_url($this->data['controller'].'/'.$this->data['method']));
					}
				}else{
					$this->set_message("warning", "Kata sandi tidak cocok, silakan coba lagi.");
					redirect(base_url($this->data['controller'].'/'.$this->data['method']));
				}
			}else{
				$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">Daftar</li>';
				$this->render($this->data, "signup", "frontpage");
			}
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}
	
	public function price_lists($offset=0)
	{
		$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">Daftar Harga</li>';
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
			'total_rows' => sizeof($this->call_sp("sel_SERVICES", $params)),
			'per_page' => $perpage,
			'num_links' => 3,
			'uri_segment' => 3
		);
		$params = array($perpage, $offset, "", (isset($this->data['search']['SEARCH_BY']) ? $this->data['search']['SEARCH_BY'] : ""));
		$this->data['lists'] = $this->call_sp("sel_SERVICES", $params);
		$this->data['pagination'] = $this->paging($pagination);
		$this->render($this->data, "price_lists", "frontpage");
	}

	public function order_lists($offset=0)
	{
		if($this->data['user_access_read']==true){
			$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">Daftar Pesanan</li>';
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
				'total_rows' => sizeof($this->call_sp("sel_ORDERS", $params)),
				'per_page' => $perpage,
				'num_links' => 3,
				'uri_segment' => 3
			);
			$params = array($perpage, $offset, "", (isset($this->data['search']['SEARCH_BY']) ? $this->data['search']['SEARCH_BY'] : ""));
			$customer_lists = $this->call_sp("sel_CUSTOMERS", array(0,0,"",""));
			$this->data['customer_id'] = NULL;
			foreach($customer_lists as $l){
				if($l->USER_ID==$this->data['current_user']->USER_ID) $this->data['customer_id'] = $l->CUSTOMER_ID;
			}
			$this->data['lists'] = $this->call_sp("sel_ORDERS", $params);
			$this->data['pagination'] = $this->paging($pagination);
			$this->render($this->data, "order_lists", "frontpage");
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}
	
	public function order()
	{
		if($this->data['user_access_create']==true){
			if($this->input->server('REQUEST_METHOD')=='POST'){
				$order = $this->input->post($this->data['controller']);
				$order_details = $this->input->post('order_details');
				$order['DOWN_PAYMENT'] >= $order['TOTAL_PAYMENT'] ? $pay_status = 1 : $pay_status = 0;
				$customer_lists = $this->call_sp("sel_CUSTOMERS", array(0,0,"",""));
				$customer_id = NULL;
				foreach($customer_lists as $l){
					if($l->USER_ID==$this->data['current_user']->USER_ID) $customer_id = $l->CUSTOMER_ID;
				}
				$params = array(
					NULL,
					$customer_id,
					NULL,
					$order['DOWN_PAYMENT'],
					$order['TOTAL_PAYMENT'],
					$pay_status,
					1,
					NULL
				);
				$result = $this->call_sp("ins_ORDERS", $params);
				foreach($order_details['ID_SERVICES'] as $key => $row){
					$params = array(
						$result[0]->LAST_ID,
						$row,
						$order_details['PRICE'][$key],
						$order_details['AMOUNT'][$key]
					);
					$this->call_sp("ins_ORDER_DETAILS", $params);
				}
				if(sizeof($this->error)==0){
					$this->set_message('success', 'Data telah disimpan.');
					redirect(base_url($this->data['controller'].'/order_lists'));
				}else{
					$this->set_message('error', $this->error['message']);
					redirect(base_url($this->data['controller'].'/'.$this->data['method']));
				}
			}else{
				$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">Pesanan</li>';
				$this->data['service_lists'] = $this->call_sp("sel_SERVICES", array(0,0,"",""));
				$this->render($this->data, "order", "frontpage");
			}
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}

	public function order_edit()
	{
		if($this->data['user_access_update']==true){
			if($this->input->server('REQUEST_METHOD')=='POST'){
				$data = $this->input->post($this->data['controller']);
				$order_details = $this->input->post('order_details');
				$params = array(
					$data['ORDER_ID'],
					NULL,
					$data['CUSTOMER_ID'],
					NULL,
					$data['DOWN_PAYMENT'],
					$data['TOTAL_PAYMENT'],
					$data['PAY_STATUS'],
					$data['ORDER_STATUS'],
					NULL
				);
				$this->call_sp("upd_ORDERS", $params);
				$this->call_sp("del_ORDER_DETAILS", array($data['ORDER_ID']));
				foreach($order_details['ID_SERVICES'] as $key => $row){
					$params = array(
						$data['ORDER_ID'],
						$row,
						$order_details['PRICE'][$key],
						$order_details['AMOUNT'][$key]
					);
					$this->call_sp("ins_ORDER_DETAILS", $params);
				}
				if(sizeof($this->error)==0){
					$this->set_message('success', 'Data telah diubah.');
					redirect(base_url($this->data['controller'].'/order_lists'));
				}else{
					$this->set_message('error', $this->error['message']);
					redirect(base_url($this->data['controller'].'/order_lists'));
				}
			}else{
				empty($this->uri->segment(3)) ? redirect(base_url($this->data['controller'].'/order_lists')) : $id = $this->uri->segment(3);
				$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">Ubah Pesanan</li>';
				$this->data['service_lists'] = $this->call_sp("sel_SERVICES", array(0,0,"",""));
				$this->data['edit'] = $this->call_sp("sel_ORDERS", array(0,0,$id,""));
				$this->data['edit'] = $this->data['edit'][0];
				$this->data['details'] = $this->call_sp("sel_ORDER_DETAILS", array($this->data['edit']->ORDER_ID));
				$this->render($this->data, "order_edit", "frontpage");
			}
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}

	public function order_delete()
	{
		if($this->data['user_access_delete']==true){
			if($this->input->server('REQUEST_METHOD')=='POST'){
				$data = $this->input->post($this->data['controller']);
				foreach($data['DEL'] as $del){
					$this->call_sp("del_ORDERS", array($del));
				}
			}else{
				$del = $this->uri->segment(3);
				$this->call_sp("del_ORDERS", array($del));
			}
			if(sizeof($this->error)==0){
				$this->set_message('success', 'Data telah dihapus.');
				redirect(base_url($this->data['controller'].'/order_lists'));
			}else{
				$this->set_message('error', $this->error['message']);
				redirect(base_url($this->data['controller'].'/order_lists'));
			}
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}

	public function order_struck()
	{
		if($this->data['user_access_read']==true){
			empty($this->uri->segment(3)) ? redirect(base_url($this->data['controller'].'/order_lists')) : $id = $this->uri->segment(3);
			$this->data['orders'] = $this->call_sp("sel_ORDERS", array(0,0,$id,""));
			$this->data['orders'] = $this->data['orders'][0];
			$this->data['detail_lists'] = $this->call_sp("sel_ORDER_DETAILS", array($id));
			$this->data['title'] = "Struk Pesanan";
			$this->render_prints($this->data);
		}else{
			$this->set_message("warning", "Anda tidak memiliki izin untuk mengakses halaman ini.");
			redirect(base_url());
		}
	}
	
	public function contact()
	{
		$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">Kontak</li>';
		$this->render($this->data, "contact", "frontpage");
	}
	
}