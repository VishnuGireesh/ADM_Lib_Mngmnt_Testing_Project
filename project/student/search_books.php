
<?php
    session_start();
    include "connection.php";
    
    if(!(isset($_SESSION['student'])))
{?>
     <script>
            window.location="login.php";
        </script>
<?php
}
    $u= $_SESSION['student'];
    $tot=0;
    $res=mysqli_query($link,"select * from messages where dusername='$u' && read1='n'");
    $tot=mysqli_num_rows($res);

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>search_books</title>


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/nprogress.css" rel="stylesheet">
    <link href="css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="#" class="site_title"><i class="fa fa-book"></i> <span>LMS</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>

                        <h2><?php echo $u ?></h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a href="my_issued_books.php"><i class="fa fa-book"></i> My Books <span class="fa fa-chevron-down"></span></a>

                            </li>
                            <li><a href="search_books.php"><i class="fa fa-search" ></i> Search Books <span class="fa fa-chevron-down"></span></a>

                            </li>
                            <li><a href="message_from_library.php"><i class="fa fa-comments"></i> Msg From Library <span class="fa fa-chevron-down"></span></a>

                            </li>
                            

                        </ul>
                    </div>


                </div>

            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="images/img.jpg" alt=""><?php echo $u ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="s_logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green" onclick="window.location='message_from_library.php'"><?php echo $tot ?></span>
                            </a>

                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->





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
                                <h2>Search Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                            <form name="ss" method="POST">
                            <input type="text" name="key" placeholder="Enter keyword" class="form-control" required><br>
                            <button type="submit" name="sub">SEARCH</button>
                            </form>

                        </div>
                       <?php
                        if(isset($_POST["sub"]))
                        {
                            ?>

                            <table class="table table-bordered">
                                <tr>
                                    <?php
                                         $i=0;
                                         $qury="select * from books where name like ('%$_POST[key]%') && a_qty>0"  or die (mysqli_error());
                                         $result=mysqli_query($link,$qury);
                                         while($row=mysqli_fetch_array($result))
                                    {
                                        $a=$row["image"];
                                            $b="books_image/";
                                            $c=$b.$a;
    
                                        $i=$i+1;
                                        echo "<td>";?> <img src="<?php echo $c; ?>" height="100px" width="100px">  <?php 
                                        echo "<br><b>"; echo $row["name"]; echo "</b></br>";
                                        echo "<br><b>Available : "; echo $row["a_qty"]; echo "</b></br>";
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

                        <?php
                        }

                        else{

                        ?>
                        
                                
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
                                        echo "<br><b>Available : "; echo $row["a_qty"]; echo "</b></br>";
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

                                <?php }
                                
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