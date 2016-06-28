<script type="text/javascript">
    $(document).ready(function() 
        { 
            $(".sortable").tablesorter(); 
        } 
    ); 
</script>

<div class="container">
    
    <ol class="breadcrumb">
        <li><?php echo anchor('game/view/'.$game->game_id, 'Game'); ?></li>
        <?php if(isset($faction->faction_id)): ?>
            <li><?php echo anchor('faction/view/'.$faction->faction_id, 'Faction'); ?></li>
        <?php endif; ?>
    </ol>  
    
    <h1>Player List</h1>
    
    <table class="table table-striped tablesorter sortable">
        <thead><tr>
            <th>Name</th>
            <th>User</th>
            <th>Rank</th>
            <th>&nbsp;</th>
        </tr></thead>
        <tbody>
    <?php foreach($players as $p): ?>
        <tr>
            <td><?php echo $p->name; ?></td>
            <td><?php echo $p->username; ?></td>
            <td><?php echo $p->rank; ?></td>
            <td><?php echo anchor('player/view/'.$p->player_id, 'VIEW'); ?></td>
        </tr>    
    <?php endforeach; ?>
        </tbody>
    </table>
</div>