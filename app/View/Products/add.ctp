<!-- add //-->
<?php
/**
 * @var $this View
 */
?>

<?= $this->Form->create('Product',array('action'=>'add')); ?>
<table>
    <tr>
        <td width="30%">
            <?= $this->Form->input('code'); ?>
            <?= $this->Form->input('name'); ?>
            <?= $this->Form->input('type', array(
                'options' => Configure::read('Product.type')
            ));?>
            <?= $this->Form->input('desc'); ?>
        </td>
        <td>
            <table id="specialexecs">
                <caption>Special Execution</caption>
                <tr style='display:none' id='rowtpl'>
                    <td>
                        <select>
                            <option value="">- please choose -</option>
                            <?php foreach($specialExecs as $specialExec): ?>
                                <option value="<?=$specialExec['SpecialExec']['id']?>"><?=$specialExec['SpecialExec']['name']?></option>
                            <?php endforeach ?>
                        </select>
                        <input type="text" style="width:auto"/>
                        <a href="#" onclick="$(this).closest('tr').remove();return false;">[x]</a>
                    </td>
                </tr>
            </table>
            <div style="text-align: right"><small><a href="#" onclick="return addSpecialExec(this)">[+ add more]</a></small></div>
        </td>
    </tr>
</table>
<?= $this->Form->input('weekday', array(
    'label' => 'Weekday (optional)',
    'type'=>'select',
    'multiple'=>'checkbox',
    'options'=> array( '1'=>'Mon', '2'=>'Tue', '3'=>'Wed', '4'=>'Thur','5'=>'Fri','6'=>'Sat','7'=>'Sun'),
    'div' => array('class'=>'input select weekday')
)); ?>
<?= $this->Form->end(__('Submit')); ?>

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

<style>
div.weekday>div.checkbox {
    clear: none;
    float: left;
}
</style>
