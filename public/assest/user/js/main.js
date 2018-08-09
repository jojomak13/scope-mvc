function msg(msgContent, type = 1, fieldName = '')
{
    var options = {
        "positionClass": (fieldName) ? "toast-bottom-left" : "toast-top-full-width",
        "timeOut": 3000,
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "tapToDismiss": false

    };
    
    switch(type) {
        case '1':
            toastr.success(msgContent, fieldName, options);
        break;
        case '2':
            toastr.error(msgContent, fieldName, options);
        break;
        case '3':
            toastr.warning(msgContent, fieldName, options);
        break;
        case '4':
            toastr.info(msgContent, fieldName, options);
        break;
    }
}
