<!-- add //-->
<?php
/**
 * @var $this View
 */
?>
<?= $this->Form->create('SpecialExec', array('action' => 'add')); ?>

<!-- Modal -->
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Special Execution</h4>
        </div>
        <div class="modal-body">
            <?=$this->Form->input('name', array(
                'label'=>false,
                'type' => 'text',
                'div' => 'form-group',
                'class' => 'form-control',
                'placeholder' => 'Name'
            ));
            ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>

<?= $this->Form->end(); ?>

