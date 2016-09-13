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
                $Star=($fvalue['d_must']=='Y')?'<span style="color:RED;">*</span>':'';

                //Input Text
                if($fvalue['d_type']==1):
            ?>
                <tr>
                  <th><?=$Star.$fvalue['d_title']?></th>
                  <td>
                    <input type="text" name="<?=$fvalue['d_fname']?>" value="<?php echo $dbdata[$fvalue['d_fname']]?>" id="<?=$fvalue['d_fname']?>"  class="contentin-table-tdtextfield"  >
                  </td>
                </tr>
            <?
                endif;
                //Input Radio
                if($fvalue['d_type']==2):
            ?>
                <tr>
                  <th><?=$Star.$fvalue['d_title']?></th>
                  <td>
                    <? $num=0;
                    foreach ($fvalue['d_val'] as $key => $value):?>
                      <input value=<?=$key?> name="<?=$fvalue['d_fname']?>" id="<?=$fvalue['d_fname']?>" <?php $ch=($dbdata[$fvalue['d_fname']]==$key)?'checked':'';$ch=($num==0)?'checked':''; echo $ch;?> type="radio"><?=$value?>
                    <? $num++;endforeach;?>
                  </td>
                </tr>
            <?
                endif;
                //Input checkbox
                if($fvalue['d_type']==3):
            ?>
                <tr>
                  <th><?=$Star.$fvalue['d_title']?></th>
                  <td>
                    <? foreach ($fvalue['d_val'] as $key => $value):?>
                        <input value=<?=$key?> name="<?=$fvalue['d_fname']?>[]" id="<?=$fvalue['d_fname'].$key?>" <?php echo preg_match("/".$key."/i",$dbdata[$fvalue['d_fname']])?'checked':'';?> type="checkbox"><label for="<?=$fvalue['d_fname'].$key?>"><?=$value?></label>
                    <? endforeach;?>
                    
                  </td>
                </tr>
            <?
                endif;
                //Input select
                if($fvalue['d_type']==4):
            ?>
                <tr>
                  <th><?=$Star.$fvalue['d_title']?></th>
                  <td>
                    <select name="<?=$fvalue['d_fname']?>" id="<?=$fvalue['d_fname']?>">
                    <? foreach ($fvalue['d_val'] as $key => $value):?>
                      <option value=<?=$key?> <?php echo ($dbdata[$fvalue['d_fname']]==$key)?'selected':'';?>><?=$value?></option>
                    <? endforeach;?>
                    </select>
                  </td>
                </tr>
            <?
                endif;
                //Input textarea
                if($fvalue['d_type']==5):
            ?>
                <tr>
                  <th><?=$Star.$fvalue['d_title']?></th>
                  <td>
                    <textarea name="<?=$fvalue['d_fname']?>" id="<?=$fvalue['d_fname']?>"  class="contentin-table-textarea"><?php echo $dbdata[$fvalue['d_fname']]?></textarea>
                  </td>
                </tr>
            <?
                endif;
                //Input ckediter
                if($fvalue['d_type']==6):
            ?>
                <tr>
                  <th><?=$Star.$fvalue['d_title']?></th>
                  <td>
                    <textarea name="<?=$fvalue['d_fname']?>" id="<?=$fvalue['d_fname']?>"  class="contentin-table-textarea"><?php echo $dbdata[$fvalue['d_fname']]?></textarea>
                  </td>
                </tr>
            <?
                endif;
                //Input view
                if($fvalue['d_type']==7):
            ?>  
                <tr>
                  <th><?=$fvalue['d_title']?></th>
                  <td>
                    <img src="/<?php echo $dbdata[$fvalue['d_fname']]?>" width="10%" >
                  </td>
                </tr>
            <?
                endif;
                //Input file
                if($fvalue['d_type']==8):
            ?>
                <tr>
                  <th><?=$fvalue['d_title']?></th>
                  <td>
                    <input type="file"   name="<?=$fvalue['d_fname']?>" id="<?=$fvalue['d_fname']?>"/>
                    <input type="hidden" name="<?=$fvalue['d_fname'].'_ImgHidden'?>" value="<?php echo $dbdata[$fvalue['d_fname']]?>"/>
                  </td>
                </tr>
            <?
                endif;
                //Input hidden
                if($fvalue['d_type']==9):
            ?>
                <input type="hidden" name="<?=$fvalue['d_fname']?>" value="<?php echo $dbdata[$fvalue['d_fname']]?>">
            <?
                endif;
                //Input date
                if($fvalue['d_type']==10):
            ?>
                <tr>
                  <th><?=$fvalue['d_title']?></th>
                  <td>
                    <input type="text" name="<?=$fvalue['d_fname']?>" id="<?=$fvalue['d_fname']?>" value="<?php echo $dbdata[$fvalue['d_fname']]?>">
                  </td>
                </tr>
              
            <?  endif;
                //time
                if($fvalue['d_type']==11):
            ?>
                <tr>
                  <th><?=$fvalue['d_title']?></th>
                  <td>
                    <input type="text" name="<?=$fvalue['d_fname']?>" id="<?=$fvalue['d_fname']?>" value="<?php echo $dbdata[$fvalue['d_fname']]?>">
                  </td>
                </tr>
            <?  endif;
                if($fvalue['d_type']==12):
            ?>
                <tr>
                  <th><?=$fvalue['d_title']?></th>
                  <td>
                    <input type="text" name="<?=$fvalue['d_fname']?>" id="<?=$fvalue['d_fname']?>" value="<?php echo $dbdata[$fvalue['d_fname']]?>">
                  </td>
                </tr>
            <?  endif;
                //address
                if($fvalue['d_type']==13):
            ?>
                <tr>
                  <th><?=$fvalue['d_title']?></th>
                  <td>
                  <select name="<?=$fvalue['d_fname'][0]?>" rel="<?=$fvalue['d_fname'][0]?>" onchange="SelectCity(this,'<?=$fvalue['d_fname'][1]?>')">
                  <option value="0">請選擇</option>
                  <? foreach ($fvalue['CityConfig'] as $key => $value):?>
                    <option value="<?=$value['d_id']?>" <?=($dbdata[$fvalue['d_fname'][0]]==$value['d_id'])?'selected':'';?>><?=$value['d_name']?></option>
                  <? endforeach;?>
                </select>
                <select name="<?=$fvalue['d_fname'][1]?>" id="<?=$fvalue['d_fname'][1]?>"></select>
                <input type="text" name="<?=$fvalue['d_fname'][2]?>"  value="<?php echo $dbdata[$fvalue['d_fname'][2]]?>" class="contentin-table-tdtextfield">
                  </td>
                </tr>
            <?endif;endforeach;?>
          	<tr>
              <th>狀態</th>
              <td>
                <input <?=(empty($dbdata['d_enable']))?'checked':'';echo ($dbdata['d_enable']=='Y')?'checked':'';?> name="d_enable" value="Y" type="radio">啟動
                <input <?=($dbdata['d_enable']=='N')?'checked':'';?>name="d_enable" value="N" type="radio">關閉
              </td>
            </tr>
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
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="/js/myjava/ckeditor.js"></script>

