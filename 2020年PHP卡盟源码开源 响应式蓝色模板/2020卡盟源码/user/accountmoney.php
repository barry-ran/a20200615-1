

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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

<!-- ��ѡԪ�� ��ʼ -->
<script src="http://batian.22km.cn:80/js/util/CheckBoxUtil.js" type="text/javascript"></script>
<!-- ��ѡԪ�� ���� -->
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
</head>
<body>
	<div class="ifra-right_con">
		<h3 class="column-title">
			<b>�ʽ���ϸ</b>
		</h3>
		<form name="saleForm" id="saleForm">
			<div class="capi-search">
				
				<dl class="period">
					<dt>��ѯʱ��</dt>
					<dd>
						<input type="text" id="startTime" readonly="readonly" name="startTime" value=""/> - <input type="text" id="endTime" readonly="readonly" name="endTime" value=""/>
						<a href="javascript:void(0);" name="afterday"  class="date_di">����</a>
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
						<input name="nowPage" id="nowPage" value="1" type="hidden"/>
					</dt>
					<dd>
						<input id="btn_search_user" type="button" value="��ѯ" class="btn1" />
					</dd>
				</dl>
			</div>
		</form>
		<div id="paramBox" class="capi-tbl capital">
			<table>
	<thead>
		<tr>
			<th width="15%">��������</th>
			<th width="6%">��������	</th>
			<th width="12%">����(<?=$moneytype?>)</th>
			<th width="5%">֧��(<?=$moneytype?>)	</th>
			<th width="5%">�仯ǰ(<?=$moneytype?>)</th>
			<th width="8%">�仯��(<?=$moneytype?>)</th>
		</tr>
	</thead>
	
		<tbody>
			
				<tr class="trd">
					<td align="center">2018-04-21 18:11:39 </td>
					<td align="center">
						
						
						΢��֧��
						
						
						
						
					</td>
					<td align="center">WX201804211802453861</td>
					<td align="center">105.0</td>
					<td align="center">֧��ʧ��
						
						
					</td>
					<td align="center">�ȴ�����</td>
				</tr>
		</tbody>
	
	
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px; padding-bottom:15px; padding-right:50px;">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?> </td>
</tr>
</table>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#saleForm").ajaxForm({
			url:"moneyDetailList.htm",
			type:"post",
			dataType:"html",
			success:function(data){
				$("#paramBox").html(data);
			}
		});
		$("#saleForm").submit();
		
		
		$("#btn_search_user").click(function(){
		$("#saleForm").ajaxForm({
			url:"moneyDetailList.htm",
			type:"post",
			dataType:"html",
			success:function(data){
				$("#paramBox").html(data);
			}
		});
		$("#saleForm").submit();
		});
	});
	</script>
</body>
</Html>
