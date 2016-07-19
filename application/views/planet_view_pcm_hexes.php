<?php

    // Starting coordinates
    $startX = 100;
    $startY = 100;
    
    // Standard hex dimensions
    $height = 100;
    $width = 87;
    
    $deltaY = $height;
    $deltaX = $width / 2;
    
    $r = 0;
    $colsperrow = array(8,9,10,11,12,13,14,15,14,13,12,11,10,9,8);
    $deltaXperrow = array(3.5,3,2.5,2,1.5,1,0.5,0.0,0.5,1,1.5,2,2.5,3,3.5);
    
    // Generate 15 rows of hexes
    $x = $startX;
    $y = $startY;
    while ($r < 15)
    {
        $c = 0;
        while ($c < $colsperrow[$r])
        {
            $x = $startX + $deltaXperrow[$r]*$width + $c*$width;
            echo '<div class="hex" style="top:'.$y.'px; left:'.$x.'px;" url="'.base_url('planet/view/view_hex/'.$planet->planet_id.'/'.$r.'/'.$c).'">';
            echo sprintf('%02d%02d', $r, $c);
            echo '</div>';
            $c++;
        }
        $r++;
        $y += $deltaY;
        
    }