<script type="text/javascript" src="/js/datepicker/jquery.datetimepicker.full.js"></script>   
<link type="text/css" rel="stylesheet" href="/js/datepicker/jquery.datetimepicker.css">
<script src="/js/datepicker/usedate.js"></script>
<script src="/js/myjava/citycategory.js"></script>

<script>
<? foreach ($fdata as $fkey => $fvalue):
    //ckediter
  if($fvalue['d_type']==6):
?>     
  CKEDITOR.replace(<?=$fvalue['d_fname']?>,config);
<? elseif($fvalue['d_type']==10):?>
  $("#<?=$fvalue['d_fname']?>").datetimepicker(DateOnly);
<? elseif($fvalue['d_type']==11):?>
  $("#<?=$fvalue['d_fname']?>").datetimepicker(Time);
<? elseif($fvalue['d_type']==12):?>
  $("#<?=$fvalue['d_fname']?>").datetimepicker();
<? elseif($fvalue['d_type']==13 and !empty($dbdata[$fvalue['d_fname'][0]])):?>
  DefaultCity(<?=$dbdata[$fvalue['d_fname'][0]]?>,<?=$dbdata[$fvalue['d_fname'][1]]?>,"<?=$fvalue['d_fname'][1]?>");
<? endif;
endforeach;?>
</script>