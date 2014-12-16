<?php
	$thanksKind = "";
	switch ($result['kinds']) {
		case 1:
			$thanksKind = "優しさ";
			break;
		case 2:
			$thanksKind = "力";
			break;
		case 3:
			$thanksKind = "プレゼント";
			break;
		case 4:
			$thanksKind = "知恵";
			break;
		default:
			break;
	}
?>
<div id='fb-root'></div>
<div id="resultContainer">
	<div style="text-align: center; padding: 10px; font-size: 120%;">
		<?php echo $result['to_name']; ?>にありがとう【<?php echo $thanksKind ?>】を伝えました！
	</div>
	<div style="text-align: center">
		<img src="/cakephp/app/webroot/img/b0<?php echo $result['kinds']; ?>.png">
		<img src="/cakephp/app/webroot/img/yaji.gif">
		<a href="/cakephp/thanks/other?id=<?php echo $result['to_id']; ?>"> <img style="height: 50px; width: 50px;" src="https://graph.facebook.com/<?php echo $result['to_id']; ?>/picture"> </a>
	</div>
	<div style="text-align: center">
		<p><?php echo $result['comment']; ?></p>
	</div>
</div>
<script src='http://connect.facebook.net/en_US/all.js'></script>
<div style="text-align: center;">
	<p><a onclick='postToFeed(); return false;'>相手のフィードに投稿する</a></p>
</div>
<div style="text-align: center;">
	<p><?php echo $result['to_name']; ?>さんのこころがあなたの「<?php echo $thanksKind ?>」で彩られました。</p>
	<p><?php echo $result['to_name']; ?>さんの「<?php echo $thanksKind ?>」が<?php echo $toUserPoint[$result['kinds']-1][0]['count']; ?>ポイントアップしました。</p>
</div>
<div style="text-align: center;">
	<div style="width:50%; float: left; text-align: center;">
	    <span>あなたの感謝ゲージ</span>
	    <?php for ($i = 0; $i < 3; $i++) { 
	    	if ($i < 3 - $nextThanksPoint) {
	    		print '<img width="30" height="30" src="/cakephp/app/webroot/img/heart_filled.png">';
	    	} else {
	    		print '<img width="30" height="30" src="/cakephp/app/webroot/img/heart_empty.png">';
	    	}
	    }
	    ?>
	</div>
	<div style="width:50%; float: left; text-align: center;">
		<?php if (3 == $nextThanksPoint):?>
		<div style="background-color: rgb(250, 230, 233);">感謝バッジGET!<br>あなたの心も彩られました！<div>
		<?php else: ?>
		感謝バッジがもらえるまであと<?php echo $nextThanksPoint ?>回
		<?php endif ?>
	</div>
</div>
<div style="text-align: center;">
	<a href="/cakephp/thanks/other?id=<?php echo $result['to_id']; ?>">相手のページヘ</a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="/cakephp/thanks">マイページへ</a>
</div>
<p id='msg'></p>

<script>

FB.init({appId: "", status: true, cookie: true, xfbml:true});

function postToFeed() {

	// calling the API ...
	var obj = {
		method: 'feed',
		from: <?php echo $result['from_id']; ?>,
		to: <?php echo $result['to_id']; ?>,
		//redirect_uri: 'http://thx.chu.jp/cakephp/thanks',
		link: 'http://developers.facebook.com/docs/reference/dialogs/',
		picture: '<?php echo 'http://thx.chu.jp/cakephp/app/webroot/img/b0'.$result['kinds'].'.png'; ?>',
		name: 'Facebook Dialogs',
		caption: 'Reference Documentation',
		description: '<?php echo $result['comment']; ?>'
	};

	function callback(response) {
		// document.getElementById('msg').innerHTML = "フィードへの投稿を完了しました。TOP画面に移動します。";
		// setTimeout(function(){
			// location.href = "../thanks/";
		// }, 3000)
	}

	FB.ui(obj, callback);
}

</script>
</div>
