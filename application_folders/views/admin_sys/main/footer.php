<script LANGUAGE="JavaScript">
function confirmY(name,url)
{
	var return_flag;
	if(name!='' && url!='')
	{
		return_flag=confirm("確定刪除【"+name+"】資料？");
		if (return_flag) {
			location.href=url;
		}
	}
	else if(url!='')
	{
		location.href=url;
	}
}
</script>
</body>
</html>