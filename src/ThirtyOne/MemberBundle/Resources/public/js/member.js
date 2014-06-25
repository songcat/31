$('.addForm a, a.editEntity').click(function (event) {
    event.preventDefault();
    var formType = $(this).attr('id');
    if($(this).hasClass('editEntity')) {
        var id = $(this).attr('class').split(" ")[1];
        var num = id;
    }
    else {
        var num = $(this).attr('class');
        var id = null;
    }
    $.ajax({
        type: "POST",
        url: '/ThirtyOne/web/app_dev.php/profil/getAjax',
        data: {form: formType, id: id, num: num}
    }).done(function (data) {
         $('.'+formType+' .form .' + num).replaceWith(data);
    });
});
/*
$('.recherche form').submit(function () {
    var family = $("input#form_family").val();
    var region = $("option:selected").val();
    $.ajax({
        type: "POST",
        url: '/ThirtyOne/web/app_dev.php/rechercher/getResult/'+family+'_'+region
    }).done(function (data) {
        $('.results').html(data);
    });
    return false;
});*/

$('.service a.reserve').click(function(event) {
    event.preventDefault();
    if($(this).attr('data-type')=='place') {
        $('input#form_place').val($(this).attr('data-id'));
        $('.resume .place').html($(this).attr('data-price'));
    }
    else if ($(this).attr('data-type')=='food'){
        $('input#form_food').val($(this).attr('data-id'));
        $('.resume .food').html($(this).attr('data-price'));
    }
    else {
        $('input#form_music').val($(this).attr('data-id'));
        $('.resume .music').html($(this).attr('data-price'));
    }
});