<!-- index //-->
<?php
/**
 * @var $this View
 */
?>
<?=$this->Form->create('ProductSection',array('action'=>'add?product_id='.$product['Product']['id']));?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?=$product['Product']['name']?> - Sections</h4>
        </div>
        <div class="modal-body">

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th width="10">&nbsp;</th>
                    <th width="200">Section Name</th>
                    <?php foreach(Configure::read('Common.weekday') as $weekday): ?>
                        <th width="30"><?=$weekday?></th>
                    <?php endforeach ?>
                </tr>
                </thead>
                <tbody id="sections"></tbody>
            </table>

            <a href="#" onclick="return addRow()" style="float: right">[+more section]</a>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>
<?php echo $this->Form->end(); ?>

<script>
    var productWeekday = <?=json_encode($product['Product']['weekday'])?>;
    $(function() {
        <?php if (empty($product['ProductSection'])): ?>
            addRow();
        <?php else: ?>
            <?php foreach($product['ProductSection'] as $i=>$productSection): ?>
                addRow({
                    sectionId: '<?=$productSection['section_id']?>',
                    weekday: <?=json_encode($productSection['weekday'])?>,
                    sectionProductId: '<?=$productSection['section_product_id']?>'
                });
            <?php endforeach ?>
       <?php endif ?>
    });
    function addRow(data) {
        data = data || {};
        var $form = $("#ProductSectionAddForm");
        var $sections = $("#sections");
        var count = $('tr', $sections).length;
        var $tr = $('<tr/>');
        var $deleteBtn = $('<td/>').append(
            $('<button class="close"/>').html('&times;').click(function() {
                $(this).closest('tr').fadeOut(function() {
                    $(this).remove();
                    if ($('tr', $sections).length <=0) {
                        addRow();
                    }
                });
                return false;
            })
        );
        var $referBtn = $('<a/>').attr('href','#').attr('title','Switch to Non-News Product').html('&nbsp;&nbsp;<i class="icon-circle-arrow-right"></i>').click(function() {
            loadSupplementsIntoSection($(this).closest('td'));
            return false;
        });
        var $section = $('<select class="form-control" name="data['+count+'][ProductSection][section_id]" style="width:85%" required="required"/>');
        $section.append($('<option value=""/>').text('- Section -'));
        <?php foreach($sections as $i=>$section): ?>
            var sectionWeekday = <?=json_encode($section['Section']['weekday'])?>;
            $section.append($('<option value="<?=$section['Section']['id']?>"/>').text('<?=$section['Section']['name']?>').data('sectionWeekday',sectionWeekday));
        <?php endforeach ?>
        $section.change(function() {
            var $this = $(this);
            if ($this.val()) {
                var sectionWeekday = $(":selected", $this).data('sectionWeekday');
                $this.closest('tr').find('input[type=checkbox]').each(function() {
                    $(this).prop('checked', $.inArray($(this).val(), sectionWeekday ? sectionWeekday : productWeekday)>=0);
                });

            }
        });
        var $tdName = $('<td class="form-inline"/>').append($section).append($referBtn);
        $tr.append($deleteBtn).append($tdName);

        <?php foreach(Configure::read('Common.weekday') as $i=>$weekday): ?>
            var $checkbox<?=$i?> = $('<input name="data['+count+'][ProductSection][weekday][]" type="checkbox" value="<?=$i?>"/>');
            if (data.weekday) {
                if ($.inArray('<?=$i?>',data.weekday) >= 0) {
                    $checkbox<?=$i?>.prop('checked', true);
                }
            } else {
                <?php if (!empty($product['Product']['weekday']) && in_array($i, $product['Product']['weekday'])): ?>
                    $checkbox<?=$i?>.prop('checked', true);
                <?php endif ?>
            }
            var $td<?=$i?> = $('<td/>').append($checkbox<?=$i?>);
            $tr.append($td<?=$i?>);

            <?php if ($i==1): ?>
                $checkbox<?=$i?>.attr('required','required');
            <?php endif ?>
        <?php endforeach ?>

        $tr.append($('<input type="hidden" name="data['+count+'][ProductSection][product_id]" value="<?=$product['Product']['id']?>"/>'));
        $sections.append($tr);

        if (data) {
            if (data.sectionProductId) {
                loadSupplementsIntoSection($section.closest('td'), data.sectionProductId);
            } else {
                $section.val(data.sectionId);
            }
        }

        return false;
    }

    function loadSupplementsIntoSection($td, defaultVal) {
        var index = $td.closest('tr').index();
        var $select = $('<select class="form-control"/>').attr('name','data['+index+'][ProductSection][section_product_id]');
        var url = "<?=$this->Html->url(array('controller'=>'products','action'=>'findAllBy'))?>";
        $.post(url, {by: 'type', val: 2}, function(json) {
            if (json.length==0) {
                alert('There is no Non-News Product');
                return false;
            }
            $td.empty();
            $.each(json, function(i) {
                product = json[i].Product;
                $option = $('<option/>').val(product.id).text(product.name).data('product',product);
                $select.append($option);
            });
            $select.change(function() {
                var product = $(this).find('option:selected').data('product');
                if (product.weekday) {
                    $td.closest('tr').find('input[type=checkbox]').each(function() {
                        $(this).prop('checked', $.inArray($(this).val(), product.weekday)>=0);
                    });
                } else {
                    $td.closest('tr').find('input[type=checkbox]').prop('checked', false);
                }
            });
            $td.append($select);
            if (defaultVal) {
                $select.val(defaultVal);
            }
            $select.trigger('change');
        }, 'json');
    }
</script>

