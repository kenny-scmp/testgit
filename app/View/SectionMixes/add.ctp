<!-- add //-->
<?php
/**
 * @var $this View
 */
?>

<?php echo $this->Form->create('SectionMix',array('action'=>'add')); ?>
<fieldset>
    <div class="input select required">
        <label style="display:inline">Product: </label>
        <select onchange="loadSection(this)" id="productOrPackage">
            <option value="">- Product or Package -</option>
            <optgroup label="Packages">
                <?php foreach($packages as $package): ?>
                    <option value="<?=$package['Package']['id']?>" type="package"><?=$package['Package']['name']?></option>
                <?php endforeach ?>
            </optgroup>
            <optgroup label="Products">
                <?php foreach($products as $product): ?>
                    <option value="<?=$product['Product']['id']?>" type="product"><?=$product['Product']['name']?></option>
                <?php endforeach ?>
            </optgroup>
        </select>
    </div>
    <?=$this->Form->input('channel_id', array('label'=>array('text'=>'Channel: ','style'=>'display:inline'),'empty' => '--- Please Choose ---', 'onchange'=>'loadSubChannel(this);'));?>
    <?php
        echo $this->Form->input('Market', array(
            'label' => array(
                'text' => 'Market: ',
                'style' => 'display:inline'
            ),
            'options' => array('All Region'),
            'empty' => '--- Please Choose ---'
        ))
    ?>
    <div>
        <table>
            <tr>
                <td>
                    <b>Section:</b>
                    <table id="sectionTable">
                        <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Product</th>
                            <th>Section</th>
                            <?php foreach(Configure::read('Common.weekday') as $weekday): ?>
                                <th width="30"><?=$weekday?></th>
                            <?php endforeach ?>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</fieldset>
<?php echo $this->Form->end(__('Submit'));?>

<script>
    $(function() {
       $("#SectionMixAddForm").submit(function() {
           var $productOrPackage = $('#productOrPackage');
           var productOrPackage = $productOrPackage.find('option:selected').attr('type');
           $productOrPackage.attr('name', productOrPackage=='package' ? 'data[SectionMix][package_id]' : 'data[SectionMix][product_id]');
           return true;
       });
    });
    function loadSection(obj) {
        var $obj = $(obj);
        var id = $obj.val();
        if (id) {
            var type = $(':selected',$obj).attr('type');
            var url = type=='product' ? "<?=$this->Html->url(array('controller'=>'products','action'=>'findAllBy.json'))?>" : "<?=$this->Html->url(array('controller'=>'packages','action'=>'findAllBy.json'))?>";
            $('#sectionTable tbody').empty();
            $.post(url, {by: 'id', val: id}, function(json) {
                if (type=='product') {
                    $.each(json, function(i,product) {
                        addSectionRow(product);
                    });
                } else {
                    $.each(json[0]['PackageProduct'], function(i,packageProduct) {
                        var data = {
                            'Product': packageProduct['Product'],
                            'ProductSection': packageProduct['Product']['ProductSection']
                        };
                        addSectionRow(data);
                    });
                }
            }, 'json');
        }
    }

    function loadSubChannel(channelSelObj) {
        var $channelSelObj = $(channelSelObj);
        var selectedVal = $channelSelObj.val()
        $channelSelObj.next("select").remove();
        $channelSelObj.attr('name','data[SectionMix][channel_id]');
        if (selectedVal) {
            var url = "<?=$this->Html->url(array('controller'=>'channels','action'=>'viewSubChannels.json'))?>";
            var param = {id : selectedVal};
            $.post(url, param, function(json) {
                if (json.length>0) {
                    var $select = $('<select/>').attr('name','data[SectionMix][channel_id]');
                    $select.append($('<option/>').text('--- Sub Channels ---'));
                    for(i in json) {
                        var subchannel = json[i].Channel;
                        var id = subchannel.id;
                        var title = subchannel.title;
                        var $options = $('<option/>').val(id).text(title);
                        $select.append($options);
                    }
                    $channelSelObj.after($select).removeAttr('name');
                }
            });
        }
    }

    function addSectionRow(product) {
        var productWeekday = product['Product'].weekday || [];
        var productSections = product['ProductSection'];
        var sectionMixProductsCount = $("#SectionMixAddForm input[type=checkbox][main]").length;
        $checkbox = $('<td/>').append($('<input type="checkbox" checked name="data[SectionMixProduct]['+sectionMixProductsCount+'][product_id]" value="'+product['Product']['id']+'"/>').attr('productId', product['Product']['id']).attr('main','1').click(function() {
            $(this).closest('table').find('tr[productId='+$(this).attr('productId')+']').find('input[type=checkbox]').prop('checked', $(this).prop('checked'));
        }));
        $tr = $('<tr/>').attr('productId', product['Product']['id']);
        $product = $('<td/>').html(product['Product'].name);
        $tr.append($checkbox).append($product);

        if (productSections.length > 0) {
            $checkbox.attr('rowspan', productSections.length);
            $product.attr('rowspan', productSections.length);
            $.each(productSections, function(i, sections) {
                var $_tr = $('<tr/>').attr('productId', product['Product']['id']);;
                if (i==0) {
                    $_tr = $tr;
                }
                var sectionIdName = 'section_id';
                var sectionIdVal = sections.section_id;
                if (sections.section_product_id) {
                    sectionIdName = 'section_product_id';
                    sectionIdVal = sections.section_product_id;
                }
                $_tr.append($('<td/>').append($('<input type="checkbox" checked name="data[SectionMixProduct]['+sectionMixProductsCount+'][SectionMixProductSection][]['+sectionIdName+']" value="'+sectionIdVal+'"/>').attr('productId', product['Product']['id']).click(function() {
                    $(this).closest('table').find('tr[productId='+$(this).attr('productId')+']').find('input[type=checkbox][main]').prop('checked',true);
                })).append(sections.section_product_id ? sections.SectionProduct.Product.name : sections.Section.name));
                for (var w=0; w<7; w++) {
                    if (sections.weekday || sections.Section.weekday || productWeekday) {
                        var wd = sections.weekday ? sections.weekday : sections.Section.weekday;
                        wd = wd ? wd : productWeekday
                        $_tr.append($('<td align="center"/>').html($.inArray((w+1+''), wd)>=0 ? 'X' : '-'));
                    }
                }
                $('#sectionTable tbody').append($_tr);
            });
        } else {
            $tr.append($('<td/>').html('-'));
            for (var w=0; w<7; w++) {
                $tr.append($('<td align="center"/>').html($.inArray((w+1+''), productWeekday)>=0 ? 'X' : '-'));
            }
            $('#sectionTable tbody').append($tr);
        }

    }
</script>