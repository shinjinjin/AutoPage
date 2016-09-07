function is_number(data)
{
	return !isNaN(data);
	
}
function is_email(data) 
{
	if (data.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)
		return true;
	else
		return false;
}






// JavaScript Document