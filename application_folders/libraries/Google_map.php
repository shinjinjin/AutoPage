<?php
class Google_map
{
	var $address='';
	function __Construct ()
	{
		//$this->address = $address;
	}
	//地圖經緯度
	public function google_map($address='',$location='tw')
	{
		//$address=$this->address;

		$addr_str_encode = urlencode($address);
		//-2016-0106-由於地圖server不同-需更改MAP地區位置

		$url = "http://maps.googleapis.com/maps/api/geocode/json"
			."?sensor=true&language=zh-TW&region=tw&address=".$addr_str_encode;

		//-2016-0106-由於地圖server不同-需更改MAP地區位置
		$geo = file_get_contents($url);
		$geo = json_decode($geo,true);
		$geo_status = $geo['status'];
		if($geo_status=="OVER_QUERY_LIMIT"){ die("OVER_QUERY_LIMIT"); }
		if($geo_status!="OK") continue;
		$geo_address = $geo['results'][0]['formatted_address'];
		$num_components = count($geo['results'][0]['address_components']);
		//郵遞區號、經緯度
		$geo_zip = $geo['results'][0]['address_components'][$num_components-1]['long_name'];
		$geo_lat = $geo['results'][0]['geometry']['location']['lat'];
		$geo_lng = $geo['results'][0]['geometry']['location']['lng'];
		$geo_location_type = $geo['results'][0]['geometry']['location_type'];
		
		 $addr_latlng_array= array(
			'lat'	=>$geo_lat,
			'lng'	=>$geo_lng
		);
		return $addr_latlng_array;
	}
}
?>