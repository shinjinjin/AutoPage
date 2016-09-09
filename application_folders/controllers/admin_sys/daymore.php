<?php
class Daymore extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('date');
		$this -> load -> helper('form');
		
		$this->load->model($this->admin_path.'auth_model');

		@session_start();
		$this->load->library('/mylib/useful');
		$this->load->model('MyModel/mymodel');
		$this->load->library('mylib/useful');
		$this->load->library('mylib/comment');
	}

	//文章分類列表
	public function article_type(){
		//頭尾、基本設定
		$this->useful->backconfig();

		//自動頁面欄位
		$fdata=$this->mymodel->GetAutoPage($_SESSION['Menu']['menuid'],'list');
		$data['fdata']=$fdata;

		//分頁程式 start
		$data['ToPage']=$Topage=!empty($_POST['ToPage'])?$_POST['ToPage']:1;
		$qpage=$this->useful->SetPage($_SESSION['Menu']['FileName'],'','10');
		$data['page']=$this->useful->get_page($qpage);
		//分頁程式 end

		//撈取資料
		$dbdata=$this->mymodel->select_page_form($_SESSION['Menu']['FileName'],$qpage['result'],$fdata);
		$data['dbdata']=$dbdata;

		$this->load->view('admin_sys/autopage/auto_list',$data);
	}
	//文章分類
	public function article_type_info(){
		//頭尾、基本設定
		$this->useful->backconfig();

		//自動頁面欄位
		$fdata=$this->mymodel->GetAutoPage($_SESSION['Menu']['menuid']);
		$data['fdata']=$fdata;
		//撈取資料
		if(!empty($_POST['d_id'])){
			$dbdata=$this->mymodel->OneSearchSql($_SESSION['Menu']['FileName'],'*',array('d_id'=>$_POST['d_id']));			
			$data['dbdata']=$dbdata;		
		}

		$this->load->view('admin_sys/autopage/auto_info',$data);
	}
	//文章列表
	public function article(){
		//頭尾、基本設定
		$this->useful->backconfig();

		//自動頁面欄位
		$fdata=$this->mymodel->GetAutoPage($_SESSION['Menu']['menuid'],'list');
		$data['fdata']=$fdata;

		//分頁程式 start
		$data['ToPage']=$Topage=!empty($_POST['ToPage'])?$_POST['ToPage']:1;
		$qpage=$this->useful->SetPage($_SESSION['Menu']['FileName'],'','10');
		$data['page']=$this->useful->get_page($qpage);
		//分頁程式 end

		//撈取資料
		$dbdata=$this->mymodel->select_page_form($_SESSION['Menu']['FileName'],$qpage['result']);
		$data['dbdata']=$dbdata;

		$this->load->view('admin_sys/autopage/auto_list',$data);
	}
	//文章內文
	public function article_info(){
		//頭尾、基本設定
		$this->useful->backconfig();

		//自動頁面欄位
		$fdata=$this->mymodel->GetAutoPage($_SESSION['Menu']['menuid']);

		$data['fdata']=$fdata;
		//撈取資料
		if(!empty($_POST['d_id'])){
			$dbdata=$this->mymodel->OneSearchSql($_SESSION['Menu']['FileName'],'*',array('d_id'=>$_POST['d_id']));			
			$data['dbdata']=$dbdata;		
		}

		$this->load->view('admin_sys/autopage/auto_info',$data);
	}

	//資料增修刪
	public function data_AED(){
		@session_start();
		$this->load->library('/mylib/CheckInput');
		$check=new CheckInput;		

		if($_POST['deltype']=='Y'){
			$this->mymodel->delete_where($_SESSION['Menu']['FileName'],array('d_id'=>$_POST['d_id']));
			$_POST['deltype']='N';
			$this->meg('/admin_sys/'.$_SESSION['Menu']['DBName'].'/'.$_SESSION['Menu']['FileName'],'刪除成功');
			return '';
		}
		//資料寫入
		$this->useful->backconfig();
		
		$id=$_POST['d_id'];
		$dbname=$_POST['dbname'];
		$fileid='d_id';

		$fdata=$this->mymodel->GetAutoPage($_SESSION['Menu']['menuid']);
		//處理必填欄位
		foreach ($fdata as $cvalue):
			if($cvalue['d_must']=='Y')
				$check->fname[]=array($cvalue['d_musttype'],Comment::SetValue($cvalue['d_fname']),$cvalue['d_title']);
		endforeach;
		
		$tcheck=$check->main();
		if(!empty($tcheck)){
			//記錄密碼
			$_SESSION['RI']=$data;
			$_SESSION['ssoc']=1;

			echo $check->main();
			return '';
		}

		//各型態處理函式
		foreach ($fdata as $cvalue):
			//CheckBox處理
			if($cvalue['d_type']=='3'){
				$Str=implode('@#',$_POST[$cvalue['d_fname']]);
				$_POST[$cvalue['d_fname']]=$Str;
			}
		endforeach;

		if($id){
			$data=$this->useful->DB_Array($_POST);
		}else{
			$data=$this->useful->DB_Array($_POST,1);
		}

		//去除陣列無用值
		$data=$this->useful->UnsetArray($data,array('dbname','d_id'));
	
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
		
		$this->useful->AlertPage($this->admin_path.$_SESSION['Menu']['DBName'].'/'.$dbname.'',$msg);		
	}

}