<div class="container">
    <h1>Add a New Rank for <?php echo $faction->name; ?></h1>
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="<?php echo base_url('index.php/ranks/create/'.$faction->faction_id); ?>" method="post">
        
        <div class="form-group">
            <label class="col-md-2 control-label">Rank Order</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="order_num" placeholder="Order">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Rank Name</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>