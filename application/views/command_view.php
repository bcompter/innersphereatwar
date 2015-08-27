<div class="container">
    <h1><?php echo $command->name ?></h1>
    <table class="table">
        <tr>
            <th>Faction</th><td><?php echo anchor('faction/view/'.$faction->faction_id, $faction->name); ?></td>
        </tr>
        <tr>
            <th>Experience</th><td><?php echo $command->experience; ?></td>
        </tr>
        <tr>
            <th>Tech Rating</th><td><?php echo $command->tech; ?></td>
        </tr>
        <tr>
            <th>Loyalty</th><td><?php echo $command->loyalty; ?></td>
        </tr>
        <tr>
            <th>Location</th>
            <td>
                <?php echo anchor('planet/view/'.$planet->planet_id, $planet->name); ?>
                (<?php echo anchor('command/move/'.$command->command_id, 'MOVE'); ?>)
            </td>
        </tr>

    </table>
    
    <h2>Formations <small>(<?php echo anchor('command/add_formation/'.$command->command_id, 'add'); ?>)</small></h2>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Move</th>
            <th>Tactics</th>
            <th>Morale</th>
            <th>&nbsp;</th>
            <th>Token Links</th>
        </tr>
        <?php foreach($formations as $f): ?>
        <tr>
            <td><?php echo $f->name; ?></td>
            <td><?php echo $f->type; ?></td>
            <td><?php echo $f->move; ?></td>
            <td><?php echo $f->tactics; ?></td>
            <td><?php echo $f->morale; ?></td>
            <td>
                <?php echo anchor('formation/view/'.$f->formation_id, 'VIEW'); ?> |
                <?php echo anchor('formation/edit_name/'.$f->formation_id, 'EDIT'); ?>
            </td>
            <td>
                <?php echo anchor('formation/place_token/'.$f->formation_id.'/Aero', 'PLACE Aero'); ?> |
                <?php echo anchor('formation/place_token/'.$f->formation_id.'/Ground', 'PLACE Ground'); ?> |
                <?php echo anchor('formation/remove_token/'.$f->formation_id, 'REMOVE'); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <h2>Orders <small>(<?php echo anchor('orders/create/'.$command->command_id, 'add'); ?>)</small></h2>
    <table class="table table-striped">
        <tr>
            <th>Type</th>
            <th>Order Points</th>
            <th>&nbsp;</th>

        </tr>
        <?php foreach($orders as $o): ?>
        <tr>
            <td><?php echo $o->type; ?></td>
            <td><?php echo $o->points; ?></td>
            <td>
                <?php echo anchor('orders/delete/'.$command->command_id.'/'.$o->order_id, 'delete'); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</div>