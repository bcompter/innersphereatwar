<div class="container">
    <h1>Move the Combat Command, <?php echo $command->name; ?>, to a New Planet</h1>

    <table class="table table-striped">
        <tr>
            <th>Planet</th>
            <th>&nbsp</th>
        </tr>
        <?php foreach($planets as $p): ?>
            
        <tr>
            <td><?php echo $p->name; ?></td>
            <td><?php echo anchor('command/move/'.$command->command_id.'/'.$p->planet_id, 'MOVE'); ?></td>
        </tr>        
        
        <?php endforeach; ?>
    </table>
    
</div>