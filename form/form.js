$(document).ready(function() {
    $("#contactform").submit(function(e) {
        e.preventDefault(); //It stops form from refreshing the page.

        var form = $(this);
        var url = form.attr("action");
        $("#submit").html('Please wait... <span class="fas fa-circle-notch fa-spin"></span>');

        // You can remove the setTimeout function if you don't want to delay the submission
        // setTimeout(function() {
            $.ajax({          
                type: "post",
                url: url,
                data: form.serialize(),
                dataType: "json",
                cache: false,
                success: function(data) {
                    if(data.status == 'ok') {
                        $("#submit").html('Submit Message <span class="fa-solid fa-angle-right"></span>');
                        showModal(); // ✅ Call your modal
                        form.trigger("reset");
                    } else {
                        $("#submit").html('Submit Message <span class="fa-solid fa-angle-right"></span>');
						alert("Failed to send email. Please try again."); // Display error alert box
                        grecaptcha.reset();
                    }
                }
            });
        // }, 2000); // Remove this line if you don't want a delay
    });
});
