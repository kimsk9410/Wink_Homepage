<?php include_once('../../header.php')?>
  <br>
  <h1> 공지사항 <h1>
<?
include "dbconn.inc";
$table_name="board";
$mode=$_GET[mode];
$read_uno=$_GET[read_uno];
$pn=$_GET[pn];
$map_en=$_GET[map_en];

if( !strcmp($mode,"read")){
 $query = "update $table_name set hit = hit + 1 where uno = $read_uno";
 if (!$query){ die ('update 쿼리에 실패했습니다'.mysql_error()); }
 $result = mysql_query($query,$dbconn);
 $query="select name,email,stu_num,subject,content,client_ip from $table_name where uno = $read_uno";
 if (!$query){ die ('select 쿼리에 실패했습니다'.mysql_error()); }
 $result = mysql_query($query,$dbconn);
 $name=mysql_result($result,0,0);
 $email=mysql_result($result,0,1);
 $stu_num=mysql_result($result,0,2);
 $subject=mysql_result($result,0,3);
 $content=mysql_result($result,0,4);
 $client_ip=mysql_result($result,0,5);
 $subject = htmlspecialchars($subject);
 $subject = stripslashes($subject);
  $content = htmlspecialchars($content);
  $content = nl2br($content);
?>
<div id="list">
<table align=center border=1>
 <tr><td colspan=3 class="topBar"></td></tr>
 <tr><td colspan=3 height=6 ></td></tr>
 <tr>
  <td class="col1" bgcolor=7db4e7 color=ffffff>Title</td>
  <td align=left > <? echo("$subject");?> </td>
 </tr>
 <tr>
  <td class="col1" bgcolor=7db4e7 color=ffffff>Writer</td>
  <td class="col2" align=left> 
   <? 
    if($email) 
     echo("<a href = \"mailto:$email\">$name   [ <u>$email</u> ]</a>");
    else
     echo ("$name");
   ?>
  </td>
 </tr>
 <tr>
  <td class="col1" bgcolor=7db4e7 color=ffffff>
  Student No.
  </td>
  <td colspan=1 class="col2" align=left>
  <?
  if($stu_num)
   echo ("<a target = \"_blank\">$stu_num</a>");
  else
   echo("");
  ?>
  </td>
 </tr>
  <tr><td colspan=3 height=6 ></td></tr>
  <tr><td colspan=3 class="topBar"></td></tr>
</table>
</div>
<table align=center>
 <tr>
  <td align=left>
   <br>
   <blockquote><?php echo(" $content "); ?></blockquote>
  </td>
 </tr>
</table>

<div id=content_menu>
<table align=center>
 <tr>
  <td width = "375" align = "right" bgcolor="#a7cbec" >
<!--   <a href = "./reply.html?mode=form&reply_uno=<?php echo("$read_uno"); ?>"> [답글 쓰기]</a> -->
   <a href = "modify.php?mode=form&modify_uno=<?=$read_uno ?>&pn=<?=$pn ?>"> [글 수정]</a>
   <a href = "delete.php?mode=form&delete_uno=<?=$read_uno ?>&pn=<?=$pn ?>"> [글 삭제]</a>
  </td>
 </tr>
</table>
</div>
<br>
<br>
<?
}
?>
<table align=center>
 <tr class="heading2">
  <td width ="50" align="center" >
  No.
  </td>
  <td width ="420" align="center">
  Title
  </td>
  <td width ="100" align="center">
  Writer
  </td>
  <td width ="100" align="center">
  Date
  </td>
  <td width ="80" align="center">
  Hit
  </td>
 </tr>
<?php
 $query="select uno,gno,reply_depth,name,email,subject,register_date,hit from $table_name order by gno desc, reply_depth asc";
 $result=mysql_query($query,$dbconn);
 $total_record=mysql_num_rows($result);
 $page_num=10;               // 환경설정 : 한화면에 몇개의 list를 뿌려주는 것

 if ( ($total_record - $page_num) > 0 ) 
 {
	$list_num=$total_record / $page_num;
	$list_max=ceil($list_num);         // 반올림
 }
 else
  $list_max=1;
