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
                                <h2>Send Notification to Student</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                            <form method="POST" enctype='multipart/form-data'>
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <select class="form-control" name="dusername">
                                            <option>---Choose---</option>
                                            <?php
                                            $res=mysqli_query($link,"select * from studreg");
                                            while($row=mysqli_fetch_array($res))
                                            {
                                                ?>
                                                <option value="<?php echo $row["uname"] ?>">
                                                    <?php echo $row["uname"]."(".$row["eno"].")"; ?>
                                                </option>
                                                <?php
                                            } 
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="title" placeholder="Enter title">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea name="msg" class="form-control" placeholder="Enter msg"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" name="sub" value="SEND MESSAGE">
                                    </td>
                                </tr>
                            </table>
                            </form>

                            <?php
                                if(isset($_POST["sub"]))
                                {   
                                    $admin=$_SESSION['admin'];
                                    echo $admin;
                                    mysqli_query($link,"insert into messages(susername,dusername,title,msg,read1) values('$admin','$_POST[dusername]','$_POST[title]','$_POST[msg]','n')");
                                    ?>
                                        <div class="alert alert-success col-lg-6 col-lg-push-3">
                                                 Message Send successfully!!
                                         </div>

                                         <Script>
                                             window.setTimeout(function(){
                                                // Move to a new location or you can do something else
                                                window.location.href = "send_notification.php";
                                            }, 5000);
                                         </script>
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