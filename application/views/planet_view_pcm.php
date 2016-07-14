<script type="text/javascript">                                         
    // Set variables
    <?php echo 'var $updateurl = "'.base_url('index.php/planet/update/'.$planet->planet_id.'/ground').'";'; ?>
     
</script>
<script src="<?php echo base_url('pcm.js'); ?>"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Game Alerts</h3>
                </div>
                <div class="panel-body" id="game_info">
                    Panel content
                </div>
            </div>   
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Info Pane</h3>
                </div>
                <div class="panel-body" id="hex_info">
                    Panel content
                </div>
            </div>
            
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Map View</h3>
                </div>
                <div class="panel-body">
                    <div class="map_container">
                        <div class =" map_drag ui-draggable">
                            <?php $this->load->view('planet_view_pcm_hexes', $hex); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
    <div class="row">
        <div class="col-md-12">
            
                    <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Game Messages</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
        </div>
    </div>
</div>