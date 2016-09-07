<!DOCTYPE HTML>
<html>
<head>
<? //date_default_timezone_set("Asia/Taipei");
   $comp_name = $this->session->userdata('comp_name');
   $maturity = $this->session->userdata('maturity');
   $sub_day=floor(($maturity-time())/86400)+1;
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$this->lang->line('ManagementSystem');?></title>
<link href="/css/base.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/css/admin/datepicker.css" type="text/css" media="screen" />	
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">




</head>

<body >

