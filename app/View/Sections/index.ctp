<?php
/**
 * @var $this View
 */
?>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th><?php echo $this->Paginator->sort('id', '#'); ?></th>
        <th><?php echo $this->Paginator->sort('product_code'); ?></th>
        <th><?php echo $this->Paginator->sort('name'); ?></th>
        <th><?php echo $this->Paginator->sort('weekday'); ?></th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($sections as $section): ?>
    <tr>
        <td><?php echo h($section['Section']['id']); ?>&nbsp;</td>
        <td><?php echo h($section['Section']['product_code']); ?>&nbsp;</td>
        <td><?php echo h($section['Section']['name']); ?>&nbsp;</td>
        <td><?php echo $section['Section']['weekday'] ? h(implode(',', $section['Section']['weekday'])) : ''; ?>
            &nbsp;</td>
        <td width="1">
            <button class="close" onclick="confirmPost('<?=$this->Html->url(array('action'=>'delete',$section['Section']['id']))?>','<?=__('Delete %s - %s ?', $section['Section']['product_code'], $section['Section']['name'])?>')">&times;</button>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->element('paginate'); ?>

<button class="btn btn-default btn-block" onclick="return addNewSection();">Add New</button>

<script>
    function addNewSection() {
        var url = '<?=$this->Html->url(array('action'=>'add'))?>';
        var $dialog = $('<div class="modal fade"></div>').load(url, function() {
            $dialog.modal().on('hidden.bs.modal', function() {
                $dialog.remove();
            });
        });
        return false;
    }
</script>