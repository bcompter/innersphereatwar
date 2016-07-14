<?php

if ( ! function_exists('game_message'))
{
    function game_message($game_id, $msg, $player_id=0)
    {
        $CI =& get_instance();
        $CI->load->model('gamemsgmodel');
        
        $gamemsg = new stdClass();
        $gamemsg->game_id = $game_id;
        $gamemsg->message = $msg;
        
        if ($player_id != 0)
            $gamemsg->player_id=$player_id;
        
        $CI->gamemsgmodel->create($gamemsg);
    }
}

