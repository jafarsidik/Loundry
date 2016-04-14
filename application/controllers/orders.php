<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends MY_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$this->data['breadcrumb'] = '
			<li><a href="javascript:void(0)">Pesanan</a></li>
			<li><a href="'.base_url($this->data['controller']).'">Pesanan</a></li>
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
				'total_rows' => sizeof($this->call_sp("sel_ORDERS", $params)),
				'per_page' => $perpage,
				'num_links' => 3,
				'uri_segment' => 3
			);
			$params = array($perpage, $offset, "", (isset($this->data['search']['SEARCH_BY']) ? $this->data['search']['SEARCH_BY'] : ""));
			$this->data['lists'] = $this->call_sp("sel_ORDERS", $params);
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
				$order = $this->input->post($this->data['controller']);
				$order_details = $this->input->post('order_details');
				if($order['CUSTOMERS'] == -1){
					$params = array(
						$order['CUSTOMER_TYPES'],
						$order['USERS'],
						$order['OWNER'],
						$order['NAME'],
						$order['ADDRESS'],
						$order['PHONE'],
						$order['EMAIL']
					);
					$this->call_sp("ins_CUSTOMERS", $params);
					$result = $this->call_sp("LAST_ID_CUSTOMERS");
					$order['CUSTOMERS'] = $result[0]->LAST_ID;
				}
				$order['DOWN_PAYMENT'] >= $order['TOTAL_PAYMENT'] ? $pay_status = 1 : $pay_status = 0;
				$params = array(
					$this->data['current_user']->USER_ID,
					$order['CUSTOMERS'],
					NULL,
					$order['DOWN_PAYMENT'],
					$order['TOTAL_PAYMENT'],
					$pay_status,
					0,
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
					redirect(base_url($this->data['controller']));
				}else{
					$this->set_message('error', $this->error['message']);
					redirect(base_url($this->data['controller'].'/'.$this->data['method']));
				}
			}else{
				$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">Tambah</li>';
				$this->data['customer_lists'] = $this->call_sp("sel_CUSTOMERS", array(0,0,"",""));
				$this->data['customer_type_lists'] = $this->call_sp("sel_CUSTOMER_TYPES", array(0,0,"",""));
				$this->data['user_lists'] = $this->call_sp("sel_USERS", array(0,0,"",""));
				$this->data['service_lists'] = $this->call_sp("sel_SERVICES", array(0,0,"",""));
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
				$order_details = $this->input->post('order_details');
				$params = array(
					$data['ORDER_ID'],
					$this->data['current_user']->USER_ID,
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
					redirect(base_url($this->data['controller']));
				}else{
					$this->set_message('error', $this->error['message']);
					redirect(base_url($this->data['controller'].'/'.$this->data['method']));
				}
			}else{
				empty($this->uri->segment(3)) ? redirect(base_url($this->data['controller'])) : $id = $this->uri->segment(3);
				$this->data['breadcrumb'] = $this->data['breadcrumb'].'<li class="active">Ubah</li>';
				$this->data['customer_lists'] = $this->call_sp("sel_CUSTOMERS", array(0,0,"",""));
				$this->data['customer_type_lists'] = $this->call_sp("sel_CUSTOMER_TYPES", array(0,0,"",""));
				$this->data['user_lists'] = $this->call_sp("sel_USERS", array(0,0,"",""));
				$this->data['service_lists'] = $this->call_sp("sel_SERVICES", array(0,0,"",""));
				$this->data['edit'] = $this->call_sp("sel_ORDERS", array(0,0,$id,""));
				$this->data['edit'] = $this->data['edit'][0];
				$this->data['details'] = $this->call_sp("sel_ORDER_DETAILS", array($this->data['edit']->ORDER_ID));
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
					$this->call_sp("del_ORDERS", array($del));
				}
			}else{
				$del = $this->uri->segment(3);
				$this->call_sp("del_ORDERS", array($del));
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

	public function accept()
	{
		if($this->data['user_access_read']==true){
			empty($this->uri->segment(3)) ? redirect(base_url($this->data['controller'])) : $id = $this->uri->segment(3);
			$orders = $this->call_sp("sel_ORDERS", array(0,0,$id,""));
			$params = array(
				$id,
				$this->data['current_user']->USER_ID,
				$orders[0]->CUSTOMER_ID,
				NULL,
				$orders[0]->DOWN_PAYMENT,
				$orders[0]->TOTAL_PAYMENT,
				$orders[0]->PAY_STATUS,
				2,
				NULL
			);
			$this->call_sp("upd_ORDERS", $params);
			if(sizeof($this->error)==0){
				$this->set_message('success', 'Data telah dikonfirmasi.');
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
	
	public function struck_orders()
	{
		if($this->data['user_access_read']==true){
			empty($this->uri->segment(3)) ? redirect(base_url($this->data['controller'])) : $id = $this->uri->segment(3);
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
	
}