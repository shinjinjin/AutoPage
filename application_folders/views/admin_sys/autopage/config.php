<!DOCTYPE HTML>
<html>
    <head id="<?=$DBName?>">
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
    <script src="/js/myjava/page.js"></script>        <!-- bootstrap -->
    </head>
    
    <body>
        <span id="FileName" fval="<?=$FileName?>"></span>
        <div class="wapper">
            <div >
                <!--header-->
                    <div class="">
                        <div class="header-title">
                        
<div class="content-all">
    <div class="content-title" >
      <div>欄位編輯</div>
      <a href="javascript:window.location.href='<?=$this->admin_path?>/Autopage'">回首頁</a>
      <div class="clear"></div>
    </div>
     <form action="<?=$this->admin_path?>/Autopage/data_AED" method="post" enctype="multipart/form-data" id='formid'>
    <div class="content-content">
      <div class="product-table">
        <div class="product-table-all">
          <table border="0" cellspacing="0" cellpadding="0" class="contentin-table" style="width:100%;">
            <tr>
              <th>修改之列表</th>
              <td>
                <select id="selectmenu">
                <? foreach ($jdata as $key => $value):?>
                  <option value="<?=$value['d_id']?>" <?php echo ($value['d_id']==$d_menu_id)?'selected':'';?>><?php echo $value['d_menuname']?></option>                  
                <? endforeach;?>
                </select>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
       <div class="content-content">
      <div class="product-table">
        <a href="#" id="add_menu">增加標題</a>
        <table border="0" cellspacing="0" cellpadding="0" class="content-table" style="width:100%;">
        <thead>
          <tr>
            <td>列表?</td>
            <td>欄位名稱</td>
            <td>名稱</td>
            <td>類型</td>
            <td>必填?</td>
            <td>必填檢查方式</td>
            <td>選項給值(以@#分隔)</td>
            <td>排序</td>
            <td>最長長度</td>
            <td>搜尋?</td>
            <td>另個資料表</td>
            <td>Config d_type</td>
          </tr>
         </thead>
          <tbody id="addbody">
          <? 
      if(!empty($dbdata)){
        foreach($dbdata as $val){
      ?>
          <tr class="E7E7E7">
            <td><select name="d_list[]"><option value="Y" <?php echo ($val['d_list']=='Y')?'selected':'';?>>Y</option><option value="N" <?php echo ($val['d_list']=='N')?'selected':'';?>>N</option></select></td>
            <td><input type="text" name="d_fname[]" value="<?php echo $val['d_fname']?>" ></td>
            <td><input type="text" name="d_title[]" value="<?php echo $val['d_title']?>" ></td>
            <td>
              <select name="d_type[]">
                <? foreach ($cdata as $key => $value):?>
                  <option value="<?=$value['d_val']?>" <?php echo ($val['d_type']==$value['d_val'])?'selected':'';?>><?=$value['d_title']?></option>
                <? endforeach;?>
              </select>
            </td>
            <td><select name="d_must[]"><option value="Y" <?php echo ($val['d_must']=='Y')?'selected':'';?>>Y</option><option value="N" <?php echo ($val['d_must']=='N')?'selected':'';?>>N</option></select></td>
            <td>
              <select name="d_musttype[]">
                <option value="">無</option>
                <? foreach ($sdata as $key => $value):?>
                  <option value="<?=$value['d_title']?>" <?php echo ($val['d_musttype']==$value['d_title'])?'selected':'';?>><?=$value['d_title']?></option>
                <? endforeach;?>
              </select>
            </td>
            <td><input type="text" name="d_val[]" value="<?php echo $val['d_val']?>" ></td>
            <td><input type="text" name="d_sort[]" value="<?php echo $val['d_sort']?>" width="80"></td>
            <td><input type="text" name="d_maxlength[]" value="<?php echo $val['d_maxlength']?>" ></td>
            <td><select name="d_search[]"><option value="Y" <?php echo ($val['d_search']=='Y')?'selected':'';?>>Y</option><option value="N" <?php echo ($val['d_search']=='N')?'selected':'';?>>N</option></select></td>
            <td><input type="text" name="d_ctype[]" value="<?php echo $val['d_ctype']?>" ></td>
            <td><input type="text" name="d_config[]" value="<?php echo $val['d_config']?>" ></td>
            <input type="hidden" name="sid[]" value="<?=$val['d_id']?>">
          </tr>
    <? }} ?>
          </tbody> 
        </table>
        <div class="mt-10 contentin-button-sit ">
          <input type="hidden" name="d_menu_id" id="d_menu_id" value="<?=$d_menu_id?>">
          <input type="hidden" name="dbname" value="auto_page">
          <input type="submit" value="確定" class="contentin-button" >
        </form>
        </div>
      </div>
  </div>
</div>
<script>
$('#selectmenu').change(function(){
  $('#d_menu_id').val($(this).val());
  $('#formid').attr('action','');
  $('#formid').submit();
});
$('#add_menu').click(function(){
  $('#addbody').append(
    '<tr class="E7E7E7">'+
      '<td><select name="d_list[]"><option value="Y">Y</option><option value="N">N</option></select></td>'+
      '<td><input type="text" name="d_fname[]"></td>'+
      '<td><input type="text" name="d_title[]"></td>'+
      '<td>'+
        '<select name="d_type[]">'+
          '<? foreach ($cdata as $key => $value):?>'+
            "<option value='<?=$value['d_val']?>'><?=$value['d_title']?></option>"+
          '<? endforeach;?>'+
        '</select>'+
      '</td>'+
      '<td><select name="d_must[]"><option value="Y">Y</option><option value="N">N</option></select></td>'+
      '<td>'+
        '<select name="d_musttype[]">'+
          '<option value="">無</option>'+
          '<? foreach ($sdata as $key => $value):?>'+
            '<option value="<?=$value["d_title"]?>" ><?=$value["d_title"]?></option>'+
          '<? endforeach;?>'+
        '</select>'+
      '</td>'+
      '<td><input type="text" name="d_val[]"></td>'+
      '<td><input type="text" name="d_sort[]"></td>'+
      '<td><input type="text" name="d_maxlength[]"></td>'+
      '<td><select name="d_search[]"><option value="Y">Y</option><option value="N">N</option></select></td>'+
      '<td><input type="text" name="d_ctype[]"></td>'+
      '<td><input type="text" name="d_config[]"></td>'+
    '</tr>'
  );
});
</script>
