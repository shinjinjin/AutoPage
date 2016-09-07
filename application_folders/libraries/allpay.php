<?php
class Allpay {
	//訂單編號
	var $Trade_no="";
	//交易金額
	var $Total_amt = "";
	//交易描述
	var $Trade_desc = "";
	//如果商品名稱有多筆，需在金流選擇頁一行一行顯示商品名稱的話，商品名稱請以井號分隔(#)
	var $Item_name = "";
	//交易返回頁面
	var $Return_url = "";
	//交易通知網址
	var $Client_back_url = "";
	//選擇預設付款方式
	var $Choose_payment = "ALL";
	//是否需要額外的付款資訊
	var $NeedExtraPaidInfo = "Y";
	// //Alipay 必要參數
	var $Alipay_item_name = '';
	var $Alipay_item_counts = '';
	var $Alipay_item_price = '';
	var $Alipay_email = '';
	var $Alipay_phone_no = '';
	var $Alipay_user_name = '';


	public function __construct($Merchant_id="",$Hash_key="",$Hash_iv="")//初始化
	{
		$this->Merchant_id=$Merchant_id;	//商店代號
		$this->Hash_key=$Hash_key;			//HashKey
		$this->Hash_iv=$Hash_iv;			//HashIV
	}


    public function AllPayForm(){
    	//交易網址(測試環境)
		switch ($this->mode)
		{
			case 0:
				$gateway_url = "http://payment-stage.allpay.com.tw/Cashier/AioCheckOut";
				break;
			case 1:
				$gateway_url = "https://payment.allpay.com.tw/Cashier/AioCheckOut";
				break;
		}
		$Alipay_item_counts=1;
		// 商品多筆則做#字分隔處理
		
		$Alipay_item_name=$Item=$this->Item_name;
		
		$Alipay_item_price=$this->Total_amt;
		

		$form_array = array(
		    "MerchantID" => $this->Merchant_id,
		    "MerchantTradeNo" => $this->Trade_no,
		    "MerchantTradeDate" => date("Y/m/d H:i:s"),
		    "PaymentType" => "aio",
		    "TotalAmount" => $this->Total_amt,
		    "TradeDesc" => $this->Trade_desc,
		    "ItemName" => $Item,
		    "ReturnURL" => $this->Return_url,
		    "ChoosePayment" => $this->Choose_payment,
		    "ClientBackURL" => $this->Client_back_url,
			"NeedExtraPaidInfo" => $this->NeedExtraPaidInfo,
			// # Alipay 必要參數
			"AlipayItemName" => $Alipay_item_name,
			"AlipayItemCounts" => $Alipay_item_counts,
			"AlipayItemPrice" => $Alipay_item_price,
			"Email" => $this->Alipay_email,
			"PhoneNo" => $this->Alipay_phone_no,
			"UserName" => $this->Alipay_user_name
		  );
		# 調整ksort排序規則--依自然排序法(大小寫不敏感)var 
		ksort($form_array);
		# 取得 Mac Value
		$form_array['CheckMacValue'] = $this->_getMacValue($this->Hash_key, $this->Hash_iv, $form_array);
			
		$html_code = '<form target="_blank" method=post action="' . $gateway_url . '" >';
		foreach ($form_array as $key => $val) {
		    $html_code .= "<input type='hidden' name='" . $key . "' value='" . $val . "'>";
		}
		//$html_code .= "<input  class='button04' type='submit' value='送出' >";
		
		return $html_code;
	}

 	//特殊字元置換
	private function _replaceChar($value)
	{
		$search_list = array('%2d', '%5f', '%2e', '%21', '%2a', '%28', '%29');
		$replace_list = array('-', '_', '.', '!', '*', '(', ')');
		$value = str_replace($search_list, $replace_list ,$value);
		
		return $value;
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
		$encode_str = $this->_replaceChar($encode_str);
		return md5($encode_str);
	}
}