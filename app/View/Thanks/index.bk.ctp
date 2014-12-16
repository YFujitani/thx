<!-- File: /app/View/Posts/index.ctp -->
<?php if ($friends):?>
<h1>All Thanks Record Test</h1>
<table>
    <tr>
        <th>Id</th>
        <th>FROM</th>
        <th></th>
        <th>TO</th>        
        <th>種類</th>        
        <th>コメント</th>        
        <th>作成日</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($thanks as $thank): ?>
    <tr>
        <td><?php echo $thank['Thank']['id']; ?></td>
        <td>
        	<image style="height: 50px; width: 50px;" src="https://graph.facebook.com/<?php echo $thank['Thank']['from_id'];?>/picture">
        	<br>
        	<?php echo $thank['Thank']['from_name']; ?>
        </td>
        <td> -> </td>
        <td>
        	<image style="height: 50px; width: 50px;" src="https://graph.facebook.com/<?php echo $thank['Thank']['to_id'];?>/picture">
        	<br>
        	<?php echo $thank['Thank']['to_name']; ?>
        </td>
        <td><?php echo $thank['Thank']['kinds']; ?></td>
        <td><?php echo $thank['Thank']['comment']; ?></td>
        <td><?php echo $thank['Thank']['created_date']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>

<!-- Power of Heart部分 -->
<div>
</div>

<!-- Say Sthanks リンク -->
<div>
    →<a href="./say">SAY "THANKS"!</a>
</div>
<?php else: ?>
<a href="<?php echo $url;?>" target="_top">ログイン</a>
<?php endif ?>
