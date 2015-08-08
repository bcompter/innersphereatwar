<table border="1">
    <tr><th colspan="7"><?php echo $command->name; ?>, <?php echo $formation->name; ?></th></tr>
    
    <tr>
        <th>Move: <?php echo $formation->move; ?></th>
        <th>Skill:</th><td><?php echo $formation->experience; ?></td>
        <th>Tactics:</th><td><?php echo $formation->tactics; ?>, <?php echo $formation->stance.'('.$formation->stance_mod.')' ?></td>
        <th>Morale:</th><td><?php echo $formation->morale; ?></td>
    </tr>
    <tr>
        <td>Moved?</td>
        <td>Detected?</td>
        <td>Role?</td>
        <td>Tactics?</td>
        <td>Damage?</td>
        <td colspan="3">&nbsp</td>
    </tr>
    <tr>
        <th>Combat Units</th><th>TMM</th><th>ARM</th><th>S</th><th>M</th><th>L</th><th>Morale</th>
    </tr>
    <?php foreach($combatunits as $c): ?>
    <tr>
        <td><?php echo $c->name; ?></td>
        <td><?php echo $c->tmm; ?></td>
        <td><?php echo $c->armor; ?></td>
        <td><?php echo $c->short_dmg; ?></td>
        <td><?php echo $c->med_dmg; ?></td>
        <td><?php echo $c->long_dmg; ?></td>
        <td><?php echo $c->morale; ?></td>
    </tr>
    <?php endforeach; ?>
    
</table>