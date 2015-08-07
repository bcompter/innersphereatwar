<div 
    class="token" 
    action="<?php echo base_url('index.php/token/update_position/'.$token->token_id);  ?>" 
    id="<?php echo $token->token_id ?>"
    style="top:<?php echo $token->y; ?>px; left:<?php echo $token->x; ?>px; background-color:<?php echo $token->color; ?>;">
    <table>
        <tr>
            <?php if($token->detected): ?>
            <td><div class="inline"><img src="<?php echo base_url('images/mech.png'); ?>"></div></td>
            <td><div><h1><?php echo substr($token->formation_name, 0, 2); ?></h1></div></td>
            <?php else: ?>
            <td><div class="inline"><img src="<?php echo base_url('images/radar.png'); ?>"></div></td>
            <?php endif; ?>
        </tr>        
    </table>
    
</div>