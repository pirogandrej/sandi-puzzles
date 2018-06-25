// Инициализация переменных

if(typeof w_mini == "undefined")
{
    var w_mini = 1;
}

if(typeof h_mini == "undefined")
{
    var h_mini = 1;
}

if(typeof wh_cut == "undefined")
{
    var wh_cut = 100;
}

if(typeof number_zone == "undefined")
{
    var number_zone = 3;
}

if(typeof images == "undefined")
{
    var images = [];
}

if(typeof posX == "undefined")
{
    var posX = [];
}

if(typeof posY == "undefined")
{
    var posY = [];
}

var WidthMain,
    WidthWindow,
    HeightWindow,
    p_width,
    p_height,
    p_min_pic,
    border_width;

var x1_curent = 0,
    y1_curent = 0,
    objDrop;

var card_map = [];

card_map['resSelect'] = [];
card_map['resOk'] = [];
card_map['idSelect'] = [];
card_map['number_in_drop'] = [];

card_map['image'] = [];
card_map['x'] = [];
card_map['y'] = [];

for(var i=0; i < number_zone; i++){
    card_map['resSelect'][i] = 0;
    card_map['resOk'][i] = 0;
    card_map['idSelect'][i] = 0;
    card_map['number_in_drop'][i] = 0;
    card_map['image'][i] = images[i];
    card_map['x'][i] = posX[i];
    card_map['y'][i] = posY[i];
}

var timer = 0,
    hour = 0,
    minute = 0,
    second = 0,
    varTimer;

var WidthMainPic,
    HeightMainPic;

var x,
    y,
    divName;

var number_in_drop,
    number_out_zone,
    flag_check_in_drop,
    flag_check_out_drop,
    numDrugPic;


//======================== end Инициализация переменных ============================================

//========================= Действия при изменении размера экрана ==================================

