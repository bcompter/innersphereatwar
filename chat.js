// Track the last timestamp
var lastChatTime;

// Handle submit click events
$(document).ready(function() 
{
    // Public Chat Submit Button
    $("#chat_submit").submit(function(event)
    {
        // Stop default operation
        event.preventDefault();

        // Get data from the form
        var $msg = $(this).find('input[id=chat_message"]').val();
        var $url = $(this).attr('action');

        // Send to post
        $.post( $url, {msg: $msg} );

        // Clear text from chat input
        $(this).find('input[id="chat_message"]').val('');

        // Regain focus to text input
        $(this).find('input[id="chat_message"]').focus();

    });
    
    // Load the last few chat messages
    $loadUrl = $("#chat_submit").attr('load_url');
    $.post( $loadUrl,
        function(xml)
        {
            // Grab the last time
            var time = $("chattime", xml).text();
            lastChatTime = time;

            // Append messages to the div
            var msgs = $("chats", xml).html();
            $("#chat_window").append( msgs );
            
            var users = $("users", xml).html();
            $("#who_window").html( users );

            // Set scroll bars
            var chatdivscroll = document.getElementById("chat_window");
            chatdivscroll.scrollTop = chatdivscroll.scrollHeight;

            // Execute update loop after loading is complete
            update();
        }
    );

});  // end of document ready

/**
 * Check back with the server for new messages every so often
 */ 
function update()
{
    $updateUrl = $("#chat_submit").attr('update_url');
    $.post( $updateUrl, {chattime: lastChatTime},
        function(xml)
        {                    
            // On success, do something with the data
            // Grab the last time
            var time = $("time",xml).text();
            lastChatTime = time;

            // Append chat messages to the div
            var doChatScroll = true;
            var chatdivscroll = document.getElementById("chat_window");

            if ( chatdivscroll.scrollHeight - chatdivscroll.scrollTop > 150)
                doChatScroll = false;

            var msgs = $("chats",xml).html();
            $("#chat_window").append( msgs );

            var users = $("users", xml).html();
            $("#who_window").html( users );

            chatdivscroll.scrollTop = chatdivscroll.scrollHeight;
        }
    );

    setTimeout("update()", 5000);

};  // end update