<script type="text/javascript" <?php echo 'src="'.$this->config->item('base_url').'tablesorter.js"'; ?>></script> 

<script type="text/javascript">
    $(document).ready(function() 
        { 
            $(".sortable").tablesorter(); 
        } 
    ); 
</script>

<div class="container">
    <h1>User List </h1>
    
    <table class="table table-striped tablesorter">
        <thead><tr>
            <th>Username</th>
            <th>Email</th>
            <th>Group</th>
        </tr></thead>
    <?php foreach($users as $u): ?>
        <tr>
            <td><?php echo $u->username; ?></td>
            <td><?php echo $u->email; ?></td>
            <td><?php echo $u->group_id; ?></td>
        </tr>    
    <?php endforeach; ?>
    </table>
</div>