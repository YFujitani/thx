<div id="fb-root"></div>
<script>
// register.ctpのFB.initと干渉するようなのでコメントアウト
// 
//	( function(d, s, id) {
//			var js, fjs = d.getElementsByTagName(s)[0];
//			if (d.getElementById(id))
//				return;
//			js = d.createElement(s);
//			js.id = id;
//			js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=273271196033866";
//			fjs.parentNode.insertBefore(js, fjs);
//		}(document, 'script', 'facebook-jssdk')); 
</script>

<div class="gridContainer clearfix">
	<div id="LayoutDiv5">
		<image style="height: 50px; width: 50px;" src="https://graph.facebook.com/<?php echo $me['id']; ?>/picture">
		<div class="name">
			<?php echo $me['first_name']; ?>'s HEART
		</div>
	</div>

	<div id="LayoutDiv1">
		<div class="logo">
			<a href="/cakephp/thanks">
				<img src="/cakephp/app/webroot/img/logo.gif">
			</a>
		</div>
		<!-- いったんコメントアウト
		<div class="like">
			<div class="fb-like" data-href="https://www.facebook.com/" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true" data-font="lucida grande"></div>
		</div>
		-->
	</div>
	<div id="LayoutDiv2">
		<div class="heart">
			<!-- スマフォやタブレット端末用にdefault.ctpのJSでリサイズ -->
			<img class="heart_fm" src="/cakephp/app/webroot/img/heart_parts/00_flame.png">
			<img class="heart_aw" src="/cakephp/app/webroot/img/heart_parts/00_allwhite.png">
			<?php $cnt = 0; ?>
			<?php foreach ($heartParts as $part): ?>
				<img class="heart_part_<?php echo $cnt + 1 ;?>" src="<?php echo $part; ?>">
				<?php ++$cnt; ?>
			<?php endforeach; ?>
		</div>
	</div>
