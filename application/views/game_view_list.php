<script type="text/javascript" <?php echo 'src="'.$this->config->item('base_url').'tablesorter.js"'; ?>></script> 

<script type="text/javascript">
    $(document).ready(function() 
        { 
            $(".sortable").tablesorter(); 
        } 
    ); 
</script>

<div class="container">
    <h1>Game List <small>(<?php echo anchor('game/create', 'new'); ?>)</small></h1>
    
    <table class="table table-striped tablesorter sortable">
        <thead>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($games as $g): ?>
        <tr>
            <td><?php echo $g->name; ?></td>
            <td><?php echo anchor('game/view/'.$g->game_id, 'VIEW'); ?></td>
        </tr>    
        <?php endforeach; ?>
        </tbody>
    </table>
</div>