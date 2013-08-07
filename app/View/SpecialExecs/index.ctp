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
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($specialExecs as $specialExec): ?>
            <tr>
                <td><?=$specialExec['SpecialExec']['id']?></td>
                <td><?=$specialExec['SpecialExec']['name']?></td>
                <td width="1"><button class="close" onclick="confirmPost('<?=$this->Html->url(array('action'=>'delete',$specialExec['SpecialExec']['id']))?>','<?=__('Delete %s ?', $specialExec['SpecialExec']['name'])?>')">&times;</button></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php echo $this->element('paginate'); ?>

<button class="btn btn-default btn-block" onclick="return addNewSpecialExec();">Add New</button>

<script>
    function addNewSpecialExec() {
        var url = '<?=$this->Html->url(array('action'=>'add'))?>';
        var $dialog = $('<div class="modal fade"></div>').load(url, function() {
            $dialog.modal().on('hidden.bs.modal', function() {
                $dialog.remove();
            });
        });
        return false;
    }
</script>