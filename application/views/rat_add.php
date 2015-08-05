<div class="container">
    <h1>Add a Unit to RAT, <?php echo $rat->name; ?></h1>
    <ul>
        <li>Faction: <?php echo $rat->faction; ?></li>
        <li>Type: <?php echo $rat->type; ?></li>
        <li>Size: <?php echo $rat->size; ?></li>
    </ul>
    <table class="table table-striped">
        <tr>
            <th>Unit Name</th>
            <th>MV</th>
            <th>ARM</th>
            <th>STR</th>
            <th>S</th>
            <th>M</th>
            <th>L</th>
            <th>OV</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($units as $u): ?>
        <tr>
            <td><?php echo $u->name; ?></td>
            <td><?php echo $u->movement; ?></td>
            <td><?php echo $u->armor; ?></td>
            <td><?php echo $u->structure; ?></td>
            <td><?php echo $u->dmg_short; ?></td>
            <td><?php echo $u->dmg_med; ?></td>
            <td><?php echo $u->dmg_long; ?></td>
            <td><?php echo $u->overheat; ?></td>
            <td><?php echo anchor('rat/add_unit/'.$rat->rat_id.'/'.$u->unit_id, 'ADD'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>