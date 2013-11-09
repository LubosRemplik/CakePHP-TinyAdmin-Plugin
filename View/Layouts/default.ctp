<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo sprintf('%s | TinyAdmin', $title_for_layout); ?></title>
	<?php
	echo $this->Html->meta('icon');

	echo $this->Html->css('/twbs/bootstrap/dist/css/bootstrap-theme.min.css');
	echo $this->Html->css('/twbs/bootstrap/dist/css/bootstrap.min.css');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
</head>
<body>
	<div class="container">
		<div id="header" class="row">
			<div class="col-md-9 col-md-offset-3">
				<h1><?php echo $title_for_layout; ?></h1>
			</div>
		</div>
		<div id="content" class="row">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
<?php 
echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
echo $this->Html->script('/twbs/bootstrap/dist/js/bootstrap.min.js');
echo $this->fetch('script'); 
?>
</body>
</html>
