$(document).ready(function() { 
    $("#solicitarAcceso").submit(function(e) {
         //stop submitting the form to see the disabled button effect 
        //e.preventDefault();
        // Change text of button element 
        $("#btnSubmit").html("Solicitud enviada");
        //disable the submit button 
        $("#btnSubmit").attr('disabled', true);
    }); 
});