  <div class="content-all">
    <div class="content-title" >
      <div class="content-ti-title"><?=$TitleName?>列表</div>
      <div class="content-ti-menu">
       <ul>
          <li><a href="javascript:void(0)" id="add_action" dval="<?=$_SESSION['Menu']['menuid']?>">新增</a></li> 
        </ul>
      </div>
    </div>
    <div class="clear"></div>
    <?=form_open($form,array('enctype'=>"multipart/form-data","id"=>"search_form"));?>
    <? if($IsEnable=='Y'):?>
      <div class="search">
      	<div style="float:right">
          <select name="show_num" id="show_num" style="border:0px; font-size:14px; margin:5px;">
            <option value="no">請選擇</option>
            <option value="Y">批次上架</option>
            <option value="N">批次下架</option>            
          </select>
          <input type="button" value="修改" style=" font-size:14px;"  onclick="allcheck()"/>
      	</div>
      </div>
    <?endif;?>
    <!--內容之內容-->
    <div class="content-content">
      <div class="product-table">
        <table  border="0" cellspacing="0" cellpadding="0" class="content-table" style="width:100%;">
        <thead>
          <tr>
            <? if($IsEnable=='Y'):?>
              <th>全選<br /><input type="checkbox" onclick="check_all(this,'allid[]')" /></th>
              <td>狀態</td>
            <?endif;?>
            <? foreach ($fdata as $fvalue):?>
              <td><?=$fvalue['d_title']?></td>
            <? endforeach;?>
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
            <? if($IsEnable=='Y'):?>
              <td><input type="checkbox" name="allid[]" value="<?=$val['d_id']?>" /></td>
              <td><?=$this->useful->ChkOC($val['d_enable'])?></td>
           	<?endif;?>
            <?foreach ($fdata as $fvalue):
                if($fvalue['d_type']==2):
            ?>
              <td><?=$fvalue['d_val'][$val[$fvalue['d_fname']]];?></td>
            <?  else:?>
              <td><?=$val[$fvalue['d_fname']];?></td>
              <?  endif;?>
            <? endforeach;?>
			      <td><a href="#" id="fix_action" rel="<?=$val['d_id']?>" ><img src="/images/menu/ico-modify-a.png" name="modify" width="20" height="19" border="0"></a></td>
            <td><a href="#" id="del_action" rel="<?=$val['d_id']?>" fildname="<?=$val['d_title']?>"  style="border:none; cursor:pointer;"><img src="/images/menu/icn_trash-a.png" name="icn_trash" width="16" height="14" border="0"></a>
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
</div>
<script src='/js/myjava/allcheck.js'></script>