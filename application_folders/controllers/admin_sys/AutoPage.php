<?php
class Autopage extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('date');
		$this -> load -> helper('form');
		
		@session_start();
		$this->load->model('MyModel/mymodel');
		$this->load->library('mylib/useful');
		$this->load->library('mylib/comment');

	}

	public function index(){
		//頭尾、基本設定
		$this->useful->backconfig();

		$data['dbdata']=$this->mymodel->get_jur('','1');

		$this->load->view('admin_sys/autopage/index',$data);
	}
	public function info($d_id=''){
		//頭尾、基本設定
		$this->useful->backconfig();

		if(!empty($d_id)){
			$data['dbdata']=$dbdata=$this->mymodel->OneSearchSql('d_menu','*',array('d_id'=>$d_id));
			$data['sdata']=$this->mymodel->get_jur($d_id,'1');
			$data['submit']='修改';			
		}
		$this->load->view('admin_sys/autopage/info',$data);
	}

	public function config($d_id){
		// //頭尾、基本設定
		// $this->useful->backconfig();

		$data['jdata']=$jdata=$this->mymodel->get_jur($d_id);
		if(!empty($_POST['d_menu_id']))
			$data['d_menu_id']=$d_menu_id=$_POST['d_menu_id'];
		else
			$data['d_menu_id']=$d_menu_id=$jdata[0]['d_id'];

		$data['dbdata']=$this->mymodel->select_page_form('auto_page','','*',array('d_menu_id'=>$d_menu_id));

		//類型
		$data['cdata']=$this->mymodel->BaseConfig('autotype');
		//檢查方式
		$data['sdata']=$this->mymodel->BaseConfig('searchtype');

		$this->load->view('admin_sys/autopage/config',$data);
	}

	//資料增刪修
	public function data_AED($DB='',$del_id=''){
		@session_start();
		$this->load->library('/mylib/CheckInput');
		$check=new CheckInput;		

		if(!empty($del_id)){
			$this->mymodel->delete_where($DB,array('d_id'=>$del_id));
			if($DB=='d_menu')
				$this->mymodel->delete_where($DB,array('d_p_id'=>$del_id));
			$this->meg('/admin_sys/Autopage','刪除成功');
			return '';
		}

		
		$id=$_POST['d_id'];
		$dbname=$_POST['dbname'];
		$fileid='d_id';

		if($id){
			$data=$this->useful->DB_Array($_POST);
		}else{
			$data=$this->useful->DB_Array($_POST,1);
		}


		// 範例: $check->fname[]=array('_Select',Comment::SetValue('cid'),'分類');		
		
		$tcheck=$check->main();
		if(!empty($tcheck)){
			//記錄密碼
			$_SESSION['RI']=$data;
			$_SESSION['ssoc']=1;

			echo $check->main();
			return '';
		}
		
		

		//去除陣列無用值
		$data=$this->useful->UnsetArray($data,array('dbname','d_id','create_time','update_time'));
		if($dbname=='d_menu'){
			$bigdata['d_menuname']=$data['b_menuname'];
			$bigdata['d_sort']=$data['b_sort'];
			$bigdata['d_enable']=$data['b_enable'];
			if($id!=''){
				$this->mymodel->update_set($dbname,$fileid,$id,$bigdata);
				$msg='修改成功';
			}else{
				 $create_id=$this->mymodel->insert_into($dbname,$bigdata);
				
				if($create_id)
					$msg='新增成功';
				else
					$msg='新增失敗';
				$id=$create_id;
			}

			if(is_array($data['d_menuname'])){
				foreach ($data['d_menuname'] as $key => $value) {
					$iudata=array(
						'd_p_id'=>$id,
						'd_code'=>$data['d_code'][$key],
						'd_menuname'=>$data['d_menuname'][$key],
						'd_listname'=>$data['d_listname'][$key],
						'd_head'=>$data['d_head'][$key],
						'd_dbname'=>$data['d_dbname'][$key],
						'd_sort'=>$data['d_sort'][$key],
						'd_enable'=>$data['d_enable'][$key],
						'd_oc'=>$data['d_oc'][$key],
					);
					// $chkdata=$this->mymodel->OneSearchSql('d_menu',$fileid,array('d_id'=>$data['sid'][$key]));
					if(!empty($data['sid'][$key])){
						$this->mymodel->update_set($dbname,$fileid,$data['sid'][$key],$iudata);
					}else{
						 $create_id=$this->mymodel->insert_into($dbname,$iudata);
					}
				}
				//去除陣列無用值
				$data=$this->useful->UnsetArray($data,array('d_code','d_menuname','d_listname','d_head','d_dbname','d_sort','d_enable','sid'));
			}
			$this->useful->AlertPage($this->admin_path.'Autopage',$msg);
			return '';
		}

		if($dbname=='auto_page'){
			if(is_array($data['d_fname'])){
				foreach ($data['d_fname'] as $key => $value) {
					$iudata=array(
						'd_menu_id'=>$data['d_menu_id'],
						'd_list'=>$data['d_list'][$key],
						'd_fname'=>$data['d_fname'][$key],
						'd_title'=>$data['d_title'][$key],
						'd_type'=>$data['d_type'][$key],
						'd_must'=>$data['d_must'][$key],
						'd_musttype'=>$data['d_musttype'][$key],
						'd_val'=>$data['d_val'][$key],
						'd_sort'=>$data['d_sort'][$key],
						'd_maxlength'=>$data['d_maxlength'][$key],
						'd_search'=>$data['d_search'][$key],
						'd_ctype'=>$data['d_ctype'][$key],
						'd_config'=>$data['d_config'][$key],
					);
					
					if(!empty($data['sid'][$key])){
						$this->mymodel->update_set($dbname,$fileid,$data['sid'][$key],$iudata);
					}else{
						 $create_id=$this->mymodel->insert_into($dbname,$iudata);
					}
				}
				
			}

			$this->useful->AlertPage($this->admin_path.'Autopage',$msg);
			return '';
		}

		if($id!=''){
			$this->mymodel->update_set($dbname,$fileid,$id,$data);
			$msg='修改成功';
		}else{
			 $create_id=$this->mymodel->insert_into($dbname,$data);
			
			if($create_id)
				$msg='新增成功';
			else
				$msg='新增失敗';
		}
		

		$this->useful->AlertPage($this->admin_path.'Autopage',$msg);		
	} 
}