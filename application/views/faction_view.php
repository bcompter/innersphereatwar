<div class="container">
    <h1><?php echo $faction->name; ?></h1>
    <h2>Data</h2>
    <ul>
        <li>...</li>
        <li>...</li>
        <li>...</li>
    </ul>
    
    <h2>Player List <small>(<?php echo anchor('game/join/'.$game->game_id, 'join'); ?>)</small></h2>
    <?php foreach($players as $p): ?>
    
    <?php endforeach; ?>
</div>