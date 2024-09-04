$(document).ready(function() {
    $("#zglos").on("click", function(){
        $.post("insertReport.php", { tresc: "" + $("#reportID").val() + ""}, function(data) {
                $("#pa").text("Wysłano zgłoszenie!");
        });
    });
});