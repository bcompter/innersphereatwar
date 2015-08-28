<div class="container">
    <?php echo anchor('planet/view_game/'.$planet->game_id, '<< Planet List') ?>
    <h1><?php echo $planet->name; ?></h1>
    <div class="col-md-7">
    <table class="table table-striped">
        <tr><td>Owner</td><td><?php $planet->faction_name; ?></td></tr>
        <tr>    <td>Type</td><td><?php echo $planet->type; ?></td></tr>
        <tr>    <td>X</td><td><?php echo $planet->x; ?></td></tr>
        <tr>    <td>Y</td><td><?php echo $planet->y; ?></td></tr>
        <tr>    
            <td>Salvage Pool (<?php echo anchor('planet/clear_salvage/'.$planet->planet_id, 'clear'); ?>)</td>
            <td><?php echo $planet->salvage_pool; ?></td>
        </tr>
    </table>
    </div>
    <div class="col-md-10">
        <h2> <?php echo anchor('planet/view_aero/'.$planet->planet_id,'AERO MAP'); ?> | <?php echo anchor('planet/view_ground/'.$planet->planet_id, 'GROUND MAP'); ?> </h2>
    </div>
    
    <div class="col-md-10">
        <h2>Also Here</h2>
        <table class="table table-striped">
            <tr>
                <th>Combat Commands</th>
                <th>Faction</th>
                <th>&nbsp;</th>
            </tr>
            
            <?php foreach($commands as $c): ?>
            <tr>
                <td><?php echo $c->name; ?></td>
                <td><?php echo $c->faction_name; ?></td>
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
    
    <div class="col-md-10">
        <h2>DANGER ZONE</h2>
        <p>
            (<?php echo anchor('planet/delete/'.$planet->planet_id, 'delete'); ?>)
        </p>
    </div>
</div>