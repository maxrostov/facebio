 $('.ui.dropdown').not('#agency_id').dropdown();
if($('#agency_id').length) {$('#agency_id').dropdown({onChange: agency_leave});}

// $('.ui.checkbox').checkbox();
// $('.ui.radio.checkbox').checkbox();
$('.menu .item').tab();





$(document).ready(function () {

    $(".js-dadata_address").suggestions({
        token: "ed5933cf7d6feed31bba9363ea70c7f5ac1f7717",
        type: "ADDRESS"     });

    $(".js-dadata_fms").suggestions({
        token: "ed5933cf7d6feed31bba9363ea70c7f5ac1f7717",
        type: "fms_unit"    });

    $(".js-dadata_fio").suggestions({
        token: "ed5933cf7d6feed31bba9363ea70c7f5ac1f7717",
        type: "fio"    });


    $("input[name='Person[plan_ids][]']").change(function () {
        var maxAllowed = 3;
        var cnt = $("input[name='Person[plan_ids][]']:checked").length;
        if (cnt == maxAllowed) {
            // $(this).prop("checked", "");
            $("input[name='Person[plan_ids][]']:not(:checked)").prop("disabled", true);
            // alert('Можно выбрать не больше ' + maxAllowed + ' вариантов');
        } else{
            $("input[name='Person[plan_ids][]']").prop("disabled", false);

        }
    });

    $("input[name='Person[socialhelp1_ids][]']").change(function () {
        var maxAllowed = 4;
        var cnt = $("input[name='Person[socialhelp1_ids][]']:checked").length;
        if (cnt == maxAllowed) {

            $("input[name='Person[socialhelp1_ids][]']:not(:checked)").prop("disabled", true);
        } else{
            $("input[name='Person[socialhelp1_ids][]']").prop("disabled", false);

        }
    });

    $("input[name='Person[socialhelp2_ids][]']").change(function () {
        var maxAllowed = 4;
        var cnt = $("input[name='Person[socialhelp2_ids][]']:checked").length;
        if (cnt == maxAllowed) {

            $("input[name='Person[socialhelp2_ids][]']:not(:checked)").prop("disabled", true);
        } else{
            $("input[name='Person[socialhelp2_ids][]']").prop("disabled", false);

        }
    });

    $('#calendar').fullCalendar({
        locale: 'ru',
        events: visits_events
    })

});


