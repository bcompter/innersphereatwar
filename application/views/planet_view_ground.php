<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h1><?php echo $planet->name; ?></h1>
            <table class="table table-striped">
                <tr>    <td>Type</td><td><?php echo $planet->type; ?></td></tr>
                <tr>    <td>X</td><td><?php echo $planet->x; ?></td></tr>
                <tr>    <td>Y</td><td><?php echo $planet->y; ?></td></tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            
            <img src="<?php echo base_url('images/groundmap.png') ?>" />
            
            <?php 
                // Display each token on this view
                foreach ($tokens as $t)
                {
                    unset($data);
                    $data['token'] = $t;
                    $this->load->view('token_view', $data);
                }
            ?>

            
        </div>
    </div>
</div>