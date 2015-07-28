<?php
    // xml template
    echo "<?xml version=\"1.0\"?>\n";
    echo "<response>\n";
        echo '<info>';

        if (isset($error))
        {
            echo '<div class="error">'.$error.'</div>';
        }
        if (isset($notice))
        {
            echo '<div class="notice">'.$notice.'</div>';
        }
        if (isset($warning))
        {
            echo '<div class="warning">'.$warning.'</div>';
        }
        
        $flash = $this->session->flashdata('notice');
        if ($flash != '')
        {
            echo '<div class="notice">'.$flash.'</div>';
        }
        $flash = $this->session->flashdata('error');
        if ($flash != '')
        {
            echo '<div class="error">'.$flash.'</div>';
        }
        $flash = $this->session->flashdata('warning');
        if ($flash != '')
        {
            echo '<div class="warning">'.$flash.'</div>';
        }
        if (isset($content))
        {
            $this->load->view($content);
        }
        
        echo '</info>';
    echo '</response>';
?>