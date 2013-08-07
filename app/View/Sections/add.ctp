<?php echo $this->Form->create('Section'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Section</h4>
        </div>
        <div class="modal-body">
            <?=$this->Form->input('product_code', array(
                'label'=>false,
                'type' => 'text',
                'div' => 'form-group',
                'class' => 'form-control',
                'placeholder' => 'Product Code'
            ));
            ?>

            <?=$this->Form->input('name', array(
                'label'=>false,
                'type' => 'text',
                'div' => 'form-group',
                'class' => 'form-control',
                'placeholder' => 'Name'
            ));
            ?>

            <div class="btn-group" data-toggle="buttons">
                <?php foreach(Configure::read('Common.weekday') as $i=>$weekday): ?>
                    <label class="btn btn-primary">
                        <input type="checkbox" value="<?=$i?>" name="data[Section][weekday][]"><?=$weekday?>
                    </label>
                <?php endforeach ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>
<?php echo $this->Form->end(); ?>