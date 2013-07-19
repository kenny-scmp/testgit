<!-- add //-->
<?php
/**
 * @var $this View
 */
?>
<?php echo $this->Form->create('User', array('novalidate','type'=>'file')); ?>
<fieldset>
    <legend><?php echo __('Add User'); ?></legend>
    <?php
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Form->file('attachment');
    ?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<?=$this->Html->link('back',array('action'=>'index'))?>