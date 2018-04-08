/*global  $, console, alert */
$(document).ready(function () {
    'use strict';
    $(window).scroll(function () {
        if ($(this).scrollTop() >= $('.navbar').height()) {
            $('.navbar').addClass('scrolled');
            
        } else {
            $('.navbar').removeClass('scrolled');
        }
    });
    // Tabs choose
    var listItem = $('section.tabs .tab-switch li');
    $(listItem).click(function () {
        $(this).addClass('active').siblings().removeClass('active');
        $('section.tabs .tab-content > div').fadeOut();
        $('.' + $(this).data('class')).fadeIn();
    });
});