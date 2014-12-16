<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php echo $this->Html->charset(); ?>
	<title>ARIGATO! -ありがとうを伝えよう-</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<link href="/cakephp/app/webroot/js">
	<link href="/cakephp/app/webroot/css/boilerplate.css" rel="stylesheet" type="text/css">
	<link href="/cakephp/app/webroot/css/common.css" rel="stylesheet" type="text/css">
	<link href="/cakephp/app/webroot/css/design.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Quicksand:300,400' rel='stylesheet' type='text/css'>
	<script src="/cakephp/app/webroot/js/jquery-1.7.2.min.js"></script>
	<script src="/cakephp/app/webroot/js/design.js"></script>
	<script src="/cakephp/app/webroot/js/respond.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
$(function() {
	var nav = $('.alpha');
	nav.hover(
		function(){
			$(this).fadeTo("fast",0.5);
		},
		function () {
			$(this).fadeTo("fast",1);
		}
	);
	if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf('iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {
		var resize = "33%"
		$(".heart_fm").css("width", resize).css("height", resize);
		$(".heart_aw").css("width", resize).css("height", resize);
		for (var i = 1; i <= 15; i++) {
			$(".heart_part_"+i).css("width", resize).css("height", resize);
		}
	}
	
});
</script>
	
</head>
<body>
<?php echo $this->element('header'); ?>
<!-- TODO 開発用につきハート部分は一旦コメントアウト -->
	<div id="container">
		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	<!div>
<?php echo $this->element('footer'); ?>
<!--	
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
-->
</body>
</html>
