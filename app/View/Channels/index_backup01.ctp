
<!--
<h1>Blog Posts</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Title</th>
    </tr>




<?php foreach ($channels as $channel): ?>
            <tr>
                <td><?php echo $channel['Channel']['id']; ?></td>
                <td>
    <?php echo $this->HTML->link($channel['Channel']['title'], array('action' => 'view', $channel['Channel']['id'])); ?>
                </td>
                <td>
                    <select">
                        <option value="<?php echo $channel['Channel']['id']; ?>"><?php echo $channel['Channel']['title']; ?></option>
                    </select>
                </td>

            </tr>
<?php endforeach; ?>
</table>

-->


<select style="width: 250px;">
    <?php foreach ($channels as $channel): ?> 
        <option value="<?php echo $channel['Channel']['id']; ?>"><?php echo $channel['Channel']['title']; ?></option>
    <?php endforeach; ?>
</select>