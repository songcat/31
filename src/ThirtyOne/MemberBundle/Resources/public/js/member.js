$('.addForm a').click(function () {
    var formType = $(this).attr('class');
    $.ajax({
        type: "POST",
        url: '/ThirtyOne/web/app_dev.php/inscription/getAjax',
        data: {form: formType}
    }).done(function (data) {
        $('.form').html(data);
    });
})
