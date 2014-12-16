<!-- File: /app/View/Posts/index.ctp -->
<?php
if(!isset($_SESSION)) session_start();

$token = sha1(uniqid(mt_rand(), true));
// ワンタイムトークンをセッションに追加する
$_SESSION['token'][] = $token;
?>
<script>
$(function() {
	// ありがとうを送るひとの選択
	$('.mainImage').live('click', function(e) {
		var $target = $(e.target);
		$('#toUserImg').css('visibility', '');
		$('#toUserImg').attr('src', $target.attr('src'));
		$('#toUserImg').attr('alt', $target.attr('alt'));
		$('#toUserContainer').append($(this).parent().parent());
		$('#hiddenTarget').empty().append($target.parent('a').nextAll("input").clone());
		return false;
	});
	// ありがとうの種類の選択
	$('.imgThanksKind').live('click', function(e) {
		$('#thanksKind').find('td').each(function(i,v) {
			$(v).css('border', 'none');
		});
		$(e.target).parent("td").css('border', 'solid 1px red');
		$("input[name='kinds']").val($(e.target).attr('data-kind'));
	});
	// 入力チェック
	$('#frmInput').submit(function(){
		var message = "";
		if ("" == $('#hiddenTarget').html()) {
			message += "ありがとうを送るひとを選択してください。\r";
		}
		if ("" == $("input[name='kinds']").val()) {
			message += "ありがとうの種類を選択してください。\r";
		}
		if ("" != message) {
			alert(message)
			return false;
		}
	});
});
</script>
<style>
	.selectTargetContainer {
		clear: none; width: 100%; float: right;
	}
	.selectTargetContainer .headerLabel {
		clear: none; width: 100%; padding: 10px;
	}
	.selectTargetContainer .targetIcon {
		float: left; padding: 20px;
	}
	.profImg {
		width: 50px; height: 50px;
	}
	.imgFromTo {
		padding: 10px; width: 50px; height: 50px;
	}
	.imgThanksKind {
		padding-right: 10px;
	}
	
</style>
<div class="selectTargetContainer">
	<div class="headerLabel">
		「ありがとう」を伝えたい相手を選択してください。
	</div>
	<div>
	<?php foreach ($friends['data'] as $friend): ?>
		<div class="targetIcon">
			<a href="#" disabled="" title="<?php echo $friend['name'];?>">
				<image class="mainImage" type="image" id="main_id" src="https://graph.facebook.com/<?php echo $friend['id'];?>/picture" value="<?php echo $friend['id'];?>" alt="<?php echo $friend['name'];?>" title="<?php echo $friend['name'];?>">
			</a>
			<input name="to_id" type="hidden" value="<?php echo $friend['id'];?>"/>
			<input name="to_name" type="hidden" value="<?php echo $friend['name'];?>"/>
			<input name="from_id" type="hidden"  value="<?php echo $me['id'];?>"/>
			<input name="from_name" type="hidden"  value="<?php echo $me['name'];?>"/>
		</div>
	<?php endforeach; ?>
	</div>
</div>
<div align="center">
	<image class="imgFromTo" src="https://graph.facebook.com/<?php echo $me['id']; ?>/picture">
	<image src="/cakephp/app/webroot/img/yaji.gif">
	<image class="imgFromTo" id="toUserImg" style="visibility: hidden;">
</div>
<form id="frmInput" name="frmInput" method="post" action="register">
	<div id="hiddenTarget"></div>
	<div style="clear: none; padding: 30px;">
		<!-- ありがとうを伝える友達を選択するドラッグアンドドロップの部品を埋め込むエリア -->
		<div id="toUserContainer" style="display: none"></div>
	</div>
	<div style="float: left; width: 45%;">
		<label for="kinds">どんな「ありがとう」？</label>
		<input type="hidden" name="kinds" value="">
		<table id="thanksKind" style="border: none; width: 80%">
			<tr>
				<td>
					<img data-kind="1" class="imgThanksKind" src="/cakephp/app/webroot/img/b01.png">
					優しさ
				</td>
				<td>
					<img data-kind="2" class="imgThanksKind" src="/cakephp/app/webroot/img/b02.png">
					力
				</td>
			</tr>
			<tr>
				<td>
					<img data-kind="3" class="imgThanksKind" src="/cakephp/app/webroot/img/b03.png">
					プレゼント
				</td>
				<td>
					<img data-kind="4" class="imgThanksKind" src="/cakephp/app/webroot/img/b04.png">
					知恵
				</td>
			</tr>
		</table>
	</div>
	<div style="float: left; width: 45%;">
		<label for="message">メッセージをお書きください。</label>
		<div>
			<textarea name="comment" id="comment" style="width: 80%;"></textarea>
		</div>
		<div>
			<input type="submit" value="ありがとうを送る">
			<input type="hidden" name="token" value="<?php echo h($token)?>">
		</div>
	</div>
</form>



