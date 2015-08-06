<div class="container">
    <h1><?php echo $command->name ?></h1>
    <table class="table">
        <tr>
            <th>Name</th><td><?php echo $command->name; ?></td>
        </tr>
        <tr>
            <th>Experience</th><td><?php echo $command->experience; ?></td>
        </tr>
        <tr>
            <th>Loyalty</th><td><?php echo $command->loyalty; ?></td>
        </tr>
        <tr>
            <th>Location</th><td><?php echo anchor('planet/view/'.$planet->planet_id, $planet->name); ?></td>
        </tr>

    </table>
    
    <h2>Formations <small>(<?php echo anchor('command/add_formation/'.$command->command_id, 'add'); ?>)</small></h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Move</th>
            <th>Tactics</th>
            <th>Morale</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach($formations as $f): ?>
        <tr>
            <td><?php echo $f->name; ?></td>
            <td><?php echo $f->type; ?></td>
            <td><?php echo $f->move; ?></td>
            <td><?php echo $f->tactics; ?></td>
            <td><?php echo $f->morale; ?></td>
            <td><?php echo anchor('formation/view/'.$f->formation_id, 'VIEW'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</div>