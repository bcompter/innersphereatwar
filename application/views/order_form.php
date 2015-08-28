<div class="container">
    <h1>Issue Order for <?php echo $command->name; ?></h1>
    
    <h2>Current Orders</h2>
    <table class="table table-striped">
        <tr>
            <th>Type</th>
            <th>Order Points</th>
            <th>RP Cost</th>
            <th>Notes</th>

        </tr>
        <?php foreach($orders as $o): ?>
        <tr>
            <td><?php echo $o->type; ?></td>
            <td><?php echo $o->points; ?></td>
            <td><?php echo $o->rp_cost; ?></td>
            <td><?php echo $o->notes; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <p>
        <ul>
            <li>If using Transport Orders, you may only use Defend Combat Orders afterwards.</li>
            <li>If you use 3 or more Order points on Transport, you may not use any Combat Orders.</li>
            <li>If you began the turn in Combat, you may only use 2 Transport Orders.</li>
        </ul>
    </p>
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="<?php echo base_url('index.php/orders/create/'.$command->command_id); ?>" method="post">

        <div class="form-group">
            <label class="col-md-2 control-label">Order</label>
            <div class="col-md-10">
                <select class="form-control" name="type">
                    <option>Train</option>
                    <option>Rest</option>
                    <option>Repair</option>
                    <option>Move</option>
                    <option>Assault</option>
                    <option>Attack</option>
                    <option>Raid</option>
                    <option>Counter Insurgency</option>
                    <option>Guerilla Warfare</option>
                    <option>Shield</option>
                    <option>Commerce Raid</option>
                    <option>Fortify</option>
                    <option>Dig In</option>
                    <option>Defend</option>
                    <option>Go to Ground</option>
                    <option>Scatter</option>
                    <option>Patrol</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Note</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="note" placeholder="Notes...">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>