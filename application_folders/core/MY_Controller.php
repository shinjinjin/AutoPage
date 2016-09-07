<?
class MY_Controller extends CI_Controller {

	public $admin_path						='/admin_sys/';
	//20151127-新增路徑-路徑------------------
	public $article_path					='./uploads/article/';
	//20151127-新增路徑-商品路徑------------------
	public $product_path					='./uploads/product/';
	//20151127-新增路徑-內訓課程------------------
	public $course_path						='./uploads/course/';
	//20160126-新增路徑-首頁圖------------------
	public $banner_path						='./uploads/banner/';
	//20160201-新增路徑-QRCODE------------------
	public $qrcode_path						='./uploads/qrcode/';
	//20160202-新增路徑-photo------------------
	public $photo_path						='/uploads/photo/';
	//20160202-新增路徑-問券編輯器------------------
	public $surveyCK_path					='/uploads/surveyCk/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');

		$this->admin_id=$this->session->userdata('admin_id');
		$this->admin_action=$this->session->userdata('action_list');
		$this->member_id=$this->session->userdata('member_id');
		
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		
		$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile)/i";

		if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'api'))
		{
			
		}
		elseif(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'web_viwe'))
		{
			//$this->turn_page($this->web_view_path.'index/login');
		}

	}
	//排序函式
	/*
		$movie=$this->array_sort($movie,'is_rese','desc');
		$movie=>排序之二維陣列
		is_rese=>排序欄位
		desc=>排序順序
	*/
	function array_sort($arr,$keys,$type='asc'){ 
		$keysvalue = $new_array = array();
		foreach ($arr as $k=>$v){
		$keysvalue[$k] = $v[$keys];
		}
		if($type == 'asc'){
			asort($keysvalue);
		}else{
			arsort($keysvalue);
		}
			reset($keysvalue);
		foreach ($keysvalue as $k=>$v){
			$new_array[$k] = $arr[$k];
		}
			return $new_array; 
	} 

	//提示畫面admin
	public function meg($url,$info,$sec='')
	{
		$data['meg_url']=$url;
		$data['mag']=$info;
		$data['url']=$this->admin_path;
		if($sec=='')
			$sec=1;
			
		$data['sec']=$sec;
		
		$this->load->view($this->admin_path.'main/error_header', $data);
		$this->load->view($this->admin_path.'message/info', $data);
		$this->load->view($this->admin_path.'main/footer');
	}
	
	public function meg1($url,$info)
	{
		$data['meg_url']=$url;
		$data['mag']=$info;
		$data['url']=$this->admin_path;

		$this->load->view($this->admin_path.'main/error_header', $data); 
		$this->load->view($this->admin_path.'message/info_10sec', $data);
		$this->load->view($this->admin_path.'main/footer');
	}
	
	//提示畫面user
	public function meg2($url,$info)
	{
		$data['meg_url']=$url;
		$data['mag']=$info;
		$data['mid']=$this->session->userdata('mid');
		$this->load->view('templates/header', $data);
		$this->load->view('templates/catalog', $data);
		$this->load->view($this->admin_path.'message/info', $data);
		$this->load->view('templates/footer');
	}
	
	//Alert轉跳頁
	public function alert_page($msg,$url){
		$alert='<script>alert("'.$msg.'");window.loction.href="'.$url.'";</script>';
		return $alert;
	}

	//轉頁
	public function turn_page($url)
	{
		$this->load->helper('url');
		redirect($url);
	}	

	//檢查數值
	public function is_number($data)
	{
		if(ctype_digit($data))
			return 1;
		else
			return 0;
	}

	//分頁程式
	public function page($total,$url,$limit,$page='')
	{
		$this->load->library('pagination');
		if($page=='')
			$num_links=2;
		else
			$num_links=1;
		$config['base_url'] = $url;
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['num_links'] =$num_links;		
		$config['page'] = floor(($page/$limit) + 1);
		$config['full_tag_open'] = '';
		$config['full_tag_close'] = '';
		$this->pagination->initialize($config); 
		$page=$this->pagination->create_links();
		return $page;
	}
	
		
	//取得現在時間
	public function get_now_time(){
			date_default_timezone_set("Asia/Taipei");
			return date('Y-m-d H:i');
	}
	//取得來源IP
	public function get_ip(){			
		if(!empty($_SERVER["HTTP_CLIENT_IP"]))
		{
		  $cip = $_SERVER["HTTP_CLIENT_IP"];
		}
		elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
		{
		  $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		elseif(!empty($_SERVER["REMOTE_ADDR"]))
		{
		  $cip = $_SERVER["REMOTE_ADDR"];
		}
		else{
		  $cip = "無法取得IP位址！";
		}
		 return $cip;
	}

	

	//上傳圖片
	//	img 上傳物件的名稱
	//	w寬度
	//	h 高度
	//	upload_path 上傳路徑
	//	type 圖片類型
	//  thumb 是否縮圖
	public function up_image($img,$w,$h,$upload_path,$type='',$thumb='')
	{
		$this->load->library('image_lib');
		$img_name=array('thumb'=>'','original'=>'');
		//上傳格式
		$update_img=array(
			'upload_path'	=> $upload_path,
			'allowed_types'	=> $type,
//			'max_size'		=>	'',
//			'max_width'		=>	'',
//			'max_height'	=>	''
			'encrypt_name'	=> TRUE
		);		
		
		$this->load->library('upload',$update_img);
				
				
		if (!$this->upload->do_upload($img))//不符合上傳格式
		{
			$error = array('error' => $this->upload->display_errors());
			
			return $error;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());//回傳圖片資料
			if($thumb=='0')
			{
				//縮圖格式
				$img_thumbnail=array(
					'image_library'		=>'gd2',
					'source_image'		=>$data['upload_data']['full_path'],
					'create_thumb'		=>TRUE,
					'maintain_ratio'	=>TRUE,
					'width'				=>$w,
					'height'			=>$h
				);
				$this->image_lib->initialize($img_thumbnail); 
				$this->image_lib->resize();
				$this->image_lib->clear();
				$img_name['thumb']=$data['upload_data']['raw_name'].'_thumb'.$data['upload_data']['file_ext'];
			}
			$img_name['original']=$data['upload_data']['raw_name'].$data['upload_data']['file_ext'];
			return $img_name;
		}		
	}

	//上傳縮圖片
	//	img 上傳物件的名稱
	//	upload_path 上傳路徑
	//	type 圖片類型
	public function up_image_thumb($img,$upload_path,$type,$name)
	{
		$this->load->library('image_lib');
		
		$img_name=array('thumb'=>'','original'=>'');
		//上傳格式
		$update_img=array(
			'upload_path'	=> $upload_path,
			'allowed_types'	=> $type,
			'file_name'		=>$name,
//			'max_size'		=>	'',
//			'max_width'		=>	'',
//			'max_height'	=>	''
			'encrypt_name'	=> TRUE
		);
		
		$this->load->library('upload',$update_img);

		if (!$this->upload->do_upload($img))//不符合上傳格式
		{
			$error = array('error' => $this->upload->display_errors());
			return '';
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());//回傳圖片資料
			$img_thumb=$data['upload_data']['raw_name'] .$data['upload_data']['file_ext'];
			return $img_thumb;
		}		
	}


	// //管理者帳號
	// public function admin_info_data($id)
	// {
	// 	$this->load->model('admin_sys/admin_model');
	// 	if($id)
	// 	{
	// 		$admin_data=$this->admin_model->get_admin_data($id);
	// 		$admin_data['com']=$this->admin_model->get_com_data($admin_data['com_id']);
	// 	}
	// 	return $admin_data;
	// }



	//文章編輯器
	public function ck_ckeditor($content='')
	{
		$this->load->helper('url');
        // CKeditor载入
        $this->load->library ('ckeditor');
		
        $this->ckeditor->basePath = base_url () . 'ckeditor/';
        $this->ckeditor->returnOutput = true;
        
        // CKFinder载入
        $this->load->library ( 'ckfinder' );
        $this->ckfinder->basePath = base_url () . 'ckfinder/';
        
        // 让CKEditor和CKFinder结合起来
        $this->ckfinder->SetupCKEditorObject ( $this->ckeditor );
        
        // 初始化编辑器
        $ck = $this->ckeditor->editor ('contents',$content);

        // 之后在试图view中,就直接可以 echo $ck; 就可以在页面中看到编辑器了。
		return $ck;		
	}

	//上傳檔案
	// upload_path 路徑
	// type 上傳類型
	public function up_file($file_name,$upload_path,$type,$overwrite=FALSE)
	{
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = $type;
		$config['encrypt_name']	= TRUE;
		$config['overwrite']	= $overwrite;
		$config['max_size']	= '0';

		$this->load->library('upload',$config);

		if (!$this->upload->do_upload($file_name))
		{
			$error = array('error' => $this->upload->display_errors());
			return $error; 
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			return $data;
		}		
	}
	
	//上傳檔案
	// id 資料表id
	// table 資料表名稱
	// name 檔案名稱 
	// public function file_list($id,$table,$name)
	// {
	// 	$up_data = array(
	// 	   'external_id' 	=> $id,
	// 	   'table' 			=> $table ,
	// 	   'file_name' 		=> $name
	// 	);
	// 	$this->load->model($this->admin_path.'login_model');
	// 	$id=$this->login_model->filelist_add($up_data);
	// 	return $id;
	// }
	
	//壓縮檔案
	public function compress_zip($name,$path_absolute)
	{
		$this->load->library('zip');
		$this->zip->archive($name.'.zip');
		$path = $path_absolute.$name;
		$this->zip->read_file($path);
		$this->zip->download($name.'.zip');	
		return '';
	}
	
	public function compress_file($name,$path_absolute)
	{
		$this->load->helper('download');
		$path = $path_absolute.$name;
		$data = file_get_contents($path); // Read the file's contents
		force_download($name,$data);
	}

	//截斷函數
	public function ellipsize($codepage = 'UTF-8', $str, $max_length, $position = 1, $ellipsis = '&hellip;')
	{
		// Strip tags
		$str = trim(strip_tags($str));
		
		// Is the string long enough to ellipsize?
		if (mb_strlen($str, $codepage) <= $max_length)
		{
			return $str;
		}
		
		$beg = mb_substr($str, 0, floor($max_length * $position), $codepage);
		
		$position = ($position > 1) ? 1 : $position;
		
		if ($position === 1)
		{
			$end = mb_substr($str, 0,-($max_length - mb_strlen($beg, $codepage)), $codepage);
		}
		else
		{
			$end = mb_substr($str,-($max_length - mb_strlen($beg, $codepage)), $max_length, $codepage);
		}
		
		return $beg.$ellipsis.$end;
	}
	
	public function create_html_editor($input_name, $input_value = '')
	{
		if ( !function_exists('version_compare') || version_compare( phpversion(), '5', '<' ) )
		{
			$this->load->library('Fckeditor_php4');
			$editor = new Fckeditor_php4($input_name);
		}
		else
		{
			$this->load->library('Fckeditor_php5');
			$editor = new Fckeditor_php5($input_name);
		}
		$editor->BasePath   = '/js/admin/fckeditor/';
		$editor->ToolbarSet = 'Normal';
		$editor->Width      = '100%';
		$editor->Height     = '320';
		$editor->Value      = $input_value;
		$FCKeditor = $editor->CreateHtml();
		return $FCKeditor;
	}
	
	//會員路徑資料交
	public function user_path($path,$mid)
	{
		$user=str_pad($mid,10,'0',STR_PAD_LEFT);
		$one=substr($user,7,3);
		$two=substr($user,0,3);
		$three=substr($user,3,4);
		return $dir='.'.$path.$one.'/'.$two.'/'.$three.'/'.$user.'/';
	}
	
	//創建目錄	
	public function create_dir($dir)
	{
		if (!is_dir($dir))
		{
			$temp = explode('/',$dir);
			$cur_dir = '';
			for($i=0;$i<count($temp);$i++)
			{
				$cur_dir .= $temp[$i].'/';
				if (!is_dir($cur_dir))
				{
					@mkdir($cur_dir,0777);
				}
			}
		}
	}

	
	//時間轉換
	public function time_converter($second='',$dates='',$format='')
	{
		if(!$format)
		{
			$format='Y-m-d';
		}
		
		if($second)
		{
			//$second+=28800;
			return date($format, $second);
		}
		else
		{
			return  strtotime ($dates);
		}
	}
	
	//抓取今天日期
	public function get_date($YMD='Y-m-d H:i:s')
	{
		return date($YMD);
	}
	
		//帳號加密
	public function get_encryption($account,$code,$dec='')
	{
		if($dec='')
		{
			$ago_words=rand('4','7');//前面加的字數
			$after_words=rand('2','9');//後面加的字數
			$ago=$this->generatorPassword($ago_words);//前面加的字
			$after=$this->generatorPassword($after_words);//後面加的字
			$ago.$code.$after.$ago_words.$after_words;
		}
	}
	
	//亂數密碼產生
	public function generatorPassword($number)
	{
		$password_len = $number;
		$password = '';
		// remove o,0,1,l
		$word = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
		$len = strlen($word);
		for ($i = 0; $i < $password_len; $i++) {
			$password .= $word[rand() % $len];
		}
		return $password;
	}

	
	
	
	
	//GCM推播
	//$apiKey 傳送key
	//$devicetoken array()
	//訊息
	//$message=array(
	//	'title'=>'asdasdasd',
	//	'link'=>'qweqweqweq',
	//	'message'=>'3453453443345345'
	//);
	public function gcm($apiKey,$devicetoken,$message)
	{
		$this->load->library('gcm_push');
		$gcm = new Gcm_push($apiKey);
		$gcm->pushNotification($devicetoken,$message);
		$pushResultArray=$gcm->pushResultArray();
		return $pushResultArray;
	}
	
	//ios推播
	//$pem  推播憑證
	//$deviceToken array()
	//$meg 訊息
	//return $device array()
	public function apsn($pem,$deviceToken,$meg)
	{
		$this->load->library('Apsn_push');
		$gcm = new Apsn_push($pem);
		foreach($deviceToken as $key=>$val)
		{
			$device[$key]['token']=$val;
			$device[$key]['status']=$gcm->pushNotification($val,$meg);
		}
		return $device;
	}
	
	//百度推播
	//$apiKey 傳送key
	//$devicetoken array()
	//訊息
	//$message=array(
	//	'title'=>'asdasdasd',
	//	'link'=>'qweqweqweq',
	//	'message'=>'3453453443345345'
	//);
	public function baidu($apiKey,$secretkey,$message)
	{
		/*$this->load->library('baidu_push');
		$baidu = new Baidu_push ( $apiKey, $secretKey ) ;
		$push_type = 3; //推送广播消息
		$optional[Baidu_push::MESSAGE_TYPE] = 1; 
		$message_key = "msg_key";
		$ret = $baidu->pushMessage ( $push_type, $message, $message_key, $optional ) ;	
		return $ret;*/
		
		$this->load->library('Channel');
		$channel = new Channel ( $apiKey, $secretkey ) ;
		$push_type = 3; //推送广播消息
		$optional[Channel::MESSAGE_TYPE] = 1;  
		$message_key = "msg_key";
		$ret = $channel->pushMessage ( $push_type, $message, $message_key, $optional ) ;	
		return $ret;
	}
	
	//excel資料取出
	public function excel($file)
	{
		$this->load->library('excel/oleread');
		$this->load->library('excel/Spreadsheet_Excel_Reader');
		$data = new Spreadsheet_Excel_Reader();  
		$data->setOutputEncoding('UTF-8');  
		$data->read($file); 
		return $data->sheets;
	}
	
	
	//----------------------------------------------------------------------------------- 
	// 函數名：export_xls($title_array='', $data_array='', $filename)
	// 作 用 ：產生excel
	// 參 數 ：無
	// 返回值：無
	// 備 注 ：無
	//----------------------------------------------------------------------------------- 
	public function export_xls($title_array='', $data_array='', $filename,$extension='xls')
	{
	    // 清空輸出緩沖區
	    ob_clean();

	    //欄位矩陣
	    $row_n=array(
	    	'0'=>'A', '1'=>'B', '2'=>'C', '3'=>'D', '4'=>'E',
	    	'5'=>'F', '6'=>'G', '7'=>'H', '8'=>'I', '9'=>'J',
	    	'10'=>'K', '11'=>'L', '12'=>'M', '13'=>'N', '14'=>'O',
	    	'15'=>'P', '16'=>'Q', '17'=>'R', '18'=>'S', '19'=>'T',
	    	'20'=>'U', '21'=>'V', '22'=>'W', '23'=>'X', '24'=>'Y', '25'=>'Z'
	    );
	    
	    // 載入PHPExcel類庫
	    $this->load->library('PHPExcel');
	    $this->load->library('PHPExcel/IOFactory');
	    
	    // 創建PHPExcel對象
	    $objPHPExcel = new PHPExcel();
	    
	    // 設置excel文件屬性描述
	    $objPHPExcel->getProperties()
	                ->setTitle("reports")
	                ->setDescription("")
	                ->setCreator("wepower");
	    
	    // 設置當前工作表
	    $objPHPExcel->setActiveSheetIndex(0);
	   
	    // 設置表頭
	    foreach($title_array as $key => $value)
		{
			$fields[] = $value;
		}
	    
	    // 列編號從0開始，行編號從1開始
	    $col = 0;
	    $row = 1;
	    foreach($fields as $key => $field)
	    {
	    	//$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setAutoSize(true);
	        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $field);
	        $col++;
	    }
	    
	    // 從第二行開始輸出數據內容
	    $row = 2;
	    foreach ($data_array as $key => $value)
		{
			foreach ($value as $pdkey => $pdvalue)
			{
				$objPHPExcel->getActiveSheet()->getColumnDimension($row_n[$pdkey])->setWidth(20);//->setAutoSize(true);
				//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($pdkey, $row, $row_n[$pdkey]);
				$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($pdkey, $row)->setValueExplicit($pdvalue, PHPExcel_Cell_DataType::TYPE_STRING);
			}
	        $row++;
		}
	    
	    //輸出excel文件
	    $objPHPExcel->setActiveSheetIndex(0);
	    
	    //設置HTTP頭
	    header('Content-Type: application/vnd.ms-excel; charset=utf-8');
	    header('Content-Disposition: attachment;filename="'.mb_convert_encoding($filename, "Big-5", "UTF-8").'.'.$extension.'"');
	    header('Cache-Control: max-age=0');
	    
	    // 第二個參數可取值：CSV、Excel5(生成97-2003版的excel)、Excel2007(生成2007版excel)
	    $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
	    $objWriter->save('php://output');
	}	
	
	
	//
	// path 路徑
	// file 檔案
	//
	//
	public function download_sim($path,$name)
	{
		header("Content-type: text/html; charset=utf-8");
		$file=$path.$name; // 實際檔案的路徑+檔名
		$filename=$name; // 下載的檔名
		
		//指定類型
		header("Content-type: ".filetype("$file"));
		//指定下載時的檔名
		header("Content-Disposition: attachment; filename=".$filename."");
		//輸出下載的內容。
		readfile($file);
	}
	public function download_word($path,$name,$title)
	{
		header("Content-type: text/html; charset=UTF-8");
		$file=$path.$name; // 實際檔案的路徑+檔名
		$filename=$name; // 下載的檔名
		//指定類型
		//header("Content-type:".filetype("$file"));
		header("Content-type:application/doc;");
		//指定下載時的檔名
		header("Content-Disposition: attachment; filename=".$title.".pdf");
		//輸出下載的內容。
		readfile($file);
	}
	//創建qrcode
	public function qrcode_produce($path,$data,$image_name,$correct='L',$size='4',$version='0',$repeat='0')
	{
		$this->load->library('Qrcode');
		$this->qrcode->clear();
		$this->qrcode->set_file_path($path);
		$this->qrcode->set_data($data);
		$this->qrcode->set_error_correct($correct);
		$this->qrcode->set_module_size($size);
		$this->qrcode->set_version($version);
		$qrcode_file=$this->qrcode->build($image_name,$repeat);
		return $path.$qrcode_file;
	}
	
	//刪除檔案
	public function DelFile($filename){
		unlink($filename);	
	}
	
	public function remote_download($save_to='/',$urls='')
	{
		$mh = curl_multi_init();
		if(!is_array($$urls))
			$urls[]=$urls;
		
		foreach ($urls as $i => $url) {
			$g = $save_to.basename($url);
			if(!is_file($g)){
				$conn[$i] = curl_init($url);
				$fp[$i] = fopen ($g, "w");
				curl_setopt($conn[$i], CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
				curl_setopt($conn[$i], CURLOPT_FILE, $fp[$i]);
				curl_setopt($conn[$i], CURLOPT_HEADER ,0);
				curl_setopt($conn[$i], CURLOPT_CONNECTTIMEOUT,60);
				curl_multi_add_handle ($mh,$conn[$i]);
			}
		}
			do {
			$n = curl_multi_exec($mh,$active);
		}
		while ($active);
		foreach ($urls as $i => $url)
		{
			curl_multi_remove_handle($mh,$conn[$i]);
			curl_close($conn[$i]);
			fclose($fp[$i]);
		}
		curl_multi_close($mh);		
	}

	//session
	function start_session($expire = 0)
	{
	    if ($expire == 0) {
	        $expire = ini_get('session.gc_maxlifetime');
	    } else {
	        ini_set('session.gc_maxlifetime', $expire);
	     }
	 
	    if (empty($_COOKIE['PHPSESSID'])) {
	        session_set_cookie_params($expire);
	        session_start();
	    } else {
	        session_start();
	        setcookie('PHPSESSID', session_id(), time() + $expire);
	     }
	}
	
	
	public function write_log($str,$status,$data_array)  //傳入資料夾名 想寫近的狀態 資料       
	{
		$textname = $str.date("Ymd").".txt"; //檔名  filename
		//$URL = $str;                         //路徑  Path
		//if(!is_dir($URL))                                 // 路徑中的$str 資料夾是否存在 Folder exists in the path
			//mkdir($URL,0700);
		
		$URL = $textname;                           //完整路徑與檔名 The full path and filename
	
		$time = $str.$status.":".date("Y-m-d H:i:s"); //時間 Time
		$writ_tmp = '';
		foreach ($data_array as $key => $value) //將陣列資料讀出 To read array data
		{
		   $writ_tmp .= ",".$key."=".$value;             
		}
		$write_data = $time.$writ_tmp."\n"; 
					
		$fileopen = fopen($URL, "a+");               
		fseek($fileopen, 0);
		fwrite($fileopen,$write_data);                 //寫資料進去 write data
		fclose($fileopen);
	}
		//get youtube id
	public function get_ytb_id($url)
	{
		//去除首尾空白
		$url=trim($url);

		//擷取id
		if($pos = strpos($url, '?v=') !== false)
		{
			//後綴參數檢查
			$pos=strpos($url, '?v=');
			$and_mark=strpos($url, '&');
			if($and_mark != false)
			{
				$id=substr($url, $pos+3, ($and_mark-$pos-3));
			}
			else
			{
				$id=substr($url, $pos+3);
			}
		}
		else
		{
			//youtu.be檢查
			if($pos = strpos($url, 'youtu.be') !== false)
			{
				$pos=strrpos($url, '/');
				$and_mark=strpos($url, '&');
				if($and_mark != false)
				{
					$id=substr($url, $pos+1, ($and_mark-$pos-1));
				}
				else
				{
					$id=substr($url, $pos+1);
				}
			}
			else
			{
				$id='';
			}
		}
		return $id;
	}	
	
	//上傳一般圖檔
    public function upload_single_image($image_dir, $image_file, $image_name='')
    {
        /*上傳圖片文件類型列表 */
        $uptypes = array (
            'image/jpg',
            'image/jpeg',
            'image/pjpeg',
            'image/gif',
            'image/png'
        );

        $file_extname = substr($image_file['name'], strpos($image_file['name'], '.'));

        /*產生唯一的檔案名稱*/
        if(!$image_name)
        	$image_name = md5(uniqid(rand())) . $file_extname;
        
        /*檢查文件類型 */
        if(in_array($image_file['type'], $uptypes))
        {
            /*上傳圖片類型為jpg,pjpeg,jpeg */
            if (strstr($image_file['type'], "jp"))
            {
                if(!($source = @ imageCreatefromjpeg($image_file['tmp_name'])))
                {
                    $data=array(
                        "error" => '檔案類型錯誤'
                    );
                    return $data;
                }
            }
            elseif(strstr($image_file['type'], "png"))
            {
                if(!($source = @ imagecreatefrompng($image_file['tmp_name'])))
                {
                    $data=array(
                        "error" => '檔案類型錯誤'
                    );
                    return $data;
                }
                /*上傳圖片類型為gif */
            }
            elseif(strstr($image_file['type'], "gif"))
            {
                if(!($source = @ imagecreatefromgif($image_file['tmp_name'])))
                {
                    $data=array(
                        "error" => '檔案類型錯誤'
                    );
                    return $data;
                }
              /*其他例外圖片排除 */
            }
            else
            {
                $data=array(
                    "error" => '檔案類型錯誤'
                );
                return $data;
            }
            $w = imagesx($source); /*取得圖片的寬 */
            $h = imagesy($source); /*取得圖片的高 */
            
            /* 儲存到檔案目錄 */
            switch ($image_file['type']) {
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($source, $image_dir . $image_name);
                    break;
                case 'image/gif':
                    imagegif($source, $image_dir . $image_name);
                    break;
                case 'image/png':
                    imagepng($source, $image_dir . $image_name);
                    break;
            }

            //圖檔資訊回傳
            $data=array("path" => $image_name, 'error' => '');

            return $data;
        }
        else
        {
            $data=array("error" => '檔案類型錯誤');

            return $data;
        }
    }
	
	// 控制浮水印符合框框大小
	public function resizeImage($filename, $max_width, $max_height, $type = '', $old_image = '')
	{
	    list($orig_width, $orig_height) = getimagesize($filename);

	    $width = $orig_width;
	    $height = $orig_height;

	    # taller
	    if ($height > $max_height) {
	        $width = ($max_height / $height) * $width;
	        $height = $max_height;
	    }

	    # wider
	    if ($width > $max_width) {
	        $height = ($max_width / $width) * $height;
	        $width = $max_width;
	    }

    	switch ($type) {
    		case 'jpg':
    			$image_p = imagecreatetruecolor($width, $height);
	    		$image = imagecreatefromjpeg($filename);
	    		imagecopyresampled($image_p, $image, 0, 0, 0, 0, 
                                     $width, $height, $orig_width, $orig_height);
             	//刪除原始圖檔
				if(is_file($old_image))
				{
					unlink($old_image);
					imagejpeg($image_p, $filename);
				}
				else 
				{
					imagejpeg($image_p, $old_image);
				}
	    		
    			break;
    		
    		case 'png':
    			$image_p = imagecreatetruecolor($width, $height);
				imagealphablending( $image_p, false );
				imagesavealpha( $image_p, true );
	    		$image = imagecreatefrompng($filename);
	    		imagecopyresampled($image_p, $image, 0, 0, 0, 0, 
                                     $width, $height, $orig_width, $orig_height);
             	//刪除原始圖檔
				if(is_file($old_image))
				{
					unlink($old_image);
	    			imagepng($image_p, $filename);
				}
				else
				{
	    			imagepng($image_p, $old_image);
				}
    			break;
    		
    		case 'gif':
    			$image_p = imagecreatetruecolor($width, $height);
				imagealphablending( $image_p, false );
				imagesavealpha( $image_p, true );
	    		$image = imagecreatefromgif($filename);
	    		imagecopyresampled($image_p, $image, 0, 0, 0, 0, 
                                     $width, $height, $orig_width, $orig_height);
	    		//刪除原始圖檔
				if(is_file($old_image))
				{
					unlink($old_image);
	    			imagegif($image_p, $filename);
	    		}
	    		else
	    		{
	    			imagegif($image_p, $old_image);
	    		}
    			break;
    		
    		default:
    			$image_p = imagecreatetruecolor($width, $height);
	    		$image = imagecreatefromjpeg($filename);
	    		imagecopyresampled($image_p, $image, 0, 0, 0, 0, 
                                     $width, $height, $orig_width, $orig_height);
	    		//刪除原始圖檔
				if(is_file($old_image))
				{
					unlink($old_image);
	    			imagejpeg($image_p, $filename);
				}
				else
				{
	    			imagejpeg($image_p, $old_image);
				}
    			break;
    	}
		/* 檔案resize存檔 */
		
	    return $filename;
	}
	

	//清除Input不必要符號-以保安全性
	public function cleaninput($input){ 
	    $clean = strtolower($input); 
	    $clean = preg_replace("/[^a-z]/", "", $clean); 
	    $clean = substr($clean,0,12); 
	    return $clean; 
	} 
}