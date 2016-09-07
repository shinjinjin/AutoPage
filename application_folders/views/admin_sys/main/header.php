<!DOCTYPE HTML>
<html>
    <head id="<?=$DBName?>">
        <? 
        header("Cache-control: private");

		// date_default_timezone_set( "Asia/Taipei"); 
		$sub_day=floor(($maturity-time())/86400)+1;
        ?>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title><?=$header['nettitle']?></title>
            <link href="/css/base.css" rel="stylesheet" type="text/css">
            <link rel="stylesheet" href="/css/admin/datepicker.css" type="text/css"
            media="screen" />
            <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"
            rel="stylesheet">
            <link rel="stylesheet" href="/css/colorbox.css" />
            <!--header隱藏-->
            <script src="/js/Important/jquery-1.9.1.js"></script>
            <script type='text/javascript' src='/js/Important/header.js'></script>
            <script src="/js/Important/datepicker.js"></script>
            <script src="/js/Important/datepicker_time.js"></script>
            <script src="/js/jquery.colorbox.js"></script>
            <script src="/js/myjava/page.js"></script>


            <!-- bootstrap -->
            <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
            <!--Left選單-->
            <script>
                $(function() {
                    $(".menu li a").click(function() {
                        var _this = $(this);
                        if (_this.next("ul").length > 0) {
                            if (_this.next().is(":visible")) {
                                //隱藏子選單並替換符號
                                _this.toggleClass('meun2');
                                _this.next().hide();
                            } else {
                                //開啟子選單並替換符號
                                _this.removeClass("meun2");
                                _this.next().show();
                            }
                            //關閉連結
                            return false;
                        }
                    });

                    $("a").focus(function() {
                        $(this).blur();
                    });
                });
            </script>
    </head>
    
    <body>
        <span id="FileName" fval="<?=$FileName?>"></span>
        <div class="wapper">
            <div class="right-block">
                <!--header-->
                <header class="nav-down">
                    <div class="header-all">
                        <div class="header-title">
                        <div class="header-ti-left">
                        	<?=$header['nettitle']?>
                              </div>
                            <a href="/admin_sys/index/logout">
                                <div class="header-ti-right">
                                    登出
                                </div>
                            </a>
                          
                        </div>
                        <div class="clear">
                        </div>
                        <div class="header-footer">
                            <div class="header-fo-F7B52C">
                            </div>
                            <div class="header-fo-AACC04">
                            </div>
                            <div class="header-fo-F7B52C">
                            </div>
                            <div class="header-fo-AACC04">
                            </div>
                        </div>
                    </div>
                </header>
                <div class="clear">
                </div>
                