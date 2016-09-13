<div class="content-all">
    <div class="content-title" >
      <div class="content-ti-title">列表編輯內文</div>
       
      <div class="clear"></div>
    </div>
     <form action="<?=$this->admin_path?>/Autopage/data_AED" method="post" enctype="multipart/form-data">
    <div class="content-content">
      <div class="product-table">
        <div class="product-table-all">
          <table border="0" cellspacing="0" cellpadding="0" class="contentin-table" style="width:100%;">
            <tr>
              <th>大標題名稱</th>
              <td>
                <input type="text" name="b_menuname" value="<?php echo $dbdata['d_menuname']?>"  class="contentin-table-tdtextfield"  >
              </td>
            </tr>
            <tr>
              <th>排序</th>
              <td>
                <input type="text" name="b_sort" value="<?php echo $dbdata['d_sort']?>"  class="contentin-table-tdtextfield"  >
              </td>
            </tr>
          	<tr>
              <th>狀態</th>
              <td>
                <input <?=(empty($dbdata['d_enable']))?'checked':'';echo ($dbdata['d_enable']=='Y')?'checked':'';?> name="b_enable" value="Y" type="radio">啟動
                <input <?=($dbdata['d_enable']=='N')?'checked':'';?>name="b_enable" value="N" type="radio">關閉
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
       <div class="content-content">
      <div class="product-table">
        <a href="#" id="add_menu">增加標題</a>
        <table  border="0" cellspacing="0" cellpadding="0" class="content-table" style="width:100%;">
        <thead>
          <tr>
            <td>權限</td>
            <td>標題</td>
            <td>列表名稱</td>
            <td>資料夾</td>
            <td>資料庫</td>
            <td>排序</td>
            <td>上下架功能</td>
            <td>啟動</td>
          </tr>
         </thead>
          <tbody id="addbody">
          <? 
      if(!empty($sdata)){
        foreach($sdata as $val){
      ?>
          <tr class="E7E7E7">
                <td><input type="text" name="d_code[]" value="<?php echo $val['d_code']?>" ></td>
                <td><input type="text" name="d_menuname[]" value="<?php echo $val['d_menuname']?>" ></td>
                <td><input type="text" name="d_listname[]" value="<?php echo $val['d_listname']?>" ></td>
                <td><input type="text" name="d_head[]" value="<?php echo $val['d_head']?>" ></td>
                <td><input type="text" name="d_dbname[]" value="<?php echo $val['d_dbname']?>" ></td>
                <td><input type="text" name="d_sort[]" value="<?php echo $val['d_sort']?>" ></td>
                <td><select name="d_oc[]"><option value="Y" <?php echo ($val['d_oc']=='Y')?'selected':'';?>>Y</option><option value="N" <?php echo ($val['d_oc']=='N')?'selected':'';?>>N</option></select></td>
                <td><select name="d_enable[]"><option value="Y" <?php echo ($val['d_enable']=='Y')?'selected':'';?>>Y</option><option value="N" <?php echo ($val['d_enable']=='N')?'selected':'';?>>N</option></select></td>
                <input type="hidden" name="sid[]" value="<?=$val['d_id']?>">
          </tr>
    <? }} ?>
          </tbody> 
        </table>
        <div class="mt-10 contentin-button-sit ">
          <input type="hidden" name="d_id" value="<?=$dbdata['d_id']?>">
          <input type="hidden" name="dbname" value="d_menu">
          <input type="submit" value="<?php echo $submit;?>" class="contentin-button" >
        </form>
        </div>
      </div>
  </div>
</div>
<script>
$('#add_menu').click(function(){
  $('#addbody').append(
    '<tr class="E7E7E7">'+
      '<td><input type="text" name="d_code[]"></td>'+
      '<td><input type="text" name="d_menuname[]"></td>'+
      '<td><input type="text" name="d_listname[]"></td>'+
      '<td><input type="text" name="d_head[]"></td>'+
      '<td><input type="text" name="d_dbname[]"></td>'+
      '<td><input type="text" name="d_sort[]"></td>'+
      '<td><select name="d_oc[]"><option value="Y">Y</option><option value="N">N</option></select></td>'+
      '<td><select name="d_enable[]"><option value="Y" >Y</option><option value="N">N</option></select></td>'+
    '</tr>'
  );
});
</script>