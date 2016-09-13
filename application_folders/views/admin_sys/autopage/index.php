<div class="content-all">
    <div class="content-title" >
      <div class="content-ti-title">菜單列表</div>
      <div class="content-ti-menu">
       <ul>
          <li><a href="<?=$this->admin_path?>Autopage/info" >新增</a></li> 
        </ul>
      </div>
    </div>
    <div class="clear"></div>
    <?=form_open($form,array('enctype'=>"multipart/form-data","id"=>"search_form"));?>
      <!-- <div class="search">
      	<div style="float:right">
          <select name="show_num" id="show_num" style="border:0px; font-size:14px; margin:5px;">
            <option value="no">請選擇</option>
            <option value="Y">批次上架</option>
            <option value="N">批次下架</option>            
          </select>
          <input type="button" value="修改" style=" font-size:14px;"  onclick="allcheck()"/>
      	</div>
      </div> -->
    <!--內容之內容-->
    <div class="content-content">
      <div class="product-table">
        <table  border="0" cellspacing="0" cellpadding="0" class="content-table" style="width:100%;">
        <thead>
          <tr>
            <th>全選<br /><input type="checkbox" onclick="check_all(this,'allid[]')" /></th>
            <td>狀態</td>
            <td>大標題</td>
            <td>欄位編輯</td>
            <td>修改</td>
            <td>刪除</td>
          </tr>
         </thead>
          <tbody>
          <? 
		  if(!empty($dbdata)){
			  foreach($dbdata as $val){
		  ?>
          <tr class="E7E7E7">
                <td><input type="checkbox" name="allid[]" value="<?=$val['d_id']?>" /></td>
                <td><?=$this->useful->ChkOC($val['d_enable'])?></td>
                <td><?=$val['d_menuname']?></td>
                <td><a href="<?=$this->admin_path?>Autopage/config/<?=$val['d_id']?>" ><img src="/images/menu/ico-modify-a.png" name="modify" width="20" height="19" border="0"></a></td>
                <td><a href="<?=$this->admin_path?>Autopage/info/<?=$val['d_id']?>" ><img src="/images/menu/ico-modify-a.png" name="modify" width="20" height="19" border="0"></a></td>
                <td><a href="<?=$this->admin_path?>Autopage/data_AED/d_menu/<?=$val['d_id']?>" style="border:none; cursor:pointer;"><img src="/images/menu/icn_trash-a.png" name="icn_trash" width="16" height="14" border="0"></a>
            </td>
          </tr>
		<? }} ?>
          </tbody> 
        </table>
        <input type="hidden" name="ToPage" id="ToPage" value="<?=$ToPage?>">
		</form>
        <div class="product-pageall"><?=$page?></div>
        
      </div>
      <div style=" background-color:#F00;"></div>
    </div>
  </div>