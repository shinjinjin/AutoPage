<ul>
	<?php if($CurrectPage>1):?>
	<li><a href = "javascript:void(0);" id="FirstPage">&lt;&lt; 第一頁</a></li>
	<li><a href="javascript:void(0);" id="PrevPage">&lt;上一頁</a></li>
	<?php endif;?>
	<li><select style="visibility:visible;" name="ToNowPage" id="ToNowPage">
	<?php if($TotalPage==0):?>
		<option value="1">1</option>
	<?php else:?>
		<?php for($i=1;$i<=$TotalPage;$i++):?>
		<option value="<?php echo $i;?>" <?php if(($CurrectPage)==$i):?>selected<?php endif;?>><?php echo $i;?></option>
	    <?php endfor;?>
	<?php endif;?>
	</select></li>
	<?php if($CurrectPage<$TotalPage):?>
	<li><a href="javascript:void(0);" id="NextPage">下一頁 &gt;</a></li>
	<li><a href="javascript:void(0);" id="LastPage" rel="<?php echo $TotalPage;?>">最後一頁 &gt;&gt;</a></li>
	<?php endif;?>
	<li><?php echo $PageView; ?></li>
</ul>
                                                                                                                        