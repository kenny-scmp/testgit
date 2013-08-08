<!-- index //-->
<?php
/**
 * @var $this View
 */
?>
<?=$this->Html->link('Add User', array('action'=>'add'))?>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Attachment</th>
        <th>Action</th>
        <th>Created</th>
    </tr>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td><?php echo $user['User']['id']; ?></td>
            <td>
                <?php echo $this->Html->link($user['User']['username'], array('controller'=>'users','action' => 'view', $user['User']['id'])); ?>
            </td>
            <td>
                <?php echo $this->Html->link($user['Attachment']['name'], array('controller'=>'attachments','action' => 'download', $user['User']['attachment_id'])); ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink ( 'Delete', array (
                    'action' => 'delete',
                    $user['User']['id']
                ), array (
                    'confirm' => 'Are you sure?'
                ) );
                ?>
                <?php echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id'])); ?>
            </td>
            <td>
                <?php echo $this->Time->timeAgoInWords($user['User']['created']); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>

<?php echo $this->element('paginate'); ?>
