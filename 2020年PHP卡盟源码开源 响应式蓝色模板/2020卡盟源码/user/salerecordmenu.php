
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;" />
<!-- jQueryԪ�� ��ʼ -->
<script src="http://batian.22km.cn:80/js/main/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQueryԪ�� ���� -->

<!-- ����Ԫ�� ��ʼ -->
<link href="http://batian.22km.cn:80/front/2016/11/08/01/css/style.css" rel="stylesheet" type="text/css" />
<!-- ����Ԫ�� ���� -->

<!-- ��Ԫ�� ��ʼ -->
<script src="http://batian.22km.cn:80/js/main/jquery.form.js" type="text/javascript"></script>
<!-- ��Ԫ�� ���� -->

<!-- ʱ��Ԫ�� ��ʼ -->
<link href="http://batian.22km.cn:80/css/jQueryUI/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="http://batian.22km.cn:80/js/jQueryUI/jquery-ui.js" type="text/javascript"></script>
<script src="http://batian.22km.cn:80/js/util/DateUtil.js" type="text/javascript"></script>
<!-- ʱ��Ԫ�� ���� -->
</head>
<body>
	<div class="ifra-right_con">
		<h3 class="column-title">
			<b>���ۼ�¼��ѯ</b>
		</h3>
		<div id="menuBox">








<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript">
	var now = new Date(); //��ǰ����     
	var nowDayOfWeek = now.getDay(); //���챾�ܵĵڼ���     
	var nowDay = now.getDate(); //��ǰ��     
	var nowMonth = now.getMonth(); //��ǰ��     
	var nowYear = now.getYear(); //��ǰ��     
	nowYear += (nowYear < 2000) ? 1900 : 0; //

	//��ʽ�����ڣ�yyyy-MM-dd     
	function formatDate(date) {
		var myyear = date.getFullYear();
		var mymonth = date.getMonth() + 1;
		var myweekday = date.getDate();

		if (mymonth < 10) {
			mymonth = "0" + mymonth;
		}
		if (myweekday < 10) {
			myweekday = "0" + myweekday;
		}
		return (myyear + "-" + mymonth + "-" + myweekday);
	}
	function getWeekStartDate() {
		var weekStartDate = new Date(nowYear, nowMonth, nowDay - nowDayOfWeek);
		return formatDate(weekStartDate);
	}
	//��ñ��µĿ�ʼ����     
	function getMonthStartDate() {
		var monthStartDate = new Date(nowYear, nowMonth, 1);
		return formatDate(monthStartDate);
	}
</script>
<script type="text/javascript">
	$().ready(function(){
		$.datepicker.setDefaults({
			dateFormat : "yy-mm-dd", // ���ڸ�ʽ
			// showAnim : "scale", //��ʾЧ�� slide | scale | fadeIn
			// showButtonPanel : true, //��ʾ��ť���
			// currentText : "����",
			// closeText : "���",
			showOn : "button",
			buttonImage : "http://batian.22km.cn/front/imgs/calendar.gif",
			buttonImageOnly : true,
			selectOtherMonths : true,
			defaultDate : +7,// Ĭ��ʱ��
			dayNamesMin : [ "��", "һ", "��", "��", "��", "��", "��" ],
			monthNames : [ "1��", "2��", "3��", "4��", "5��", "6��", "7��", "8��","9��", "10��", "11��", "12��" ],
			beforeShow : function(picker) { // ��ʼ����С�ڽ�������
				/*
				 * return { minDate : (picker.id == "pickerEndDate" ?
				 * $("#startTime").datepicker("getDate"): null), maxDate :
				 * (picker.id == "pickerStartDate" ?
				 * $("#endTime").datepicker("getDate") : null) }
				 */
				// alert(picker.value);
			}
		});
		$("#startTime,#endTime").datepicker();
		$("#startTime").val($.formatDate(new Date(), 2, 0));
		$("#endTime").val($.formatDate(new Date(), 2, 1));
			
			
		//ʱ��ؼ���ʽ
		$(".period a").click(function(){
			$(".period a").attr("class","date_di");
			$(this).attr("class","date_di date_di_on");
		});
		$("a[name='afterday']").click(function(){
			$("#startTime").val($.formatDate(new Date(), 2, -1));
		});
		$("a[name='today']").click(function(){
			$("#startTime").val($.formatDate(new Date(), 2, 0));
		});
		$("a[name='toweek']").click(function(){
			$("#startTime").val(getWeekStartDate());
		});
		$("a[name='tomonth']").click(function(){
			$("#startTime").val(getMonthStartDate());
		});
			 
		$("a[name='theweek']").click(function(){
			$("#startTime").val($.formatDate(new Date(), 2, -7));
		});
		$("a[name='themonth']").click(function(){
			$("#startTime").val($.formatDate(new Date(), 2, -30));
		});
		$("a[name='thetree']").click(function(){
			$("#startTime").val($.formatDate(new Date(), 2, -90));
		});
	});
