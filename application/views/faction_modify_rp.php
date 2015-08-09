<div class="container">
    <h1>Adjust Resource Points for <?php echo $faction->name; ?> <small>(<?php echo $faction->rp; ?>)</small></h1>
    <p>
        (Both positive and negative values accepted.)
    </p>
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="<?php echo base_url('index.php/faction/modify_rp/'.$faction->faction_id); ?>" method="post">
        
        
        <div class="form-group">
            <label class="col-md-2 control-label">Amount</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="amount" placeholder="Amount">
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>