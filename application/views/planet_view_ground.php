<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h1><?php echo $planet->name; ?><small> Planetary Combat Map</small></h1>
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