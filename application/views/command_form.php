<div class="container">
    <h1>Create a New Combat Command</h1>
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="<?php echo base_url('index.php/command/create/'.$faction->faction_id); ?>" method="post">
        <div class="form-group">
            <label class="col-md-2 control-label">Name</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Experience</label>
            <div class="col-md-10">
                <select class="form-control" name="experience">
                    <option>Green</option>
                    <option>Regular</option>
                    <option>Veteran</option>
                    <option>Elite</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Loyalty</label>
            <div class="col-md-10">
                <select class="form-control" name="loyalty">
                    <option>Questionable</option>
                    <option>Reliable</option>
                    <option>Fanatical</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Equipment Rating</label>
            <div class="col-md-10">
                <select class="form-control" name="tech">
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>Special</option>
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