<div class="container">
    <h1><?php echo $planet->name; ?></h1>
    <table class="table table-striped">
        <tr>    <td>Type</td><td><?php echo $planet->type; ?></td></tr>
        <tr>    <td>X</td><td><?php echo $planet->x; ?></td></tr>
        <tr>    <td>Y</td><td><?php echo $planet->y; ?></td></tr>
    </table>
    
    <div class="col-md-10">
        <h2> <?php echo anchor('planet/view_aero/'.$planet->planet_id,'AERO MAP'); ?> | <?php echo anchor('planet/view_ground/'.$planet->planet_id, 'GROUND MAP'); ?> </h2>
    </div>
    
    <div class="col-md-10">
        <h2>Also Here</h2>
        <table class="table table-striped">
            <tr>
                <th>Combat Commands</th>
                <th>&nbsp;</th>
            </tr>
            
            <?php foreach($commands as $c): ?>
            <tr>
                <td><?php echo $c->name; ?></td>
                <td>
                    <?php echo anchor('command/view/'.$c->command_id, 'VIEW'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            
        </table>
    </div>
    
    <div class="col-md-10">
        <h2>Nearby Systems</h2>
        <table class="table table-striped">
            <tr>
                <th>Planet</th>
                <th>&nbsp;</th>
            </tr>
            
            <tr>
                <td>...</td>
                <td>VIEW</td>
            </tr>
        </table>
    </div>
</div>