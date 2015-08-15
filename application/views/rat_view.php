<div class="container">
    <h1>Viewing RAT, <?php echo $rat->name; ?> <small>(<?php echo anchor('rat/add_unit/'.$rat->rat_id, 'add unit'); ?>)</small></h1>
    <table class="table">
        <tr><td>Faction: </td><td><?php echo $rat->faction; ?></td></tr>
        <tr><td>Type: </td><td><?php echo $rat->type; ?></td></tr>
        <tr><td>Tech: </td><td><?php echo $rat->tech; ?></td></tr>
        <tr><td>Size: </td><td><?php echo $rat->size; ?></td></tr>
    </table>
    <table class="table table-striped">
        <tr>
            <th>Roll</th>
            <th>Unit Name</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($ratdata as $d): ?>
        <tr>
            <td><?php echo $d->roll; ?></td>
            <td><?php echo $d->unit_name; ?></td>
            <td>
                <?php echo anchor('unit/view/'.$d->unit_id, 'view'); ?> |
                <?php echo anchor('rat/remove_unit/'.$rat->rat_id.'/'.$d->data_id, 'delete'); ?> |
                <?php echo anchor('rat/update_data/'.$rat->rat_id.'/'.$d->data_id.'/1', '+1'); ?> |
                <?php echo anchor('rat/update_data/'.$rat->rat_id.'/'.$d->data_id.'/-1', '-1'); ?> |
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>