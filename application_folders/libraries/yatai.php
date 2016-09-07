<?
	// 錏鈦API
	class Yatai
	{
		var $api_flag='';//API 狀態
		
		public function __construct ($api_flag='')
		{
			$this->flag = $api_flag;
		}
		public function post_yatai($product='')
		{
			$product+=array('api_flag'=>$this->flag);
			$product=json_encode($product);

			$ch = curl_init('http://220.135.161.128/tm/api.php');
			// $ch = curl_init('http://webtest.test888.org/api/tmapi/index');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $product);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			        'Content-Type: application/json',
			        'Content-Length: ' . strlen($product))
			);

			$result = curl_exec($ch);
			// $result = json_decode($result);
			// var_dump($product);
			var_dump($result);
			// print_r($result);
			// echo $result;
			// return $result;
		}
	
	}
?>