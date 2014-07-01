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
         $('.'+formType+' .form.' + num).replaceWith(data);
    });
});

$('.service a.reserve').click(function(event) {
    event.preventDefault();
    if($(this).attr('data-type')=='place') {
        $('.placeValue').val($(this).attr('data-id'));
        $('.resume .place').html($(this).attr('data-price'));
    }
    else if ($(this).attr('data-type')=='food'){
        $('.foodValue').val($(this).attr('data-id'));
        $('.resume .food').html($(this).attr('data-price'));
    }
    else {
        $('.musicValue').val($(this).attr('data-id'));
        $('.resume .music').html($(this).attr('data-price'));
    }
});

var getThreadMessage = function($this) {
    var thread = $this.attr('data-info');
    $.ajax({
        type: "POST",
        url: '/ThirtyOne/web/app_dev.php/message/getMessage',
        data: {thread: thread}
    }).done(function (data) {
        $('.threadMessages').html(data);
    });
};

getThreadMessage($(".thread a:first-child"));

$('.thread a').click(function(event) {
    event.preventDefault();
    getThreadMessage($(this));
});