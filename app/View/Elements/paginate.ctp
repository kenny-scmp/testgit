<!-- paginate //-->
<?php
/**
 * @var $this View
 */
?>
<div class="paging">
    <?php
        echo $this->Paginator->prev('< ' . __d('cake', 'previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__d('cake', 'next') .' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>