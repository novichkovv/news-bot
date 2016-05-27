/**
 * Created by asus1 on 29.08.2015.
 */

/**
 *
 * @param params
 */

var ajax = function ajax(params)
{
    if(!params.values)params.values = new Object;
    params.values.ajax = true;
    params.values.action = params.action;
    if(params.common) {
        params.values.common = true;
    }
    if(params.get_from_form)
    {
        $("#" + params.get_from_form + " input:not([type='checkbox'],[type='radio']), #" + params.get_from_form + " textarea, #" + params.get_from_form + " select").each(function()
        {
            params.values[$(this).attr('name')] = $(this).val();
        });
        $("#" + params.get_from_form + " input[type='checkbox']").each(function()
        {
            if($(this).prop('checked')) {
                params.values[$(this).attr('name')] = $(this).val();
            }
        });
        $("#" + params.get_from_form + " input[type='radio']").each(function()
        {
            if($(this).prop('checked')) {
                params.values[$(this).attr('name')] = $(this).val();
            }
        });
        $("#" + params.get_from_form + " .summernote").each(function()
        {
            params.values[$(this).attr('data-name')] = $(this).code();
        });
    }
    $.ajax(
        {

            url: params.url ? params.url : '',
            type: 'post',
            data: params.values,
            success: function(result)
            {
                params.callback(result);
            }
        }
    );
};

/**
 *
 * @param form_id
 * @returns {boolean}
 */

var validate = function validate(form_id)
{
    var form = $("#" + form_id);
    var validate = true;
    $('.validate-message').each(function()
    {
        $(this).removeClass('down');
        $(this).slideUp();
    });
    $('.has-error').each(function()
    {
        $(this).removeClass('has-error');
    });
    $('.has-error-note').each(function()
    {
        $(this).removeClass('has-error-note');
    });
    $(form).find('[data-require="1"], select.data-required').each(function()
    {
        var val;
        if($(this).hasClass('summernote')) {
            val = $("#" + $(this).attr('id')).code();
        } else {
            val = $(this).val();
        }
        if(!val || val == '' || val === null || (val == false && val !== 0))
        {
            $(this).parent().find('.error-require').slideDown();
            $(this).parent().find('.error-require').addClass('down');
            if($(this).hasClass('summernote')) {
                $(this).next('.note-editor').addClass('has-error-note');
            } else {
                $(this).addClass('has-error');
            }
            validate = false;
        }
    });

    $(form).find('[data-validate="email"]').each(function()
    {
        var regexp = /^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/;
        if($(this).val() && !regexp.test($(this).val())) {
            if(!$(this).attr('.error-require') || $(this).parent().find('.error-require').css('display') == 'none')
                $(this).parent().find('.error-validate').slideDown();
            validate = false;
        }
    });

    $(form).find('[data-validate="password"]').each(function()
    {
        if($(this).val() != $(form).find('[data-validate="repeat_password"]').val())
        {
            if($(form).find('[data-validate="repeat_password"]').parent().find('.error-require').css('display') == 'none' ||
                !$(form).find('[data-validate="repeat_password"]').parent().find('.error-require').length) {
                $(form).find('[data-validate="repeat_password"]').parent().find('.error-validate').slideDown();
            }
            validate = false;
        }
    });

    $(form).find('[data-min]').each(function()
    {
        var min = $(this).attr('data-min');
        if($(this).val().length < min && $(this).parent().find('.error-require').css('display') == 'none') {
            $(this).parent().find('.error-min').slideDown();
            validate = false;
        }
    });

    $(form).find('[data-max]').each(function()
    {
        var min = $(this).attr('data-max');
        if($(this).val().length < min && $(this).parent().find('.error-require').css('display') == 'none') {
            $(this).parent().find('.error-max').slideDown();
            validate = false;
        }
    });

    $(form).find('[data-one_ten="1"]').each(function()
    {
        var val = $(this).val();
        if((isNaN(parseInt(val)) || parseInt(val) < 0 || parseInt(val) > 10)) {
            $(this).parent().find('.error-one_ten').slideDown();
            validate = false;
        }
    });

    return(validate);

};

/**
 *
 * @param str
 * @param charlist
 * @returns {*}
 */

function trim( str, charlist ) {	// Strip whitespace (or other characters) from the beginning and end of a string
    charlist = !charlist ? ' \s\xA0' : charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\$1');
    var re = new RegExp('^[' + charlist + ']+|[' + charlist + ']+$', 'g');
    return str.replace(re, '');
}


/**
 *
 * @param id
 */