</script>


		<form name="saleForm" id="saleForm">
			<div class="capi-search">
				<dl>
					<dt>��ѯ����</dt>
					<dd>
						<input name="inputKeyWord" id="inputKeyWord" type="text" class="input2">
					</dd>
					<dd>
					<select id="inputKeyValue" name="inputKeyValue">
						<option value="1">��ֵ�˺�</option>
						<option value="2">������</option>
						<option value="3">��Ʒ����</option>
					</select>
					</dd>
					<dd>
					<select id="goodType" name="goodType">
						<option value="0">ȫ������</option>
						<option value="1,2">������</option>
						<option value="3">�˹�������</option>
					</select>
				</dd>
				</dl>
				<dl>
					<dt>����״̬</dt>
					<dd>
						<span id="CheckBoxList1">
  							<label><input type="checkbox" value="1" name="orderState" id="orderState">�ȴ�����</label>
  							<label><input type="checkbox" value="2" name="orderState" id="orderState">���ڳ�ֵ</label>
  							<label><input type="checkbox" value="3" name="orderState" id="orderState">���׳ɹ�</label>
  							<label><input type="checkbox" value="4" name="orderState" id="orderState">����ȡ��</label>
  							</span>
					</dd>
				</dl>
				<dl class="period">
					<dt>��ѯʱ��</dt>
					<dd>
						<input type="text" id="startTime" readonly="readonly" name="startTime" value="" class="hasDatepicker"><img class="ui-datepicker-trigger" src="http://batian.22km.cn/front/imgs/calendar.gif" alt="..." title="..."> - <input type="text" id="endTime" readonly="readonly" name="endTime" value="" class="hasDatepicker"><img class="ui-datepicker-trigger" src="http://batian.22km.cn/front/imgs/calendar.gif" alt="..." title="...">
						<a href="javascript:void(0);" name="afterday" class="date_di">����</a>
	                    <a href="javascript:void(0);" name="today" class="date_di date_di_on">����</a>
	                    <a href="javascript:void(0);" name="toweek" class="date_di">����</a>
	                    <a href="javascript:void(0);" name="tomonth" class="date_di">����</a>
	                    <a href="javascript:void(0);" name="theweek" class="date_di">��һ��</a>
	                    <a href="javascript:void(0);" name="themonth" class="date_di">��һ��</a>
	                    <a href="javascript:void(0);" name="thetree" class="date_di">������</a>
					</dd>
				</dl>
				<dl class="opear">
					<dt>
						<input name="nowPage" id="nowPage" value="1" type="hidden">
					</dt>
					<dd>
						<input id="btn_search_user" type="button" value="��ѯ" class="btn1">
					</dd>
				</dl>
			</div>
		</form>
		<div id="paramBox" class="capi-tbl capital">







  
    <title></title>
  
  
  
  	<table>
     <thead>
    	<tr>
        	<th>��������</th>
            <th>��Ʒ����</th>
            <th>����</th>
            <th>����</th>
            <th>���򵥼�</th>
            <th>��ֵ</th>
			<th>Ͷ��</th>
            <th>״̬</th>
        </tr>
    </thead>
    <tbody>
    	
       
       	<tr class="trd">
					<td align="center">2018-04-21 18:11:39 </td>
					<td align="center">test</td>
					<td align="center">����</td>
					<td align="center">1</td>
					<td align="center">0.00</td>
					<td align="center">1.00</td>
					<td align="center">Ͷ�߶���</td>
					<td align="center">״̬</td>
				</tr>
       
  </tbody>
  </table>
  
  <form id="selectOrderForm" name="selectOrderForm" method="post">
					<input type="hidden" value="1" id="allpage" name="allPage">
					<input type="hidden" value="1" id="nowpage" name="nowPage">
					<input type="hidden" value="20" id="everypage" name="everyPage">
					<input type="hidden" value="" name="inputKeyWord">
					<input type="hidden" value="1" name="inputKeyValue">
					<input type="hidden" value="" name="orderState">
					<input type="hidden" value="0" name="goodType">
					<input type="hidden" value="2018-04-21" name="startTime">
					<input type="hidden" value="2018-04-22" name="endTime">
				
					</form>
  <script type="text/javascript">
	$(document).ready(function(){
		$("a[name='showorder']").click(function(){
		var orderid=$(this).attr("id");
		parent.Dialog.win({
			title:"������ϸ��Ϣ<span style='color:red;font-weight: normal;margin-left:25px;'>ע���������Ƶ������Ͽ��Բ鿴���ص���Ϣ</span>",
			iframe:{src:"inter/showordermess.htm?orderid="+orderid},
			width:900,
			height:550
		});
	});
	
	//��ҳ��ѯ
	cutPageOrder=function(num){
		var nowPage=$("#nowpage").val();
		var allPage=$("#allpage").val();
	
		if(num==0){
			$("#nowpage").val("1");
		}
		if(num==-1){
			nowPage=nowPage-1;
			if(nowPage<1){
				nowPage=1;
			}
			
			$("#nowpage").val(nowPage);
		} 
		if(num==1){
			nowPage=parseInt(nowPage)+1;
			if(nowPage>=allPage){
				nowPage=allPage;
			}
			$("#nowpage").val(nowPage);
			
		}
		if(num==2){
			$("#nowpage").val(allPage);	
		}
		
		
		$("#selectOrderForm").ajaxForm({
			url:"salelist.htm",
			dataType:"html",
			type:"post",
			success:function(data){
				$("#paramBox").html(data);
			}
			
		});
		
		$("#selectOrderForm").submit();
	};
	
	});

