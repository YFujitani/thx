<!-- File: /app/View/Posts/index.ctp -->
<?php if ($friends):?>
<div id="LayoutDiv3">

	<div class="mn">
		<img src="/cakephp/app/webroot/img/thankshistory.gif">
	</div>
	<div class="waku" style="overflow: scroll;">
	<!--列ここから-->
	<?php $count = 0; ?>
	<?php foreach ($thanks as $thank): ?>
		<?php $odd = (++$count % 2 == 1) ? true : false; ?>
		<div class="<?php echo $odd ? "hstodd" : "hsteven" ?>">
			<div class="time">
				<img src="/cakephp/app/webroot/img/clock.gif"><?php echo $thank['Thank']['created_date']; ?>
			</div>
			<div class="datas">
				<!-- もらったポイント、あげたポイントで表示切り替えの実装  -->
				<?php if ($fb == $thank['Thank']['from_id']):?>
					<?php /* もらったポイント */ ?>
					<a href="/cakephp/thanks/other?id=<?php echo $thank['Thank']['from_id'];?>">
						<img style="height: 50px; width: 50px;" src="https://graph.facebook.com/<?php echo $thank['Thank']['from_id'];?>/picture">
					</a>
					<img src="/cakephp/app/webroot/img/yaji.gif">
					<img src="/cakephp/app/webroot/img/b0<?php echo $thank['Thank']['kinds']; ?>.png">
				<?php elseif ($fb == $thank['Thank']['to_id']):?>
					<?php /* あげたポイント */ ?>
					<img src="/cakephp/app/webroot/img/b0<?php echo $thank['Thank']['kinds']; ?>.png">
					<img src="/cakephp/app/webroot/img/yaji.gif">
					<a href="/cakephp/thanks/other?id=<?php echo $thank['Thank']['to_id'];?>">
						<img style="height: 50px; width: 50px;" src="https://graph.facebook.com/<?php echo $thank['Thank']['to_id'];?>/picture">
					</a>
				<?php endif ?>
				<!--<img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash2/372091_1375165905_2052108563_q.jpg">-->
			</div>
		</div>
		<?php echo $odd ? "" : '<div style="clear:both"></div>' ?>
	<?php endforeach; ?>
	<!--列ここまで-->
	</div>
</div>

<div id="LayoutDiv4">
	<div class="mn">
		<img src="/cakephp/app/webroot/img/powerofheart.gif">
	</div>
	<div class="waku2">
		<div class="power">
			<img src="/cakephp/app/webroot/img/t01.gif"> <?php echo $thanksByKind[1]; ?>
			<img src="/cakephp/app/webroot/img/t02.gif"> <?php echo $thanksByKind[2]; ?>
			<img src="/cakephp/app/webroot/img/t03.gif"> <?php echo $thanksByKind[3]; ?>
			<img src="/cakephp/app/webroot/img/t04.gif"> <?php echo $thanksByKind[4]; ?>
			<img src="/cakephp/app/webroot/img/t05.gif"> <?php if (array_key_exists(0, $thanksPoint[0]))  echo $thanksPoint[0][0]['thanksPoint'] ?>
		</div>
	</div>
	<div class="thxbtn">
		<a href="/cakephp/thanks/say">
			<img src="/cakephp/app/webroot/img/thanksbtn.gif" class="alpha" style="opacity: 1;">
		</a>
	</div>
</div>
<!-- Say Sthanks リンク -->
<?php else: ?>
<a href="<?php echo $url;?>" target="_top">ログイン</a>
<?php endif ?>
