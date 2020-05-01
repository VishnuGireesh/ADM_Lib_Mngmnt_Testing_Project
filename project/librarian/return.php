<?php
    include "connection.php";
    $id=$_GET["id"];
    $d=date('Y-m-d');

    $res=mysqli_query($link,"update issue_books set b_return_date='$d' where id=$id");
    
    $bname="";
    $res=mysqli_query($link,"select * from issue_books where id=$id");
    
    while($row=mysqli_fetch_array($res))
    {
        $bname=$row["b_name"];
    }

    mysqli_query($link,"update books set a_qty=a_qty+1 where name='$bname'");

?>

<script>
    window.location="return_book.php";
</script>