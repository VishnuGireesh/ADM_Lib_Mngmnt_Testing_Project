<?php

include "connection.php";
include "headder.php";

if(!(isset($_SESSION['admin'])))
{?>
     <script>
            window.location="adminlogin.php";
        </script>
<?php
}

?>

        <!-- page content area main -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3></h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Book With Details</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                            <table class="table table-bordered">
                                <tr>

                                <?php
                                    $i=0;
                                    $res=mysqli_query($link,"select * from books where a_qty>0");
                                    while($row=mysqli_fetch_array($res))
                                    {
                                        $a=$row["image"];
                                            $b="books_image/";
                                            $c=$b.$a;
    
                                        $i=$i+1;
                                        echo "<td>";?> <img src="<?php echo $c; ?>" height="100px" width="100px">  <?php 
                                        echo "<br><b>"; echo $row["name"]; echo "</b></br>";
                                        echo "<br><b>Available : "; echo $row["a_qty"]; echo "</b>";
                                        echo "<br><b>Total : "; echo $row["qty"]; echo "</b>";
                                        echo "<br>"; ?> <a href="book_borrowers.php?bname=<?php echo $row["name"];  ?>" style="color:red;">Current Borrowers</a><?php echo "</b></br>";
                                        echo "</td>";

                                        if($i==4)
                                        {
                                            echo "</tr>";
                                            echo "<tr>";
                                            $i=0;
                                        }

                                    }
                                ?>
                                </table>    

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->


        <?php
            include "footer.php";
        ?>