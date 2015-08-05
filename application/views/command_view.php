<div class="container">
    <h1><?php echo $command->name ?></h1>
    <table class="table">
        <tr>
            <th>Name</th><td><?php echo $command->name; ?></td>
        </tr>
        <tr>
            <th>Experience</th><td><?php echo $command->experience; ?></td>
        </tr>
        <tr>
            <th>Loyalty</th><td><?php echo $command->loyalty; ?></td>
        </tr>
        <tr>
            <th>Location</th><td><?php echo anchor('planet/view/'.$planet->planet_id, $planet->name); ?></td>
        </tr>

    </table>
    
    <h2>Formations <small>(<?php echo anchor('command/add_formation/'.$command->command_id, 'add'); ?>)</small></h2>
    ...
    
</div>