// ----- 페이지 맵 구현하기 -------
 if ($pn)
 {
 $list_st=$total_record - ($total_record - ($pn - 1)* $page_num);
 $list_en=$list_st + $page_num;
 $article_no = $total_record - ($pn - 1) * $page_num;
 }
 else                    // 페이지 번호가 없을경우
 {
  $list_st=0;
  $list_en=$page_num;
  $article_no = $total_record;
 }
 
// ----- 리스트 출력하기 ------
 if ( $list_en > $total_record )         // pn 제한걸기
  $list_en=$total_record;
 
 for($i=$list_st ;$i < $list_en ;$i++)
 {
  $uno = mysql_result($result, $i, 0);
     $gno = mysql_result($result, $i, 1);
     $reply_depth = mysql_result($result, $i, 2);
     $name = mysql_result($result, $i, 3);
     $email = mysql_result($result, $i, 4);
     $subject = mysql_result($result, $i, 5);
     $register_date = mysql_result($result, $i, 6);
     $hit = mysql_result($result, $i, 7);
	 $subject = stripslashes($subject);
	 $register_date = date("Y-m-d",$register_date);
?>
  
<tr>
 <td align = "center"><?php echo("$article_no"); ?></td>
 <td><a href = "list.php?mode=read&read_uno=<?=$uno ?>&pn=<?=$pn ?>&map_en=<?=$map_en ?>"> <? echo ("$subject"); ?></a> </td>
 <td align = "center"><?php echo("$name");?></td>
 <td align = "center"><?php echo("$register_date");?></td>
 <td align = "center"><?php echo("$hit");?> </td>
</tr>
<?php
 $article_no--;
 }

if(!$total_record)
{
 ?>
 <tr>
  <td align = "center" colspan="5">
  글이 존재하지 않습니다.
  </td>
 </tr>
<?php
}
?>
</table>
<table border=0 cellspacing=0 cellpadding=0 align=center>
 <tr>
  <td width=500 align=center>
  <?php
// list map 보여주기
  if  ( $list_max < 10 )
  {
    for ( $i=1 ; $i<$list_max  ; $i++ )
    {
     $pn=$i;
     echo ("<a href=list.php?pn=$pn>[$i]</a>");
    }
  }
   else
   {
 
   if (!$map_en)
   {
    $map_st=$list_max-($list_max-1);
    $map_en=$list_max-($list_max-10);
   }
   else
   {
   $map_st=$map_en+1;
   $map_en=$map_en+10;
   }
   if ( $list_max > 10 )
   {
    if (( $map_en > 10 ))
    { 
     // 이전 페이지 구현
     $pn_pr=$map_st -10;
     $map_pr=$map_en-20;
     echo ("<font size=1 color=green> <a href=./list.html?pn=$pn_pr&map_en=$map_pr> <<이전페이지 </a></font>");
    }
     for ( $i=$map_st ; $i <= $map_en ; $i++ )
     {
      if ( $list_max >= $i ) {
       $pn=$i;
       $map=$map_en-10;      // 현재 map 에 나오는 index [??] 가 가져야 하는 값
       echo ("<a href=list.php?pn=$pn&map_en=$map >[$i]</a>");
       }
     }
     // 다음페이지 구현
    
    if  (floor($list_max / 10) > ($map_st / 10 ) )
    {
    $pn=$pn+1;           // 다음페이지 클릭시 페이지에 뿌려줘야하는 pn
    echo ("<font size=1 color=green> <a href=list.php?pn=$pn&map_en=$map_en> 다음 페이지>> </a></font>");
    }
   }
    
   }

  ?>
    
  </td>
  <td align=right>
   <a href="list.php">[글 목록]</a>
   <a href="write.php?mode=form">[글 쓰기]</a>
  </td>
 </tr>
</table>

<?php include_once('../../footer.php')?>
