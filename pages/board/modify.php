<?php include_once('../../header.php')?>
  <br>
<script language="javascript">
 function check_form(form) {
 if  (!modify_form.name.value)
 {
  alert('이름을 입력하세요');
  modify_form.name.focus();
  return;
 }
 if  (!modify_form.passwd.value)
 {
  alert('패스워드를 입력하세요');
  modify_form.passwd.focus();
  return;
 }
 if  (!modify_form.subject.value)
 {
  alert('글 제목을 입력하세요');
  modify_form.subject.focus();
  return;
 }
 if  (!modify_form.content.value)
 {
  alert('글 내용을 입력하세요');
  modify_form.content.focus();
  return;
 }
 modify_form.submit();
}
function go_list() {
 location.href="list.php";
}
</script>

<?php
include "dbconn.inc";
$table_name="board";
$mode=$_GET["mode"];
$modify_uno=$_GET["modify_uno"];
if(!$mode)
 $mode="form";
if(!strcmp($mode,"form"))
{
 $query="select name,email,stu_num,subject,content,client_ip from $table_name where uno=$modify_uno";
 $result=mysql_query($query,$dbconn);
 $name=mysql_result($result,0,0);
 $email=mysql_result($result,0,1);
 $stu_num=mysql_result($result,0,2);
 $subject=mysql_result($result,0,3);
 $content=mysql_result($result,0,4);
 $client_ip=mysql_result($result,0,5);
 
 $subject=htmlspecialchars($subject);
 $subject=stripslashes($subject);
  $content=htmlspecialchars($content);
 $content=stripslashes($content);
?>
<form name = "modify_form" method="post" action="modify.php?mode=post&modify_uno=<?php echo "$modify_uno"; ?> ">
<table width=750 align=center border=0>
 <tr>
  <td>
   <font size=4 color=black face="휴먼엽서체"><b>&nbsp&nbsp 글 수정하기 </b></font>
  </td>
 </tr>
 <tr><td height=6 bgcolor=#a7cbec></td></tr>
</table>
  <table width = "730" border=0 cellspacing ="1" cellpadding ="1" align=center>
   <tr>
    <td width =100  bgcolor="#a7cbec" align=center>
     <font size=2 face="휴먼엽서체"/>
    <p class="an">글쓴이 (*)</p>
    </td>
    <td>
     <input type = "text" name ="name" class="an" onMouseOver="this.style.background='#c3cbd2'" onMouseOut="this.style.background='white'" value="<?php echo "$name"; ?>" size =20 >
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
     <input tupe ="text" name ="email" value="<?php echo "$email"; ?>" size=40>
    </td>
   </tr>
   <tr>
    <td width=100 bgcolor="#a7cbec" align=center>
     <font size=2 face="휴먼엽서체"/>
    학번
    </td>
    <td>
     <input tupe ="text" name ="stu_num" value="<?php echo "$stu_num"; ?>" size=40>
    </td>
   </tr>
   <tr>
    <td width=100 bgcolor="#a7cbec" align=center>
     <font size=2 face="휴먼엽서체"/>
    글 제목 (*)
    </td>
    <td>
     <input tupe ="text" name = "subject" value="<?php echo "$subject"; ?>" size ="90">
    </td>
   </tr>
   <tr>
    <td width=100 bgcolor="#a7cbec" align=center>
     <font size=2 face="휴먼엽서체"/>
    글 내용 (*)
    </td>
    <td>

     <textarea name="content" cols="88" rows="10"><?php echo $content ?></textarea>
    </td>
   </tr>
  </table>
  <table width ="750" border="0" cellspacing ="5" cellpadding="0" align=center>
   <tr>
   <td colspan=3 height=7 bgcolor=#a7cbec align=center>
    <input type = "button" onclick="go_list();" value = "글목록" >
     <input type = "button" onclick="check_form();" value = "입력확인">
     <input type = "button" onclick="form.reset()" value = "다시 쓰기">
   </td>
   </tr>
  </table>
</form>
<?php
}else if(!strcmp($mode,"post")){
 
 
 $passwd=$_POST[passwd];
 $query="select passwd from $table_name where uno=$modify_uno";
 $result=mysql_query($query,$dbconn);
 $real_passwd=mysql_result($result,0,0);
 $query="select password('$passwd')";
 $result=mysql_query($query,$dbconn);
 $input_passwd=mysql_result($result,0,0);
 if(strcmp($real_passwd,$input_passwd))
 {
?>
  <script language="javascript">
   alert("패스워드가 일치하지 않습니다!");
   history.back();
  </script>
<?php
 exit();
 }
 //변수 받는 부분//
 $subject =addslashes($_POST[subject]);
 $content =addslashes($_POST[content]);
 $name=($_POST[name]);
    $passwd=($_POST[passwd]);
 $email=($_POST[email]);
 $stu_num=($_POST[stu_num]);


 $query="update $table_name set name='$name',email='$email',stu_num='$stu_num',subject='$subject',content='$content'";
 $result=mysql_query($query,$dbconn);
?>
 <script language=javascript>
  document.location.href='list.php';
 </script>
 
<?php
}
?>

<?php include_once('../../footer.php')?>
