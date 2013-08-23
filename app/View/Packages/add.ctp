<!-- add //-->
<?php
/**
 * @var $this View
 */
?>

<script>
$(function() {
    $.validator.addMethod('requireOneProduct', function (value) { return $('.require-one-product:checked').size() > 0; }, 'Please select at least one product.');
    $("#PackageAddForm").find('input:checkbox[name*=product_id]:first').attr('requireOneProduct','1').end().validate({
        groups: {
            requireOneProduct: $.map($("#PackageAddForm").find('input:checkbox[name*=product_id]'), function(e) {return $(e).attr('name')}).join(' ')
        }
    });
});

//$("#PackageAddForm").find('input:checkbox[name*=product_id]')
</script>

<?php echo $this->Form->create('Package',array('action'=>'add')); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Package</h4>
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
            <div id="errContainer-oneProduct" style="width:1px;position:absolute;height:1px;margin-top:20px">&nbsp;</div>
            <table class="table table-striped table-hover table-condensed" id="products">
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Product</th>
                    <?php foreach(Configure::read('Common.weekday') as $weekday): ?>
                        <th><?=$weekday?></th>
                    <?php endforeach ?>
                </tr>
                <tbody>
                <?php foreach($products as $i=>$product): ?>
                    <tr>
                        <td>
                            <?=$this->Form->input(null, array('name'=>'data[PackageProduct]['.$i.'][product_id]','type'=>'checkbox','label'=>false,'hiddenField'=>false,'value'=>$product['Product']['id'],'onclick'=>'enableWeekdaySelect(this)','class'=>'require-one-product', 'errContainerId'=>'errContainer-oneProduct'));?>
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>
<?= $this->Form->end(); ?>
<script>
    $(function() {
       $('#products').dataTable({
           "bInfo": false,
           "bSort": false,
           "sPaginationType": "bootstrap",
           "iDisplayLength": 8,
           "bFilter": false,
           "sScrollY": "250px",
           "sDom": "tp<'clearfix'>",
           "bScrollCollapse": true,
           "fnInitComplete": function(oSettings) {
               setTimeout(function() {
                   $('.paging_bootstrap ul').addClass('pagination pagination-centered');
                   $('#products').dataTable().fnAdjustColumnSizing(false);
               },1);
           }
       });
        //$("#products").dataTable().fnAdjustColumnSizing(false)
    });
    function enableWeekdaySelect(obj) {
        var $this = $(obj);
        $this.closest('tr').find('input[type=checkbox][name*=weekday]').prop('disabled', !$this.prop('checked'));
    }
</script>