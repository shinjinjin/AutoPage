<?
	// 歐付寶
	class Allpay
	{
		var $Merchantid='';			//商家代號
		var $Hash_key='';			//hash
		var $Hash_iv='';			//iv
		var $MerchantTradeNo='';	//訂單編號
		var $MerchantTradeDate='';	//訂單日期
		var $TotalAmount='';		//交易金額
		var $TradeDesc='';			//交易描述
		var $Returnurl='';			//交易返回頁面
		var $ClientBackURL='';		//您要歐付寶返回按鈕導向的瀏覽器端網址
		var $OrderResultURL='';		//您要收到付款完成通知的瀏覽器端網址
		var $Choosepayment='PaymentMethod::ALL';		//付款方式
		
		var $paymenttype='';		//會員選擇的付款方式
		var $itemname='';			//商品名稱(以井號分隔(#))
		var $Returnurl='';			//交易返回頁面
		
		var $clientbackurl='';		//交易通知網址
		var $devicesource='';		//裝置來源
		var $ignorepayment='';		//忽略的付款方式
		var $needextrapaidinfo='';	//額外回傳
		var $creditinstallment='';	//分期期數	0=>不分期
		var $mode='0';

		public function __construct ($merchantid='',$hash_key='',$hash_iv='')
		{
			$this->merchant=$merchantid;	//商家代號
			$this->hash=$hash_key;	//hash
			$this->iv=$hash_iv;	//iv
		}
		//產生form表
		public function AllPayForm(){	

			// form_active 交易網址
			switch ($this->mode)
			{
				case 0:
					$gateway_url = "http://payment-stage.allpay.com.tw/Cashier/AioCheckOut";
					break;
				case 1:
					$gateway_url = "https://payment.allpay.com.tw/Cashier/AioCheckOut";
					break;
			}

			// AllPay Configuration
			/* *****************************************************************************************
			 * () AllPay 參數
			 * http://www.allpay.com.tw/Content/files/%E5%85%A8%E6%96%B9%E4%BD%8D%E9%87%91%E6%B5%81%E4%BB%8B%E6%8E%A5%E6%8A%80%E8%A1%93%E6%96%87%E4%BB%B6.pdf
			 * -----------------------------------------------------------------------------------------
			 * [] 舉例值 
			 * -----------------------------------------------------------------------------------------
			 * 「訂單產生」參數設定說明 :
			 * -----------------------------------------------------------------------------------------
			 * MerchantID 				: 廠商編號          Varchar(10) 
			 * MerchantTradeNo 			: 廠商交易編號      Varchar(20)     (不可重複)
			 * MerchantTradeDate 		: 廠商交易時間      Varchar(20)     (格式：yyyy/MM/dd HH:mm:ss)
			 * PaymentType 				: 交易類型          Varchar(20)     [aio]
			 * TotalAmount				: 交易金額		  
			 * TradeDesc				: 交易描述		    Varchar(200)    (不可為空)
			 * ItemName 				: 商品名稱  	    Varchar(200)    (以#分隔) [車x1#玩具x1]
			 * return_url  				: 付款完成通知      Varchar(200)    (將付款結果以 server端幕後方式，回傳到該網址)
			 							  回傳網址			
			 * ChoosePayment			: 選擇預設付款方式  Varchar(20)     (不可為空)
			 * CheckMacValue 			: 檢查碼			Varchar			(不可為空)
			 * DeviceSource 			: 裝置來源			Varchar(10)     (P:桌機  M:手機)
			 * ClientBackURL            : Client端			Varchar(200)
			 							  返回廠商網址
			 * IgnorePayment 			: 忽略的付款方式	Varchar(100)    (以#分隔) [ATM#CVS]
			 * *****************************************************************************************/
			$form_array = array(
			    "MerchantID" 		=> $this->merchant, 			// 商家代號
			    "MerchantTradeNo"   => $this->merchanttradeno,		// 訂單編號
			    "MerchantTradeDate" => date("Y/m/d H:i:s"),  	// 訂單日期
			    "PaymentType" 		=> "aio",			// 交易類型
			    "TotalAmount" 		=> $this->totalamount,			// 交易金額
			    "TradeDesc" 		=> $this->tradedesc,			// 交易描述
			    "ItemName" 			=> $this->itemname,				// 商品名稱(以井號分隔(#))
			    "ReturnURL" 		=> $this->returnurl,			// 交易返回頁面
			    "ChoosePayment" 	=> $this->choosepayment,		// 付款方式
			    "ClientBackURL" 	=> $this->clientbackurl,		// 交易通知網址
			    "NeedExtraPaidInfo" => $this->needextrapaidinfo,	// 額外回傳

			);

			ksort($form_array,SORT_NATURAL |SORT_FLAG_CASE);
			$form_array['CheckMacValue'] = $this->_getMacValue($this->hash,$this->iv, $form_array);

			$form_info="<form action='".$gateway_url."' method='post' >";
			
			foreach($form_array as $key => $val)
			{
			    $form_info .= "<input type='hidden' name='" . $key . "' value='" . $val . "'><BR>";
			}
			$form_info.="<input type='submit'>";
			$form_info.="</form>";
			return $form_info;
		}
		//產生檢查碼
		private function _getMacValue($hash_key, $hash_iv, $form_array)
		{
			$encode_str = "HashKey=" . $hash_key;
			foreach ($form_array as $key => $value)
			{
				$encode_str .= "&" . $key . "=" . $value;
			}
			$encode_str .= "&HashIV=" . $hash_iv;
			$encode_str = strtolower(urlencode($encode_str));
			$encode_str = $this->_replaceSPChar($encode_str);

			return md5($encode_str);
		}

		private function _replaceSPChar($value)
   		{
	        $search_list = array('%2d', '%5f', '%2e', '%21', '%2a', '%28', '%29');
	        $replace_list = array('-', '_', '.', '!', '*', '(', ')');
	        $value = str_replace($search_list, $replace_list ,$value);
	        return $value;
    	}

    	//訂單亂數產生器
    	private function generatorPassword($str_len, $strings)
		{
			$word = 'ab0123456789cdefghijklmn0123456789opqrstuvwxyzABCD0123456789EFGHIJKLMNO0123456789PQRSTUVWKYZ0123456789';
		    $len = strlen($word);

		    for ($i = 0; $i < $str_len; $i++) {
		        $strings .= $word[rand() % $len];
		    }

		    return $strings;
		}
	}
?>