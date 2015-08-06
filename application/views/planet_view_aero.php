<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h1><?php echo $planet->name; ?><small> Star System Radar Map</small></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            
            <img src="<?php echo base_url('images/spacemap.png') ?>" />
            
            <?php 
                // Display each token on this view
                foreach ($tokens as $t)
                {
                    unset($data);
                    $data['token'] = $t;
                    log_message('error', $t->x.' '.$t->y);
                    $this->load->view('token_view', $data);
                }
            ?>

            
        </div>
    </div>
</div>