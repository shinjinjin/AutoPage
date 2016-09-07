<?php
class Index extends MY_Controller {

    public $view_parameter = '';

	public function __construct()
	{
		parent::__construct();

		// helpers
		$this -> load -> helper('form');
        $this -> load -> helper('url');
		$this -> load -> library('encrypt');
		$this -> load -> library('mylib/comment');

        $this->load->model($this->admin_path.'admin_model');
        // 設定共用參數
        $this -> view_parameter['menu_width'] = '204.5px';
        header('Access-Control-Allow-Origin: *'); // mac

        @session_start();
		$this->load->library('/mylib/useful');
			
	}

	// 登入
	public function index()
	{

		$data['lang_type']=$this -> session -> userdata('lang_type');
		$data['url']=$this->admin_path;
		
		// 尚未有人登入
		if(!$this -> session -> userdata('is_login'))
		{
			// model
			$this -> load -> model($this -> admin_path.'login_model');

			$data['captcha']=$this->login_model->captcha_img();
			
			$data['form']='/admin_sys/index/login';
			
			$this->load->view('admin_sys/templates/header');
			$this->load->view('admin_sys/login/index', $data);	
			$this->load->view('admin_sys/templates/footer');	
		}
		else
		{	
			  $this -> load -> view('admin_sys/main/header',$data);
			  $this -> load -> view('admin_sys/main/menu');
			  $this -> load -> view('admin_sys/main/footer');
		}
	}
	
	// 判斷是否登入
	public function login()
	{
		@session_start();
		// models
		$this -> load -> model($this -> admin_path.'login_model');
		$data['url']=$this->admin_path;
		
        // 載入共用參數
        $view_parameter = $this -> view_parameter;

   //    	$CCheck = Comment::ClassExists ( "mylib/Check" );
   //   	$check->fname [] = array ("chk_null","do_type",$this -> input -> post('user_name'),"指令");
   //      $check->main ();
			// $this->error = $check->error;
			// if(empty($this->error)){
			// }

        // 判斷是否登入
		if($_SESSION['is_login'])
		{
			//頭尾、基本設定
			$this->useful->backconfig();
		}
		else
		{
				$this -> load -> library('form_validation');
				$captcha=$this->input->post('captcha');
				
				// 登入帳密
				if($this->login_model->captcha_img($captcha)==0)
				{
					$this->meg('index','驗證碼輸入錯誤，請重新輸入',5);
					return '';
				}
				else{
					
					$login_data = array(
						'user_name' => $this->cleaninput($this -> input -> post('user_name')),
						'password'  => $this -> input -> post('password'),
					);
			
					if($this -> input -> post('user_name')=='su'){
						
						$su_is_login = $this -> su_login_check($this -> input -> post('user_name'), $this -> input -> post('password'));
						
						if(!$su_is_login)
						{
							$this -> meg('index','帳號或密碼錯誤，請重新輸入',5);
							return '';
						}
						else // 超管登入
						{
							 //頭尾、基本設定
							$this->useful->backconfig();
						}	
					}
					else{
						$admin=$this->login_model->login_chekc($login_data);//管理者登入
						
						if($admin==0)
						{
							$this->meg('../index','帳號或密碼錯誤，請重新輸入',5);
							return '';
						}else{
			
							// 登入狀態紀錄
							$_SESSION['is_login']= 1;
							$_SESSION['admin_id']=  $admin['admin_id'];
							$_SESSION['user_name']= $admin['user_name'];
							$_SESSION['action_list']= 'all';

							//頭尾、基本設定
							$this->useful->backconfig();
						}
					}
				}
		}
	}
	//權限錯誤進入畫面
	public function content(){
		$data['url']=$this->admin_path;
	//	$this -> load -> view('admin_sys/main/header',$data);
		$this ->is_admin();
		$this -> load -> view('admin_sys/main/footer');
	}
    // 超級管理者登入
	private function su_login_check($user_name, $pw)
	{
		if($user_name == 'su' && $pw == '1')
		{
			$this -> session -> set_userdata('admin_id', 999);
			$this -> session -> set_userdata('user_type', 'su'); // su, member, or admin -> company
			$this -> session -> set_userdata('action_list', 'all');
			return '1';
		}
		return '0';
	}
	
	// 登出
	public function logout()
	{
		$this -> session -> unset_userdata('admin_id');
		$this -> session -> unset_userdata('lang_type');
		$this -> session -> unset_userdata('com_id');
		$this -> session -> unset_userdata('user_name');
		$this -> session -> unset_userdata('comp_name');
		$this -> session -> unset_userdata('action_list');
		$this -> session -> unset_userdata('app_version');
		$this -> session -> unset_userdata('maturity');
		$this -> session -> sess_destroy();
		$this->meg('../index','登出成功',3);
		return '';
	}
	
	public function error()
	{
		$this->load->view('admin_sys/templates/header');
		$this->load->view('admin_sys/login/info');
		$this->load->view('admin_sys/templates/footer');		
	}
	
}