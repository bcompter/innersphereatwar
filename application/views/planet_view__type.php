<?php 

$planet->type_str = 'Other';
$cost = 576;
if ($planet->type == 'Minor')
{
    $planet->type_str = 'Minor Industrial';
    $cost = 960;
}
else if ($planet->type == 'Major')
{
    $planet->type_str = 'Major Industrial';
    $cost = 960;
}
else if ($planet->type == 'Hyper')
{
    $planet->type_str = 'Hyper Industrial';
    $cost = 0;
}
else if ($planet->type == 'Regional')
{
    $planet->type_str = 'Regional Capital';
    $cost = 1920;
}
else if ($planet->type == 'National')
{
    $planet->type_str = 'National Capital';
    $cost = 0;
}
?>    
    
<tr><td>Type</td><td><?php echo $planet->type_str; ?></td></tr>

<?php if (isset($upgrade->upgrade_id)): ?>

<tr><td>&nbsp;</td>
    <td>Upgrade Underway (<?php echo anchor('planet/infrastructure_upgrade_cancel/'.$planet->planet_id, 'Cancel'); ?>)</td>
</tr>

<?php else: ?>

    <?php if ($planet->type != 'National' && $planet->type != 'Hyper'): ?>
    <tr>    <td>&nbsp;</td><td><?php echo anchor('planet/infrastructure_upgrade/'.$planet->planet_id, 'Upgrade Infrastructure ('.$cost.' RP)') ?></td></tr>
    <?php endif; ?>

<?php endif; ?>