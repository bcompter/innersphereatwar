<div class="container">
    <h1><?php echo $game->name; ?></h1>
    <ul>
        <li>Turn: <?php echo $game->turn; ?></li>
    </ul>
    <h2>List of Factions <small>(<?php echo anchor('faction/create/'.$game->game_id, 'add'); ?>)</small></h2>
    <p>...</p>
</div>
