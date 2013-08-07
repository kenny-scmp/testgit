<!-- paginate //-->
<?php
/**
 * @var $this View
 */
?>
<div class="text-center">
    <ul class="pagination pagination-centered">
        <?php
        echo $this->Paginator->prev('&laquo;', array('tag' => 'li','class'=>'next', 'escape'=>false), null, array('tag' => 'li','class'=>'next','escape'=>false,'class'=>'disabled','disabledTag'=>'a'));
        echo $this->Paginator->numbers(array('tag' => 'li', 'separator'=>'', 'currentClass' => 'active', 'currentTag'=>'a','first' => 1, 'last' => 1,'modulus'=>4,'ellipsis'=>'<li class=\'disabled\'><a>...</a></li>'));
        echo $this->Paginator->next('&raquo;', array('tag' => 'li','class'=>'previous', 'escape'=>false), null, array('tag' => 'li','class'=>'previous','escape'=>false,'class'=>'disabled','disabledTag'=>'a'));
        ?>
    </ul>
</div>