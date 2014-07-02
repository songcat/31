$('.addForm a, a.editEntity').click(function (event) {
    event.preventDefault();
    var formType = $(this).attr('id');
    if ($(this).hasClass('editEntity')) {
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
        $('.' + formType + ' .form.' + num).replaceWith(data);
    });
});

$('.services a.reserve').click(function (event) {
    event.preventDefault();
    if ($(this).attr('data-type') == 'place') {
        $('.placeValue').val($(this).attr('data-id'));
        $('.resume .place').html($(this).attr('data-price'));
    }
    else if ($(this).attr('data-type') == 'food') {
        $('.foodValue').val($(this).attr('data-id'));
        $('.resume .food').html($(this).attr('data-price'));
    }
    else {
        $('.musicValue').val($(this).attr('data-id'));
        $('.resume .music').html($(this).attr('data-price'));
    }
});

var getThreadMessage = function ($this) {
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

$('.thread a').click(function (event) {
    event.preventDefault();
    getThreadMessage($(this));
});

$('ul.thread li').click(function () {
    $(this).find('h4').removeClass('new');
});

// menu responsive
$("#btn-nav").click(function (e) {
    e.preventDefault();
    $(this).toggleClass("is-open");
    $('header nav > ul').stop().slideToggle("600");
    if (linkNavH == null) linkNavH = $('nav .has-sub-nav').height();
    $(".btn-sub-nav").css("height", linkNavH);
});

if ($(window).width() < 770) {
    $('.createRallye form').hide();
    $('.createRallye .contentBlock').append('<p class="resolution">Cette fonctionnalité est indisponible pour votre résolution</p>');
}

$(window).resize(function () {
    if ($(window).width() < 770) {
        $('.createRallye form').hide();
        if (!$('p.resolution'))
            $('.createRallye .contentBlock').append('<p class="resolution">Cette fonctionnalité est indisponible pour votre résolution</p>');
        else
            $('p.resolution').show();
    }
    else {
        $('.createRallye form').show();
        $('p.resolution').remove();
    }
})