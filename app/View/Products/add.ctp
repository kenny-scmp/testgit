<!-- add //-->
<?php
/**
 * @var $this View
 */
?>

<?= $this->Form->create('Product',array('action'=>'add')); ?>

<!-- Modal -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Product</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->Form->input('code', array(
                            'div' => 'form-group',
                            'class' => 'form-control'
                        )); ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $this->Form->input('name', array(
                            'div' => 'form-group',
                            'class' => 'form-control'
                        )); ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->Form->input('type', array(
                            'div' => 'form-group',
                            'class' => 'form-control',
                            'options' => Configure::read('Product.type')
                        ));?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <label>Weekday(optional)</label><br>
                        <div class="btn-group" data-toggle="buttons">
                            <?php foreach(Configure::read('Common.weekday') as $i=>$weekday): ?>
                                    <label class="btn btn-primary btn-small">
                                        <input type="checkbox" value="<?=$i?>" name="data[Product][weekday][]"><?=$weekday?>
                                    </label>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-lg-12">
                        <table id="specialexecs" class="col-lg-12">
                            <tr style='display:none' id='rowtpl'>
                                <td>
                                    <div class="form-inline">
                                        <div class="col-lg-1 form-group">
                                            <button type="button" class="close" onclick="$(this).closest('tr').remove();return false;">&times;</button>
                                        </div>
                                        <div class="col-lg-5 form-group">
                                            <select class="form-control">
                                                <option value="">- special execution -</option>
                                                <?php foreach($specialExecs as $specialExec): ?>
                                                    <option value="<?=$specialExec['SpecialExec']['id']?>"><?=$specialExec['SpecialExec']['name']?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <input type="text" class="form-inline form-control" placeholder="Remark"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <button type="button" class="btn btn-link pull-right" onclick="return addSpecialExec(this)">[+ add more]</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

<?= $this->Form->end(); ?>

<script>
    $(function() {
        addSpecialExec();
    });
    function addSpecialExec(a) {
        var $newRow = $('#rowtpl').clone().show();
        var count = $('#specialexecs tr').length;
        $newRow.removeAttr('id');
        $('select', $newRow).attr('name','data[ProductSpecialExec]['+(count-1)+'][special_exec_id]');
        $('input', $newRow).attr('name','data[ProductSpecialExec]['+(count-1)+'][remark]');
        $('#specialexecs').append($newRow);
        return false;
    }
</script>

