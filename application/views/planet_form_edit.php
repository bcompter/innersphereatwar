<div class="container">
    <h1>Edit the Planet <?php echo $planet->name; ?></h1>
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="<?php echo base_url('index.php/planet/edit/'.$planet->planet_id); ?>" method="post">
        <div class="form-group">
            <label class="col-md-2 control-label">Name</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" value="<?php echo $planet->name; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Type</label>
            <div class="col-md-10">
                <select class="form-control" name="type" value="<?php echo $planet->type; ?>">
                    <option>Capital</option>
                    <option>Regional</option>
                    <option>Hyper</option>
                    <option>Major</option>
                    <option>Minor</option>
                    <option>Other</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">X Position</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="x" placeholder="X Position" value="<?php echo $planet->x; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Y Position</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="y" placeholder="Y Position" value="<?php echo $planet->y; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>