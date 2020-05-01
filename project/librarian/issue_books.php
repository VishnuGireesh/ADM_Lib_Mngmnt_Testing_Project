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
                                <h2>Issue Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                Add content to the page ...
                                <form name="f1" method="post">
                                    <select name="enoo" id="ee" class="form-control">
                                        <option>--Choose--</option>
                                        <?php
                                            $res=mysqli_query($link,"select eno from studreg");
                                            while($row=mysqli_fetch_array($res))
                                            {
                                                echo "<option>";
                                                echo $row["eno"];
                                                echo"</option>";
                                            }
                                        ?>
                                    </select>
                                <button type="submit" name="sub">SUBMIT</button>

                                </form>
    
                            </div>
                        <div id="issuebox">
                            <?php
                                if(isset($_POST["sub"]))
                                {

                                   $res=mysqli_query($link,"select * from studreg where eno=$_POST[enoo]");


                                   while($rows=mysqli_fetch_array($res))
                                   {
                                       $name=$rows["name"];
                                       $sem=$rows["sem"];
                                       $phone=$rows["phone"];
                                       $mail=$rows["email"];
                                       $uname=$rows["uname"];
                                   }
                                    ?>

                                    <form name="sform"  method="post">

                                                <input type="text" placeholder="Enrollement no" name="enumber" class="form-control" value="<?php echo $_POST["enoo"]; ?>" readonly><br>

                                                <input type="text" placeholder="studentname" name="names" class="form-control" value="<?php echo $name; ?>" ><br>

                                                <input type="text" placeholder="studentsem" name="sems" class="form-control"  value="<?php echo $sem; ?>" ><br>

                                                <input type="text" placeholder="studentcontact" name="phones" class="form-control" value="<?php echo $phone; ?>" ><br>

                                                <input type="text" placeholder="studentemail" name="emails" class="form-control" value="<?php echo $mail; ?>"><br>
                                                
                                                <input type="text" placeholder="student username" name="unames" class="form-control"  value="<?php echo $uname; ?>"><br>

                                                <select name="book" id="ee" class="form-control" >
                                                    <option>--choose--</option>
                                                    <?php
                                                        $m=mysqli_query($link,"select name from books where a_qty>0");
                                                        while($r=mysqli_fetch_array($m))
                                                        {
                                                            echo "<option>";
                                                            echo $r["name"];
                                                            echo"</option>";
                                                        }
                                                    ?>

                                                </select><br>

                                                <input type="date" placeholder="bookissuedate" name="idate" class="form-control" value="<?php echo date('Y-m-d'); ?>"><br>

                                                <button type="submit" name="sub2">ISSUE BOOK</button>

                                                

                                        </form>
                                    
                                   <?php

                                        }

                                        if(isset($_POST["sub2"]))
                                        {
                                            $qty=0;
                                            $res=mysqli_query($link,"select * from books where name='$_POST[book]'");
                                            while($row=mysqli_fetch_array($res))
                                            {
                                                $qty=$row["a_qty"];
                                            }
                                            if($qty==0)
                                            {?>

                                    <div class="alert alert-success col-lg-6 col-lg-push-3">
                                                 Book Is Not Available
                                         </div>

                                         <Script>
                                             window.setTimeout(function(){
                                                // Move to a new location or you can do something else
                                                window.location.href = "issue_books.php";
                                            }, 5000);
                                         </script>
                                            <?php

                                            }
                                            else{
                                            mysqli_query($link,"insert into issue_books(s_eno,s_name,s_sem,s_contact,s_email,b_name,b_issue_date,b_return_date,s_uname) values($_POST[enumber],'$_POST[names]',$_POST[sems],'$_POST[phones]','$_POST[emails]','$_POST[book]','$_POST[idate]',' ','$_POST[unames]')");
                                            mysqli_query($link,"update books set a_qty=a_qty-1 where name='$_POST[book]'");
                                            ?>
                                            
                                            <div class="alert alert-success col-lg-6 col-lg-push-3">
                                                 Book Issued successfully!!
                                         </div>

                                         <Script>
                                             window.setTimeout(function(){
                                                // Move to a new location or you can do something else
                                                window.location.href = "issue_books.php";
                                            }, 5000);
                                         </script>

                                            <?php
                                            }
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