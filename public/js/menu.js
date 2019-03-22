//献立登録：メニュー朝プルダウンの＋マーク
function btn1_list_add() {
    var menu_name1 = $('.selecter_1 option:selected').text();
    window.alert(menu_name1);
    if (menu_name1 != "（選択してください）") {
        $('input:hidden[name="menu_name1"]').val(menu_name1);
        document.frm1list.submit();
    }
}
//献立登録：メニュー昼プルダウンの＋マーク
function btn2_list_add() {
    var menu_name2 = $('.selecter_2 option:selected').text();
    window.alert(menu_name2);
    if (menu_name2 != "（選択してください）") {
        $('input:hidden[name="menu_name2"]').val(menu_name2);
        document.frm2list.submit();
    }
}
//献立登録：メニュー夜プルダウンの＋マーク
function btn3_list_add() {
    var menu_name3 = $('.selecter_3 option:selected').text();
    window.alert(menu_name3);
    if (menu_name3 != "（選択してください）") {
        $('input:hidden[name="menu_name3"]').val(menu_name3);
        document.frm3list.submit();
    }
}

//献立登録：メニュー朝自由入力の＋マーク
function btn4_list_add() {
    var menu_name4 = $('#free_menu1').val();
    window.alert(menu_name4);
    if (menu_name4 != "（選択してください）") {
        $('input:hidden[name="menu_name4"]').val(menu_name4);
        document.frm4list.submit();
    }
}
//献立登録：メニュー昼自由入力の＋マーク
function btn5_list_add() {
    var menu_name5 = $('#free_menu2').val();
    window.alert(menu_name5);
    if (menu_name5 != "（選択してください）") {
        $('input:hidden[name="menu_name5"]').val(menu_name5);
        document.frm5list.submit();
    }
}
//献立登録：メニュー夜自由入力の＋マーク
function btn6_list_add() {
    var menu_name6 = $('#free_menu3').val();
    window.alert(menu_name6);
    if (menu_name6 != "（選択してください）") {
        $('input:hidden[name="menu_name6"]').val(menu_name6);
        document.frm6list.submit();
    }
}

// $('#editview').click(function() {
//     var edit_date = $('.selecter_4 option:selected').text();
//     window.alert(edit_date);
    
//     //document.frm7list.submit();
// })

//献立編集：
function editview() {
    var edit_date = $('.selecter_7 option:selected').text();
    $('input:hidden[name="edit_date"]').val(edit_date);
    document.frm7list.submit();
}