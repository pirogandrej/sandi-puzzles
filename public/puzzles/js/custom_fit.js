var x1_curent = 0;
var y1_curent = 0;

var resSelect1 = 0;
var resSelect2 = 0;
var resSelect3 = 0;
var resSelect4 = 0;
var resOk1 = 0;
var resOk2 = 0;
var resOk3 = 0;
var resOk4 = 0;
var idSelect1 = 0;
var idSelect2 = 0;
var idSelect3 = 0;
var idSelect4 = 0;
var timer = 0;
var hour = 0;
var minute = 0;
var second = 0;
var varTimer;

var maxNumberZone = 10;

$(document).ready(function() {

    for (var i = 3; i <= maxNumberZone; i++) {
        $("#numberZone").append($('<option value="' + i + '">' + i + '</option>'));
    }

});

$("select#sizeZone").change(function () {

    $("select#numberZone").empty();

    var sizeZone = $("select#sizeZone").val();
    switch (sizeZone) {
        case '100':
            maxNumberZone = 10;
            break;
        case '150':
            maxNumberZone = 10;
            break;
        case '200':
            maxNumberZone = 8;
            break;
        case '250':
            maxNumberZone = 6;
            break;
    }

    for (var i = 3; i <= maxNumberZone; i++) {
        $("#numberZone").append($('<option value="' + i + '">' + i + '</option>'));
    }

});

$('.change_profile').click(function() {
    $( "#form-profile" ).submit();
});

//image - gamephp

$('.change_image_js').click(function() {
    $( "#form-image" ).submit();
});

$(".change_game_visible").change(function() {
    var obj = this;
    var id_num = $(obj).data("post-id");
    var url = $(obj).data("url");
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:"POST",
        url:url,
        data:{_token: csrfToken,id_visible: id_num},
        success: function (data) {
            if($(obj).val() == 1) {
                $(obj).css('color','lightgreen');
                console.log('visible ok - yes');
            }
            else{
                $(obj).css('color','#FFA9AE');
                console.log('visible ok - no');
            }
        },
        error: function(){
            console.log('visible error');
        }
    });
});

function timer_picture()
{
    varTimer =
        setInterval(function(){
            ++timer;
            hour   = Math.floor(timer / 3600);
            minute = Math.floor((timer - hour * 3600) / 60);
            second = timer - hour * 3600 - minute * 60;
            if (hour < 10) hour = '0' + hour;
            if (minute < 10) minute = '0' + minute;
            if (second < 10) second = '0' + second;
            $('#timer').html(hour + ':' + minute + ':' + second);
        }, 1000);
}



