<div class="container">
    <h1>Create a New Unit</h1>
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="<?php echo base_url('index.php/unit/create'); ?>" method="post">
        <div class="form-group">
            <label class="col-md-2 control-label">Name</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" placeholder="Name">
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
            <label class="col-md-2 control-label">Move</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="move" placeholder="Move">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Jump</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="jump" placeholder="Jump">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Armor</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="armor" placeholder="Armor Value">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Structure</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="structure" placeholder="Structure">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Short</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="short" placeholder="Short">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Medium</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="medium" placeholder="Medium">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Long</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="long" placeholder="Long">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Overheat</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="overheat" placeholder="Overheat">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Special</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="special" placeholder="Special">
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>