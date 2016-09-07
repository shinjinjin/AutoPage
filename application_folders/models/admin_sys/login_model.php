<?php
class login_model extends MY_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function login_chekc($data)
	{
		$this->load->library('encrypt');//加密
		$this->load->library('session');
		$sql='SELECT * FROM admin_user as a 
				WHERE a.`user_name`="'.$data['user_name'].'"';
		$query = $this->db->query($sql);
		$admin=$query->row_array();

		if(count($admin)!=0)
		{
			$password = $this->encrypt->decode($admin['password']);
	
			if($password == $data['password'])
			{
				$last_login=array('last_login'=>time());
				$this->db->where('admin_id', $admin['admin_id']);
				$this->db->update('admin_user', $last_login); 
				
				return array('admin_id'=>$admin['admin_id'],'user_name'=>$admin['user_name']);
			}
			else{
				return 0;
			}
		}
	}
	//圖片驗證碼
	public function captcha_img($captcha='') 
	{
		$this->load->helper('captcha');
		$this->load->library('session');
		if($captcha=='')
		{
			//$pool = '123456789zxcvbnmkjh';
			$pool = '1234567890';
			$word = '';
			for ($i = 0; $i < 4; $i++){
				$word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
			}
			$this->session->set_userdata('captcha', $word);
			$vals = array(
				'word'	 	=> $word,
				'img_path'	 => './_captcha/',
				'img_url'	 => '/_captcha/',
				'img_width'	 => '150',
				'img_height' => 38,
				'expiration' => 1200
			 );
			 
			$cap = create_captcha($vals);
			return $cap['image'];
		}
		else
		{

			if($captcha == $this->session->userdata('captcha'))
			{
				return '1';
			}
			else
			{
				return '0';
			}
			
		}
	}	
	
	//菜單
	public function menu($su=''){
		$sql='select m_id,m_title,m_name from menu where 1=1 and s_id="0"';
		if($su!='')
			$sql.=' and is_admin=1';
		else	
			$sql.=' and is_admin=0 and is_enable=0';
		
		$sql.=' order by m_order';
	
		$query = $this->db->query($sql);
		$data=$query->result_array();
		foreach($data as $key=>$val){
			$sql1='select m_id,m_title,m_url,m_name from menu where s_id='.$val['m_id'].' and is_enable=0 order by m_order';
			$query1 = $this->db->query($sql1);
			$data1=$query1->result_array();
			$menu_data[$val['m_title']]=$data1;
					
				
			$sql1='';
		}	
	return $menu_data;
	}
}