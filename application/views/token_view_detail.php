<table>
    <tr><th colspan="7"><?php echo $command->name; ?>, <?php echo $formation->name; ?></th></tr>
    
    <tr>
        <th>Move: <?php echo $formation->move; ?></th>
        <th>Skill:</th><td><?php echo $formation->experience; ?></td>
        <th>Tactics:</th><td><?php echo $formation->tactics; ?></td>
        <th>Morale:</th><td><?php echo $formation->morale; ?></td>
    </tr>
    <tr>
        <td><?php echo ($token->moved ? anchor('token/set_moved/'.$token->token_id.'/0', 'MOVED', 'class="tokenlink"') : anchor('token/set_moved/'.$token->token_id.'/1', 'NOT MOVED', 'class="tokenlink"')); ?></td>
        <td><?php echo ($token->detected ? anchor('token/set_detected/'.$token->token_id.'/0', 'DETECTED', 'class="tokenlink"') : anchor('token/set_detected/'.$token->token_id.'/1', 'RADAR', 'class="tokenlink"')); ?></td>
        <td><?php echo anchor('token/switch_role/'.$token->token_id, $formation->role, 'class="tokenlink"') ?></td>
        <td colspan="3">
            <?php echo 
                anchor('token/switch_tactics/'.$token->token_id, $formation->stance, 'class="tokenlink"')
                .' ('.$formation->stance_mod.') '
                .anchor('token/set_tactics_mod/'.$token->token_id.'/'.($formation->stance_mod-1), '-', 'class="tokenlink"').'/'
                .anchor('token/set_tactics_mod/'.$token->token_id.'/'.($formation->stance_mod+1), '+', 'class="tokenlink"'); ?>
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <th>Combat Units</th><th>TMM</th><th>ARM</th><th>S</th><th>M</th><th>L</th><th>Morale</th>
    </tr>
    <?php foreach($combatunits as $c): ?>
    <tr>
        <td><?php echo $c->name; ?></td>
        <td><?php echo $c->tmm; ?></td>
        <td><?php echo $c->armor-$c->damage.'/'.$c->armor; ?></td>
        <td><?php echo $c->short_dmg; ?></td>
        <td><?php echo $c->med_dmg; ?></td>
        <td><?php echo $c->long_dmg; ?></td>
        <td><?php echo $c->morale; ?></td>
    </tr>
    <?php endforeach; ?>
    
</table>