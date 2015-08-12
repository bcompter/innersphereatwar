<div class="container">
    <h1>Edit Unit</h1>
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="<?php echo base_url('index.php/unit/edit/'.$unit->unit_id); ?>" method="post">
        <div class="form-group">
            <label class="col-md-2 control-label">Name</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $unit->name; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Type</label>
            <div class="col-md-10">
                <select class="form-control" name="type" value="<?php echo $unit->type; ?>">
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
                <select class="form-control" name="size" value="<?php echo $unit->size; ?>">
                    <option>Light</option>
                    <option>Medium</option>
                    <option>Heavy</option>
                    <option>Assault</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Move</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="move" value="<?php echo $unit->move; ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Jump</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="jump" value="<?php echo $unit->jump; ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Armor</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="armor" value="<?php echo $unit->armor; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Structure</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="structure" value="<?php echo $unit->structure; ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Short</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="short" value="<?php echo $unit->short_dmg; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Medium</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="medium" value="<?php echo $unit->med_dmg; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Long</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="long" value="<?php echo $unit->long_dmg; ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Overheat</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="overheat" value="<?php echo $unit->overheat; ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Special</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="special" value="<?php echo $unit->special; ?>">
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>