<?php
class Mymodel extends MY_Model{
	public function __construct()
	{
		$this->load->database();
	}
	
	// 分頁專用
	public function select_page_form($table="",$page="",$filed="*",$set='',$order_id="",$order_type='asc',$where_type='and'){
		$type=$where_type;
		$num=0;
    	$sql=" select ".$filed." from ".$table." ";
    	if($set!=''){
    		$sql.=" where ";
    		foreach ($set as $key => $value) {
    			$where_type=($num==0)?'':$type;    			
    			$sql.=$where_type.' '.$key.'="'.$value.'"';
    			$num++;
    		}
    	}
    
    	if($order_id!=''){
    		$sql.=' order by '.$order_id.' '.$order_type;
    	}

    	$sql.=$page;
    	
    	$query = $this->db->query($sql);
		return $query->result_array();
    }

    //單筆資料查詢
    public function OneSearchSql($table="",$filed="*",$set='',$where_type='and'){
    	$sql=" select ".$filed." from ".$table." ";
    	if($set!=''){
    		$sql.=" where 1=1 ";
    		foreach ($set as $key => $value) {
    			$sql.=$where_type.' '.$key.'="'.$value.'"';
    		}
    	}
    	$query = $this->db->query($sql);
		return $query->row_array();
    }

	//抓取系統資料
	public function GetConfig($Type='',$Cid=''){
		$sql='select d_id,d_title,d_val,d_type from d_config';
		if($Cid!=''){
			$sql.=' where d_id=?';
			$query = $this->db->query($sql,$Cid);
			return $query->row_array();
		}
		$sql.=' where d_type=?';
		$query = $this->db->query($sql,$Type);
		return $query->result_array();
	}
	// 抓取地區資料(台灣)
	public function get_area_data($s_city_id='0'){
		$sql="SELECT s_id,s_name FROM city_category where ";
		$sql.=" s_city_id=".$s_city_id;

		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//權限抓取
	public function get_jur($s_id=''){
	    $sql="select d_id,d_code,d_menuname,d_head,d_dbname from d_menu";
	    if($s_id!='')
	      $sql.=" where d_p_id=".$s_id;
	    else
	      $sql.=" where d_p_id=0";

	    $sql.=' and is_del="N" order by d_sort';
	    $query=$this->db->query($sql);
	    return $query->result_array();
	}

	//基本設定抓取
	public function BaseConfig(){
		$sql='select d_title from d_config';
		$sql.=' where d_type="net_title"';
		$query = $this->db->query($sql);
		$set= $query->row_array();
		return array('nettitle'=>$set['d_title']);
	}

	//自動頁面撈取
	public function GetAutoPage($menu_id,$list=''){
		$sql='select d_fname,d_title,d_type,d_must,d_val,d_maxlength,d_search,d_config,d_ctype,d_musttype from auto_page';
		$sql.=' where d_menu_id='.$menu_id;
		if($list!=''){
			$sql.=' and d_list="Y"';
		}
		$sql.=' order by d_sort';
		$query = $this->db->query($sql)->result_array();
		foreach ($query as $key => $value) {
			$str='';
			//2=>radio 3=>checkbox
			if($value['d_type']==2 || $value['d_type']==3){
				if(!empty($value['d_config'])){
					$dbdata=$this->GetConfig($value['d_config']);
					foreach ($dbdata as $dkey => $dvalue){
						$str[$dvalue['d_val']]=$dvalue['d_title'];
					}				    
				}else
					$str=explode('@#',$value['d_val']);
				$query[$key]['d_val']=$str;
			}
			//4=>select
			if($value['d_type']==4){
				if(!empty($value['d_ctype'])){
					$cdata=$this->select_page_form($value['d_ctype'],'','d_id,d_title',array('d_enable'=>'Y'));
					foreach ($cdata as $dkey => $dvalue){
						$str[$dvalue['d_id']]=$dvalue['d_title'];
					}				
				}else
					$str=explode('@#',$value['d_val']);

				$query[$key]['d_val']=$str;
			}

		}
		// print_r($query);
		// break;
		return $query;
	}

	//自動頁面標題
	public function GetMenuData($menu_id){		
		$msql='select d_menuname,d_listname,d_head,d_dbname,is_enable from d_menu where d_id='.$menu_id;
		$mquery = $this->db->query($msql)->row_array();
		return $mquery;
	}
}