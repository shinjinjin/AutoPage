//ckeditor
var ufm_aim_ck;
var ufm_aim = document.getElementById('content');
function createEditor( languageCode )
{
	if(ufm_aim != null)
	{
		if ( ufm_aim_ck )
		{
			ufm_aim_ck.destroy();
		}

		ufm_aim_ck = CKEDITOR.replace( 'content', {
			filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?Type=Images',
			width : 530,
			height: 300,
			resize_enabled:false,
			enterMode: 2,
			forcePasteAsPlainText :true,
			allowedContent:true,
			extraPlugins:'youtube',
			youtube_width:'640',
			youtube_height:'560',
			youtube_related:true,
			youtube_older:false,
			youtube_privacy:false,
			toolbar :
			[
				['Source'],
				['Cut','Copy','Paste','PasteText','PasteFromWord', 'Table', 'HorizontalRule', 'NumberedList','BulletedList', '-', 'Link','Unlink', '-', 'Image'],
				['Bold','Italic','Underline','Strike', 'TextColor', 'BGColor', '-', 'Font','FontSize', '-', 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Iframe'],
			],
			
		});
	}   
}
createEditor( '' );


$(function(){

	//取消按鈕關閉視窗
	$('#cancel').click(function(){
		if(confirm('您確定要取消新增嗎?'))
		{
			window.close();
		}
	});

	var form_item_num = $('#survey_item_amount').val();
    $("#select_form_item option[value=0]").attr("selected", true);
    $("#select_form_item").val(0);
    //Add a item
    $( "#select_form_item" ).on('change', function()
    {
        form_item_num++;
		$('#c_col_table').show();
		$('#c_col_hr').show();

        if ($('#select_form_item option[value=1]').is(':selected')) {
            $("#col_table").append(''+
            	'<tr class="item_tr">'+
            	'	<td style="width: 484px;"><input name="item[type][]" type="hidden" value="1">'+
				'	<input name="item[item_id][]"  value="'+(form_item_num-1)+'" type="hidden"/>'+
            	'		<input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" name="item[required][]" value="'+(form_item_num-1)+'" class="form-control">'+
            	'		<input style="width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; margin: 0px 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[name][]" placeholder="[日期] [欄位名稱] 例如：您的生日" class="item_name">'+
            	'		<button type="button" style="cursor: pointer; border: 0px; font-size: 1em;" class="aa7 btn btn-danger del_col" onclick="javascript:void(0);">移除</button>'+
            	'		<i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i>'+
            	'	</td>'+
            	'</tr>'
        	);
        }
        else if ($('#select_form_item option[value=2]').is(':selected')) {
            $("#col_table").append(''+
            	'<tr class="item_tr">'+
            	'	<td style="width: 484px;"><input name="item[type][]" type="hidden" value="2">'+
				'	<input name="item[item_id][]"  value="'+(form_item_num-1)+'" type="hidden"/>'+
            	'		<input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" name="item[required][]" value="'+(form_item_num-1)+'" class="form-control">'+
            	'		<input style="width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; margin: 0px 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[name][]" placeholder="[文字] [欄位名稱] 例如：您的公司電話" class="item_name">'+
            	'		<button type="button" style="cursor: pointer; border: 0px; font-size: 1em;" class="aa7 btn btn-danger del_col" onclick="javascript:void(0);">移除</button>'+
            	'		<i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i>'+
            	'	</td>'+
            	'</tr>'
        	);
        }
        else if ($('#select_form_item option[value=3]').is(':selected')) {
            $("#col_table").append(''+
            	'<tr class="item_tr">'+
            	'	<td style="width: 484px;"><input name="item[type][]" type="hidden" value="3">'+
				'	<input name="item[item_id][]"  value="'+(form_item_num-1)+'" type="hidden"/>'+
            	'		<input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" name="item[required][]" value="'+(form_item_num-1)+'" class="form-control">'+
            	'		<input style="width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; margin: 0px 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[name][]" placeholder="[單選] [欄位名稱] 例如：您的交通工具" class="item_name">'+
            	'		<button type="button" style="cursor: pointer; border: 0px; font-size: 1em;" class="aa7 btn btn-danger del_col" onclick="javascript:void(0);">移除</button>'+
            	'		<i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i><br>'+
            	'		<input style="margin-top: 6px; margin-left: 34px; background-color: #F3FBFF; width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[content][]" placeholder="[單選] [選項] 例如：機車 汽車 計程車" class="item_content">'+
            	'		<a href="#" class="why" tabindex = "-1" style="top: -3px;">?</a>'+
                '       <div class="prompt-box" style="padding: 3px 10px;">'+
                '			<p>[單選] 請輸入 [欄位名稱] 與 [選項]，舉例來說：</p>'+
                '			<p>'+
                '               <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" disabled="disabled" class="form-control">&nbsp;'+
                '               <input style="margin-top: 6px;background-color: #F3FBFF; width: 334px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" value="您的交通工具" class="form-control" readonly="true">&nbsp;'+
                '               <button type="button" style="border: 0px; font-size: 1em;" class="aa7 btn btn-danger">移除</button>&nbsp;<i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i></p>'+
                '			<p><input style="margin-top: 6px; margin-left: 34px; background-color: #F3FBFF; width: 333px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" class="form-control" type="text" readonly="true" value="機車 汽車 計程車"></p>'+
                '			<p>請注意，任一選項之間請加入「空白」，以分隔您的選項內容</p>'+
                '			<p>若您沒有使用任何選項間隔「空白」，此欄位將不會被新增</p>'+
                '			<p>另外，若您沒有填寫欄位名稱，此欄位也不會被新增</p>'+
                '       </div>'+
      			'	</td>'+
            	'</tr>'
        	);
        }
        else if ($('#select_form_item option[value=4]').is(':selected')) {
            $("#col_table").append(''+
            	'<tr class="item_tr">'+
            	'	<td style="width: 484px;"><input name="item[type][]" type="hidden" value="4">'+
				'	<input name="item[item_id][]"  value="'+(form_item_num-1)+'" type="hidden"/>'+
            	'		<input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" name="item[required][]" value="'+(form_item_num-1)+'" class="form-control">'+
            	'		<input style="width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; margin: 0px 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[name][]" placeholder="[下拉] [欄位名稱] 例如：您的交通工具" class="item_name">'+
            	'		<button type="button" style="cursor: pointer; border: 0px; font-size: 1em;" class="aa7 btn btn-danger del_col" onclick="javascript:void(0);">移除</button>'+
            	'		<i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i><br>'+
            	'		<input style="margin-top: 6px; margin-left: 34px; background-color: #F3FBFF; width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[content][]" placeholder="[下拉] [選項] 例如：機車 汽車 計程車" class="item_content">'+
            	'		<a href="#" class="why" tabindex = "-1" style="top: -3px;">?</a>'+
                '       <div class="prompt-box" style="padding: 3px 10px;">'+
                '			<p>[下拉] 請輸入 [欄位名稱] 與 [選項]，舉例來說：</p>'+
                '			<p>'+
                '               <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" disabled="disabled" class="form-control">&nbsp;'+
                '               <input value="您的交通工具" class="form-control" style="margin-top: 6px;background-color: #F3FBFF; width: 334px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" readonly="true">&nbsp;'+
                '               <button type="button" style="border: 0px; font-size: 1em;" class="aa7 btn btn-danger">移除</button>&nbsp;<i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i></p>'+
                '			<p><input style="margin-top: 6px; margin-left: 34px; background-color: #F3FBFF; width: 333px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" class="form-control" type="text" readonly="true" value="機車 汽車 計程車"></p>'+
                '			<p>請注意，任一選項之間請加入「空白」，以分隔您的選項內容</p>'+
                '			<p>若您沒有使用任何選項間隔「空白」，此欄位將不會被新增</p>'+
                '			<p>另外，若您沒有填寫欄位名稱，此欄位也不會被新增</p>'+
                '       </div>'+
      			'	</td>'+
            	'</tr>'
        	);
        }
        else if ($('#select_form_item option[value=5]').is(':selected')) {
            $("#col_table").append(''+
            	'<tr class="item_tr">'+
            	'	<td style="width: 484px;"><input name="item[type][]" type="hidden" value="5">'+
				'	<input name="item[item_id][]"  value="'+(form_item_num-1)+'" type="hidden"/>'+
            	'		<input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" name="item[required][]" value="'+(form_item_num-1)+'" class="form-control">'+
            	'		<input style="width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; margin: 0px 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[name][]" placeholder="[複選] [欄位名稱] 例如：您的專長" class="item_name">'+
            	'		<button type="button" style="cursor: pointer; border: 0px; font-size: 1em;" class="aa7 btn btn-danger del_col" onclick="javascript:void(0);">移除</button>'+
            	'		<i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i><br>'+
            	'		<input style="margin-top: 6px; margin-left: 34px; background-color: #F3FBFF; width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[content][]" placeholder="[複選] [選項] 例如：網站UI 平面設計 網頁撰寫" class="item_content">'+
            	'		<a href="#" class="why" tabindex = "-1" style="top: -3px;">?</a>'+
                '       <div class="prompt-box" style="padding: 3px 10px;">'+
                '			<p>[複選] 請輸入 [欄位名稱] 與 [選項]，舉例來說：</p>'+
                '			<p>'+
                '               <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" disabled="disabled" class="form-control">&nbsp;'+
                '               <input value="您的專長" class="form-control" style="margin-top: 6px;background-color: #F3FBFF; width: 334px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" readonly="true">&nbsp;'+
                '               <button type="button" style="border: 0px; font-size: 1em;" class="aa7 btn btn-danger">移除</button>&nbsp;<i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i></p>'+
                '			<p><input style="margin-top: 6px; margin-left: 34px; background-color: #F3FBFF; width: 333px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" class="form-control" type="text" readonly="true" value="網站UI 平面設計 網頁撰寫"></p>'+
                '			<p>請注意，任一選項之間請加入「空白」，以分隔您的選項內容</p>'+
                '			<p>若您沒有使用任何選項間隔「空白」，此欄位將不會被新增</p>'+
                '			<p>另外，若您沒有填寫欄位名稱，此欄位也不會被新增</p>'+
                '       </div>'+
      			'	</td>'+
            	'</tr>'
        	);
        }
        else if ($('#select_form_item option[value=6]').is(':selected')) {
            $("#col_table").append(''+
                '<tr class="item_tr">'+
                '   <td style="width: 484px;"><input name="item[type][]" type="hidden" value="6">'+
				'	<input name="item[item_id][]"  value="'+(form_item_num-1)+'" type="hidden"/>'+
                '       <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" name="item[required][]" value="'+(form_item_num-1)+'" class="form-control">'+
                '       <input style="margin: 0px 3px; width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[name][]" placeholder="[數字數量] [欄位名稱] 例如：預計同行人數" class="item_name">'+
                '       <button type="button" style="border: 0px; font-size: 1em;" class="aa7 btn btn-danger del_col" onclick="javascript:void(0);">移除</button>'+
                '       <i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i>'+
                '   </td>'+
                '</tr>'
            );
        }
        $("#select_form_item option[value=0]").attr("selected", true);
        $("#select_form_item").val(0);
    });
	//delete
	$("#col_table_tbody").on('click', '.del_col', function()
	{
		var itemid=$(this).val();
		
		if(confirm('確定刪除?')){
		
		$.ajax({
			url:'/index/del_item',
			type:'POST',
			data: 'id=' + itemid+'&type=2',
			success: function( msg ) 
			{
				
			}
		});	
		
		form_item_num--;

		$(this).parent().parent().remove();
		if(form_item_num <= 0)
		{
			$('#prompt_tr').hide();
			$('#c_col_table').hide();
			$('#c_col_hr').hide();
		}	
		
		}
	});

    $('#prompt_tr').hide();
	$('#form_uform_add').submit(function( event )
	{
        var error = false; // 預設error是沒發生的
		$('.item_name').each(function()
		{
			if($(this).val().length == 0)
    			error = true;
		});
		$('.item_content').each(function()
		{
			if($(this).val().length == 0)
                error = true;
		});
        if(error)
        {
            $('#prompt_tr').show();
            event.preventDefault();
        }
        else
            $('#prompt_tr').hide();
	});

});