</head>
<body>
<section id="main" class="column" >
    <article class="module width_full">
        <header>
        	<h3 class="tabs_involved">留言板列表</h3>
        </header>
        <table class="tablesorter" cellspacing="0">
            <thead>
              <tr>
                <td class="header">留言標題</td>
                <!--<td class="header">類別名稱</td>-->
                <td class="header">新增時間</td>
                <td class="header">回覆時間</td>
                <td class="header">顯示</td>
                <td class="header">操作</td>
              </tr>
            </thead>
            <tbody> 
                <? if(count($data)!=0){?> 
                    <?foreach ($data as $item): ?>  
                      <tr>
                        <td><?=$item['message_title'] ?></td>
                        <!--<td><?=$item['type_id'] ?></td>-->
                        <td><?=$item['addtime'] ?></td>
                        <td><?=$item['replytime'] ?></td>
                        <td><?=($item['is_display']==0)?'顯示':'不顯示'; ?></td>
                        <td>
                            <input type="image" src="/images/admin/icn_edit.png" title="回覆" onClick="javascript:location = '/admin_sys/message/message_info/<?=$item['message_id'] ?>'">
							<input type="image" src="/images/admin/icn_trash.png" title="刪除" onClick="javascript:return confirmY('<?=$item['message_title'] ?>','/admin_sys/message/message_remove/<?=$item['message_id'] ?>');">
                        </td>
                      </tr>
                    <?endforeach ?>  
                <? }else{?>
                    <tr><td colspan="4">留言板列表沒有資料</td></tr>
                <? }?>
            </tbody> 
        </table>
		<?=$page?>
    </article>
</section>


