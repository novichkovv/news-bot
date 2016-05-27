/**
 * Created by asus1 on 22.12.2015.
 */
$ = jQuery.noConflict();
$(document).ready(function() {
    $("body").on("click", ".sidebar-plus-btn", function()
    {
        $(this).closest('ul').find('.sidebar-child').slideDown();
        $(this).removeClass('sidebar-plus-btn');
        $(this).addClass('sidebar-minus-btn');
    });

    $("body").on("click", ".sidebar-minus-btn", function()
    {
        $(this).closest('ul').find('.sidebar-child').slideUp();
        $(this).removeClass('sidebar-minus-btn');
        $(this).addClass('sidebar-plus-btn');
    })
});