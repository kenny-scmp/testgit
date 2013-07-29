<!-- add //-->
<?php
/**
 * @var $this View
 */
?>
<?php echo $this->Form->create('User', array('novalidate','type'=>'file', 'autocomplete'=>'off')); ?>
<fieldset>
    <legend><?php echo __('Add User'); ?></legend>
    <?php
    echo $this->Form->input('username', array('minlength'=>'2','data-msg-minlength'=>'test - min length:2'));
    echo $this->Form->input('password');
    echo $this->Form->file('attachment');
    ?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<?=$this->Html->link('back',array('action'=>'index'))?>

<script>
    $(function() {
        $("#UserAddForm").validate();
    });
</script>