function windowSize(){

    WidthWindow = $(window).width();
    HeightWindow = $(window).height();

    if ((WidthWindow < 770) || (HeightWindow < 300)) {

        $('.container-fluid').css({"display": "none"});
        $('#div-background').css({"display": ""});
        $('#span_bk_width').html(WidthWindow);
        $('#span_bk_height').html(HeightWindow);

    }
    else
    {
        $('#div-background').css({"display": "none"});
        $('.container-fluid').css({"display": ""});
    }

    WidthMain = $('#div-main').width();
    p_width = WidthMain / w_mini;
    p_height = (HeightWindow - 30) / h_mini;

    if (p_height <= p_width){
        p_min_pic = p_height;
    }
    else {
        p_min_pic = p_width;
    }

    if((p_min_pic > 0) && (p_min_pic < 1.25)){
        border_width = 1;
    }

    if((p_min_pic >= 1.25) && (p_min_pic < 2)){
        border_width = 2;
    }

    if((p_min_pic >= 2) && (p_min_pic < 3)){
        border_width = 3;
    }

    if((p_min_pic >= 3) && (p_min_pic < 10)){
        border_width = 4;
    }

    $('#div-main').height(parseInt(h_mini * p_min_pic));

    $('#div-img img').width(parseInt(w_mini * p_min_pic));
    $('#div-img img').height(parseInt(h_mini * p_min_pic));

    $('.fitDrop-all').width(wh_cut * p_min_pic);
    $('.fitDrop-all').height(wh_cut * p_min_pic);

//================== Масштабирование элементов клиентской части ====================

    $('.button_original').css({"width": parseInt(175 * p_min_pic) + "px", "height": parseInt(30 * p_min_pic) + "px","font-size":parseInt(10 * p_min_pic) + "px","padding":0});
    $('#timer').css({"font-size":parseInt(25 * p_min_pic) + "px"});
    $('#games_all').css({"margin": parseInt(20 * p_min_pic) + "px auto"});
    $('#start_div').css({"margin": parseInt(20 * p_min_pic) + "px auto"});
    $('#ready_button').css({"top":parseInt(45 * p_min_pic) + "px","left":parseInt(50 * p_min_pic) + "px"});
    $('.span_question').css({"font-size":parseInt(25 * p_min_pic) + "px"});
    $('#modalResultError').find('.modal-dialog').css({"margin-left": parseInt(400 * p_min_pic) + "px", "margin-top": parseInt(120 * p_min_pic) + "px"});
    $('#modalResultError').find('.modal-content').css({"width": parseInt(700 * p_min_pic) + "px", "height": parseInt(300 * p_min_pic) + "px","font-size":parseInt(20 * p_min_pic) + "px","padding-left":parseInt(25 * p_min_pic) + "px"});
    $('#modalResultError').find('img').css({"width": parseInt(200 * p_min_pic) + "px","margin": parseInt(20 * p_min_pic) + "px"});
    $('#modalResultError').find('button').css({"margin-right": parseInt(250 * p_min_pic) + "px", "margin-bottom": parseInt(20 * p_min_pic) + "px","font-size":parseInt(20 * p_min_pic) + "px","width":parseInt(175 * p_min_pic) + "px","height":parseInt(40 * p_min_pic) + "px","padding":0});
    $('#modalResultOk').find('.modal-dialog').css({"margin-left": parseInt(400 * p_min_pic) + "px", "margin-top": parseInt(120 * p_min_pic) + "px"});
    $('#modalResultOk').find('.modal-content').css({"width": parseInt(650 * p_min_pic) + "px", "height": parseInt(300 * p_min_pic) + "px","font-size":parseInt(25 * p_min_pic) + "px","padding-left":parseInt(25 * p_min_pic) + "px"});
    $('#modalResultOk').find('img').css({"width": parseInt(100 * p_min_pic) + "px","margin": parseInt(20 * p_min_pic) + "px"});
    $('#modalResultOk').find('button').css({"margin-right": parseInt(220 * p_min_pic) + "px", "margin-bottom": parseInt(20 * p_min_pic) + "px","font-size":parseInt(20 * p_min_pic) + "px","width":parseInt(175 * p_min_pic) + "px","height":parseInt(40 * p_min_pic) + "px","padding":0});
    $('#modal_first').css({"margin-top": parseInt(50 * p_min_pic) + "px"});
    $('#modal_first').find('.modal-dialog').css({"margin-left": parseInt(400 * p_min_pic) + "px", "margin-top": parseInt(0 * p_min_pic) + "px"});
    $('#modal_first').find('.modal-content').css({"width": parseInt(650 * p_min_pic) + "px", "height": parseInt(300 * p_min_pic) + "px","font-size":parseInt(25 * p_min_pic) + "px","padding-left":parseInt(25 * p_min_pic) + "px"});
    $('#modal_first').find('button').css({"margin-right": parseInt(225 * p_min_pic) + "px", "margin-bottom": parseInt(20 * p_min_pic) + "px","font-size":parseInt(20 * p_min_pic) + "px","width":parseInt(175 * p_min_pic) + "px","height":parseInt(40 * p_min_pic) + "px","padding":0});

//================== Выставляю области для вставки в нужные места ====================

    WidthMainPic = w_mini * p_min_pic;
    HeightMainPic = h_mini * p_min_pic;

    x = 0;
    y = 0;
    divName = '';

    for(i=0; i < number_zone; i++){

        x = parseInt(card_map['x'][i] * WidthMainPic);
        y = parseInt(card_map['y'][i] * HeightMainPic);
        divName = '#fitDrop' + (i + 1);
        $(divName).css({"left": x + "px", "top": y + "px"});
        $('#picture-' + (i + 1)).css({"width": parseInt(100 * p_min_pic) + "px", "height": parseInt(100 * p_min_pic) + "px","margin-bottom": parseInt(5 * p_min_pic) + "px"});
        $('#picture-' + (i + 1)).find('img').css({"width": parseInt(100 * p_min_pic) + "px", "height": parseInt(100 * p_min_pic) + "px","border": border_width + "px solid darkblue"});

    }

}

$(window).on('load resize',windowSize);

//========================== end - Действия при изменении размера экрана =======

//========================== Формирование таймера =======

