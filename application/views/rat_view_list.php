<script type="text/javascript" <?php echo 'src="'.$this->config->item('base_url').'tablesorter.js"'; ?>></script> 

<script type="text/javascript">
    $(document).ready(function() 
        { 
            $(".sortable").tablesorter(); 
        } 
    ); 
</script>

<div class="container">
    <h1>RAT List <small>(<?php echo anchor('rat/create/', 'add'); ?>)</small></h1>
    
    <table class="table table-striped tablesorter">
        <thead><tr>
            <th>Name</th>
            <th>Faction</th>
            <th>Type</th>
            <th>Size</th>
            <th>Tech</th>
            <th>&nbsp;</th>
        </tr></thead>
    <?php foreach($rats as $r): ?>
        <tr>
            <td><?php echo $r->name; ?></td>
            <td><?php echo $r->faction; ?></td>
            <td><?php echo $r->type; ?></td>
            <td><?php echo $r->size; ?></td>
            <td><?php echo $r->tech; ?></td>
            <td><?php echo anchor('rat/view/'.$r->rat_id, 'VIEW'); ?></td>
        </tr>    
    <?php endforeach; ?>
    </table>
</div>