
<?php
session_start();
include "connection.php";

if(!(isset($_SESSION['admin'])))
{?>
     <script>
            window.location="adminlogin.php";
        </script>
<?php
}

    $u= $_SESSION['admin'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>display_student_info</title>


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
                            <li><a href="display_student_info.php"><i class="fa fa-graduation-cap" ></i> Student Info <span class="fa fa-chevron-down"></span></a>

                            </li>
                            <li><a href="book_details_with_students.php"><i class="fa fa-book"></i>Book Info <span class="fa fa-chevron-down"></span></a>

                            </li>
                            
                            <li><a href="add_books.php"><i class="fa fa-plus"></i>Add Books <span class="fa fa-chevron-down"></span></a>

                            </li>
                            <li><a href="delete.php"><i class="fa fa-minus"></i> Delete Books <span
                                    class="fa fa-chevron-down"></span></a>

                            </li>
                            <li><a href="issue_books.php"><i class="fa fa-arrow-right"></i> Issue Books <span class="fa fa-chevron-down"></span></a>

                            </li>
                            <li><a href="return_book.php"><i class="fa fa-arrow-left"></i> Return Books <span class="fa fa-chevron-down"></span></a>

                            </li>
                            <li><a href="send_notification.php"><i class="fa fa-mail-forward"></i> Send Message To Student <span
                                    class="fa fa-chevron-down"></span></a>

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
                                <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">0</span>
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
                                <h2>Students Info</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                            <?php
                                $res=mysqli_query($link,"select * from studreg");
                            ?>
                            <div style="overflow-x:auto;">
                            <table class="table table-bordered">
                                <tr>
                                <th>Name</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>MobileNo</th>
                                <th>Semester</th>
                                <th>EnrollementNo</th>
                                <th>Status</th>
                                <th colspan=2>Action</th>
                                </tr>

                                <?php
                                    while($row=mysqli_fetch_array($res))
                                    {
                                        echo "<tr>";
                                        echo "<td>";echo $row["name"];echo "</td>";
                                        echo "<td>";echo $row["uname"];echo "</td>";
                                        echo "<td>";echo $row["email"];echo "</td>";
                                        echo "<td>";echo $row["phone"];echo "</td>";
                                        echo "<td>";echo $row["sem"];echo "</td>";
                                        echo "<td>";echo $row["eno"];echo "</td>";
                                        echo "<td>";echo $row["status"];echo "</td>";
                                        echo "<td>";?><a href="aproove.php?id=<?php echo $row["id"]; ?>">Aproove</a><?php echo "</td>";
                                        echo "<td>";?><a href="reject.php?id=<?php echo $row["id"]; ?>">Reject</a><?php echo "</td>"; 
                                    }
                                ?>
                            </table>
                            </div>
                            <?php
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