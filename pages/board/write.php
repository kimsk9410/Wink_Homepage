<?php include_once('../../header.php')?>

<script>
function check_form(form) {
 if  (!write_form.name.value)
 {
  alert('이름을 입력하세요');
  write_form.name.focus();
  return;
 }
 if  (!write_form.passwd.value)
 {
  alert('패스워드를 입력하세요');
  write_form.passwd.focus();
  return;
 }
 if  (!write_form.subject.value)
 {
  alert('글 제목을 입력하세요');
  write_form.subject.focus();
  return;
 }
 if  (!write_form.content.value)
 {
  alert('글 내용을 입력하세요');
  write_form.content.focus();
  return;
 }
 write_form.submit();
}
function go_list() {
 location.href="list.php";
}
 </script>
<?php
$mode=$_GET["mode"];
if(!$mode)
 $mode="form";
if(!strcmp($mode,"form"))
{
?>
<br>
<form name ="write_form" method = "POST"  action = "write.php?mode=post">
<table width=750 align=center border=0>
 <tr>
  <td>
   <font size=4 color=black face="휴먼엽서체"><b>&nbsp&nbsp 새 글쓰기 </b></font>
  </td>
 </tr>
 <tr><td height=6 bgcolor=#a7cbec></td></tr>
</table>
  <table width = "730" border=0 cellspacing ="1" cellpadding ="1" align=center>
   <tr>
    <td width =100  bgcolor="#a7cbec" align=center>
     <font size=2 face="휴먼엽서체"/>
    글쓴이 (*)
    </td>
    <td>
     <input type = "text" name ="name" size =20 >
    </td>
   </tr>
   <tr>
    <td width=100 bgcolor="#a7cbec" align=center>
     <font size=2 face="휴먼엽서체"/>
     패스워드 (*)
    </td>
    <td>
     <input type = "password" name ="passwd" size =21>
    </td>
   </tr>
   <tr>
    <td width=100 bgcolor="#a7cbec" align=center>
     <font size=2 face="휴먼엽서체"/>
     이메일
    </td>
    <td>
     <input tupe ="text" name ="email" size=40>
    </td>
   </tr>
   <tr>
    <td width=100 bgcolor="#a7cbec" align=center>
     <font size=2 face="휴먼엽서체"/>
    학번
    </td>
    <td>
     <input tupe ="text" name ="stu_num" size=40>
    </td>
   </tr>
   <tr>
    <td width=100 bgcolor="#a7cbec" align=center>
     <font size=2 face="휴먼엽서체"/>
    글 제목 (*)
    </td>
    <td>
     <input tupe ="text" name = "subject" size ="90">
    </td>
   </tr>
   <tr>
    <td width=100 bgcolor="#a7cbec" align=center>
     <font size=2 face="휴먼엽서체"/>
    글 내용 (*)
    </td>
    <td>
     <textarea name="content" cols="88" rows="10"></textarea>
    </td>
   </tr>
  </table>
  <table width ="750" border="0" cellspacing ="5" cellpadding="0" align=center>
   <tr>
   <td colspan=3 height=7 bgcolor=#a7cbec align=center >
    <input type = "button" onclick="go_list();" value = "글목록">
     <input type = "button" onclick="check_form();" value = "입력확인">
     <input type = "button" onclick="form.reset()" value = "다시 쓰기">
   </td>
   </tr>
  </table>
</form>
<?php
}
 
else if(!strcmp($mode,"post"))
{
// -------- DB 접속 부분 --------------
 include "./dbconn.inc";
 
 $table_name="board";
 $query="select max(gno) from $table_name";  //max 는 gno필드의 최대값을 추출
 $result=mysql_query($query,$dbconn) or die("DB접속 혹은 쿼리에 실패하였습니다.".mysql_error());
 $row=mysql_fetch_row($result);
// -------- 변수 받는 부분 -------------
 if($row[0])
  $gno=$row[0]+1;
 else
  $gno=1;
 
 $subject =addslashes($_POST[subject]);
 $content =addslashes($_POST[content]);
 $register_date = time();
 $client_ip = getenv('REMOTE_ADDR');   //getenv - 환경변수값을 얻습니다.
 $name=($_POST[name]);
    $passwd=($_POST[passwd]);
 $email=($_POST[email]);
 $stu_num=($_POST[stu_num]);
 
$query="insert into $table_name(gno,reply_depth,name,passwd,email,stu_num,subject,content,register_date,client_ip) values('$gno','A','$name',password('$passwd'),'$email','$stu_num','$subject','$content','$register_date','$client_ip')";
$result=mysql_query($query,$dbconn) or die("DB접속 혹은 쿼리에 실패하였습니다.".mysql_error());

 ?>
 <script language="javascript">
  document.location.href='list.php';
 </script>
<?php
}
?>

<?php include_once('../../footer.php')?>