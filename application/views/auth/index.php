<script type="text/javascript" <?php echo 'src="'.$this->config->item('base_url').'javascript/tablesorter.js"'; ?>></script> 

<script type="text/javascript">
    $(document).ready(function() 
        { 
            $(".sortable").tablesorter(); 
        } 
    ); 
</script>

<div class='mainInfo'>

    <h1>Users</h1>

    <div id="infoMessage"><?php echo $message;?></div>

    <table class="sortable tablesorter" cellpadding=0 cellspacing=10>
        <thead>
        <tr>
            <th>User Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Group</th>
            <th>Created On</th>
            <th>Last Login</th>
            <th>Status</th>
            <th>&nbsp</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user):?>
            <tr>
                <td><?php echo $user['id'];?></td>
                <td><?php echo $user['username'];?></td>
                <td><?php echo $user['email'];?></td>
                <td><?php echo $user['group_description'];?></td>
                <td><?php 
                    $date = new DateTime(date("c", $user['created_on']));
                    echo $date->format('Y-m-d H:i:s');
                    ?>
                </td>
                <td><?php 
                    $date = new DateTime(date("c", $user['last_login']));
                    echo $date->format('Y-m-d H:i:s');
                    ?>
                </td>
                <td><?php echo ($user['active']) ? anchor("auth/deactivate/".$user['id'], 'Active') : anchor("auth/activate/". $user['id'], 'Inactive');?></td>
                <td><?php echo anchor("auth/promote/".$user['id'], 'Promote'); ?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

    <p><a href="<?php echo site_url('auth/create_user');?>">Create a new user</a></p>
	
</div>
