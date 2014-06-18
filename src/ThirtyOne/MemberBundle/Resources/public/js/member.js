$('.addForm a').click(function () {
    var formType = $(this).attr('id');
    var num = $(this).attr('class');
    $.ajax({
        type: "POST",
        url: '/ThirtyOne/web/app_dev.php/profil/getAjax',
        data: {form: formType}
    }).done(function (data) {
        $('.'+formType+' .form .' + num).replaceWith(data);
    });
});
