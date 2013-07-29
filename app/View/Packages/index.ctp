<!-- index //-->
<?php
/**
 * @var $this View
 */
?>
<?=$this->Html->link('Add Package', array('action'=>'add'), array('onclick'=>'return addpackage(this)'))?>
<table>
    <thead>
        <tr>
            <th width="150">Name</th>
            <th>Product</th>
            <th>Market</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($packages as $package): ?>
            <tr>
                <td><?=$package['Package']['name']?></td>
                <td>
                    <?php
                        foreach($package['PackageProduct'] as $packageProduct) {
                            echo $packageProduct['Product']['name'].'<br/>';
                        }
                    ?>
                </td>
                <td>All Region</td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    function addpackage(obj) {
        url = obj.getAttribute('href');
        var $dialog = $('<div></div>')
            .load(url, function() {
                $dialog.dialog('open');
            })
            .dialog({
                autoOpen: false,
                modal: true,
                title: "Add New Package",
                width: 'auto',
                close: function() {
                    $(this).dialog('destroy').remove();
                }
            });
        return false;
    }
</script>