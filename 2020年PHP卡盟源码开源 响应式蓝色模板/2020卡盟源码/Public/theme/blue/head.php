 <div class="header">
        <dl class="top">
           
            <dd>
                <a href="javascript:" id="JuHeShe.CN" onclick="this.style.behavior='url(#default#homepage)';this.setHomePage(location.href);">��Ϊ��ҳ</a>
                <a onclick="window.external.addFavorite('http://'+document.domain,document.title);" href="javascript:"  id="JuHeShe.CN">�����ղ�</a>
                <a href="/news.php">ƽ̨��̬</a></dd>
        </dl>
    </div>
    <!--endͷ�ļ�-->
    <div class="header_c">
        <div class="header_c_t">
            <div style="float:left;margin-top:10px;width:680px;height:80px;">
            <div style="float:left;">
                <a href="/">
                    <img src="<?=$site_logo?>"  alt="<?=$site_name?>" />
                </a>
            </div>
            </div>
            <!--end��־-->
            <div class="header_r">
                <ul class="t_tool_nav th">
                    <li id="liAgent" class="t_1"><a id="JuHeShe.CN">���Զ� </a></li>
                    <li id="liYKT" class="t_2"><a id="JuHeShe.CN">�ֻ���</a></li>
                </ul>
            </div>
            <!--endͷ�ļ���-->
        </div>
        <!--endͷ�ļ�������-->
    </div>
    <!--endͷ�ļ���-->
    <div class="nav">
        <ul class="nav th">
            <li id="nav_hover01" ><a href="/"><span>�� ҳ</span></a></li>
            <li  ><a href="/reg.php"><span>�û�ע��</span></a></li>
            <li  ><a href="/news.php"><span>ƽ̨��̬</span></a></li>
			<?php if ($site_menu!='') {
$allArray=(explode("\n",$site_menu));    ////�� explode �� �س� �����ݸ���������
foreach($allArray as $value) 
{
$allArray1=(explode('��',$value));       ////�� explode �� �� �����ݸ���������
?>
<li><a href="<?=$allArray1[1]?>" target="_blank"><span><?=$allArray1[0]?></span></a></li>
<?php
} 
} ?>
              
        </ul>
    </div>
    <!--end����-->