<div class="star_map">
    
    <div class="circle30" style="position: absolute; 
                left: <?php echo ($planet->x) + 120; ?>px;
                top: <?php echo ($planet->y) + 100; ?>px;"></div>
    
<?php foreach ($planets as $p): ?>
    <?php $rough_distance = abs($planet->x - $p->x) + abs($planet->y - $p->y); ?>
    <?php if ($rough_distance < 45): ?>

    <?php log_message('error', 'Planet: '.$p->name.', '.$p->x.', '.$p->y); ?>

    <div class="circle" 
         style="position: absolute; 
                left: <?php echo ($p->x - $planet->x)*4 + 120 + 120 - 7; ?>px;
                top: <?php echo ($p->y - $planet->y)*4 + 100 + 120 - 7; ?>px;">
    </div>
    <div style="position: absolute; 
                left: <?php echo ($p->x - $planet->x)*4 + 120 + 120 - 7; ?>px;
                top: <?php echo ($p->y - $planet->y)*4 + 20 + 100 + 120 - 7; ?>px;">
                    <?php echo $p->name; ?></div>

    <?php endif; ?>
<?php endforeach; ?>
</div>