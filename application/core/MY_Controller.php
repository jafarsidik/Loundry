<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	public $error = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->data['controller'] = $this->router->fetch_class();
    $this->data['method'] = $this->router->fetch_method();
		
		$this->data['current_user'] = array();
		$this->data['tree_menu_lists'] = array();
		$this->data['user_access_read'] = false;
		$this->data['user_access_create'] = false;
		$this->data['user_access_update'] = false;
		$this->data['user_access_delete'] = false;
		if($this->session->userdata('current_user')==false){
			$public_page = array('home/index', 'home/signin', 'home/signup', 'home/price_lists', 'home/contact');
			if(!in_array($this->data['controller'].'/'.$this->data['method'], $public_page)){
				$this->set_message("error", "Please sign in first.");
				redirect(base_url());
			}
		}else{
			$this->data['current_user'] = $this->session->userdata('current_user');
			$this->data['tree_menu_lists'] = $this->call_sp("sel_TREE_MENUS", array($this->data['current_user']->PERMISSION_ID));
			$this->data['user_access_lists'] = $this->call_sp("sel_USER_ACCESS", array($this->data['current_user']->PERMISSION_ID, $this->data['controller']));
			if(sizeof($this->data['user_access_lists']) > 0){
				$this->data['user_access_lists'][0]->READ==1 ? $this->data['user_access_read'] = true : $this->data['user_access_read'] = false;
				$this->data['user_access_lists'][0]->CREATE==1 ? $this->data['user_access_create'] = true : $this->data['user_access_create'] = false;
				$this->data['user_access_lists'][0]->UPDATE==1 ? $this->data['user_access_update'] = true : $this->data['user_access_update'] = false;
				$this->data['user_access_lists'][0]->DELETE==1 ? $this->data['user_access_delete'] = true : $this->data['user_access_delete'] = false;
			}
		}
	}
	
	protected function render($data = null, $view = null, $type = 'default')
	{		
    if (isset($data['breadcrumb']) && $data != null) {
      $this->data['breadcrumb'] = '<ol class="breadcrumb">' . $data['breadcrumb'] . '</ol>';
    }
		
    if ($view != null) {
      $views = explode('/', $view);
      if (sizeof($views) == 2) {
        $uri = $views[0] . '/' . $views[1];
      } else {
        $uri = $this->data['controller'] . '/' . $view;
      }
    } else {
			$uri = $this->data['controller'] . '/' . $this->data['method'];
		}
		
		$this->data['content_type'] = $type;
		$this->data['menubar'] = $this->load->view('shared/menubar', $this->data, true);
		$this->data['navbar'] = $this->load->view('shared/navbar', $this->data, true);
		$this->data['sidebar'] = $this->load->view('shared/sidebar', $this->data, true);
		$this->data['alert_session'] = $this->load->view('templates/template_alert_session', $this->data, true);
		$this->data['alert_js'] = $this->load->view('templates/template_alert_js', $this->data, true);
		$this->data['content'] = $this->load->view($uri, $this->data, true);
		$this->load->view('templates/template', $this->data);
	}
	
	protected function render_prints($data = null, $view = null)
	{
		if (isset($data['title']) && $data != null) {
			$this->data['title'] = "Print ".$data['title'];
		}else{
			$this->data['title'] = "Print";
		}
    if ($view != null) {
      $views = explode('/', $view);
      if (sizeof($views) == 2) {
        $uri = $views[0] . '/' . $views[1];
      } else {
        $uri = $this->data['controller'] . '/' . $view;
      }
    } else {
			$uri = $this->data['controller'] . '/' . $this->data['method'];
		}
		$this->data['content'] = $this->load->view($uri, $this->data, true);
		$this->load->view("templates/template_prints", $this->data);
	}
	
  function paging($param = array())
	{
    $config['base_url'] = $param['base_url'];
    $config['total_rows'] = $param['total_rows'];
    $config['per_page'] = $param['per_page'];
    $config['num_links'] = $param['num_links'];
    $config['uri_segment'] = $param['uri_segment'];
    $config['full_tag_open'] = '<hr><div class="text-center"><ul class="pagination">';
    $config['full_tag_close'] = '</ul></div>';
    $config['first_link'] = '&laquo;';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
    $config['last_link'] = '&raquo;';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
    $config['next_link'] = '&rsaquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
    $config['prev_link'] = '&lsaquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a>';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    return $this->pagination->create_links();
  }
	
	public function set_message($type = null, $message = null)
	{
		if ($type != null && $message != null) {
			$this->session->set_userdata('alert-session', array('type' => $type, 'message' => $message));
		}
	}
	
  public function call_sp($proc_name, $params = array(), $type = "proc", $conn = "default")
	{
    $parameter = "";
    for ($x = 0; $x < sizeof($params); $x++) {
      $parameter .= "?";
      (($x + 1) < sizeof($params)) ? $parameter .= "," : "";
    }
    $this->db->trans_start();
    if ($type == "proc") {
			if ($conn == "default") {
				$result = $this->db->query("call $proc_name($parameter)", $params);
			} else {
				$result = $conn->query("call $proc_name($parameter)", $params);
			}
    } else {
			if ($conn == "default") {
				$result = $this->db->query("select " . $proc_name . "(" . $parameter . ") as result_function", $params);
			} else {
				$result = $conn->query("select " . $proc_name . "(" . $parameter . ") as result_function", $params);
			}
    }
    $error_number = $this->db->_error_number();
    $error_message = $this->db->_error_message();
    $trans_status = $this->db->trans_status();
    $this->db->trans_complete();
    if ($trans_status === FALSE) {
      $this->db->trans_rollback();
      if ($error_number != 0) {
        $error = array(
					'error_number' => $error_number,
					'error_message' => "Some transaction has been rollback.". $error_message,
					'status' => $trans_status
        );
        $this->error_message($error);
      }
      $this->db->trans_rollback();
      $row = array();
    } else {
      $row = $result->result();
      $result->next_result();
      $result->free_result();
    }
    return $row;
  }
	
  public function error_message($error = array())
	{
    $message = "";
    switch (intval($error['error_number'])) {
      case 1318 : $message = "Incorrect number of arguments for PROCEDURE, please call your administrator to fix it.";
        break;
      case 1062 : $message = "Duplicate entry for Primary Key, please call your administrator to fix it.";
        break;
      case 1305 : $message = "PROCEDURE does not exist, please call your administrator to fix it.";
        break;
      case 1452 : $message = "Cannot add or update a child row: a foreign key constraint fails, please call your administrator to fix it.";
        break;
      case 1242 : $message = "Sub query return more than one row, please call your administrator to fix it.";
        break;
      case 10060 : show_404(); #CONNECTION TIME OUT
        break;
    }
    $this->error = array(
      'message' => $message
    );
  }
	
}