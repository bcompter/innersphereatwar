<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>ISW Dashboard</h1>
    
            <p>
                Welcome to the Inner Sphere at War game dashboard.
            </p>
            
            <h2>Links</h2>
            
            <div class="col-md-4">
                <h3>Games</h3>
                <ul>
                    <li><?php echo anchor('game/view_all', 'View Games'); ?></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3>RATs</h3>
                <ul>
                    <li><?php echo anchor('rat/view_all', 'View RATs'); ?></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3>Units</h3>
                <ul>
                    <li><?php echo anchor('unit/view_all', 'View Units'); ?></li>
                </ul>
            </div>         
        </div>
    </div>
</div>