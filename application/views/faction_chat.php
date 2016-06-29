<div class="container">
    
    <ol class="breadcrumb">
        <li><?php echo anchor('game/view/'.$faction->game_id, 'Game'); ?></li>
        <li><?php echo anchor('faction/view/'.$faction->factione_id, 'Faction'); ?></li>
    </ol> 
    
    <div class="row">
        <h1><?php echo $faction->name; ?> Chat room</h1>
    </div>
    <div class="row">
        <div class="col-md-8" id="chat_window"> 
            
        </div>
        <div class="col-md-4" id="who_window"> 
            Lobby
        </div>    
    </div>
    <div class="row">
        <div class="col-md-12"> 
            <form class="form-inline" 
                  action="<?php echo base_url('faction/chat_new/'.$faction->faction_id); ?>" 
                  method="post"
                  load_url="<?php echo base_url('faction/chat_load/'.$faction->faction_id); ?>" 
                  update_url="<?php echo base_url('faction/chat_update/'.$faction->faction_id); ?>">
                
                <div class="form-group">
                    <label for="chatmsg">Chat</label>
                    <input type="text" class="form-control" id="chatmsg" placeholder="Message">
                </div>
                <button type="submit" class="btn btn-default" id="chat_submit">Send</button>
            </form>
        </div>  
    </div>
</div>