// Document load
$(document).ready(function() 
{
    // Make tokens draggable
    $(function(){$(".token").draggable({
        
        stop: function() {
            var position = $(this).position();
            
            // Send the new position data to the server
            $url = $(this).attr("action");
            $x = position.left;
            $y = position.top;
            $.post( $url, {x: $x, y: $y} );
        }
                
    });});
    
});