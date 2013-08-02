<div class="sections form">
<?php echo $this->Form->create('Section'); ?>
	<fieldset>
		<legend><?php echo __('Add Section'); ?></legend>
	<?php
		echo $this->Form->input('product_code');
		echo $this->Form->input('name');
		echo $this->Form->input('weekday', array('label'=>'Weekday: (comma separate - e.g: 1,2,3,4,5,6,7)'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
