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
                        <h3>Plain Page</h3>
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
                                <h2>Return_Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                
                            <form name="f1" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                    <select name="enoo" id="ee" class="form-control">
                                        <option>--Choose eno--</option>
                                        <?php
                                            $res=mysqli_query($link,"select s_eno from issue_books where b_return_date='0000-00-00'");
                                            while($row=mysqli_fetch_array($res))
                                            {
                                                echo "<option>";
                                                echo $row["s_eno"];
                                                echo"</option>";
                                            }
                                        ?>
                                    </select></td>

                                <td><button type="submit" name="sub" class="form-control" style="background-color:blue;color:white;">SELECT</button></td>
                                </tr>
                            </table>          
                                </form>

                                <table class="table table-bordered">
                                <tr>
                                <th>Enrollement</th>
                                <th>Name</th>
                                <th>Sem</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Bookname</th>
                                <th>Issue Date</th>
                                <th></th>
                                </tr>

                                <?php
                                
                                    if(isset($_POST["sub"]))
                                    {
                                        $res=mysqli_query($link,"select * from issue_books where s_eno=$_POST[enoo] && b_return_date='0000-00-00'");
                                        while($row=mysqli_fetch_array($res))
                                        {
                                            echo "<tr>";
                                            echo "<td>"; echo $row["s_eno"]; echo "</td>";
                                            echo "<td>"; echo $row["s_name"]; echo "</td>";
                                            echo "<td>"; echo $row["s_sem"]; echo "</td>";
                                            echo "<td>"; echo $row["s_contact"]; echo "</td>";
                                            echo "<td>"; echo $row["s_email"]; echo "</td>";
                                            echo "<td>"; echo $row["b_name"]; echo "</td>";
                                            echo "<td>"; echo $row["b_issue_date"]; echo "</td>";
                                            echo "<td>";?> <a href="return.php?id=<?php echo $row["id"] ?>"> Return Book </a> <?php echo "</td>";
                                            echo "</tr>";

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