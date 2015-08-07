<table>
    <tr><th colspan="4"><?php echo $command->name; ?>, <?php echo $formation->name; ?></th></tr>
    
    <tr>
        <th>Move:</th><td><?php echo $formation->move; ?></td>
        <th>Skill:</th><td><?php echo $formation->experience; ?></td>
        <th>Tactics:</th><td><?php echo $formation->tactics; ?>, <?php echo $formation->stance.'('.$formation->stance_mod.')' ?></td>
        <th>Morale:</th><td><?php echo $formation->morale; ?></td>
    </tr>
    <tr>
        <th>Combat Units</th><th>TMM</th><th>ARM</th><th>S</th><th>M</th><th>L</th>
    </tr>
    <?php foreach($combatunits as $c): ?>
    <tr>
        <td><?php echo $c->name; ?></td>
    </tr>
    <?php endforeach; ?>
    
</table>