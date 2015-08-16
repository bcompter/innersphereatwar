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
    $.post( $updateurl, {}, function(xml)
    {            
        $tokens = $("tokens",xml).text();
        $tokens = jQuery.parseJSON($tokens);
        
        for ($t in $tokens)
        {
            $theId = "#" + $tokens[$t].token_id;
            $actual = $($theId);
            $p = $actual.position();
            if ($p.top != $tokens[$t].y || $p.left != $tokens[$t].x)
            {
                $actual.animate({
                    left: $tokens[$t].x,
                    top: $tokens[$t].y
                    }, 1000, function() {
                // Animation complete.
                });
            }
        }
    });
    
    setTimeout("update()", 5000);
}