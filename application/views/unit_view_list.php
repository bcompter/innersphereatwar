<script type="text/javascript" <?php echo 'src="'.$this->config->item('base_url').'tablesorter.js"'; ?>></script> 

<script type="text/javascript">
    $(document).ready(function() 
        { 
            $(".sortable").tablesorter(); 
        } 
    ); 
</script>

<div class="container">
    <h1>Unit List <small>(<?php echo anchor('unit/create/', 'add'); ?>)</small></h1>
    
    <table class="table table-striped tablesorter">
        <thead><tr>
            <th>Name</th>
            <th>Type</th>
            <th>Size</th>
            <th>Move</th>
            <th>Jump</th>
            <th>Short</th>
            <th>Medium</th>
            <th>Long</th>
            <th>OV</th>
            <th>Armor</th>
            <th>Structure</th>
            <th>Special</th>
            <th>&nbsp;</th>
        </tr></thead>
    <?php foreach($units as $u): ?>
        <tr>
            <td><?php echo $u->name; ?></td>
            <td><?php echo $u->type; ?></td>
            <td><?php echo $u->size; ?></td>
            <td><?php echo $u->move; ?></td>
            <td><?php echo $u->jump; ?></td>
            <td><?php echo $u->short_dmg; ?></td>
            <td><?php echo $u->med_dmg; ?></td>
            <td><?php echo $u->long_dmg; ?></td>
            <td><?php echo $u->overheat; ?></td>
            <td><?php echo $u->armor; ?></td>
            <td><?php echo $u->structure; ?></td>
            <td><?php echo $u->special; ?></td>

            <td style="min-width:100px">
                <?php echo anchor('unit/view/'.$u->unit_id, 'VIEW'); ?> | 
                <?php echo anchor('unit/edit/'.$u->unit_id, 'EDIT'); ?>
            </td>
        </tr>    
    <?php endforeach; ?>
    </table>
</div>
