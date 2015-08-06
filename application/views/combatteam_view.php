<div class="container">
    <h1><?php echo $combatteam->name ?></h1>
    <table class="table">
        <tr><th>Formation</th><td><?php echo anchor('combatunit/view/'.$combatunit->combatunit_id, $combatunit->name); ?></td></tr>
        <tr><th>Size</th><td><?php echo $combatteam->size; ?></td></tr>
        <tr><th>Move</th><td><?php echo $combatteam->move; ?></td></tr>
        <tr><th>TMM</th><td><?php echo $combatteam->tmm; ?></td></tr>
        <tr><th>ARM</th><td><?php echo $combatteam->arm; ?></td></tr>
        <tr><th>Short</th><td><?php echo $combatteam->s; ?></td></tr>
        <tr><th>Medium</th><td><?php echo $combatteam->m; ?></td></tr>
        <tr><th>Long</th><td><?php echo $combatteam->l; ?></td></tr>
        
    </table>
    
    <h2>Lances<small> (<?php echo anchor('combatteam/generate/'.$combatteam->combatteam_id, 'generate'); ?>)</small></h2>
    <table class="table table-striped">

    </table>
    
</div>