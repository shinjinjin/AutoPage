<!--左選單-->
<div class="left-block">
    <div class="left-block-title" style="">
        <?=$user_name?>
    </div>
    <div class="left-menu">
        <ul class="menu">
        <? if(!empty($menu)):foreach($menu as $key =>$val):?>
            <li ><a href="#2" class="meun1"><?=$key?></a>
            <ul class="submenu" >
            <? if(!empty($val)):foreach($val as $key1 =>$val1):?>
                <li><a href="javascript:void(0)" id="menu_list" menuval="<?=$val1['d_dbname']?>" menuid="<?=$val1['d_id']?>" menuhead="<?=$val1['d_head']?>"><?=$val1['d_name']?></a></li> 
            <? endforeach;endif;?>
            </ul>
 	    <?endforeach;endif;?>
        </ul>
    </div>
</div>
