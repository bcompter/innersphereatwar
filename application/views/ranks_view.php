<div class="container">
    
    <ol class="breadcrumb">
        <li><?php echo anchor('faction/view/'.$faction->faction_id, 'Faction View'); ?></li>
    </ol> 
    
    <h1><?php echo $faction->name; ?> Ranks</h1>
    
    <h2>Ranks <small>(<?php echo anchor('ranks/create/'.$faction->faction_id, 'add'); ?>)</small></h2>
    <table class="table table-striped tablesorter">
        <thead>
            <tr>
                <th>Order</th>
                <th>Rank</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
    <?php foreach($ranks as $r): ?>
    
        <tr>
            <td><?php echo $r->order_num; ?></td>
            <td><?php echo $r->text; ?></td>
            <td><?php echo anchor('ranks/delete/'.$r->rank_id, 'delete'); ?></td>
        </tr>
        
    <?php endforeach; ?>
    </table>
    
</div>