$(function() {

    $("#ready_button").click(function(){
        clearInterval(varTimer);
        if((resSelect1 == 1) &&
            (resSelect2 == 1) &&
            (resSelect3 == 1) &&
            (resSelect4 == 1) &&
            (resOk1 == 1) &&
            (resOk2 == 1) &&
            (resOk3 == 1) &&
            (resOk4 == 1)
        )
        {
            $('#modalResultOk').modal('show');
            $('#modalResultOkText').text("Использовано секунд : " + timer + " .");
        }
        else
        {
            $('#modalResultError').modal('show');
            $('#modalResultErrorText').text("Использовано секунд : " + timer + " .");
        }
    });

    $("#timer_button").click(function(){
        timer_picture();
    });

    $("#start_button").click(function(){
        location.reload();
    });

    $('.draggable').draggable({
        // containment: '#container'
    });

    $('.droppable').droppable({

        drop: function(event, ui) {
            ui.draggable.position( { of: $(this), my: 'center', at: 'middle' } );

            var numDrop = 0,
                numDrug = 0;
            var dropwhere      = $(this).attr('id');
            var whatWasDropped = ui.draggable.attr("id");

            var obj_main = $('#div-img');
            var image1 = $(obj_main).data("image1");
            var image2 = $(obj_main).data("image2");
            var image3 = $(obj_main).data("image3");
            var image4 = $(obj_main).data("image4");
            var file_image = '';

            switch (whatWasDropped) {
                case 'picture-1':
                    numDrug = 1;
                    file_image = image1;
                    break;
                case 'picture-2':
                    numDrug = 2;
                    file_image = image2;
                    break;
                case 'picture-3':
                    numDrug = 3;
                    file_image = image3;
                    break;
                case 'picture-4':
                    numDrug = 4;
                    file_image = image4;
                    break;
            }
            switch (dropwhere) {
                case 'fitDrop1':
                    numDrop = 1;
                    if (resSelect1 == 0)
                    {
                        resSelect1 = 1;
                        idSelect1 = numDrug;
                        $(this).addClass('dis');

                    }
                    break;
                case 'fitDrop2':
                    numDrop = 2;
                    if (resSelect2 == 0)
                    {
                        resSelect2 = 1;
                        idSelect2 = numDrug;
                        $(this).addClass('dis');

                    }
                    break;
                case 'fitDrop3':
                    numDrop = 3;
                    if (resSelect3 == 0)
                    {
                        resSelect3 = 1;
                        idSelect3 = numDrug;
                        $(this).addClass('dis');

                    }
                    break;
                case 'fitDrop4':
                    numDrop = 4;
                    if (resSelect4 == 0)
                    {
                        resSelect4 = 1;
                        idSelect4 = numDrug;
                        $(this).addClass('dis');

                    }
                    break;
            }
            if(numDrug == numDrop)
            {
                switch (numDrop) {
                    case 1:
                        resOk1 = 1;
                        break;
                    case 2:
                        resOk2 = 1;
                        break;
                    case 3:
                        resOk3 = 1;
                        break;
                    case 4:
                        resOk4 = 1;
                        break;
                }
            }
            var s = '<img src="' + file_image + '" class="img">';

            ui.draggable.html(s);
        },
        activeClass: "active",
        hoverClass: "hover",
        tolerance: "intersect",
        out: function (event, ui)
        {
            var numDrop = 0,
                numDrug = 0;
            var whatWasDropped = ui.draggable.attr("id");
            var dropwhere = $(this).attr('id');

            var obj_main = $('#div-img');
            var image1 = $(obj_main).data("image1");
            var image2 = $(obj_main).data("image2");
            var image3 = $(obj_main).data("image3");
            var image4 = $(obj_main).data("image4");
            var file_image = '';

            switch (whatWasDropped) {
                case 'picture-1':
                    numDrug = 1;
                    file_image = image1;
                    break;
                case 'picture-2':
                    numDrug = 2;
                    file_image = image2;
                    break;
                case 'picture-3':
                    numDrug = 3;
                    file_image = image3;
                    break;
                case 'picture-4':
                    numDrug = 4;
                    file_image = image4;
                    break;
            }

            switch (dropwhere) {
                case 'fitDrop1':
                    if (numDrug == idSelect1)
                    {
                        numDrop = 1;
                        resSelect1 = 0;
                        $(this).removeClass( 'dis' );
                    }
                    break;
                case 'fitDrop2':
                    if (numDrug == idSelect2)
                    {
                        numDrop = 2;
                        resSelect2 = 0;
                        $(this).removeClass( 'dis' );
                    }
                    break;
                case 'fitDrop3':
                    if (numDrug == idSelect3)
                    {
                        numDrop = 3;
                        resSelect3 = 0;
                        $(this).removeClass( 'dis' );
                    }
                    break;
                case 'fitDrop4':
                    if (numDrug == idSelect4)
                    {
                        numDrop = 4;
                        resSelect4 = 0;
                        $(this).removeClass( 'dis' );
                    }
                    break;
            }
            switch (numDrop) {
                case 1:
                    resOk1 = 0;
                    break;
                case 2:
                    resOk2 = 0;
                    break;
                case 3:
                    resOk3 = 0;
                    break;
                case 4:
                    resOk4 = 0;
                    break;
            }
            var s = '<img src="' + file_image + '" class="img">';
            ui.draggable.html(s);
        }
    });

});

