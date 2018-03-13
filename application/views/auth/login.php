<div class="container">
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
    <h1>Login</h1>

    <div class='mainInfo'>
        <br />

        <div class="pageTitleBorder"></div>
        <p>Please login with your email address and password below.</p>

        <div id="infoMessage"><?php echo (isset($message) ? $message : '') ;?></div>

        <?php echo form_open("auth/login");?>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="email" class="form-control">
        </div>
        
        <div class="checkbox">
            <label>
                <input type="checkbox"> Remember Me
            </label>
        </div>
        <?php echo form_submit('submit', 'Login');?>


        </form>

    </div>
    <div class="col-md-4"></div>
    </div>
    </div>
</div>