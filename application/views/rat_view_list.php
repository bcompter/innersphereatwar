<div class="container">
    <h1>RAT List</h1>
    
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Faction</th>
            <th>Type</th>
            <th>Class</th>
            <th>&nbsp;</th>
        </tr>
    <?php foreach($rats as $r): ?>
        <tr>
            <td><?php echo $r->name; ?></td>
            <td><?php echo $r->faction; ?></td>
            <td><?php echo $r->type; ?></td>
            <td><?php echo $r->class; ?></td>
            <td><?php echo anchor('rat/view/'.$r->rat_id, 'VIEW'); ?></td>
        </tr>    
    <?php endforeach; ?>
    </table>
</div>