function ajax_datatable(id)
{
    var oTable = $("#" + id).dataTable({
        "destroy": $.fn.dataTable.isDataTable("#" + id),
        "bJQueryUI": false,
        "bAutoWidth": false,
        //"sPaginationType": "full_numbers",
        "sDom": '<"datatable-header"Tfl><"datatable-scroll"t><"datatable-footer"ip>',
        "sAjaxSource": '?',
        "bServerSide": true,
        "fnServerParams": function ( aoData ) {
            aoData.push(
                { "name": "ajax", "value": true },
                { "name": "action", "value": id }
            );
            var params = Object();
            $('.filter-field').each(function(){
                if($(this).val())
                    params[$(this).attr('name')] = {"value" : $(this).val(), "sign" : $(this).attr('data-sign')};
            });
            aoData.push({"name" : "params", "value" : JSON.stringify(params)});
        },
        "oLanguage": {
            "sLengthMenu": "<span></span> _MENU_",
            "oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": "<i class=\"fa fa-angle-right\"></i>", "sPrevious": "<i class=\"fa fa-angle-left\"></i>" }
        },
        "oTableTools": {
            "sRowSelect": "single",
            "sSwfPath": "/media/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sButtonText": "Copy",
                    "sButtonClass": "btn"
                },
                {
                    "sExtends": "print",
                    "sButtonText": "Print",
                    "sButtonClass": "btn"
                },
                {
                    "sExtends": "collection",
                    "sButtonText": "Save <span class='caret'></span>",
                    "sButtonClass": "btn btn-primary",
                    "aButtons": [ "csv", "xls", "pdf" ]
                }
            ]
        }
    });
    $('.filter-field').change(function(){
        oTable.fnFilter();
    });
}

/**
 *
 * @param selector
 * @param action
 */

function ajax_select2(selector, action)
{
    $(selector).select2({
        ajax: {
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params,
                    action: action,
                    ajax: 'true'
                };
            },
            results: function(data) {
                return {  results: data };

            },
            cache: true
        },
        minimumInputLength: 2
    });
}

/**
 *
 * @param params
 */

function ajax_file_upload(params)
{
    var btnUpload = $('#'+ (params.button ? params.button : 'upload_btn'));
    var status = $('#' + (params.status ? params.status : 'upload_status'));
    new AjaxUpload(btnUpload, {
        action: params.action ? params.action : '',
        name: params.name ? params.name : 'file',
        data: params.data,
        onSubmit: function(file, ext){
            if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                status.text('Only JPG, PNG or GIF files are allowed');
                return false;
            }
            status.html(params.status_upload ? params.status_upload : '<img src="http://' + document.domain + '/images/main/pl_90.GIF" />');
        },
        onComplete: function(file, msg){
            ajax_respond(msg,
                function(respond) {
                    status.html('');
                    params.success(respond);
                },
                function(respond) {
                    if(typeof params.error == 'function') {
                        params.error();
                    } else {
                        Notifier.error('Не удалось загрузить изображение');
                    }
                }
            );
        }
    });
}

/**
 *
 * @param function_name
 * @returns {boolean}
 */

function function_exists( function_name ) {
    if (typeof function_name == 'string'){
        return (typeof window[function_name] == 'function');
    } else{
        return (function_name instanceof Function);
    }
}

/**
 *
 * @param needle
 * @param haystack
 * @returns {boolean}
 */

function in_array(needle, haystack) {
    var found = false, key;

    for (key in haystack) {
        if (haystack[key] == needle) {
            found = true;
            break;
        }
    }
    return found;
}

/**
 *
 * @param msg
 * @param success
 * @param fail
 * @param ret
 * @returns {*}
 */

function ajax_respond(msg, success, fail, ret) {
    try {
        var respond = JSON.parse(msg);
    }
    catch (e) {
        if(ret) {
            return e;
        } else {
            Notifier.error('Непредвиденная Ошибка!');
        }
    }
    if(respond.status == 1) {
        success(respond);
        return false;
    } else {
        if(ret) {
            return respond.error;
        } else {
            if(typeof fail == 'function') {
                fail(respond);
            } else {
                for(var i in respond.error) {
                    for(var j in respond.error[i]) {
                        for(var type in respond.error[i][j]) {
                            Notifier.error(respond.error[i][j][type]['text']);
                        }
                    }
                }
            }
        }
    }


}

function slideToAnchor(anchor, speed) {
    if(undefined === speed) {
        speed = 1000;
    }
    var $anchor = $(anchor);
    var destination = $anchor.offset().top;
    $("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination}, speed);
}
