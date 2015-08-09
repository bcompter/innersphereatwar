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

    // Handle token clicks
    $("body").delegate(".tokenlink", "click", function(event)
    {
        event.preventDefault();
        $url = $(this).attr('href');
        $.post( $url, function(xml)
        {               
            var msgs = $("info",xml).html();
            $("#token_info").html( msgs );
        }
        );   
    });
    
    // Start the update timer
    setTimeout("update()", 5000);
    
});

// Check back with the server for updates
function update()
{
    
    
    setTimeout("update()", 5000);
}