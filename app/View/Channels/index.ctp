<fieldset>
    <legend>All Channels</legend>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Channel Name</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($channels as $channel): ?>
            <tr>
                <td><?php echo $channel['Channel']['id']; ?></td>
                <td><?php echo $this->Html->link($channel['Channel']['title'], array('action'=>'edit', $channel['Channel']['id']));?></td>
                <td><?php echo $this->Html->link('Sub-Channels',array('action'=>'viewSubChannels',$channel['Channel']['id']));?></td>
                <td width="1">
                    <button class="close" onclick="confirmPost('<?=$this->Html->url(array('action'=>'delete',$channel['Channel']['id']))?>','<?=__('Delete %s ?', $channel['Channel']['title'])?>')">&times;</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <button class="btn btn-default btn-block" data-target="#addChannel" data-toggle="modal">Add New</button>
</fieldset>

<div class="modal fade" id="addChannel">
    <div class="modal-dialog">
        <?php echo $this->Form->create('Channel', array('action' => 'add')); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Channel</h4>
            </div>
            <div class="modal-body">
                <table id="dataTable" class="table table-striped table-hover">
                    <tr>
                        <td width="50">&nbsp;</td>
                        <td>
                            <?php echo $this->Form->input('0.Channel.title', array('label' => false,'class'=>'form-control','div'=>'form-group','placeholder'=>'Channel Title')); ?>
                        </td>
                    </tr>
                </table>
                <button type="button" class="btn btn-primary btn-mini pull-right" onclick="addRow()">
                    <i class="icon-plus"></i> add more
                </button>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>


<script language="javascript">
    function addRow() {
        var $table = $("#dataTable");
        var $newRow = $table.find('tr:first').clone();
        $newRow.find('td:first').append(
            $('<button type="button" class="close"/>').html('&times;').click(function() {
                $(this).closest('tr').fadeOut(function() {
                    $(this).remove();
                });
            })
            ).end().find('input[name*=Channel]').each(function() {
                var name = $(this).attr('name').replace('0', Math.floor(Math.random()*1000)+1);
                $(this).attr('name', name);
                $(this).val($(this).attr('type')=='text' ? '' : $(this).val());
            });
        $table.append($newRow);
    }
</script>
