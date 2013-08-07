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
        <th>Channel</th>
        <th>Product/Package</th>
        <th>Section</th>
        <th>&nbsp;</th>
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
                            if ($sectionMixProductSection['SectionProduct']) {
                                echo '<li>'.$sectionMixProductSection['SectionProduct']['name'].'</li>';
                            } else {
                                echo '<li>'.$sectionMixProductSection['Section']['name'].'</li>';
                            }
                        }
                        echo '</ul>';
                    } else {
                        echo '</li>';
                    }
                    echo '</ul>';
                }
                ?>
            </td>
            <td width="1">
                <button class="close" onclick="confirmPost('<?=$this->Html->url(array('action'=>'delete',$sectionMix['SectionMix']['id']))?>','<?=__('Delete #%s ?', $sectionMix['SectionMix']['id'])?>')">&times;</button>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<button class="btn btn-default btn-block" onclick="model('<?=$this->Html->url(array('action'=>'add'))?>')">Add New</button>
