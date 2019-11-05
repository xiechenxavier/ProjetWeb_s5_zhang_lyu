/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    $("#datepicker").datepicker();
    $(document).on('click', '.btn_hide', function () {
        $(".menu").toggle("slow");
        $(".btn_show").toggle("slow");
        //$(".btn_show").css("display","fixed");
        $(this).toggle("slow");
    });

    $(document).on('click', '.btn_show', function () {
        $(".menu").toggle("slow");
        $(".btn_hide").toggle("slow");
        $(this).toggle("slow");

    });
    $(document).on('click', '.but_hide_tab', function () {
        $("#tableau").toggle("slow");
        $(".but_show_tab").toggle(1000);
        $(this).toggle();
    });
    $(document).on('click', '.but_show_tab', function () {
        $("#tableau").toggle("slow");
        $(".but_hide_tab").toggle("slow");
        $(this).toggle();
    });
});

