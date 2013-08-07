<!-- index //-->
<?php
/**
 * @var $this View
 */
?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Product</th>
            <th>Market</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($packages as $package): ?>
            <tr>
                <td><?=$package['Package']['id']?></td>
                <td><?=$package['Package']['name']?></td>
                <td>
                    <?php
                        foreach($package['PackageProduct'] as $packageProduct) {
                            echo $packageProduct['Product']['name'].'<br/>';
                        }
                    ?>
                </td>
                <td>All Region</td>
                <td width="1">
                    <button class="close" onclick="confirmPost('<?=$this->Html->url(array('action'=>'delete',$package['Package']['id']))?>','<?=__('Delete %s ?', $package['Package']['name'])?>')">&times;</button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<button class="btn btn-default btn-block" onclick="model('<?=$this->Html->url(array('action'=>'add'))?>')">Add New</button>