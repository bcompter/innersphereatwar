<script type="text/javascript" <?php echo 'src="'.$this->config->item('base_url').'tablesorter.js"'; ?>></script> 

<script type="text/javascript">
    $(document).ready(function() 
        { 
            $(".sortable").tablesorter(); 
        } 
    ); 
</script>

<div class="container">
    
    <ol class="breadcrumb">
        <li><?php echo anchor('game/view/'.$faction->game_id, 'Game View'); ?></li>
    </ol> 
    
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
        <tr>
            <td>Order RP Requirement: </td>
            <td><?php echo $order_rp_cost; ?></td>
        </tr>
        <tr>
            <td>Ranks: </td>
            <td>(<?php echo anchor('faction/view_ranks/'.$faction->faction_id, 'VIEW'); ?>)</td>
        </tr>
    </table>
    
    <h2>Player List <small>(<?php echo anchor('faction/join/'.$faction->faction_id, 'join'); ?>)</small></h2>
    <table class="table table-striped">
        <tr>
            <th>User</th>
            <th>Rank</th>
            <th>&nbsp;</th>
        </tr>
    <?php foreach($players as $p): ?>
    
    <tr>
        <td><?php echo $p->name; ?></td>
        <td><?php echo $p->rank; ?></td>
        <td><?php echo anchor('player/view/'.$p->user_id, 'VIEW'); ?></td>
    </tr>
        
    <?php endforeach; ?>
    </table>
    
    <h2>Combat Commands <small>(<?php echo anchor('command/create/'.$faction->faction_id, 'add'); ?>)</small></h2>
    <table class="table table-striped tablesorter">
        <thead><tr>
            <th>Name</th>
            <th>Experience</th>
            <th>Loyalty</th>
            <th>Fatigue</th>
            <th>In Supply</th>
            <th>Location</th>
            <th>In Combat</th>
            <th>Has Orders</th>
            <th>&nbsp;</th>
            </tr></thead>
    <?php foreach($commands as $c): ?>
    
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
        
    <?php endforeach; ?>
    </table>
    
</div>
