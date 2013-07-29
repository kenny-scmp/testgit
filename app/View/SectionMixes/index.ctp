<!-- index //-->
<?php
/**
 * @var $this View
 */
?>
<?=$this->Html->link('Add Section Mix', array('action'=>'add'), array('onclick'=>'return addsectionmix(this)'))?>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Channel</th>
        <th>Package</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($sectionMixes as $sectionMix): ?>
        <tr>
            <td><?=$sectionMix['SectionMix']['id']?></td>
            <td><?=$sectionMix['Channel']['title']?></td>
            <td><?=$sectionMix['Package']['name']?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<script>
    function addsectionmix(obj) {
        url = obj.getAttribute('href');
        var $dialog = $('<div></div>')
            .load(url, function() {
                $dialog.dialog('open');
            })
            .dialog({
                autoOpen: false,
                modal: true,
                title: "Add New Section Mix",
                width: '700',
                close: function() {
                    $(this).dialog('destroy').remove();
                }
            });
        return false;
    }
</script>