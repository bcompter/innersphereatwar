<div class="container">
    <h1><?php echo $unit->name; ?> <small>(<?php echo anchor('unit/view_all', 'back to Unit List'); ?>)</small></h1>
    <h3></h3>
    <table class="table table-striped">
        <tr>    <td>Name</td><td><?php echo $unit->name; ?></td></tr>
        <tr>    <td>Type</td><td><?php echo $unit->type; ?></td></tr>
        <tr>    <td>Size</td><td><?php echo $unit->size; ?></td></tr>
        <tr>    <td>Move</td><td><?php echo $unit->move; ?></td></tr>
        <tr>    <td>Jump</td><td><?php echo $unit->jump; ?></td></tr>
        <tr>    <td>Short</td><td><?php echo $unit->short_dmg; ?></td></tr>
        <tr>    <td>Medium</td><td><?php echo $unit->med_dmg; ?></td></tr>
        <tr>    <td>Long</td><td><?php echo $unit->long_dmg; ?></td></tr>
        <tr>    <td>Overheat</td><td><?php echo $unit->overheat; ?></td></tr>
        <tr>    <td>Armor</td><td><?php echo $unit->armor; ?></td></tr>
        <tr>    <td>Structure</td><td><?php echo $unit->structure; ?></td></tr>
        <tr>    <td>Special</td><td><?php echo $unit->special; ?></td></tr>
    </table>
</div>