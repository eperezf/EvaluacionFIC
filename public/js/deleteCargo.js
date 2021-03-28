$(document).ready(() => {
    $("#actividades").click(function (e) {
        if($(e.target).is("button")) {
            var activityId = e.target.value;
            $("#actividadId").attr("value", activityId);
        } else {
            $("#actividadId").attr("value", "");
        }
    });
});