var ifrheight= Math.min(window.document.documentElement.scrollHeight,window.document.body.scrollHeight);
window.parent.parent.parent.document.getElementById("right").style.height=ifrheight+50+"px";
</script>
<script type="text/javascript">
	$(document).ready(function(){
		InitPage();
	});
	
	function InitPage() {
		$(".table1 .trd").each(function (i) {
        	if (i % 2 == 0) {
            	$(this).addClass("tr1");
            }
            else {
                $(this).addClass("tr2");
            }
            $(this).bind("mouseover", function () {
                this.style.backgroundColor = "#a2dcff";
            });
            $(this).bind("mouseout", function () {
                this.style.backgroundColor = "";
            });
        });
	}
</script>
  

</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#saleForm").ajaxForm({
				url : "salelist.htm",
				type : "post",
				dataType : "html",
				success : function(data) {
					$("#paramBox").html(data);
				}
			});
			$("#saleForm").submit();

			$("#btn_search_user").click(function() {
				$("#saleForm").ajaxForm({
					url : "salelist.htm",
					type : "post",
					dataType : "html",
					success : function(data) {
						$("#paramBox").html(data);
					}
				});
				$("#saleForm").submit();
			});
		});
	</script>


</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#menuBox").load("salerecordparam.htm");
		});
	</script>


<div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body>
</Html>
