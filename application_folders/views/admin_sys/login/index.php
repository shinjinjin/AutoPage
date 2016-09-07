<link href="/css/admin/base.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="wapper">
        <div class="login">
            <div class="logo">
            </div>
            <div class="logoin-title">
               登入您的系統
            </div>
            <?=form_open($form,array( 'enctype'=>"multipart/form-data")) //,"onsubmit"=>"return check(this)"?>
                <div>
                    <input type="text" class="login-input405 mt-10" name="user_name" id="user_name"
                    placeholder="User Name" value="<?=$account?>">
                </div>
                <div>
                    <input type="password" class="login-input405 mt-10" name="password" id="password"
                    placeholder="Password" value="<?=$pwd?>">
                </div>
                <div class="mt-10">
                    <input type="text" class="login-name" name="captcha" id="captcha" placeholder="驗證碼">
                    <div class="login-input150 mt-5">
                        <?=$captcha?>
                    </div>
                </div>
                <div class="clear">
                </div>
                <!--登入按鈕-->
                <div class="mt-10">
                    <div class="signin left">
                        <a id="loginbtn" href="#" onClick="$(this).closest('form').submit()">
                          登入系統
                        </a>
                    </div>
				</div>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" /> 
                </form>
        </div>
    </div>
</body>

</html>
<script>

$(document).ready(function () {
        $('#user_name').focus();
    });
$('#captcha').keypress(function(e) {
        var key = window.event ? e.keyCode : e.which;
        if (key == 13)
            $('#loginbtn').click();
    });

$('#tbSearch').keypress(function(e) {
        if(e.which == 13) {
            $('#loginbtn').focus().click();
        }
});

// function check(frm)
// {
// 	if(frm.elements['user_name'].value==''){
// 		alert('請輸入帳號');	
// 		return false;
// 	}
// 	else if(frm.elements['password'].value==''){
// 		alert('請輸入密碼');	
// 		return false;
// 	}
// 	else if(frm.elements['captcha'].value==''){
// 		alert('請輸入驗證碼');	
// 		return false;
// 	}
// 	else
// 		return true;
// }
</script>
