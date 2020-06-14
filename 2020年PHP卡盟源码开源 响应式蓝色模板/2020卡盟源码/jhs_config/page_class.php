
<?php
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}
class page{

private $total;      //���ݱ������ݵ�������
private $listRows;  //ÿҳ��ʾ����
private $limit; 
private $uri; 
private $pageNum;       //ҳ��
private $listNum=8;    //�б���Ŀ Ĭ�ϵ���8
private $config=array("Header"=>"��¼","Prev"=>"��һҳ","Next"=>"��һҳ","First"=>"�� ҳ","Last"=>"β ҳ");
public function __construct($total,$listRows=10){
$pages=inject_check($_GET['page']);
if ($pages==''){
$pages=1;	
}

$this->total=$total;
$this->listRows=$listRows;
$this->uri=$this->getUri();
$this->page=!empty($pages) ? $pages:1 ;
$this->pageNum=ceil($this->total/$this->listRows);
$this->limit=$this->setLimit();
$this->ypages=$pages ."/". $this->pageNum;
}

private function setLimit(){
return "Limit ".($this->page-1)*$this->listRows.",{$this->listRows}";
}
private function getUri(){
$url=$_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?");
$parse=parse_url($url);
if(isset($parse["query"])){
parse_str($parse["query"],$params);
unset($params["page"]);
$url=$parse['path'].'?'.http_build_query($params);
}
return  $url;
}
public function __get($args){
if ($args=="limit")
return  $this->limit;
else
return  null;
}
private function start(){
if ($this->total==0)
return 0;
else
return ($this->page-1)*$this->listRows+1;
}
private function end(){
return min($this->page*$this->listRows,$this->total);
}
private function First(){
if($this->page==1)
$html="<a href='#'>{$this->config["First"]}</a>";
else
$html="<a href='{$this->uri}&page=1'>{$this->config["First"]}</a>";
return $html;
}
private function Prev(){
if($this->page==1)
$html="<a href='#'>{$this->config["Prev"]}</a>";
else
$html="<a href='{$this->uri}&page=".($this->page-1)."'>{$this->config["Prev"]}</a>";
return $html;
}


private function pageList(){
$linkpage="";
$iunm=floor($this->listNum/2);
for($i=$iunm;$i>=1;$i--){
$page=$this->page-$i;
if($page<1)
continue;
$linkpage.="<a href='{$this->uri}&page={$page}'>{$page}</a>";
}
$linkpage.="<span class='current'>{$this->page}</span>";
for($i=1;$i<$iunm;$i++){
$page=$this->page+$i;
if($page<=$this->pageNum)
$linkpage.="<a href='{$this->uri}&page={$page}'>{$page}</a>";
else
break;
}
return $linkpage;
}
private function Next(){
if($this->page==$this->pageNum)
$html="<a href='#'>{$this->config["Next"]}</a>";
else
$html="<a href='{$this->uri}&page=".($this->page+1)."'>{$this->config["Next"]}</a>";
return $html;
}
private function Last(){
if($this->page==$this->pageNum)
$html="<a href='#'>{$this->config["Last"]}</a>";
else
$html="<a href='{$this->uri}&page=".($this->pageNum)."'>{$this->config["Last"]}</a>";
return $html;
}
private function Gopage(){
return '<input onkeyup="value=this.value.replace(/\D+/g,\'\')" type="text" onKeyDown="javascript:if(event.keyCode==13){var page=(this.value>'.$this->pageNum.')?'.$this->pageNum.':this.value;location=\''.$this->uri.'&page=\'+page+\'\'}" value="'.$this->page.'" style="width:25px"';
}

private function total(){
$html="<a href='#'>�ܼ�¼: $this->total �� ҳ��: $this->ypages </a>";
return $html;
}




function paging(){
$html="<div class='pager'>";
$html.=$this->total();
$html.=$this->First();
$html.=$this->Prev();
$html.=$this->pageList();
$html.=$this->Next();
$html.=$this->Last();
$html.="</div>";
//$html.=$this->Gopage();//ҳ����ת
return $html;
}
}
?>