<script type="text/javascript">                                         
    // Set variables
    <?php echo 'var $updateurl = "'.base_url('index.php/planet/update/'.$planet->planet_id.'/ground').'";'; ?>
     
</script>

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
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Hex Info</h3>
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
                        <?php $this->load->view('planet_view_pcm_hexes'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Unit Info</h3>
                </div>
                <div class="panel-body" id="unit_info">
                    Panel content
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