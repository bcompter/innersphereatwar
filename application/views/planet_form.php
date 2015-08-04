<div class="container">
    <h1>Create a New Planet</h1>
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="<?php echo base_url('index.php/planet/create/'.$game->game_id); ?>" method="post">
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
                <input type="text" class="form-control" name="x" placeholder="X Position">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Y Position</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="y" placeholder="Y Position">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>