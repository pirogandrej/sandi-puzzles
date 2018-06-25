// Инициализация переменных

if(typeof isReady == "undefined")
{
    var isReady = '';
}

if(typeof PicMiniWidth == "undefined")
{
    var PicMiniWidth = 100;
}

if(typeof PicMiniHeight == "undefined")
{
    var PicMiniHeight = 100;
}

if(typeof wh_item == "undefined")
{
    var wh_item = 100;
}
if(typeof card_map['activ'] == "undefined")
{
    var card_map = [];
    card_map['activ'] = [];
}
if(typeof number_activ == "undefined")
{
    var number_activ = 1;
}

var x1_curent = 0;
var y1_curent = 0;

var WidthMainWindow = $(window).width();
var HeightMainWindow = $(window).height();

var div_pic = $('#div-main').height();
$('#imagePic1').height(HeightMainWindow - 374);

var WidthMainImage = WidthMainWindow * 0.8;
var HeightMainImage = HeightMainImage * 0.5;
var moveDiv = document.getElementById('movediv');

var div_number = 0;
var url = "";
var img = '';
var i_activ = 0;
var flag_crop_full = 0;

var offsetPic = $("div#imagePic1").offset();
var xOffsetPic = offsetPic['left'],
    yOffsetPic = offsetPic['top'];
var x = 0,
    y = 0;
var YScroll = 0,
    PicDivWidth = 0,
    ratio = 1,
    wh_item_ratio = 150,
    maxScroll = 0;

moveDiv.style.left = 0 + 'px';
moveDiv.style.top = 0 + 'px';

if( card_map['activ'].length > 0)
{
    for(var i = 0; i < card_map['activ'].length; i++)
    {
        if(card_map['activ'][i] == 1 )
        {
            i_activ++;
            div_number = '#box_' + i;
            url = card_map['image_url'][i];
            img = '<img src="' + url + '" style="width:100px;">';
            $(div_number).html(img);
            $(div_number).css('border','');
            $('#imagePic1').append('<div id="shadow_' + i + '" style="opacity:0.7;background-color: rgba(134,228,255,0.99); width:' + wh_item_ratio +'px;height: ' + wh_item_ratio +'px;position: absolute;left:' + card_map['description'][i]['x1'] + 'px;top:' + card_map['description'][i]['y1'] + 'px;"></div>');
        }
    }
}

if(i_activ == card_map['activ'].length){
    $(moveDiv).css('display','none');
}
else{
    $(moveDiv).css('display','');
}

window.onmousemove = function (e) {

    x = e.pageX;
    y = e.pageY;
    maxScroll = PicMiniHeight*ratio - (HeightMainWindow - 374 + 35);

    if((x > (xOffsetPic - 1 + 20)) && (y > (yOffsetPic - 1 + 20)) && (x < (parseInt(PicMiniWidth*ratio - wh_item_ratio - 0) + xOffsetPic + 20)) && (y < (parseInt(PicMiniHeight*ratio - wh_item_ratio) + yOffsetPic + 20 - YScroll - 35 - maxScroll + YScroll - 1))){

        moveDiv.style.left = (x - xOffsetPic - 20) + 'px';
        moveDiv.style.top = (y - yOffsetPic - 20 + YScroll) + 'px';

        var xOffsetMoveDiv = moveDiv.offsetLeft;
        var yOffsetMoveDiv = moveDiv.offsetTop;

        x1_curent = xOffsetMoveDiv;
        y1_curent = yOffsetMoveDiv;

    }
};


$('.image_cut').click(function() {

    console.log(card_map);
    console.log('x1_current = ' + x1_curent);
    console.log('y1_current = ' + y1_curent);

    var isOut = 0,
        i_activ = 0,
        i;

    for (i = 0; i < card_map['activ'].length; i++)
    {

        if (card_map['activ'][i] == 1)
        {
            i_activ++;
            if
            (
                ((parseInt((card_map['description'][i]['x1']) * ratio) + parseInt(wh_item_ratio)) < x1_curent) ||
                ((parseInt((card_map['description'][i]['y1']) * ratio) + parseInt(wh_item_ratio)) < y1_curent) ||
                ((parseInt((card_map['description'][i]['x1']) * ratio) - parseInt(wh_item_ratio)) > x1_curent) ||
                ((parseInt((card_map['description'][i]['y1']) * ratio) - parseInt(wh_item_ratio)) > y1_curent)
            )
            {
                isOut++;
            }
        }
    }

    if
    ( i_activ == isOut )
    {

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var url_cut_activ = $(this).data('url_cut_activ');
        var image_id = $(this).data('image_id');
        var last_activ;
        var x1_current_origin = parseInt(x1_curent / ratio);
        var y1_current_origin = parseInt(y1_curent / ratio);

        $.ajax({
            type:"POST",
            url:url_cut_activ,
            data:{_token: csrfToken,
                image_id: image_id,
                x: x1_current_origin,
                y: y1_current_origin
            },
            success: function (data) {

                card_map = JSON.parse(data);

                last_activ = number_activ;
                number_activ = card_map['number_activ'];

                console.log('ok');
                console.log(card_map);
                console.log('last_activ = ' + last_activ);
                console.log('number_activ = ' + number_activ);

                div_number = '#box_' + last_activ;

                url = card_map['image_url'][last_activ];
                img = '<img src="' + url + '" style="width:100px;">';
                $(div_number).html(img);
                $(div_number).css('border','');
                $('#box_' + number_activ).css('border','1px solid #affcf5');
                $('#imagePic1').append('<div id="shadow_' + last_activ + '" style="opacity:0.7;background-color: rgba(134,228,255,0.99); width:' + wh_item_ratio +'px;height: ' + wh_item_ratio +'px;position: absolute;left:' + x1_curent + 'px;top:' + y1_curent + 'px;"></div>');

                if(card_map['isReady'] == 1){
                    $(moveDiv).css('display','none');
                }
                else{
                    $(moveDiv).css('display','');
                }

                $('#box_' + last_activ).css('border','');
                $('#box_' + last_activ).css('padding-top','');
            },
            error: function(){
                console.log('error');
            }
        });

    }
    else
    {
        alert("Необходимо чтобы области не пересекались");
    }
});