function timer_picture(){
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

//========================== end - Формирование таймера =======

function timerOutFunc() {

    var hour = Math.floor(timer / 3600),
        min = Math.floor((timer - hour * 3600) / 60),
        sec = timer - hour * 3600 - min * 60,
        hourStr, minStr, secStr;
    if(hour){
        hourStr = hour.toString();
        minStr = min < 9 ? "0" + min.toString() : min.toString();
        secStr = sec < 9 ? "0" + sec.toString() : sec.toString();
        return hourStr + " час. " + minStr + " мин. " + secStr + " сек.";
    }
    if(min){
        minStr = min.toString();
        secStr = sec < 9 ? "0" + sec.toString() : sec.toString();
        return  minStr + " мин. " + secStr + " сек.";
    }
    return sec.toString() + " сек.";
}


$(function() {

    $("#ready_button").click(function(){

        clearInterval(varTimer);

        var isInput = 0;
        var timerOut = timerOutFunc();

        for(var i=0; i < number_zone; i++){
            if
            (
                (card_map['resSelect'][i] == 1) &&
                (card_map['resOk'][i] == 1)
            )
            {
                isInput++;
            }
        }

        if(isInput == number_zone)
        {
            $('#modalResultOk').modal('show');
            $('#modalResultOkText').text("Использовано времени : " + timerOut);
        }
        else
        {
            $('#modalResultError').modal('show');
            $('#modalResultErrorText').text("Использовано времени : " + timerOut);
        }

    });

    $("#timer_button").click(function(){
        timer_picture();
    });


    //============================= Перезагрузка страницы для рестарта игры =========
    $("#start_button").click(function(){
        location.reload();
    });


    $('.draggable').draggable({

        containment: 'body',
        cursor: "move",
        cursorAt: { top: 56, left: 56 },

        // ======================== Реакция на перемещение областей ======================

        drag: function(event, ui) {

        },

        start: function( event, ui ) {

            var attr_id_pic,
                i,
                picName;

            flag_check_out_drop = false;

            $(this).css({"width": parseInt(100 * p_min_pic) + "px", "height": parseInt(100 * p_min_pic) + "px", "position":"relative" , "z-index":999});
            $(this).find('img').css({"width": parseInt(100 * p_min_pic) + "px", "height": parseInt(100 * p_min_pic) + "px", "border": border_width + "px solid darkblue"});

            objDrop = this;

            attr_id_pic = $(this).attr('id');

            for(i = 0; i < number_zone; i++){

                picName = 'picture-' + (i+1);

                if (attr_id_pic == picName){

                    numDrugPic = i + 1;

                }
            }

            flag_check_in_drop = false;

            for(i = 0; i < number_zone; i++){

                if (card_map['idSelect'][i] == numDrugPic){

                    flag_check_in_drop = true;

                    number_out_zone = i;

                }
            }

        },

        stop: function( event, ui ) {
            var i,
                picName,
                attr_id_pic;

            $(this).css({ "z-index": 1 });

            attr_id_pic = $(this).attr('id');

            for(i=0; i < number_zone; i++){

                picName = 'picture-' + (i+1);

                if (attr_id_pic != picName){

                    $('#' + picName).css({ "z-index": 0 });

                }
            }
        }

    });

    $('.droppable').droppable({

        // ======================== Реакция если положили в область области ======================

        drop: function(event, ui) {

            var wh_integer = parseInt(Math.ceil(wh_cut * p_min_pic));

            var numDrop = 0,
                numDrug = 0;

            var x_shift,y_shift;

            var dropwhere      = $(this).attr('id');
            var whatWasDropped = ui.draggable.attr("id");

            x_shift = parseInt($('#'+whatWasDropped).offset().left) - parseInt($('#'+dropwhere).offset().left);
            y_shift = parseInt($('#'+whatWasDropped).offset().top) - parseInt($('#'+dropwhere).offset().top);

            var picName;

            for(i = 0; i < number_zone; i++){
                picName = 'picture-' + (i + 1);
                if (whatWasDropped == picName){
                    numDrug = i + 1;
                }
            }

            for(i=0; i < number_zone; i++){
                picName = 'fitDrop' + (i+1);
                if (dropwhere == picName){
                    numDrop = i + 1;
                }
            }

            if((flag_check_out_drop == false) && (flag_check_in_drop == true)){

                $('#'+whatWasDropped).find('img').animate({
                    width : wh_integer,
                    height : wh_integer
                },400);

                $( '#'+whatWasDropped ).animate({
                    left: "-=" + parseInt(x_shift),
                    top: "-=" + parseInt(y_shift)
                }, 400, function() {
                    // Animation complete.
                });

            }

            if (card_map['resSelect'][numDrop - 1] == 0){

                $('#'+whatWasDropped).find('img').animate({
                    width : wh_integer,
                    height : wh_integer
                },400);

                $( '#'+whatWasDropped ).animate({
                    left: "-=" + parseInt(x_shift),
                    top: "-=" + parseInt(y_shift)
                }, 400, function() {
                    // Animation complete.
                });

                $(this).addClass('dis');

                card_map['resSelect'][numDrop - 1] = 1;
                card_map['idSelect'][numDrop - 1] = numDrug;

                if(numDrug == numDrop)
                {
                    for(i=0; i < number_zone; i++){

                        if (numDrop == ( i + 1)){
                            card_map['resOk'][i] = 1;
                        }
                    }
                }

            }

        },

        activeClass: "active",
        hoverClass: "hover",
        tolerance: "intersect",

        // ======================== Реакция на выход из области ======================
        out: function (event, ui)
        {

            flag_check_out_drop = true;

            $(objDrop).find('img').css({"border": border_width + "px solid darkblue"});

            var numDrug;

            var whatWasDropped = ui.draggable.attr("id");

            var picName = '';
            for(i = 0; i < number_zone; i++){

                picName = 'picture-' + (i + 1);

                if (whatWasDropped == picName){
                    numDrug = i + 1;
                }
            }

            $('#picture-'+numDrug).css({"border": "0px solid black"});

            if (flag_check_in_drop == true)
            {
                card_map['resSelect'][number_out_zone] = 0;
                card_map['idSelect'][number_out_zone] = 0;
                card_map['resOk'][number_out_zone] = 0;
                flag_check_in_drop = false;
            }

        }
    });

});


$(document).ready(function(){

//====================== Включаем счетчик через 500 мс после загрузки страницы ==========

    setTimeout(function()
    {
        $('#modal_first').modal('show');
    }, 500);

//=========================================================================================

});

