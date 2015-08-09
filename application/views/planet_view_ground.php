<script type="text/javascript">                                         
    // Set variables
    <?php echo 'var $updateurl = \''.base_url('planet/update/'.$game->game_id).';'; ?>
     
</script>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h1><?php echo $planet->name; ?><small> Planetary Combat Map</small></h1>
            <table class="table">
                <tr>
                    <th>ISW Turn: </th>
                    <td><?php echo $game->turn; ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th>ACS Turn: </th>
                    <td><?php echo $planet->turn; ?></td>
                    <td><?php echo anchor('planet/update_turn/'.$planet->planet_id.'/-1', '-'); ?> / <?php echo anchor('planet/update_turn/'.$planet->planet_id.'/1', '+'); ?></td>
                </tr>
                <tr>    
                    <th>ACS Phase: </th>
                    <td><?php echo $planet->phase; ?></td>
                    <td><?php echo anchor('planet/update_phase/'.$planet->planet_id.'/-1', '-'); ?> / <?php echo anchor('planet/update_phase/'.$planet->planet_id.'/1', '+'); ?></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <h2>Token <small>Info</small></h2>
            <div id="token_info">
                ...
            </div>
        </div>
        <div class="col-md-2">
            <h2>Chat?</h2>
            <div id="chat">
                ...
            </div>
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