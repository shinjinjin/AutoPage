//活動判斷
function check_events(frm)
{
	var msg = new Object;
	var msg_err = '';
	msg.events_name =frm.elements['events_name'].value;
	msg.start_date =frm.elements['start_date'].value;
	msg.end_date =frm.elements['end_date'].value;
	msg.phone =frm.elements['phone'].value;
	msg.organizer_phone =frm.elements['organizer_phone'].value;
	msg.external_web =frm.elements['external_web'].value;
	msg.survey_web =frm.elements['survey_web'].value;
	msg.content =frm.elements['content'].value;
	msg.image =frm.elements['image'].value;
	msg.old_image =frm.elements['old_image'].value;
	
	if(msg.events_name.length==0)
	{
		msg_err+=msg_events_name+'\n';
	}	
	
	if(msg.start_date.length==0)
	{
		msg_err+=msg_start_date+'\n';
	}
	
	if(msg.end_date.length==0)
	{
		msg_err+=msg_end_date+'\n';
	}
	
	
	if(is_number(msg.phone)==0)
	{
		msg_err+=msg_phone+'\n';
	}
	else if(msg.phone.length>10)
	{
		msg_err+=msg_phone_length+'\n';
	}
	
	if(is_number(msg.organizer_phone)==0)
	{
		msg_err+=msg_organizer_phone+'\n';
	}
		else if(msg.organizer_phone.length>10)
	{
		msg_err+=msg_organizer_phone_length+'\n';
	}
	

	if(msg.external_web.length==0)
	{
		msg_err+=msg_external_web+'\n';
	}

	if(msg.survey_web.length==0)
	{
		msg_err+=msg_survey_web+'\n';
	}
	
	if(msg.content.length==0)
	{
		msg_err+=msg_content+'\n';
	}
	if(msg.image ==''&& msg.old_image=='')
	{
		msg_err+=msg_image+'\n';
	}
	

	if(msg_err.length>0)
	{
		alert(msg_err);
		return false;
	}
	else
	{
		return true;
	}
}

//判斷管理者
function check_admin(frm)
{
	var msg = new Object;
	var msg_err = '';
	
	admin_id =frm.elements['admin_id'].value;
	
	msg.user_name =frm.elements['user_name'].value;
	msg.email=frm.elements['email'].value;
	
	if(admin_id!='')
		msg.password =frm.elements['password'].value;
	
	msg.new_password =frm.elements['new_password'].value;
	msg.pwd_confirm =frm.elements['pwd_confirm'].value;
	
	if(msg_admin_name!='' && msg.user_name.length==0)
		msg_err+=msg_admin_name+'\n';
	
	if(msg_email!='' && msg.email.length==0)
		msg_err+=msg_email+'\n';
	else if(msg_email_err!='' && !is_email(msg.email))
		msg_err+=msg_email_err+'\n';
	
	
	if(admin_id!='')
	{
		if(msg.password !='' || msg.new_password !='' || msg.pwd_confirm !='')
		{
			if(msg.password =='')
				msg_err+=msg_old_passwork+'\n';
		
			if(msg.new_password =='')
				msg_err+=msg_new_password+'\n';
		
			if(msg.pwd_confirm =='')
				msg_err+=msg_pwd_confirm+'\n';
				
			if(msg.new_password!=msg.pwd_confirm)
				msg_err+=msg_new_confirm+'\n';
		}
	}
	else
	{
		if(msg.new_password=='')
			msg_err+=msg_passwork+'\n';
		
		if(msg.pwd_confirm =='')
			msg_err+=msg_pwd_confirm+'\n';
		
		if(msg.new_password!=msg.pwd_confirm)
			msg_err+=msg_passwork_check+'\n';
	
	}
	
	if(msg_err.length>0)
	{
		alert(msg_err);
		return false;
	}
	else
	{
		return true;
	}
}

