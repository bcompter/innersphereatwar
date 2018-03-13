<div class="container">
    
    <ol class="breadcrumb">
        <li><?php echo anchor('game/view/'.$planet->game_id, 'Game'); ?></li>
        <li><?php echo anchor('planet/view_game/'.$planet->game_id, 'Planets'); ?></li>       
    </ol>     
    
    <h1><?php echo $planet->name; ?></h1>
    <div class="row">
        <div class="col-md-7">
            <table class="table table-striped">
                <tr><td>Owner</td><td><?php $planet->faction_name; ?></td></tr>
                <?php $this->load->view('planet_view__type'); ?>
                <tr>    <td>X</td><td><?php echo $planet->x; ?></td></tr>
                <tr>    <td>Y</td><td><?php echo $planet->y; ?></td></tr>
                <tr>    
                    <td>Salvage Pool (<?php echo anchor('planet/clear_salvage/'.$planet->planet_id, 'clear'); ?>)</td>
                    <td><?php echo $planet->salvage_pool; ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-5 local_map">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Local Star Map</h3>
                </div>
                <div class="panel-body">
                    <?php $this->load->view('planet_star_map'); ?>
                </div>
          </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10">
            <h2> <?php echo anchor('planet/view_aero/'.$planet->planet_id,'AERO MAP'); ?> | <?php echo anchor('planet/view_ground/'.$planet->planet_id, 'GROUND MAP'); ?> </h2>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10">
            <h2>Also Here</h2>
            <table class="table table-striped">
                <tr>
                    <th>Combat Commands</th>
                    <th>Experience</th>
                    <th>Faction</th>
                    <th>&nbsp;</th>
                </tr>

                <?php foreach($commands as $c): ?>
                <tr>
                    <td><?php echo $c->name; ?></td>
                    <td><?php echo $c->experience; ?></td>
                    <td><?php echo anchor('faction/view/'.$c->faction_id, $c->faction_name); ?></td>
                    <td>
                        <?php echo anchor('command/view/'.$c->command_id, 'VIEW'); ?>
                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10">
            <h2>Nearby Systems</h2>
            <table class="table table-striped">
                <tr>
                    <th>Planet</th>
                    <th>Distance (light years)</th>
                    <th>&nbsp;</th>
                </tr>

                <?php foreach ($planets as $p): ?>
                <?php $rough_distance = abs($planet->x - $p->x) + abs($planet->y - $p->y); ?>
                <?php if ($rough_distance < 45 && $p->planet_id != $planet->planet_id): ?>
                <tr>
                    <td><?php echo $p->name; ?></td>
                    <td><?php echo sqrt(pow($planet->x - $p->x,2) + pow($planet->y - $p->y, 2)); ?></td>
                    <td><?php echo anchor('planet/view/'.$p->planet_id, 'VIEW'); ?></td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>

            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10">
            <h2>DANGER ZONE</h2>
            <p>
                (<?php echo anchor('planet/delete/'.$planet->planet_id, 'delete'); ?>)
            </p>
        </div>
    </div>
</div>