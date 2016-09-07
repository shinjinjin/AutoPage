<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>		
<script type="text/javascript" src="/js/datepicker/datepicker.js"></script>   
<link type="text/css" rel="stylesheet" href="/js/datepicker/datepicker.css">
<div class="content-all">
    <div class="content-title" >
      <div class="content-ti-title"><?=$submit.$TitleName?></div>
       
      <div class="clear"></div>
    </div>
    <div class="content-content">
      <div class="product-table">
        <div class="product-table-all">
        <form action="./data_AED" method="post" enctype="multipart/form-data">
          <table border="0" cellspacing="0" cellpadding="0" class="contentin-table" style="width:100%;">
            <? foreach ($fdata as $fkey => $fvalue):
                //Input Text
                if($fvalue['d_type']==1):
            ?>
                <tr>
                  <th><?=$fvalue['d_title']?></th>
                  <td>
                    <input type="text" name="<?=$fvalue['d_fname']?>" value="<?php echo $dbdata[$fvalue['d_fname']]?>" id="<?=$fvalue['d_fname']?>"  class="contentin-table-tdtextfield"  >
                  </td>
                </tr>
            <?
                endif;
                //Input checkbox
                if($fvalue['d_type']==2):
            ?>
                <tr>
                  <th><?=$fvalue['d_title']?></th>
                  <td>
                    <? foreach ($fvalue['d_val'] as $key => $value):?>
                      <input value=<?=$key?> name="<?=$fvalue['d_fname']?>" id="<?=$fvalue['d_fname']?>" <?php echo ($dbdata[$fvalue['d_fname']]==$key)?'checked':'';?> type="radio"><?=$value?>
                    <? endforeach;?>
                  </td>
                </tr>
            <?
                endif;
                //Input checkbox
                if($fvalue['d_type']==3):
            ?>
            <?
                endif;
                //Input checkbox
                if($fvalue['d_type']==4):
            ?>
            <?
                endif;
                //Input checkbox
                if($fvalue['d_type']==5):
            ?>
            <?
                endif;
                //Input checkbox
                if($fvalue['d_type']==6):
            ?>
            <?
                endif;
                //Input checkbox
                if($fvalue['d_type']==7):
            ?>
            <?
                endif;
                //Input checkbox
                if($fvalue['d_type']==8):
            ?>
            <?
                endif;
                //Input checkbox
                if($fvalue['d_type']==9):
            ?>
            <?
                endif;
                //Input checkbox
                if($fvalue['d_type']==10):
            ?>
            <?  endif;
              endforeach;
            ?>
          	
          </table>
        </div>
        <div class="clear"></div>
        <div class="mt-10 contentin-button-sit ">
          <input type="hidden" name="d_id" value="<?=$_POST['d_id']?>">
          <input type="hidden" name="dbname" value="<?=$FileName?>">
          <input type="submit" value="<?php echo $submit;?>" class="contentin-button" >
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>

CKEDITOR.replace( 'content', {
  filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?Type=Images',
  width : 530,
  height: 300,
  resize_enabled:false,
  enterMode: 2,
  forcePasteAsPlainText :true,
  allowedContent:true,
  toolbar :
  [
    ['Source'],
    ['Cut','Copy','Paste','PasteText','PasteFromWord', 'Table', 'HorizontalRule', 'NumberedList','BulletedList', '-', 'Link','Unlink', '-', 'Image'],
    ['Bold','Italic','Underline','Strike', 'TextColor', 'BGColor', '-', 'Font','FontSize', '-', 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Iframe'],
  ],
  
});
var opt={
      dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
      dayNamesMin:["日","一","二","三","四","五","六"],
      monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
      monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
      prevText:"上月",
      nextText:"次月",
      weekHeader:"週",
      showMonthAfterYear:true,
      dateFormat:"yy-mm-dd",
      changeMonth: true,
      changeYear: true,
      yearRange: "c-80:c+0",
    };
$("#d_reser_time").datepicker(opt);
</script>