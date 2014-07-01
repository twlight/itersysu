<?php $this->beginContent('/layouts/main'); ?>
<div class="container">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php
	//Yii::app()->clientScript->registerScript('js','
	//',CClientScript::POS_LOAD);
?>

<?php $this->endContent(); ?>
