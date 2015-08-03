<div class="container">
    <h1>Planet List</h1>
    
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Owner</th>
            <th>Type</th>
            <th>X</th>
            <th>Y</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
    <?php foreach($planets as $p): ?>
        <tr>
            <td><?php echo $p->name; ?></td>
            <td><?php echo $p->owner; ?></td>
            <td><?php echo $p->type; ?></td>
            <td><?php echo $p->x; ?></td>
            <td><?php echo $p->y; ?></td>
            <td><?php echo $p->status; ?></td>
            <td><?php echo anchor('planet/view/'.$p->planet_id, 'VIEW'); ?></td>
        </tr>    
    <?php endforeach; ?>
    </table>
</div>