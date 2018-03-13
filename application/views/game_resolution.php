<div class="container">
    
    <ol class="breadcrumb">
        <li><?php echo anchor('game/view/'.$game->game_id, 'Game'); ?></li>     
    </ol> 
    
    <h1><?php echo $game->name; ?></h1>
    <h2>Game Resolution Dashboard <small>(<?php echo $game->phase; ?>)</small></h2>
    
    <form action="<?php echo base_url('index.php/game/resolution/'.$game->game_id); ?>" method="post">
    
    <!-- Banking resource points -->
    <div class="row">
        <div class="col-md-9">
            <h4> 
                Bank Resource Points
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button submit" class="btn btn-default btn-md" <?php echo ($game->phase == 'bank_rp' ? '' : 'disabled="disabled"') ?> formaction="<?php echo base_url('index.php/game/bank_rp/'.$game->game_id); ?>">
                <?php if ($game->phase == 'bank_rp'): ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Execute
                <?php else: ?>
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Done
                <?php endif; ?>
                
            </button>
        </div>
    </div>
    
    <!-- Calculate resource points -->
    <div class="row">
        <div class="col-md-9">
            <h4>
                Calculate Resource Points
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button submit" class="btn btn-default btn-md" <?php echo ($game->phase == 'calc_rp' ? '' : 'disabled="disabled"') ?> formaction="<?php echo base_url('index.php/game/calc_rp/'.$game->game_id); ?>">
                <?php if ($game->phase == 'calc_rp'): ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Execute
                <?php elseif ($game->phase > 'calc_rp'): ?>
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Done
                <?php else: ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
                <?php endif; ?>
            </button>
        </div>
    </div>
    
    <!-- Order Writing -->
    <div class="row">
        <div class="col-md-9">
            <h4>
                Order Writing
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-md" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            &nbsp;
        </div>
        <div class="col-md-11">
            Order Deadline: UTC August 21, 2016 12:00:00 
        </div>
    </div>
    
    <!-- Infrastructure -->
    <div class="row top17">
        <div class="col-md-9">
            <h4>
                Infrastructure
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button submit" class="btn btn-default btn-md" <?php echo ($game->phase == 'infrastructure' ? '' : 'disabled="disabled"') ?> formaction="<?php echo base_url('index.php/game/infrastructure/'.$game->game_id); ?>">
                <?php if ($game->phase == 'infrastructure'): ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Execute
                <?php elseif ($game->phase > 'infrastructure'): ?>
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Done
                <?php else: ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
                <?php endif; ?>
            </button>
        </div>
    </div>
    
    <!-- Mercenary Supply -->
    <div class="row">
        <div class="col-md-9">
            <h4>
                Mercenary Supply
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button submit" class="btn btn-default btn-md" <?php echo ($game->phase == 'merc_supply' ? '' : 'disabled="disabled"') ?> formaction="<?php echo base_url('index.php/game/merc_supply/'.$game->game_id); ?>">
                <?php if ($game->phase == 'merc_supply'): ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Execute
                <?php elseif ($game->phase > 'merc_supply'): ?>
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Done
                <?php else: ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
                <?php endif; ?>
            </button>
        </div>
    </div>
    
    <!-- Mercenary Hiring -->
    <div class="row">
        <div class="col-md-9">
            <h4>
                Mercenary Hiring
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button submit" class="btn btn-default btn-md" <?php echo ($game->phase == 'merc_hiring' ? '' : 'disabled="disabled"') ?> formaction="<?php echo base_url('index.php/game/merc_hiring/'.$game->game_id); ?>">
                <?php if ($game->phase == 'merc_hiring'): ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Execute
                <?php elseif ($game->phase > 'merc_hiring'): ?>
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Done
                <?php else: ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
                <?php endif; ?>
            </button>
        </div>
    </div>
    
    <!-- Fortifications -->
    <div class="row">
        <div class="col-md-9">
            <h4>
                Fortifications
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button submit" class="btn btn-default btn-md" <?php echo ($game->phase == 'fortifications' ? '' : 'disabled="disabled"') ?> formaction="<?php echo base_url('index.php/game/fortifications/'.$game->game_id); ?>">
                <?php if ($game->phase == 'fortifications'): ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Execute
                <?php elseif ($game->phase > 'fortifications'): ?>
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Done
                <?php else: ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
                <?php endif; ?>
            </button>
        </div>
    </div>
    
    <!-- Diplomacy -->
    <div class="row">
        <div class="col-md-9">
            <h4>
                Diplomacy
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button submit" class="btn btn-default btn-md" <?php echo ($game->phase == 'diplomacy' ? '' : 'disabled="disabled"') ?> formaction="<?php echo base_url('index.php/game/diplomacy/'.$game->game_id); ?>">
                <?php if ($game->phase == 'diplomacy'): ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Execute
                <?php elseif ($game->phase > 'diplomacy'): ?>
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Done
                <?php else: ?>
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
                <?php endif; ?>
            </button>
        </div>
    </div>
    
    <div class="row top17">
        <div class="col-md-12">
            <h4>
                Military
            </h4>
        </div>
    </div>
    
    <!-- Raids -->
    <div class="row">
        <div class="col-md-9">
            <h4>
                Raids
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-md" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    
    <!-- Military sub-phase 1 -->
    <div class="row">
        <div class="col-md-9">
            <h4>
                Sub-phase 1
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-md" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <h4>ACS Turn 1</h4>
        </div>
        <div class="col-md-3">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                    60%
                </div>
            </div>
        </div>
        <div class="col-md-5">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <h4>ACS Turn 2</h4>
        </div>
        <div class="col-md-3">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                    20%
                </div>
            </div>
        </div>
        <div class="col-md-5">&nbsp;</div>
    </div>
    
    <!-- Military sub-phase 2 -->
    <div class="row">
        <div class="col-md-9">
            <h4>
                Sub-phase 2
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-md" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h4>ACS Turn 3</h4>
        </div>
        <div class="col-md-4">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                    60%
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h4>ACS Turn 4</h4>
        </div>
        <div class="col-md-4">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                    20%
                </div>
            </div>
        </div>
    </div>
    
    <!-- Military sub-phase 3 -->
    <div class="row">
        <div class="col-md-9">
            <h4>
                Sub-phase 3
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-md" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h4>ACS Turn 5</h4>
        </div>
        <div class="col-md-4">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                    60%
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h4>ACS Turn 6</h4>
        </div>
        <div class="col-md-4">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                    20%
                </div>
            </div>
        </div>
    </div>
    
    <!-- Military sub-phase 4 -->
    <div class="row">
        <div class="col-md-9">
            <h4>
                Sub-phase 4
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-md" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h4>ACS Turn 7</h4>
        </div>
        <div class="col-md-4">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                    60%
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h4>ACS Turn 8</h4>
        </div>
        <div class="col-md-4">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                    20%
                </div>
            </div>
        </div>
    </div>
    
    <!-- End Phase -->
    <div class="row">
        <div class="col-md-9">
            <h4>
                End Phase
            </h4>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-md" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    
    </form>
    
</div>