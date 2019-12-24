/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//当关闭reservation页面时会将用户的订单记录清空
$(function () {
    $(window).unload(function () {
        $.ajax({
            url: "./EmptyRecord.php",
            type: 'POST',
            async: false,
            data: {
                ViderListe: "TRUE"
            },
            success: function (data) {
            },
            error: function () {
                alert("#");
            }
        });
    });
});


