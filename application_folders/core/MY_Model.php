<?
class MY_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function select_page_form($table="",$page="",$filed="*",$set='',$order_id="",$order_type='asc'){
    	$sql=" select ".$filed." from ".$table." ";
    	if($set!=''){
    		$sql.=" where ";
    		foreach ($set as $key => $value) {
    			$sql.=$key.'="'.$value.'"';
    		}
    	}
    	
    	if($order_id!=''){
    		$sql.=' order by '.$order_id.' '.$order_type;
    	}

    	$sql.=$page;

    	$query = $this->db->query($sql);
		return $query->result_array();
    }
	//----------------------------------------------------------------------------------- 
	// 函數名：select_from($table, $data_where)
	// 作 用 ：取得資料庫指定內容
	// 參 數 ：$table 目標資料表名稱
	// $data_where 指定目標
	// 返回值：data陣列
	// 備 注 ：無 
	//----------------------------------------------------------------------------------- 
	public function select_from($table, $data_where)
	{
		$this->db->where($data_where);
		$query = $this->db->get($table);
		return $query->row_array();
	}
	//----------------------------------------------------------------------------------- 
	// 函數名：select_from_order($table, $order, $o_type, $data_where)
	// 作 用 ：取得資料庫指定內容-排序
	// 參 數 ：$table 目標資料表名稱
	// $order 排序目標
	// $o_type 排序類型
	// $data_where 指定目標
	// 返回值：data陣列
	// 備 注 ：無 
	//----------------------------------------------------------------------------------- 
	public function select_from_order($table, $order='', $o_type='', $data_where='',$limit='',$page='')
	{
		if(!empty($data_where))
			$this->db->where($data_where);
		if($order!='')
			$this->db->order_by($order, $o_type);
		if($page!='' ||$limit!=''){
			$query=$this->db->get($table,$limit,$page);
		}else
			$query=$this->db->get($table);
		$data=$query->result_array();
		return $data;
	}
	//----------------------------------------------------------------------------------- 
	// 函數名：select_from_total($table,$data_where)
	// 作 用 ：取得資料庫指定內容-總數
	// 參 數 ：$table 目標資料表名稱
	// $data_where 指定目標
	// 返回值：Num 總數
	// 備 注 ：無 
	//----------------------------------------------------------------------------------- 
	public function select_from_total($table,$data_where='')
	{
		if(!empty($data_where))
			$this->db->where($data_where);
		$query=$this->db->get($table);
		$data=$query->num_rows();
		return $data;
	}

	//----------------------------------------------------------------------------------- 
	// 函數名：insert_into($table, $data) 
	// 作 用 ：新增一筆資料
	// 參 數 ：$table 目標資料表名稱
	// $data 新增資料陣列
	// 返回值：資料流水號id
	// 備 注 ：無 
	//----------------------------------------------------------------------------------- 
	public function insert_into($table, $data, $data_where = '')
	{
		if($data_where != '')
			$this->db->where($data_where);
		$query = $this->db->get($table);
		$exists_check = $query->row_array();
		if((empty($exists_check) && $data_where != '') || $data_where == '') // 存在檢查 or 不檢查
		{
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}
	}

	//----------------------------------------------------------------------------------- 
	// 函數名：update_set($table, $target_name, $target_id, $data)
	// 作 用 ：修改一筆資料
	// 參 數 ：$table 目標資料表名稱
	// $target_name 指定修改目標的欄位名稱
	// $target_id 指定修改目標的id值
	// $data 修改資料陣列
	// 返回值：資料流水號id
	// 備 注 ：無 
	//----------------------------------------------------------------------------------- 
	public function update_set($table, $target_name, $target_id, $data)
	{
		$this->db->where($target_name, $target_id);
		return $this->db->update($table, $data);
	}

	//----------------------------------------------------------------------------------- 
	// 函數名：update_where_array_set($table, $target_array, $data)
	// 作 用 ：修改一筆資料
	// 參 數 ：$table 目標資料表名稱
	// $target_array 指定修改目標的欄位名稱
	// $data 修改資料陣列
	// 返回值：資料流水號id
	// 備 注 ：無 
	//----------------------------------------------------------------------------------- 
	public function update_where_array_set($table, $target_array, $data)
	{
		$this->db->where($target_array);
		return $this->db->update($table, $data);
	}

	//----------------------------------------------------------------------------------- 
	// 函數名：delete_where($table, $data_where)
	// 作 用 ：刪除一筆資料
	// 參 數 ：$table 目標資料表名稱
	// $data_where 指定刪除目標
	// 返回值：無
	// 備 注 ：無 
	//----------------------------------------------------------------------------------- 
	public function delete_where($table, $data_where)
	{
		$this->db->where($data_where);
		$this->db->delete($table); 
	}

	public function config_sql($type='',$val=''){
		$sql='select d_id,d_title,d_val from config where d_type=?';
		if($val!='')
			$sql.=' and d_val='.$val;
		$query = $this->db->query($sql,$type);
		return $query->result_array();
	}	
	//-----------------------------------------------------------------------------------
	// 函數名：get_filed_data($table,$filed,$do_where,$andor,$result_array)
	// 作 用 ：撈取資料-可指定欄位撈取資料
	// 參 數 ：$table=>資料表名稱
	// $filed=>欲撈取之欄位名稱
	// $do_where=>撈取條件
	// $andor=>AND OR
	// $result_array=>單筆或陣列輸出
	// 返回值：無
	// 備 注 ：無 
	//-----------------------------------------------------------------------------------
	public function get_filed_data($table,$filed='*',$do_where='',$andor='and',$result_array=''){
		$sql='select ';

		if($filed!='*'){
			$f_count=count($filed);
			foreach($filed as $f_key=> $val){
				if($f_key+1==$f_count)
					$sql.=$val;
				else
					$sql.=$val.',';
			}
		}else
			$sql.=$filed;

		$sql.=' from '.$table;
		
		if($do_where!=''){
			$sql.=' where ';
			$count=count($do_where);

			$d_key=0;
			foreach ($do_where as $key=> $value) {
				$d_key++;
				if($d_key==$count)
					$sql.=$key.$value;
				else
					$sql.=$key.$value.' '.$andor.' ';
			}
				echo $count;
		}
	
		$query = $this->db->query($sql);
		if($result_array!='')
			return $query->row_array();	
		else	
			return $query->result_array();	
	}
} 