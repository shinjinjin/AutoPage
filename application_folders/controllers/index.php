<?php
class Index extends MY_Controller
{
	public function __construct()//初始化
	{
		parent::__construct();
		$this->load->library('session');
		$this -> load -> helper('url');
		$this -> load -> helper('form');

		$this->load->model('MyModel/mymodel');
	}
	public function index(){
		$data['banner_data']=$this->dmodel->get_filed_data('banner');	
		$this->load->view('main',$data);
	}
	//登入
	public function login(){
		@session_start();
		
		// 判斷是否登入
		if($_SESSION['user']['login_id'])
		{
			$this->turn_page('/member');
		}
		$data['form']='index/chklogin';
		
		$this->load->view('login',$data);
	}
	//登出
	public function logout(){
		@session_start();
		@session_destroy();
	}
	//登入判斷
	public function chklogin(){
		@session_start();
		$account = $this -> input -> post('account');
		$password= $this -> input -> post('password');

		$admin=$this->imodel->get_account_data($account,'',$password);//管理者登入
	
		if($admin==0)
		{
			$this->meg('login','帳號或密碼錯誤，請重新輸入',10);
			return '';
		}
		else{
			$login_data=array(
				'last_ip'=>$this->get_ip(),
				'last_time'=>$this->get_now_time(),
			);
			$this->imodel->update_set('member','m_id',$admin,$login_data);	//更新IP 及登入時間
			// 登入狀態紀錄
			$_SESSION['user']['login_id']=$admin;

			if($_SESSION['LoginLink']!=''){
				//導入登入位置
				$Link=$_SESSION['LoginLink'];
				unset($_SESSION["LoginLink"]);
				echo "<script>alert('登入成功');window.location.href='".$Link."';</script>";
			}else
				echo "<script>alert('登入成功');window.location.href='/member';</script>";
		}
	}
	//註冊
	public function register(){
		$data['captcha']=$this->login_model->captcha_img();
		
		$data['form']='index/registering';

		$this->load->view('register',$data);
	}
	//註冊form
	public function registering(){
		$this->load->library('encrypt');//加密
		
		$name=$this->input->post('name');
		$acconut=$this->input->post('acconut');
		$password=$this->input->post('password');
		$re_password=$this->input->post('re_password');
		$email=$this->input->post('email');
		$is_send=$this->input->post('is_send');
		$captcha=$this->input->post('captcha');

		if($this->login_model->captcha_img($captcha)==0)
		{
			$msg='驗證碼輸入錯誤，請重新輸入';
			
		}else{
			$reg=$this->imodel->get_account_data($acconut,$email);	//是否有註冊過?
		
			if($reg=='NoReg'){
				if($password==$re_password){
					$pwd=$this->encrypt->encode($password);

					$data=array(
						'account' => $acconut,
						'password' => $pwd,
						'email' => $email,
						'last_ip' => $this->get_ip(),
						'create_time' => $this->get_now_time(),
						'last_time' => $this->get_now_time(),
					);

					$create_id=$this->dmodel->insert_into('member',$data);
					if($is_send=='')
						$is_send=0;
				
					if($create_id)
					{
						$info_data=array(
							'm_id'=>$create_id,
							'm_name'=>$name,
							'is_manager'=>'N',
							'is_prefer'=>$is_send,
							'update_time'=>$this->get_now_time(),
						);
						$this->dmodel->insert_into('member_info',$info_data);

						$this->session->set_userdata('login_id',$create_id);
						echo '<script>alert("註冊成功");window.location.href="/";</script>';
					}
					else
						$msg="註冊失敗";
				}else
					$msg='新舊密碼不符，請重新申請';
			}else{
				$msg='帳號或信箱已被註冊，請重新申請';
			}
		}
		$this->meg('/index/register',$msg,'10');
	}



	//--AJAX 刪除資料庫資料專用
	public function del_DB_data(){
		$DB=$this->input->post('DB');		//資料表
		$field=$this->input->post('field');	//欄位名稱
		$id=$this->input->post('id');		//刪除ID

		$file=$this->input->post('file');	//是否有檔案要刪除
		if($file==1){
			$FField=$this->input->post('FField');	//是否有檔案要刪除
			
			$data=$this->dmodel->select_from($DB,array($field=>$id));
			
			$this->DelFile($data[''.$FField.'']);
		}

		$this->dmodel->delete_where($DB,array($field=>$id));
		echo '刪除成功';
	}
	//--AJAX 刪除資料庫資料專用
	//--AJAX 開啟關閉資料專用
	public function oc_data(){
		$DB=$this->input->post('DB');		//資料表
		$field=$this->input->post('field');	//欄位名稱
		$id=$this->input->post('id');		//修改ID 需有分號區隔
		$oc=$this->input->post('oc');		//Open Close Value

		$id_val=explode(';',$id);

		foreach ($id_val as $value) {
			$this->mymodel->update_set($DB,$field,$value,array('d_enable'=>$oc));
		}
		echo '修改成功';
	}
	//--AJAX 開啟關閉資料專用
	//地區切換
	public function selectcity(){
		$cid=$_POST['cid'];
		$dbdata=$this->mymodel->GetCity($cid);
		echo json_encode($dbdata);
	}
	//地區切換
}