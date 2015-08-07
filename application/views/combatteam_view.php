<div class="container">
    <h1>Combat Team, <?php echo $combatteam->name ?> <small>(<?php echo anchor('combatteam/clear/'.$combatteam->combatteam_id, 'clear'); ?>)</small></h1>
    <table class="table">
        <tr><th>Formation</th><td><?php echo anchor('combatunit/view/'.$combatunit->combatunit_id, $combatunit->name); ?></td></tr>
        <tr><th>Size</th><td><?php echo $combatteam->size; ?></td></tr>
        <tr><th>Move</th><td><?php echo $combatteam->move; ?></td></tr>
        <tr><th>TMM</th><td><?php echo $combatteam->tmm; ?></td></tr>
        <tr><th>ARM</th><td><?php echo $combatteam->armor; ?></td></tr>
        <tr><th>Short</th><td><?php echo $combatteam->short_dmg; ?></td></tr>
        <tr><th>Medium</th><td><?php echo $combatteam->med_dmg; ?></td></tr>
        <tr><th>Long</th><td><?php echo $combatteam->long_dmg; ?></td></tr>
        
    </table>
    
    <h2>Lances<small> (<?php echo anchor('combatteam/generate/'.$combatteam->combatteam_id, 'generate'); ?>)</small></h2>
    <table class="table table-striped">
        <tr>
            <th>Lance</th>
            <th>Size</th>
            <th>Move</th>
            <th>TMM</th>
            <th>Arm</th>
            <th>S</th>
            <th>M</th>
            <th>L</th>
        </tr>
        <?php $lanceNum = 1; foreach($lances as $l): ?>
        <tr>
            <td><?php echo 'Lance '.$lanceNum++; ?></td>
            <td><?php echo $l->weight; ?></td>
            <td><?php echo $l->move; ?></td>
            <td><?php echo $l->tmm; ?></td>
            <td><?php echo $l->armor; ?></td>
            <td><?php echo $l->short_dmg; ?></td>
            <td><?php echo $l->med_dmg; ?></td>
            <td><?php echo $l->long_dmg; ?></td>
        </tr>
        <?php endforeach; $lanceNum = 1; ?>
    </table>
    
    <h2>Elements</h2>
    <table class="table table-striped">
        <tr>
            <th>Unit</th>
            <th>Size</th>
            <th>Move</th>
            <th>Jump</th>
            <th>Arm</th>
            <th>Str</th>
            <th>S</th>
            <th>M</th>
            <th>L</th>
            <th>OV</th>
            <th>Special</th>
        </tr>
        <?php $lanceNum = 1; foreach($lances as $l): ?>
        <tr>
            <th colspan="12">Lance <?php echo $lanceNum++; ?></th>
        </tr>
        
        <?php foreach($elements as $e1): foreach($e1 as $e): ?>
        <?php if ($e->lance_id == $l->lance_id): ?>
        <tr>
            <td><?php echo $e->name ?></td>
            <td><?php echo $e->weight; ?></td>
            <td><?php echo $e->move; ?></td>
            <td><?php echo $e->jump; ?></td>
            <td><?php echo $e->armor; ?></td>
            <td><?php echo $e->structure; ?></td>
            <td><?php echo $e->short_dmg; ?></td>
            <td><?php echo $e->med_dmg; ?></td>
            <td><?php echo $e->long_dmg; ?></td>
            <td><?php echo $e->overheat; ?></td>
            <td><?php echo $e->special; ?></td>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endforeach; ?>
        <?php endforeach; ?>
    </table>
    
</div>