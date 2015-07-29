<h1>Succession Wars | Register</h1>

<div class='mainInfo'>

    <div class="pageTitleBorder"></div>
	<p>Please register with your email address and password below.</p>
	
	<div id="infoMessage"><?php echo $message;?></div>
	
    <?php echo form_open("auth/register");?>
    	
      <p>
      	<label for="username">User Name:</label>
      	<?php echo form_input($username);?>
      </p>  
        
      <p>
      	<label for="email">Email:</label>
      	<?php echo form_input($email);?>
      </p>
      
      <p>
      	<label for="password">Password:</label>
      	<?php echo form_input($password);?>
      </p>     
      
      <p>
      	<label for="confirmpassword">Confirm Password:</label>
      	<?php echo form_input($confirmpassword);?>
      </p> 
      
      <p><?php echo form_submit('submit', 'Register');?></p>

      
    <?php echo form_close();?>

</div>
