<?php
    // xml template
    echo '<?xml version=\"1.0\"?>\n';
    echo '<response>\n';
    
    echo '<tokens>';
        echo json_encode($tokens);
    echo '</tokens>\n';
    
    echo '</response>\n';