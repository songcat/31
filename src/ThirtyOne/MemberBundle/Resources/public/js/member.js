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
    family = $("input#form_family").val();
    region = $("option:selected").val();
    $.ajax({
        type: "POST",
        url: '/ThirtyOne/web/app_dev.php/rechercher/getResult/'+family+'_'+region
    }).done(function (data) {
        $('.results').replaceWith(data);
    });
});
