<div class="container">
    
    <ol class="breadcrumb">
        <li><?php echo anchor('home/dashboard', 'Dashboard'); ?></li>
        <li><?php echo anchor('game/view_all', 'Game List'); ?></li>
    </ol>
    
    <h1><?php echo $game->name; ?></h1>
    <ul>
        <li>Turn: <?php echo $game->turn; ?> (<?php echo anchor('game/update_turn/'.$game->game_id.'/-1', '-'); ?> / <?php echo anchor('game/update_turn/'.$game->game_id.'/1', '+'); ?>)</li>
        <li><?php echo anchor('game/resolution/'.$game->game_id, 'Resolution'); ?></li>
    </ul>
    <h2>List of Factions <small>(<?php echo anchor('faction/create/'.$game->game_id, 'add'); ?>)</small></h2>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($factions as $f): ?>
        <tr>
            <td><?php echo $f->name; ?></td>
            <td><?php echo anchor('faction/view/'.$f->faction_id, 'VIEW'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <h2><?php echo anchor('planet/view_game/'.$game->game_id, 'View Planets'); ?></h2>
</div>
