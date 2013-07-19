<!-- view //-->
<?php
/**
 * @var $this View
 */
?>
<p>Username: <?= $user['User']['username']?></p>

<p><small>Created: <?php echo $user['User']['created']; ?></small></p>

<p><?php echo $this->Html->link($user['Attachment']['name'], array('controller'=>'attachments','action' => 'download', $user['User']['attachment_id'])); ?></p>

<?=$this->Html->link('back',array('action'=>'index'))?>