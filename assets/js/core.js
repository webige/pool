var $redirectable = 0;
var $remove = 0;

$(document).ready(function () {

    //clear old input
    $('.popupForm').click(function(){
        $('.ajax-form :input').prop('disabled',false);
        $('.ajax-form :input').prop('readonly',false);
        $('.ajax-form input[name="id"]').remove();
        // $('.ajax-form input[type="hidden"]').removeAttr('value');
        $('.ajax-form').trigger('reset');
        $('.modalWindow').modal({ show: true});
    });

    //dynamically handle form ajax requests just add that class to form and magic ^_^ if form has parameter data-redirect="true" after response 200 OK it's reload page
    $('.ajax-form').on("submit",function (e) {
        e.preventDefault();
        var passwordField = $('.ajax-form input[type=password]');

        if (passwordField.val() !== undefined ) {
            if (passwordField.val().length === 0)
                passwordField.prop('disabled',true);
        }

        $form = $('.ajax-form').serialize();
        if ($(this).attr('data-redirect')){
            $redirectable = 1;
        }
        sendAjaxRequest(
            $(this).attr('method'),
            $(this).serialize(),
            $(this).attr('action'),
            defaultSuccessAjaxResponseHandler,
            defaultErrorAjaxResponseHandler
        );
        passwordField.prop('disabled',false);

    })

    //handling switchery on/off dynamically
    $('.switcheryHandling').on("change",function () {
        checkboxState = $(this).prop('checked');
        data = {
            id:$(this).attr('data-id'),
            state:0
        };
        if (checkboxState){
            data.state = 1;
        }
        sendAjaxRequest(
            'POST',
            data,
            $(this).attr('data-route'),
            defaultSuccessAjaxResponseHandler,
            defaultErrorAjaxResponseHandler
        );
    });

    //handling delete with sweetalert
    $('.sa-warning').click(function () {
        deleteObject = $(this);
        if (deleteObject.attr('data-remove')){
            $remove = deleteObject.attr('data-id');
        }
        if (deleteObject.attr('data-redirect')){
            $redirectable = 1;
        }
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            data = {
                id:deleteObject.attr('data-id')
            };
            sendAjaxRequest(
                'POST',
                data,
                deleteObject.attr('data-route'),
                swalSuccessAjaxResponseHandler,
                defaultErrorAjaxResponseHandler
            )
        });
    });

    $('.editForm').click(function () {
        if ($(this).attr('data-redirect')){
            $redirectable = 1;
        }
        sendAjaxRequest(
            'POST',
            {id:$(this).attr('data-id')},
            $(this).attr('data-route'),
            responseFormDataAjaxSuccessHandler,
            defaultErrorAjaxResponseHandler,
        )
    });


});


/**
 *
 * @param method
 * @param data
 * @param url
 * @param success
 * @param error
 * @description Sending ajax
 * @author jedy
 * @company EW.ge
 */
function sendAjaxRequest(method,data,url,success,error){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:url,
        type:method,
        data:data,
    }).done(success).fail(error);
}

/**
 * @param data
 * @description default success handler with Notifable library
 * @author jedy
 * @company EW.GE
 */
function defaultSuccessAjaxResponseHandler(data) {
    $.Notification.notify('success','top right',data.action,data.message);
    if ($remove !== 0 ){
        $('.tableResponsive tr#'+$remove).remove();
    }
    if ($redirectable === 1){
        setTimeout(function () {
            window.location.reload(true);
        },1500)
    }
}


/**
 * @param data
 * @description default error handler with Notifable library
 * @author jedy
 * @company EW.GE
 */
function defaultErrorAjaxResponseHandler(data) {
    var errorHtml = "<ul>"

    if(data.status == 422) {
        $.each(data.responseJSON.errors, function (key, item) {
            errorHtml += "<li>"+item+"</li>";

        });
    }
    errorHtml += "</ul>"
    $.Notification.notify('error','top right','Validation Error',errorHtml)
}

/**
 * @param data
 * @description swal success handler w
 * @author jedy
 * @company EW.GE
 */
function swalSuccessAjaxResponseHandler(data){
    swal(data.action,data.message, "success");
    if ($remove !== 0 ){
        $('.tableResponsive tr#'+$remove).remove();
    }
    if ($redirectable === 1){
        setTimeout(function () {
            window.location.reload(true);
        },1500)
    }
}

/**
 * @param data
 * @description builds modal form from responsed fields it compares sql-field = form-field if equals binding it, and also adding hidden input id for updating current object
 * @author jedy
 * @company EW.GE
 */
function responseFormDataAjaxSuccessHandler(data) {

    // bind the translational fields
    if (data.hasOwnProperty('translations')){
        for (var i = 0; i<data['translations'].length; i++){
            Object.keys(data['translations'][i]).forEach(function (k) {
                currentLocaleWildCard = data['translations'][i]['locale'];
                keyString = currentLocaleWildCard+'['+k+']';
                $('.formEditable input[name="'+keyString+'"]').val(data['translations'][i][k]);

            })
        }
    }

    //bind media if exists
    //todo this not required here
    if (data.hasOwnProperty('media')){
        //bind single media
        if (data['media'][0] !== undefined){
            var fullpath = $('meta[name="site-url"]').attr('content');
            fullpath+= "/media/";
            fullpath+=data['media'][0]['image'];
            $('.mediaPathSettable').val(fullpath);
        }
    }

    Object.keys(data).forEach(function (key) {
        console.log(data[key]);

        //if input has unique fields that we need to be ignored until update
        if ($('.formEditable input[name="'+key+'"]').attr('data-ignore')){
            $('.formEditable input[name="'+key+'"]').prop('disabled', true)
        }
        if ($('.formEditable select[name="'+key+'"]').length > 0){
            $('.formEditable option[value="'+data[key]+'"]').prop("selected",true)
        }
        //adding hidden input for handling exactly what object is
        if (key === "id")
            $('.formEditable').append('<input type="hidden" name="id" value="'+data[key]+'">');

        //detect checkbox to make it checked
        if ($('.formEditable input[name="'+key+'"]').attr('type') === "checkbox") {
            if (data[key] === 1 && !$('.formEditable input[name="'+key+'"]').is(':checked')){
                $('.formEditable input[name="'+key+'"]').click();
            }if (data[key] === 0 && $('.formEditable input[name="'+key+'"]').is(':checked')) {
                $('.formEditable input[name="'+key+'"]').click();
            }
        }else{
            $('.formEditable input[name="'+key+'"]').val(data[key]);
        }
    })
    //finally showing modal
    $('.modalWindow').modal({ show: true});
}
$('.form').serialize();

// $.post('url',json,function(){
//
// });