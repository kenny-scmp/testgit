<!-- edit //-->
<?php
/**
 * @var $this View
 */
?>
<?php echo $this->Form->create('User', array('novalidate','type'=>'file')); ?>
<fieldset>
    <legend><?php echo __('Edit User'); ?></legend>
    <?php
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->input('attachment_id', array('type' => 'hidden'));
    echo $this->Html->link($this->request->data['Attachment']['name'], array('controller'=>'attachments','action' => 'download', $this->request->data['User']['attachment_id']));
    echo $this->Form->file('attachment');
    ?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<?=$this->Html->link('back',array('action'=>'index'))?>