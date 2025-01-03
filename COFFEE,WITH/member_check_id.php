<!DOCTYPE html>
<head>
<meta charset="utf-8">
<style>
.title {
   padding-left: 5px;
   font-size: 20px;
   font-weight:600;
}
#close {
   margin:20px 0 0 80px;
   cursor:pointer;
}
.login_btn {
   width: 90px;
   height: 30px;
   background-color: #DAC0A3;
   color: #fff;
   cursor: pointer;
   text-align: center;
   line-height: 30px;
   border-radius: 10px;
   font-size: 13px;
   margin: 40px 0 0 140px;
}
</style>
</head>
<body>
<div class="title">아이디 중복체크</div>
<p>
<?php
   $id = $_GET["id"];

   if(!$id) 
   {
      echo("<div>&nbsp;아이디를 입력해 주세요!</div>");
   }
   else
   {
      $con = mysqli_connect("localhost", "user1", "12345", "sample");

 
      $sql = "select * from members where id='$id'";
      $result = mysqli_query($con, $sql);

      $num_record = mysqli_num_rows($result);

      if ($num_record)
      {
         echo "<div>&nbsp;".$id." 아이디는 중복됩니다.</div>";
         echo "<div>&nbsp;다른 아이디를 사용해 주세요!</div>";
      }
      else
      {
         echo "<div>&nbsp;".$id." 아이디는 사용 가능합니다.</div>";
      }
    
      mysqli_close($con);
   }
?>
</p>
<div id="close">
   <div class="login_btn" onclick="javascript:self.close()">닫기</div>
</div>
</body>
</html>

