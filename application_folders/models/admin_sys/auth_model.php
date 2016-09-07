<?
class Auth_model extends MY_Model {

	public function __construct()
	{
		$this->load->database();
		
		//$this->load->library('session');
	}

	public function is_login($admin_id='',$member_id='')//判斷是否登入
	{
	//修正	
		if($admin_id || $member_id)
			return 1;
		else
			return 0;

	}

	public function is_auth($priv_str,$action_list='')//判斷是否有權限
	{
		if($action_list!='')
		{
			$user_action=$action_list;
		
			if($user_action=='all')
			{
				return true;	
			}
			if(strpos(',' . $user_action. ',', ',' . $priv_str . ',') === false)
			{
				return false;
			}
			else
			{
				return true;	
			}
		}
		return false;
	}

}
?>