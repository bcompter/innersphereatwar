<div 
    class="token tokenlink" 
    action="<?php echo base_url('index.php/token/update_position/'.$token->token_id);  ?>"
    href="<?php echo base_url('index.php/token/view/'.$token->token_id);  ?>"
    id="<?php echo $token->token_id ?>"
    style="top:<?php echo $token->y; ?>px; left:<?php echo $token->x; ?>px; background-color:<?php echo $token->color; ?>;">
    <table>
        <tr>
            <?php if($token->detected || ( isset($player->faction_id) && $token->faction_id == $player->faction_id)): ?>
            <td>
                <div class="inline">
                    <?php if ($token->type == 'Mech'): ?>
                    <img src="<?php echo base_url('images/mech.png'); ?>">
                    <?php elseif ($token->type == 'Vehicle'): ?>
                    <img src="<?php echo base_url('images/vehicle.png'); ?>">
                    <?php elseif ($token->type == 'Aero'): ?>
                    <img src="<?php echo base_url('images/aero.png'); ?>">
                    <?php elseif ($token->type == 'Infantry'): ?>
                    <img src="<?php echo base_url('images/infantry.png'); ?>">
                    <?php endif; ?>
                </div>
            </td>
            <td><div><h1><?php echo substr($token->formation_name, 0, 2); ?></h1></div></td>
            <?php else: ?>
            <td><div class="inline"><img src="<?php echo base_url('images/radar.png'); ?>"></div></td>
            <td><h1><?php echo substr($token->token_id, -2); ?></h1></td>
            <?php endif; ?>
        </tr>
        <tr>
            <td><?php echo ($token->moved ? 'X' : 'O') ?></td>
            <td><?php echo substr($token->token_id, -2); ?></td>
        </tr>
    </table>
    
</div>