<div class="container">
    <h1>Create a new RAT Table</h1>
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="<?php echo base_url('index.php/rat/create'); ?>" method="post">
        <div class="form-group">
            <label class="col-md-2 control-label">Name</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Faction</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="faction" placeholder="Faction">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Tech</label>
            <div class="col-md-10">
                <select class="form-control" name="type">
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>Special</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Type</label>
            <div class="col-md-10">
                <select class="form-control" name="type">
                    <option>Mech</option>
                    <option>Vehicle</option>
                    <option>Aero</option>
                    <option>Infantry</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Size</label>
            <div class="col-md-10">
                <select class="form-control" name="size">
                    <option>Light</option>
                    <option>Medium</option>
                    <option>Heavy</option>
                    <option>Assault</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>