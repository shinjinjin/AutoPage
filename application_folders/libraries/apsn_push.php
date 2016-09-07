<?
	//$deviceToken='ba5570f3883bdba664c0978009eeade025749716577b0129fe8da307cd8a5c0d';
	//$pem = '/var/www/vhosts/topapp.com.tw/httpdocs/AppPlus/attachments/date_201302/6a38af4eb5192f66fbfa084c3698d7f7.pem'; 
	//$meg='123123123123';
	//$gcm = new Apsn_push($pem);
	//echo $gcm->pushNotification($deviceToken,$meg);
	
	class Apsn_push
	{
		var $pass='';//絕對路徑
		var $devicetoken='';
		var $message='';
		
		public function __construct ($pem='')
		{
			$this->pem = $pem;
		}
		
	
		public function pushNotification($devices='', $meg='')
		{
			//訊息
			//$message=$meg;
			//pem檔案位置
			$pass=$this->pem;
			//傳送裝置編號
			$devicetoken=$devices;
			$body=$meg;
		
			// Get the parameters from HTTP get or from command line
			//echo $message = $_GET['message'] or $message = $argv[1] or $message ;
			/*$badge = (int)$_GET['badge'] or $badge = (int)$argv[2];
			$sound = $_GET['sound'] or $sound = $argv[3]*/;
			// Construct the notification payload
			/*$body = array();
			$body['aps'] = array('alert' => $message);
			if ($badge)	$body['aps']['badge'] = $badge;
			if ($sound)	$body['aps']['sound'] = $sound;*/
			/* End of Configurable Items */
			$ctx = stream_context_create();
			
			stream_context_set_option($ctx, 'ssl', 'local_cert',  $pass);
			
			$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
			 
			// connect to apns
			if (!$fp) 
			{
				return '0';//失敗
			}
			// send message
			$payload = json_encode($body);
			
			$msg = chr(0).pack('n',32).pack('H*',str_replace('','',$devicetoken)).pack('n',strlen($payload)).$payload;
			
			fwrite($fp, $msg);
			fclose($fp);
			return '1';//成功
		}
	
	}
?>