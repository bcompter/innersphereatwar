<script type="text/javascript" <?php echo 'src="'.$this->config->item('base_url').'tablesorter.js"'; ?>></script> 

<script type="text/javascript">
    $(document).ready(function() 
        { 
            $(".sortable").tablesorter(); 
        } 
    ); 
</script>

<div class="container">
    
    <ol class="breadcrumb">
        <li><?php echo anchor('game/view/'.$game->game_id, 'Game View'); ?></li>
    </ol> 
    
    
    
    <h1>Planet List <small>(<?php echo anchor('planet/create/'.$game->game_id, 'add'); ?>)</small></h1>
    
    <table class="table table-striped tablesorter">
        <thead><tr>
            <th>Name</th>
            <th>Type</th>
            <th>X</th>
            <th>Y</th>
            <th>&nbsp;</th>
        </tr></thead>
    <?php foreach($planets as $p): ?>
        <tr>
            <td><?php echo $p->name; ?></td>
            <td><?php echo $p->type; ?></td>
            <td><?php echo $p->x; ?></td>
            <td><?php echo $p->y; ?></td>
            <td>
                <?php echo anchor('planet/view/'.$p->planet_id, 'VIEW'); ?> | 
                <?php echo anchor('planet/edit/'.$p->planet_id, 'EDIT'); ?>
            </td>
        </tr>    
    <?php endforeach; ?>
    </table>
</div>