<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>天沐岩盤浴</title>
	<meta name="author" content="" />
	<meta name="copyright" content="" />
	<meta name="viewport" content="width=device-width" initial-scale="1.0">
	<link rel="Shortcut icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="Bookmark" href="images/favicon.ico" type="image/x-icon">
	<link href="/css/index/reset.css" rel="stylesheet" type="text/css" />
	<link href="/css/index/basic.css" rel="stylesheet" type="text/css" />
	<link href="/css/index/idex.css" rel="stylesheet" type="text/css" />
	<script src="/js/jquery.1.11.1.min.js"></script>
	<!-- big show slider -->
	<script src="/js/jquery.flexslider-min.js"></script>
	<script src="/js/main2.js"></script> <!-- Resource jQuery -->
	<!-- 4區塊 -->
	<link rel="stylesheet" type="text/css" href="/css/index/component2.css" />
	<script src="/js/modernizr.custom.js"></script>
</head>
<body>
<div id="native">
	<img src="/images/logo.png" class="img" />
</div>
<div class="cd-testimonials-wrapper">
	<ul class="cd-testimonials">
		<? foreach ($banner_data as $value): ?>
			<li>
				<a href="<?=$value['d_url']?>" target="_blank">
					<img src="/<?=$value['d_pic_url']?>">
						<b><?=$value['d_title']?></b>
				</a>
			</li>
		<? endforeach;?>
		
	</ul> <!-- cd-testimonials -->
</div> 
<!-- cd-testimonials-wrapper -->
<div class="container">	
    <div id="bl-main" class="bl-main">
        <section><div class="bl-box"><a href="/daymore/about"><h2 class="bl-icon-about">天沐岩盤浴</h2></a></div></section>
        <section><div class="bl-box"><a href="/idol/products"><h2 class="bl-icon-works">愛朵時尚美妝</h2></a></div></section>
        <section><div class="bl-box"><a href="/manager" class="cirle"><h2 class="bl-icon-blog">關於我</h2></a></div></section>
        <section><div class="bl-box"><a href="/index/login" class="cirle"><h2 class="bl-icon-contact">登入</h2></a></div></section>				
    </div>
</div><!-- /container -->
</body>
</html>