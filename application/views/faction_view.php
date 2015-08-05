<div class="container">
    <h1><?php echo $faction->name; ?></h1>
    <h2>Data</h2>
    <ul>
        <li>...</li>
        <li>...</li>
        <li>...</li>
    </ul>
    
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
            <th>&nbsp;</th>
        </tr>
    <?php foreach($commands as $c): ?>
    
        <tr>
            <td><?php echo $c->name; ?></td>
            <td><?php echo anchor('command/view/'.$c->command_id, 'VIEW'); ?></td>
        </tr>
        
    <?php endforeach; ?>
    </table>
    
</div>