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
        <th>Product/Package</th>
        <th>Section</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($sectionMixes as $sectionMix): ?>
        <tr>
            <td><?=$sectionMix['SectionMix']['id']?></td>
            <td><?=$sectionMix['Channel']['title']?></td>
            <td><?=$sectionMix['Package']['name']?><?=$sectionMix['Product']['name']?></td>
            <td>
                <?php
                foreach($sectionMix['SectionMixProduct'] as $sectionMixProduct) {
                    echo '<ul>';
                    echo '<li>'.$sectionMixProduct['Product']['name'];
                    if (!empty($sectionMixProduct['SectionMixProductSection'])) {
                        echo '<ul>';
                        foreach($sectionMixProduct['SectionMixProductSection'] as $sectionMixProductSection) {
                            echo '<li>'.$sectionMixProductSection['Section']['name'].'</li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '</li>';
                    }
                    echo '</ul>';
                }
                ?>
            </td>
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