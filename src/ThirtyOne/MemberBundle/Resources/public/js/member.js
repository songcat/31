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
});
