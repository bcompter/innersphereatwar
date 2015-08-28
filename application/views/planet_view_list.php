<div class="container">
    <?php echo anchor('game/view/'.$game->game_id, '<< Game View'); ?>
    <h1>Planet List <small>(<?php echo anchor('planet/create/'.$game->game_id, 'add'); ?>)</small></h1>
    
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>X</th>
            <th>Y</th>
            <th>&nbsp;</th>
        </tr>
    <?php foreach($planets as $p): ?>
        <tr>
            <td><?php echo $p->name; ?></td>
            <td><?php echo $p->type; ?></td>
            <td><?php echo $p->x; ?></td>
            <td><?php echo $p->y; ?></td>
            <td><?php echo anchor('planet/view/'.$p->planet_id, 'VIEW'); ?></td>
        </tr>    
    <?php endforeach; ?>
    </table>
</div>