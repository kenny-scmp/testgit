<!--<select>
<?php foreach ($channels as $channel): ?> 
        <option value="<?php echo $channel['Channel']['id']; ?>"><?php echo $channel['Channel']['title']; ?></option>
<?php endforeach; ?>
</select>-->


<h1 style ="font-size: 24px;">All Channels</h1>

<table style="width: 600px;">
    <tr>
        <th style="text-align: center">Channel Name</th>
        
        <th></th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($channels as $channel): ?>
        <tr>
            <td><?php echo $channel['Channel']['title']; ?></td>
            
            <td style="text-align: center"><?php echo $this->Html->link('Edit', array('action'=>'edit', $channel['Channel']['id']));?></td>
            <td style="text-align: center"><?php echo $this->Html->link('Delete',array('action'=>'delete', $channel['Channel']['id']),null,'Are you sure?')?></td>
            <td style="text-align: center"><?php echo $this->Html->link('View Sub-Channels',array('action'=>'viewSubChannels',$channel['Channel']['id']));?></td>
            
        </tr>
    <?php endforeach; ?>

</table>


<h1 style ="font-size: 24px;">Add New Channel</h1>

<script language="javascript">
    function addRow(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var colCount = table.rows[0].cells.length;

        for (var i = 0; i < colCount; i++) {

            var newcell = row.insertCell(i);

            newcell.innerHTML = table.rows[0].cells[i].innerHTML;
            newcell.innerHTML = newcell.innerHTML.replace('[0]', '[' + rowCount + ']');

            switch (newcell.childNodes[0].type) {
                case "text":
                    newcell.childNodes[0].value = "";
                    break;
                case "checkbox":
                    newcell.childNodes[0].checked = false;
                    break;
                case "select-one":
                    newcell.childNodes[0].selectedIndex = 0;
                    break;
            }
        }
    }

    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for (var i = 0; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                    if (rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }


            }
        } catch (e) {
            alert(e);
        }
    }

</script>

<!--<form action="<?php echo $this->HTML->url('index'); ?> " method="post">-->
<?php echo $this->Form->create('Channel', array('action' => 'add')); ?>
<table id="dataTable" width="350px" border="1" style="height: 10px;">
    <tr >
        <td><input type="checkbox" name="chk" /></td>
        <td>
            <?php echo $this->Form->input('0.Channel.title', array('label' => false)); ?>
        </td>
    </tr>
</table>
<input type="button" value="Add Row" onclick="addRow('dataTable')" />
<input type="button" value="Delete Row" onclick="deleteRow('dataTable')" />
<?php echo $this->Form->end('Save Channel'); ?>