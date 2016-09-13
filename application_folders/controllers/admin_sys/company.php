<?php
class Company extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('date');
		$this -> load -> helper('form');
		
		$this->load->model($this->admin_path.'auth_model');

		@session_start();
		$this->load->model('MyModel/mymodel');
		$this->load->library('mylib/useful');
		$this->load->library('mylib/comment');
	}

	//文章分類
	public function config(){
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
			if($cvalue['d_must']=='Y'){
				//照片處理
				if($cvalue['d_type']=='8'){
					$ImgHidden=Comment::SetValue($cvalue['d_fname'].'_ImgHidden');
					if(empty($ImgHidden)){
						if(empty($_FILES[$cvalue['d_fname']]['name'])){
							$check->fname[]=array($cvalue['d_musttype'],Comment::SetValue($cvalue['d_fname']),$cvalue['d_title']);
						}
					}
				}elseif ($cvalue['d_type']=='13') {
					$check->fname[]=array('_Select',Comment::SetValue($cvalue['d_fname'][0]),$cvalue['d_title'].'城市');
					$check->fname[]=array('_String',Comment::SetValue($cvalue['d_fname'][0]),$cvalue['d_title'].'地址');
				}else
					$check->fname[]=array($cvalue['d_musttype'],Comment::SetValue($cvalue['d_fname']),$cvalue['d_title']);
			}
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
				if(!empty($_POST[$cvalue['d_fname']]))
					$Str=implode('@#',$_POST[$cvalue['d_fname']]);
				
				$_POST[$cvalue['d_fname']]=$Str;
			}
			//File 處理
			if($cvalue['d_type']=='8'){
				if(!empty($_FILES[$cvalue['d_fname']]['name'])){
					$this->load->library('up_image');
					$img_path='./uploads/'.$dbname.'/';//路徑
					$this->create_dir($img_path);//創建路徑
					$imgname=date('YmdHis').$dbname.rand(1000,9999).'.jpg';//自定義名稱

					$imgpath=$this->up_image->uploadimage($_FILES[$cvalue['d_fname']],$imgname,$img_path, '600', '300');	
					$_POST[$cvalue['d_fname']]=$imgpath['path'];

					//舊圖刪除
					if(!empty($_POST[$cvalue['d_fname'].'_ImgHidden'])){
						$this->DelFile($_POST[$cvalue['d_fname'].'_ImgHidden']);
					}
				}
				unset($_POST[$cvalue['d_fname'].'_ImgHidden']);
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