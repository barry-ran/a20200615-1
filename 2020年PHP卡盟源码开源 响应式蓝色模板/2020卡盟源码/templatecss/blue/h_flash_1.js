//jquer�Ľ���ͼƬ�Զ�����
$(function(){
	var sw = 0;
	$("div.tab .num dd").mouseover(function(){
		sw = $(".num dd").index(this);
		myShow(sw);
	});
	function myShow(i){
		$("div.tab .num dd").eq(i).addClass("cur").siblings("dd").removeClass("cur");
		$("div.tab ul li").eq(i).stop(true,true).fadeIn(600).siblings("li").fadeOut(600);
	}
	//����ֹͣ������������ʼ����
	$("div.tab").hover(function(){
		if(myTime){
		   clearInterval(myTime);
		}
	},function(){
		myTime = setInterval(function(){
		  myShow(sw)
		  sw++;
		  if(sw==5){sw=0;}
		} , 3000);
	});
	//�Զ���ʼ
	var myTime = setInterval(function(){
	   myShow(sw)
	   sw++;
	   if(sw==5){sw=0;}
	} , 3000);
});