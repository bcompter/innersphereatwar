<?php foreach ($planets as $p): ?>
<?php $rough_distance = abs($planet->x - $p->x) + abs($planet->y - $p->y); ?>
<?php if ($rough_distance < 45): ?>

<div class="circle" 
     style="position: absolute; 
            left: <?php echo ($p->x - $planet->x); ?>;
            top: <?php echo ($p->y - $planet->y); ?>;">
</div>
<div style="position: absolute; 
            left: <?php echo ($p->x - $planet->x); ?>;
            top: <?php echo ($p->y - $planet->y + 18); ?>;">
                <?php echo $planet->name; ?></div>

<?php endif; ?>
<?php endforeach; ?>