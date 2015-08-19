<div class="container">
    <h1>Add a Combat Unit to <?php echo $formation->name; ?></h1>
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="<?php echo base_url('index.php/formation/add_combatunit/'.$formation->formation_id); ?>" method="post">
        <div class="form-group">
            <label class="col-md-2 control-label">Name</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Size</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="size" placeholder="Size">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Move</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="move" placeholder="Movement">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">TMM</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="tmm" placeholder="Target Movement Modifier">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">ARM</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="arm" placeholder="Armor">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Short</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="short_dmg" placeholder="short">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Medium</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="med_dmg" placeholder="Medium">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Long</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="long_dmg" placeholder="Long">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Tactics</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="tactics" placeholder="Tactics">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Morale</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="morale" placeholder="Morale">
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>