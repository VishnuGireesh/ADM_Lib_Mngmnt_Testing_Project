<?php
include "connection.php";
include "headder.php";
if(!(isset($_SESSION['admin'])))
{

    ?>
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
                                <h2>Display Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                            <form name="ss" method="POST">
                            <input type="text" name="key" placeholder="Enter keyword" class="form-control" required>

                            <button type="submit" name="sub">SEARCH</button>
                            </form>

                            <?php
                            if(isset($_POST["sub"]))
                            {
                                $qury="select * from books where name like ('%$_POST[key]%')"  or die (mysqli_error());
                                $result=mysqli_query($link,$qury);
                                
                                $count=0;
                                $count=mysqli_num_rows($result);

                                ?>
                               
                                <table class="table table-bordered">
                                    <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Author</th>
                                    <th>Publication</th>
                                    <th>Quantity</th>
                                    <th>Available Quantity</th>
                                     <th>Delete Books</th>
                                    </tr>
    
                                    <?php
                                        while($row1=mysqli_fetch_array($result))
                                        {
                                            $a=$row1["image"];
                                            $b="books_image/";
                                            $c=$b.$a;
    
                                            echo "<tr>";
                                            echo "<td>";echo $row1["name"];echo "</td>";
                                            echo "<td>";?> <img src="<?php echo $c; ?>" height="100px" width="100px"><?php echo "</td>";
                                            echo "<td>";echo $row1["author"];echo "</td>";
                                            echo "<td>";echo $row1["publication"];echo "</td>";
                                            echo "<td>";echo $row1["qty"];echo "</td>";
                                            echo "<td>";echo $row1["a_qty"];echo "</td>";
                                            echo "<td>";
                                        ?>
                                        <a href="delete.php?id=<?php echo $row1["id"] ?>">Delete Book</a>
                                        <?php
                                            echo "</tr>";
                                            $count=$count-1;
                                            
                                        }
                                    ?>
                                </table>
                                    <?php } 
                            else{
                            
                                $res=mysqli_query($link,"select * from books");

                            ?>
                           
                            <table class="table table-bordered">
                                <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Author</th>
                                <th>Publication</th>
                                <th>Quantity</th>
                                <th>Available Quantity</th>
                                <th>Delete Books</th>
                                </tr>

                                <?php
                                    while($row=mysqli_fetch_array($res))
                                    {
                                        $a=$row["image"];
                                        $b="books_image/";
                                        $c=$b.$a;

                                        echo "<tr>";
                                        echo "<td>";echo $row["name"];echo "</td>";
                                        echo "<td>";?> <img src="<?php echo $c; ?>" height="100px" width="100px"><?php echo "</td>";
                                        echo "<td>";echo $row["author"];echo "</td>";
                                        echo "<td>";echo $row["publication"];echo "</td>";
                                        echo "<td>";echo $row["qty"];echo "</td>";
                                        echo "<td>";echo $row["a_qty"];echo "</td>";
                                        echo "<td>";
                                        ?>
                                        <a href="delete.php?id=<?php echo $row["id"] ?>">Delete Book</a>
                                        <?php
                                        echo "</td>";
                                        
                                    }
                                ?>
                            </table>
                            <?php
                         } 
                         ?>
                               
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