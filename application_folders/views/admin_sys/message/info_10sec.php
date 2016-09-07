</head>
<body>
<div >
    <div style="background:#FFF; padding: 20px 50px; margin:45px 10px;">
        <table align="center" width="600">
            <tr>
                <td width="50" valign="top">
                    
                </td>
                <td style="font-size: 14px; font-weight: bold"><?=$mag;?></td>
            </tr>
            <tr>
                <td >
                    
                </td>
                <td id="redirectionMsg" style="font-size:16px;">
                	<a href="<?=$meg_url?>">登出</a><br>
					如果您不做出選擇，將在
                    <span id="spanSeconds">10</span>
                    秒後登出。
                </td>
            </tr>
        </table>
    </div>
</div>
<script language="JavaScript">
//自動轉頁
	var seconds = 10;
	var defaultUrl = '<?=$meg_url;?>';
	onload = function()
	{
	  if (defaultUrl == 'javascript:history.go(-1)' && window.history.length == 0)
	  {
		document.getElementById('redirectionMsg').innerHTML = '';
		return;
	  }
	
	  window.setInterval(redirection, 1000);
	}
	function redirection()
	{
	  if (seconds <= 0)
	  {
		window.clearInterval();
		return;
	  }
	  seconds --;
	  document.getElementById('spanSeconds').innerHTML = seconds;
	
	  if (seconds == 0)
	  {
		window.clearInterval();
		location.href = defaultUrl;
	  }
	}
</script>