<div class="container">
    
    <ol class="breadcrumb">
        <li><?php echo anchor('game/view/'.$game->game_id, 'Game'); ?></li>     
    </ol> 
    
    <h1><?php echo $game->name; ?></h1>
    <h2>Game Resolution Dashboard</h2>
    
    <!-- Banking resource points -->
    <div class="row">
        <div class="col-md-9">
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Bank Resource Points
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Execute
            </button>
        </div>
    </div>
    
    <!-- Calculate resource points -->
    <div class="row">
        <div class="col-md-9">
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Calculate Resource Points
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    
    <!-- Order Writing -->
    <div class="row">
        <div class="col-md-9">
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Order Writing
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
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
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Infrastructure
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    
    <!-- Mercenary Supply -->
    <div class="row">
        <div class="col-md-9">
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Mercenary Supply
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    
    <!-- Mercenary Hiring -->
    <div class="row">
        <div class="col-md-9">
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Mercenary Hiring
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    
    <!-- Fortifications -->
    <div class="row">
        <div class="col-md-9">
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Fortifications
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    
    <!-- Diplomacy -->
    <div class="row">
        <div class="col-md-9">
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Diplomacy
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    
    <div class="row top17">
        <div class="col-md-12">
            <h3>
                Military
            </h3>
        </div>
    </div>
    
    <!-- Raids -->
    <div class="row">
        <div class="col-md-9">
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Raids
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    
    <!-- Military sub-phase 1 -->
    <div class="row">
        <div class="col-md-9">
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Sub-phase 1
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h4>ACS Turn 1</h4>
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
            <h4>ACS Turn 2</h4>
        </div>
        <div class="col-md-4">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                    20%
                </div>
            </div>
        </div>
    </div>
    
    <!-- Military sub-phase 2 -->
    <div class="row">
        <div class="col-md-9">
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Sub-phase 2
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
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
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Sub-phase 3
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
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
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                Sub-phase 4
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
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
            <h3>
                <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
                End Phase
            </h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default btn-lg" disabled="disabled">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Waiting
            </button>
        </div>
    </div>
    
</div>