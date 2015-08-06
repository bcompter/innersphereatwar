<div class="container">
    <h1><?php echo $combatunit->name ?></h1>
    <table class="table">
        <tr>
            <th>Formation</th><td><?php echo anchor('formation/view/'.$formation->formation_id, $formation->name); ?></td>
        </tr>
    </table>
    
    <h2>Combat Teams <small>(<?php echo anchor('combatunit/add_combatteam/'.$combatunit->combatunit_id, 'add'); ?>)</small></h2>
    <table>
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
            <th>Skill</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach($combatteams as $c): ?>
        <tr>
            <td><?php echo $c->name; ?></td>
            <td><?php echo $c->type; ?></td>
            <td><?php echo $c->size; ?></td>
            <td><?php echo $c->move; ?></td>
            <td><?php echo $c->tmm; ?></td>
            <td><?php echo $c->arm; ?></td>
            <td><?php echo $c->short_dmg; ?></td>
            <td><?php echo $c->medium_dmg; ?></td>
            <td><?php echo $c->long_damage; ?></td>
            <td><?php echo $c->tactics; ?></td>
            <td><?php echo $c->morale; ?></td>
            <td><?php echo $c->skill; ?></td>
            
            <td><?php echo anchor('combatteam/view/'.$c->combatteam_id, 'VIEW'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</div>