$('.change_image').click(function() {
    $( "#form-image" ).submit();
});

$( "div.crop-box" )
    .mouseenter(function() {
        $(this).css('cursor','pointer');
        var num_span = $( this ).find( "span" ).text();
        if (num_span == '')
        {
            flag_crop_full = 1;
            $( this ).find('img').css('opacity','.25').css('position','relative');
            $( '<div id="div_del" ' +
                'style="position: relative;top: -70px;width: 90%;margin: auto"' +
                'data-url="/image_cut_delete"' +
        '><button type="button" class="btn btn-danger btn-circle btn-x2"><i class="fa fa-times"></i> </button>' +
        '</div>' ).appendTo(this);
        }
    })
    .mouseleave(function() {
        $(this).css('cursor','default');
        flag_crop_full = 0;
        $( this ).find('img').css('opacity','1');
        $( this ).find('div#div_del').remove();
    })
    .on('click', function(){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var image_id = $(this).data('image_id');
        var id_box = $(this).attr('id');
        id_box = id_box.replace('box_','');
        alert('id '+image_id);
        alert('del '+id_box);
        if(flag_crop_full == 1){
            var url_del_activ = $(this).data('url_del_activ');
            $.ajax({
                type:"POST",
                url:url_del_activ,
                data:{_token: csrfToken,
                    image_del: id_box,
                    image_id: image_id
                },
                success: function (data) {
                    console.log('ok');
                    // alert(data);
                    // console.log(data);
                    console.log('last ' + number_activ);
                    console.log('new ' + id_box);
                    card_map = JSON.parse(data);
                    console.log(card_map);

                    $('#box_' + number_activ).css('border','');
                    $('#box_' + id_box).css('border','1px solid #affcf5');
                    $('#box_' + id_box).css('padding-top','30px');
                    $('#box_' + id_box).css('color','#affcf5');
                    $('#box_' + id_box).html('<span>' + (parseInt(id_box) + 1) + '</span>');
                    $('#shadow_' + id_box).remove();
                    number_activ = id_box;
                    $(moveDiv).css('display','');
                },
                error: function(){
                    console.log('error');
                }
            });
        }
        else{
            $('#box_' + number_activ).css('border','');
            $('#box_' + id_box).html('<span>' + (parseInt(id_box) + 1) + '</span>');
            $('#box_' + id_box).css('padding-top','30px');
            $('#box_' + id_box).css('border','1px solid #affcf5');
            $('#box_' + id_box).css('color','#affcf5');
            number_activ = id_box;
            var url_change_activ = $(this).data('url_change_activ');
            $.ajax({
                type:"POST",
                url:url_change_activ,
                data:{_token: csrfToken,
                    number_activ_new: number_activ
                },
                success: function () {
                    console.log('ok');
                    console.log(number_activ);

                    $('#box_' + id_box).html('<span>' + (parseInt(id_box) + 1) + '</span>');
                    $('#box_' + id_box).css('padding-top','30px');
                    $('#box_' + id_box).css('border','1px solid #affcf5');
                    $('#box_' + number_activ).css('border','1px solid #affcf5');
                    $('#box_' + id_box).css('color','#affcf5');
                },
                error: function(){
                    console.log('error');
                }
            });
        }
    });

$(document).ready(function(){

    $('#imagePic1').css('width', WidthMainImage);
    var PicDivHeight = $('#imagePic1').height();
    PicDivWidth = $('#imagePic1').width();
    ratio = (PicDivWidth - 50) / PicMiniWidth;
    wh_item_ratio = wh_item * ratio;
    if(wh_item_ratio > PicDivHeight){
        wh_item_ratio = PicDivHeight - 50;
        ratio = wh_item_ratio / wh_item;
        PicDivWidth = ratio * PicMiniWidth + 50;
        $('#imagePic1').css('width', PicDivWidth);
    }
    $('#imagePic').css('width', PicDivWidth - 50);
    $(moveDiv).css('width', wh_item_ratio);
    $(moveDiv).css('height', wh_item_ratio);

    $("#imagePic1").scroll(function () {
        var TopScrollLimit = parseInt(PicMiniHeight*ratio - wh_item_ratio) + yOffsetPic + 20 - 35 - maxScroll;
        YScroll = $(this).scrollTop();
        if(y < (parseInt(PicMiniHeight*ratio - wh_item_ratio) + yOffsetPic + 20 - YScroll - 35 - maxScroll + YScroll)){
            moveDiv.style.top = (y - yOffsetPic - 20 + YScroll) + 'px';
        }
        else{
            moveDiv.style.top = (TopScrollLimit - parseInt(yOffsetPic) - 20 + parseInt(YScroll)) + 'px';
        }
    });

    setTimeout(function()
    {
        $('#modal_first').modal('show');
    }, 500);

});
