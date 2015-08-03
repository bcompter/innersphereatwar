<div class="container">
    <h1>Viewing RAT, <?php echo $rat->name; ?></h1>
    <ul>
        <li>Type: <?php echo $rat->type; ?></li>
        <li>Weight: <?php echo $rat->weight; ?></li>
    </ul>
    <table class="table table-striped">
        <tr>
            <th>Value</th>
            <th>Unit Name</th>
            <th>MV</th>
            <th>ARM</th>
            <th>STR</th>
            <th>S</th>
            <th>M</th>
            <th>L</th>
            <th>OV</th>
        </tr>
        <?php foreach ($ratdata as $d): ?>
        <tr>
            <td><?php echo $d->value; ?></td>
            <td><?php echo $d->name; ?></td>
            <td><?php echo $d->movement; ?></td>
            <td><?php echo $d->armor; ?></td>
            <td><?php echo $d->structure; ?></td>
            <td><?php echo $d->dmg_short; ?></td>
            <td><?php echo $d->dmg_med; ?></td>
            <td><?php echo $d->dmg_long; ?></td>
            <td><?php echo $d->overheat; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>