<?
require_once(dirname(__FILE__)."/comment.php");

class Page extends MY_Controller {

	private $m_pagesize=20;	//每頁筆數
	private $mysql;
	private $MaxNum=5;  	//顯示頁數
	private $CenterNum=3;	//中間第幾位
	public function __construct(){
		$this->CI =& get_instance();
		//$this->cf=$cf;
	}
	//設定每頁筆數
	function SetPagSize($pagesize)
	{
		$this->m_pagesize=$pagesize;
	}
	//設定資料庫連線
	function SetMySQL($mysql)
	{
		$this->m_mysql=$mysql;
	}
	// 分頁設置
	function PageStar($sql,$ToPage="",$Cond="",$WhereType){

		$PageBox=array();
		if($ToPage==""){
			$ToPage=(integer)comment::Set_GET("ToPage");
		}
		if($ToPage==""){
			$ToPage=(integer)comment::SetValue("ToPage");
		}
		
		//目前頁數
		if(empty($ToPage)){
			$PageBox["CurrectPage"]=1;
		}
		else{
			if(preg_match("/[0-9]{".strlen($ToPage).",}/",$ToPage)){
				if($ToPage<1){
					$PageBox["CurrectPage"]=1;
				}
				else{
					$PageBox["CurrectPage"]=$ToPage;
				}
			}
			else{
				$PageBox["CurrectPage"]=1;
			}
		}
		$command="SELECT count(*) as num FROM ".$sql."";
		if($Cond!=''){
    		$command.=" where 1=1 ";
    		foreach ($Cond as $key => $value) {
    			$command.=$WhereType.' '.$key.'="'.$value.'"';
    		}
    	}
		// echo "alert(\"".$command."\");";
		$result=$this->m_mysql->query($command);
		
		$total_num=0;
		foreach ($result->result_array() as $record){
			$total_num=$record["num"];
		}
		
		if(!empty($STotal)){
			$total_num=$STotal;
		}

		//總筆數
		$PageBox["TotalRecord"]=$total_num;
		
		//全顯示
		if($this->m_pagesize=="all"){
			$this->m_pagesize=$PageBox["TotalRecord"];
		}
		$PageBox["pagesize"]=$this->m_pagesize;
		//總頁數
		if(empty($total_num) or empty($this->m_pagesize)){
			$PageBox["TotalPage"]=0;
		}
		else{
			$PageBox["TotalPage"]=ceil($total_num/$this->m_pagesize);
		}
		
		if($PageBox["TotalPage"]!=0){
			if($PageBox["TotalPage"]<$PageBox["CurrectPage"]){
				$PageBox["CurrectPage"]=$PageBox["TotalPage"];
			}
		}
		else{
			$PageBox["CurrectPage"]=1;
		}
		//開始記錄
		$PageStar=(($PageBox["CurrectPage"]-1)*$this->m_pagesize);
		//sql語法
		$PageBox["result"]=" limit ".$PageStar.",".$this->m_pagesize."";
		//顯示資訊
		$PageBox["PageView"]="共".$PageBox["TotalPage"]."頁  共 ".$PageBox["TotalRecord"]."筆  目前在第".$PageBox["CurrectPage"]."頁";
		//到第幾頁內容
		//$PageBox["PageTo"]=$this->PageTo($PageBox["TotalRecord"]);
        $pt=$this->PageTo($PageBox["TotalRecord"]);
		$PageBox["PageTo"]=$pt["PageTo"];
		$PageBox["PageTo1"]=$pt["PageTo1"];
		//連結到第幾頁內容
		//$PageBox["PageToLink"]=$this->PageToLink($PageBox);
		//Ajax跳頁資料
		//$PageBox["AjaxPage"]=$this->AjaxPage($PageBox);
		return $PageBox;
	}
	//每頁幾筆
	function PageTo(&$TotalRecord=0){
		$PageNumber=0;
		$string="";
		if($TotalRecord>100){
			$PageNumber=ceil($TotalRecord/100)+5;
			if($TotalRecord>=500){
				$PageNumber=10;
			}
		}
		elseif($TotalRecord<=50){
			$PageNumber=ceil($TotalRecord/10);
		}
		for($i=1;$i<=$PageNumber;$i++){
			if($i>5){
				$num=($i-5)*100;
			}
			else{
				$num=$i*10;
			}
			$string.="<option value=\"".$num."\">每頁".$num."筆</option>";
		}
		//return $string;
		return array("PageTo"=>$string,"PageTo1"=>$PageNumber);
	}
	
}