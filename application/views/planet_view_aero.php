<div class="container">
    <div class="row">
        <div class="col-md-10">
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <img href="<?php echo base_url('/images/planet_view_aero.png') ?>">
            
            <?php 
                // Display each token on this view
                foreach ($tokens as $t)
                {
                    $data = new stdClass();
                    $data['token'] = $t;
                    $this->load->view('token_view', $data);
                }
            ?>

            
        </div>
    </div>
</div>