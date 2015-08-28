<div class="container">
    <?php echo anchor('game/view/'.$faction->game_id, '<< Game View'); ?>
    <h1><?php echo $faction->name; ?></h1>
    <h2>Faction Data</h2>
    <table class="table">
        <tr>
            <td>Resource Points: </td>
            <td><?php echo $faction->rp.' ('.anchor('faction/modify_rp/'.$faction->faction_id, 'Modify').')'; ?></td>
        </tr>
        <tr>
            <td>Combat Commands: </td>
            <td><?php echo count($commands); ?></td>
        </tr>
        <tr>
            <td>Supply Requirement: </td>
            <td><?php echo $supply; ?></td>
        </tr>
    </table>
    
    <h2>Player List <small>(<?php echo anchor('faction/join/'.$faction->faction_id, 'join'); ?>)</small></h2>
    <table class="table table-striped">
        <tr>
            <th>User</th>
            <th>&nbsp;</th>
        </tr>
    <?php foreach($players as $p): ?>
    
    <tr>
        <td><?php echo $p->username; ?></td>
        <td><?php echo anchor('auth/view_user/'.$p->user_id, 'VIEW'); ?></td>
    </tr>
        
    <?php endforeach; ?>
    </table>
    
    <h2>Combat Commands <small>(<?php echo anchor('command/create/'.$faction->faction_id, 'add'); ?>)</small></h2>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Experience</th>
            <th>Loyalty</th>
            <th>Fatigue</th>
            <th>In Supply</th>
            <th>Location</th>
            <th>In Combat</th>
            <th>&nbsp;</th>
        </tr>
    <?php foreach($commands as $c): ?>
    
        <tr>
            <td><?php echo $c->name; ?></td>
            <td><?php echo $c->experience; ?></td>
            <td><?php echo $c->loyalty; ?></td>
            <td><?php echo $c->fatigue.' ('.anchor('command/modify_fatigue/'.$c->command_id.'/-1', '-').' / '.anchor('command/modify_fatigue/'.$c->command_id.'/1', '+').')'; ?></td>
            <td><?php echo anchor('command/toggle_in_supply/'.$c->command_id, ($c->supply ? 'YES' : 'NO')); ?></td>
            <td><?php echo (isset($c->planet_name) ? anchor('planet/view/'.$c->planet_id, $c->planet_name) : 'No Where'); ?></td>
            <td><?php echo anchor('command/toggle_in_combat/'.$c->command_id, ($c->in_combat ? 'YES' : 'NO')); ?></td>
            <td><?php echo anchor('command/view/'.$c->command_id, 'VIEW'); ?></td>
        </tr>
        
    <?php endforeach; ?>
    </table>
    
</div>