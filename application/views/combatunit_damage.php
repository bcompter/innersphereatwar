<div class="container">
    <h1>Damage Combat Unit <?php echo $combatunit->name; ?></h1>
    <p>(Negative damage will repair...)</p>
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="<?php echo base_url('index.php/combatunit/damage/'.$combatunit->combatunit_id); ?>" method="post">
        <div class="form-group">
            <label class="col-md-2 control-label">Damage</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="damage" placeholder="Damage">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>