// Document load
$(document).ready(function() 
{
    // Make the map draggable
    $(function(){$(".map_drag").draggable();});
    
    // Handle hex clicks
    $("body").delegate(".hex","click", function(event)
    {
        // Form the link to be used...
        $url = $(this).attr('url');

        // Send to server, handle xml response    
        $.post( $url,
        function(xml)
        {               
            // Set info content to the server response
            var msgs = $("info",xml).html();
            $("#info").html( msgs );
        }
        );     
    });
    
    
});




