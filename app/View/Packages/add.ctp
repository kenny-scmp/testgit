<!-- add //-->
<?php
/**
 * @var $this View
 */
?>
<?php echo $this->Form->create('Package',array('action'=>'add')); ?>
<fieldset>
    <?php echo $this->Form->input('name'); ?>
    <table>
        <thead>
            <tr>
                <th width="1">&nbsp;</th>
                <th>Product</th>
                <?php foreach(Configure::read('Common.weekday') as $weekday): ?>
                    <th width="30"><?=$weekday?></th>
                <?php endforeach ?>
            </tr>
            <tbody>
                <?php foreach($products as $i=>$product): ?>
                    <tr>
                        <td>
                            <?=$this->Form->input(null, array('name'=>'data[PackageProduct]['.$i.'][product_id]','type'=>'checkbox','label'=>false,'hiddenField'=>false,'value'=>$product['Product']['id'],'onclick'=>'enableWeekdaySelect(this)'));?>
                        </td>
                        <td><?=$product['Product']['name']?></td>
                        <?php foreach(Configure::read('Common.weekday') as $weekdayId=>$weekday): ?>
                            <?php $checked = $product['Product']['weekday'] && in_array($weekdayId, $product['Product']['weekday']) ? "checked" : "";?>
                            <td><input type="checkbox" name="data[PackageProduct][<?=$i?>][weekday][]" value="<?=$weekdayId?>" <?=$checked?> disabled></td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </thead>
    </table>
    <hr/><br/>
    <b>Market:</b>
    <input type="checkbox" checked style="float:none">All Region</p>
</fieldset>

<?php
echo $this->Form->end(__('Submit'));
?>

<script>
    function enableWeekdaySelect(obj) {
        var $this = $(obj);
        $this.closest('tr').find('input[type=checkbox][name*=weekday]').prop('disabled', !$this.prop('checked'));
    }
</script>