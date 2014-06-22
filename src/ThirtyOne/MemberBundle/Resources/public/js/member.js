$('.addForm a, a.editEntity').click(function () {
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
        data: {form: formType, id: id}
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
