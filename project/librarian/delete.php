<?php
    include "connection.php";
    $id=$_GET["id"];

    if(isset($_GET["id"]))
    {
        mysqli_query($link,"delete from books where id=$id");
    ?>
<script>
    window.location="display_books.php";
</script>
<?php
    }
    else{?>
            <script>
    window.location="display_books.php";
</script>
      <?php  
    }
    ?>