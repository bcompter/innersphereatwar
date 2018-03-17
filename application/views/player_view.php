<div class="container">
    <h1><?php echo $player->name; ?></h1>
    <table class="table">
        <tr>
            <th>Played By</th><td><?php echo $player->username; ?></td>
        </tr>
        <tr>
            <th>Faction</th><td><?php echo anchor('faction/view/'.$faction->faction_id, $faction->name); ?></td>
        </tr>
        <tr>
            <th>Rank</th><td><?php echo $rank->text; ?> (<?php echo anchor('ranks/modify/'.$player->player_id, 'MODIFY'); ?>)</td>
        </tr>
    </table>
    
    <h2>Combat Commands under Command</h2>
    <table class="table table-striped tablesorter">
        <thead>
            <tr>
                <th>Name</th>
                <th>Experience</th>
                <th>Loyalty</th>
                <th>Fatigue</th>
                <th>In Supply</th>
                <th>Location</th>
                <th>In Combat</th>
                <th>Has Orders?</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
    <?php if (isset($commands)): ?>
    <?php foreach($commands as $c): ?>
        <tbody>
            <tr>
                <td><?php echo $c->name; ?></td>
                <td><?php echo $c->experience; ?></td>
                <td><?php echo $c->loyalty; ?></td>
                <td><?php echo $c->fatigue.' ('.anchor('command/modify_fatigue/'.$c->command_id.'/-1', '-').' / '.anchor('command/modify_fatigue/'.$c->command_id.'/1', '+').')'; ?></td>
                <td><?php echo anchor('command/toggle_in_supply/'.$c->command_id, ($c->supply ? 'yes' : 'NO')); ?></td>
                <td><?php echo (isset($c->planet_name) ? anchor('planet/view/'.$c->planet_id, $c->planet_name) : 'No Where'); ?></td>
                <td><?php echo anchor('command/toggle_in_combat/'.$c->command_id, ($c->in_combat ? 'YES' : 'no')); ?></td>
                <td><?php echo (isset($c->order_id) ? 'yes' : 'NO'); ?></td>
                <td><?php echo anchor('command/view/'.$c->command_id, 'VIEW'); ?></td>
            </tr>
        </tbody>
        
    <?php endforeach; ?>
    <?php endif; ?>
    </table>
    
</div>