<div class="container">
    <h1><?php echo $formation->name ?></h1>
    <table class="table">
        <tr><th>Combat Command</th><td><?php echo anchor('command/view/'.$command->command_id, $command->name); ?></td></tr>
        <tr><th>Type</th><td><?php echo $formation->type; ?></td></tr>
        <tr><th>Move</th><td><?php echo $formation->move; ?></td></tr>
        <tr><th>Tactics</th><td><?php echo $formation->tactics; ?></td></tr>
        <tr><th>Morale</th><td><?php echo $formation->morale; ?></td></tr>
    </table>
    
    <h2>Combat Units <small>(<?php echo anchor('formation/add_combatunit/'.$formation->formation_id, 'add'); ?>)</small></h2>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Size</th>
            <th>Move</th>
            <th>TMM</th>
            <th>ARM</th>
            <th>S</th>
            <th>M</th>
            <th>L</th>
            <th>Tactics</th>
            <th>Morale</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach($combatunits as $c): ?>
        <tr>
            <td><?php echo $c->name; ?></td>
            <td><?php echo $formation->type; ?></td>
            <td><?php echo $c->size; ?></td>
            <td><?php echo $c->move; ?></td>
            <td><?php echo $c->tmm; ?></td>
            <td><?php echo $c->arm; ?></td>
            <td><?php echo $c->s; ?></td>
            <td><?php echo $c->m; ?></td>
            <td><?php echo $c->l; ?></td>
            <td><?php echo $c->tactics; ?></td>
            <td><?php echo $c->morale; ?></td>
            
            <td><?php echo anchor('combatunit/view/'.$c->combatunit_id, 'VIEW'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</div>