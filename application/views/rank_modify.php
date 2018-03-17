<div class="container">
    
    <ol class="breadcrumb">
        <li><?php echo anchor('player/view/'.$player->player_id, 'Player View'); ?></li>
    </ol> 
    
    <h1>Modify Rank for <?php echo $player->name; ?> </h1>
    
    <h2>Available Ranks</h2>
    <table class="table table-striped tablesorter">
        <thead>
            <tr>
                <th>Rank</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
    <?php foreach($ranks as $r): ?>
    
        <tr>
            <td><?php echo $r->text; ?></td>
            <td><?php echo anchor('ranks/modify/'.$player->player_id.'/'.$r->rank_id, 'SET'); ?></td>
        </tr>
        
    <?php endforeach; ?>
    </table>
    
</div>