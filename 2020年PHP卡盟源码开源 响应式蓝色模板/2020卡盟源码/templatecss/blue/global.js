$(function(){
//��ʼ��ǩ���������б仯��
var $tab_dd = $("div.tab_c_nav dl dd")
$tab_dd.click(function(){
if($('div.tool_box').is(":hidden")){
$('div.tool_box').show();
}
$(this).addClass("tab_light").siblings().removeClass("tab_light");
var index = $tab_dd.index(this);
$("div.tab_c_box > div").eq(index).show().siblings("div").hide();
}).hover(function(){
$(this).addClass("tab_hover");
},function(){
$(this).removeClass("tab_hover");
});
//��ǩ���������һ��dd��Ҫ��
$('div.tab_c_nav dl').each(function() {
$(this).children('dd:last').addClass('last');  
});	
//�ı���
$("input.input_search_text").focus(function(){         // ��ַ������꽹��
if($(this).val()==this.defaultValue){
$(this).val("");
}
});
$("input.input_search_text").blur(function(){		  // ��ַ��ʧȥ��꽹��
if($(this).val()==""){
$(this).val(this.defaultValue);
}
});
});



$(document).ready(function () {
    //�۽����������֤ 
    $(".login_text1").live("focus", function () {
        $(this).siblings("span").hide();
        $(this).parent().siblings("span").hide();
    });
    $(".login_text1").live("blur", function () {
        var val = $(this).val();
        if (val != "") {
            $(this).siblings("span").hide();
        } else {
            $(this).siblings("span").show();
            $(this).parent().siblings("span").show()
        }
    });
    $(".login_text1").each(function () {
        var thisVal = $(this).val();
        //�ж��ı����ֵ�Ƿ�Ϊ�գ���ֵ�������������ʾ�û��ֵ����ʾ
        if (thisVal != "") {
            $(this).siblings("span").hide();
        } else {
            $(this).siblings("span").show();
        }

        //        $(this).focus(function () {
        //            $(this).siblings("span").hide();
        //            $(this).parent().siblings("span").hide()

        //        }).blur(function () {
        //            var val = $(this).val();
        //            if (val != "") {
        //                $(this).siblings("span").hide();
        //            } else {
        //                $(this).siblings("span").show();
        //                $(this).parent().siblings("span").show()
        //            }
        //        });
    });

});
  
  
  
$(document).ready(function(){
$("#hidenav").mouseover(function(){
  $("#others").show();
});
$("#hidenav").mouseout(function(){
  $("#others").hide();
});


});
