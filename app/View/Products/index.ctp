<!-- index //-->
<?php
/**
 * @var $this View
 */
?>
<?=$this->Html->link('Add Product', array('action'=>'add'), array('onclick'=>'return addproduct(this)'))?>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Desc</th>
        <th>Weekday</th>
        <th>Special Execution</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($products as $i=>$product): ?>
        <tr>
            <td><?=$product['Product']['name'];?></td>
            <td><?=Configure::read('Product.type')[$product['Product']['type']]?></td>
            <td><?=$product['Product']['desc'];?></td>
            <td><?php echo $product['Product']['weekday'] ? h(implode(',',$product['Product']['weekday'])) : '&nbsp;'; ?></td>
            <td>
                <?php
                foreach($product['ProductSpecialExec'] as $i=>$specialExec) {
                    if (!empty($specialExec['SpecialExec'])) {
                        echo $specialExec['SpecialExec']['name'].' -> '.$specialExec['remark'].'<br>';
                    }
                }
                ?>
            </td>
            <td>
                <?php
                    if($product['Product']['type']=='1') {
                        echo $this->Html->link('Section('.count($product['ProductSection']).')', array(
                           'controller' => 'productSections',
                           'action' => 'index',
                            $product['Product']['id']
                        ), array(
                            'onclick' => 'return addSection(this, \''.$product['Product']['name'].'\','.$product['Product']['id'].')'
                        ));
                    }
                ?>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<script>
    function addproduct(obj) {
        url = obj.getAttribute('href');
        var $dialog = $('<div></div>')
            .load(url, function() {
                $dialog.dialog('open');
            })
            .dialog({
                autoOpen: false,
                modal: true,
                title: "Add New Product",
                width: 'auto',
                close: function() {
                    $(this).dialog('destroy').remove();
                }
            });
        return false;
    }

    function addSection(obj, productName, productId) {
        url = obj.getAttribute('href');
        var $dialog = $('<div></div>')
            .load(url, function() {
                $dialog.dialog('open');
            })
            .dialog({
                autoOpen: false,
                modal: true,
                title: productName+" - Sections",
                width: 'auto',
                close: function() {
                    $(this).dialog('destroy').remove();
                }
            });
        return false;
    }
</script>

