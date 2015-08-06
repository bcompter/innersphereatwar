<div class="container">
    <h1><?php echo $combatunit->name ?></h1>
    <table class="table">
        <tr><th>Formation</th><td><?php echo anchor('formation/view/'.$formation->formation_id, $formation->name); ?></td></tr>
        
        <tr><th>Size</th><td><?php echo $combatunit->size; ?></td></tr>
        <tr><th>Move</th><td><?php echo $combatunit->move; ?></td></tr>
        <tr><th>TMM</th><td><?php echo $combatunit->tmm; ?></td></tr>
        <tr><th>ARM</th><td><?php echo $combatunit->arm; ?></td></tr>
        <tr><th>Short</th><td><?php echo $combatunit->s; ?></td></tr>
        <tr><th>Medium</th><td><?php echo $combatunit->m; ?></td></tr>
        <tr><th>Long</th><td><?php echo $combatunit->l; ?></td></tr>
        <tr><th>Tactics</th><td><?php echo $combatunit->tactics; ?></td></tr>
        <tr><th>Morale</th><td><?php echo $combatunit->morale; ?></td></tr>
        
    </table>
    
    <h2>Combat Teams <small>(<?php echo anchor('combatunit/add_combatteam/'.$combatunit->combatunit_id, 'add'); ?>)</small></h2>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Size</th>
            <th>Move</th>
            <th>TMM</th>
            <th>ARM</th>
            <th>S</th>
            <th>M</th>
            <th>L</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach($combatteams as $c): ?>
        <tr>
            <td><?php echo $c->name; ?></td>
            <td><?php echo $c->size; ?></td>
            <td><?php echo $c->move; ?></td>
            <td><?php echo $c->tmm; ?></td>
            <td><?php echo $c->arm; ?></td>
            <td><?php echo $c->s; ?></td>
            <td><?php echo $c->m; ?></td>
            <td><?php echo $c->l; ?></td>
            
            <td><?php echo anchor('combatteam/view/'.$c->combatteam_id, 'VIEW'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</div>