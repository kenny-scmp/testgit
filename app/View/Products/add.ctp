<!-- add //-->
<?php
/**
 * @var $this View
 */
?>

    <fieldset>
        <?php
        echo $this->Form->create('Product',array('action'=>'add'));
        echo $this->Form->input('code');
        echo $this->Form->input('name');
        echo $this->Form->input('type', array(
            'options' => Configure::read('Product.type')
        ));
        echo $this->Form->input('desc');
        echo $this->Form->input('weekday', array(
            'label' => 'Weekday (optional)',
            'type'=>'select',
            'multiple'=>'checkbox',
            'options'=> array( '1'=>'Mon', '2'=>'Tue', '3'=>'Wed', '4'=>'Thur','5'=>'Fri','6'=>'Sat','7'=>'Sun'),
            'div' => array('class'=>'input select weekday')
        ));
        echo $this->Form->end(__('Submit'));
        ?>
    </fieldset>
<style>
div.weekday>div.checkbox {
    clear: none;
    float: left;
}
</style>
