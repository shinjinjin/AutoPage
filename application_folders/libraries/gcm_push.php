<?
//
//$apiKey='AIzaSyCc0_h7Jwmgcil7TkDWeVHsgcho2Ic2HGI';
//
//$devicetoken=array(
//	'APA91bGcBiCAQAw5DdYL3YfBPVDqKvFq-G8dcsmNV6A9qYfScMWMk7xFsAB4go7ZsQOaPIufuCmMY8Rz9xp1AJtql8wnIVRxfM0l9ke5HsWaf1tGUraOZhMSXsjYyr8odjYzFlNa0G2ze9Kropq1Y1ILvj1J9Wgfhw',
//	'APA91bHy0AktXgUrC9z6wJ7q_vgPdmSHSPpjJnWGcdAnsEZuhLApQzeUhembEICxjrLQolmxO6B9_9CpsX0foPaPigU4Xh4Vl3wvbBKF_HnPtvTt4cyrLLhkj9Kv1p3ehUOIlAh-mOyrLLtEsCmU0UJK55PIv0pD8g'
//);
//


//$message=array(
//	'title'=>'asdasdasd',
//	'link'=>'qweqweqweq',
//	'message'=>'3453453443345345'
//);
//
//
//
//$gcm = new Gcm_push($apiKey);
//echo $gcm->pushNotification($devicetoken,$message);
//$gcm->pushResultArray();

class Gcm_push
{
	/*
	Set the api key for using push service.
	Note that if you send by "cUrl" , you should ask a "Browser Key"!
	$apiKey = "";
	*/
	var $GOOGLE_API_KEY = "";
	
	// Google Cloud Messaging Service path for push notification 
	var $GOOGLE_CLOUD_MESSAGING = "https://android.googleapis.com/gcm/send";
	
	// content type for your data format
	var $contentType = "application/json";
	
	var $pushResultArray='';//回傳值
	
	function __Construct ($apiKey='')
	{
		$this->GOOGLE_API_KEY = $apiKey;
	}
	
	/* the main function to send message */
	public function pushNotification($devices='', $msg='', $ntfyType = "")
	{
		$device_id  = $devices;
		$message    = $msg;
		$notifyType = $ntfyType;
		
		/* 
		there are example data.
		if un note this section , you can use some fake data for testign 
		$device_id  = array("50");
		$message    = "test";
		$notifyType = "packages";
		*/
		if(!is_array($device_id)) { $device_id = array($device_id); }
		
		//if data is null , then return false 
		if( count($device_id) <= 0 /*or trim($message) == ""*/) 
		{
			return false; 
		}
		
		$PushMessagess=$message['title']."@@".$message['link']."@@".$message['message']."@@".$message['push_id'];
		$post_fields=array(
			'data'=>array(
				'action'=>$PushMessagess,
				"dataType"=>$notifyType,
			),
			'registration_ids'=>$device_id
		);
		
		$post_fields=json_encode($post_fields);
		
		$aciton =array( 
			"Content-Type: ".$this->contentType ,
			"Authorization: key=".$this->GOOGLE_API_KEY
		);
		/* initial the curl object */
		$curl = curl_init();
		curl_setopt($curl , CURLOPT_URL , $this->GOOGLE_CLOUD_MESSAGING);
		curl_setopt($curl , CURLOPT_POST , true );
		curl_setopt($curl , CURLOPT_RETURNTRANSFER , true );
		curl_setopt($curl , CURLOPT_SSL_VERIFYPEER , false );
		curl_setopt($curl , CURLOPT_HTTPHEADER  , $aciton );
		curl_setopt($curl , CURLOPT_POSTFIELDS ,$post_fields);
		$pushResult = curl_exec( $curl );
		
		if($pushResult)
		{
			$pushResultArray = json_decode($pushResult,true);
			/* check if notify send success */
			if($pushResultArray["success"]==0)
			{
				return false;
			}
			else
			{
				$this->pushResultArray=$pushResultArray;
				return true;
			}
		}
		else
		{
			return false;
		}
	}
	
	public function pushResultArray()
	{
		return $this->pushResultArray;
	}
	
}

?>