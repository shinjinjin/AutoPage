</head>
<body>
<section id="main" class="column" style="height: 965px;">
	<article class="module width_full">
        <header><h3 class="tabs_involved">回覆留言</h3>
            <ul class="tabs">
				<li class="active">
					<a href="/admin_sys/message/message_lists">返回列表</a>
				</li>
			</ul>
		</header>
        <div class="module_content">
			<?= validation_errors(); ?>
            <?= form_open($form) ?>
                <fieldset style="width:48%; float:left; margin-right: 3%;">
                    <label>留言標題</label>
                    <input type="text" name="message_title" id="message_title" value="<?=$data['message_title'];?>" disabled />
                </fieldset>
                
                <fieldset style="width:48%; float:left;">
                    <label>顯示</label>
                    <select name="is_display" id="is_display">
                        <option value="0" <?=(0==$data['is_display'])?'selected':'';?> >顯示</option>
                        <option value="1" <?=(1==$data['is_display'])?'selected':'';?> >不顯示</option>
                    </select>
                </fieldset>
                <fieldset style="width:48%; float:left; margin-right: 3%;">
                    <label>文章內容</label>
                    <?=$data['content'];?>
                </fieldset>
                <fieldset style="width:48%; float:left;"> 
                    <label>新增時間</label>
                    <?=$data['addtime'];?>
                </fieldset>
                
                <fieldset style="width:48%; float:left; margin-right: 3%;">
                    <label>回覆內容</label>
                    <input type="text" name="reply" id="reply" value="<?=$data['reply'];?>" />
                </fieldset>

                 <fieldset style="width:48%; float:left;">
                    <label>回覆時間</label>
                    <?=$data['replytime'];?>
                </fieldset>
                <fieldset style="width:48%; float:left; margin-right: 3%;">
                <input type="hidden" name="parent_id" id="parent_id" value="<?=$data['parent_id'];?>"/>   
                <input type="hidden" name="id" id="id" value="<?=$data['message_id'];?>"/>   
                <input type="submit"  class="alt_btn" value="<?=$submit?>"/>
                </fieldset>    
			</form>
		</div>
	</article>
</section>

