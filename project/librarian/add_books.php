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
                        <h3>ADD BOOKS</h3>
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
                                <h2></h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                               
                                <form method="POST" enctype='multipart/form-data'>
                                    
                                       
                                        <input type="text" placeholder="Book Name" name="name" class="form-control" required><br>
                                        
                                        <label for="name"><b>Image</b></label><br>
                                        <input type="file" name="img" accept="image/jpeg" class="form-control" required><br>

                                        <input type="text" placeholder="Authour Name" name="author"  class="form-control"required><br>

                                        <input type="text" placeholder="Publication Name" name="publication" class="form-control" required><br>
                                        
                                        <label for="name"><b>Purchase Date</b></label><br>
                                        <input type="date" name="pdate" class="form-control"><br>

                                       <input type="number" placeholder="Book Price" name="price" class="form-control" required><br>

                                       <input type="number" placeholder="Book Quantity" name="qty" class="form-control" required><br>

                                       <input type="number" placeholder="Available Quantity" name="aqty" class="form-control" required><br>

                                        <button type="submit" class="registerbtn" name="sub" class="btn btn-default submit" style="background-color:blue;color:white;">ADD BOOKS</button>

                                </form>

                                <?php
                                 $name=$_SESSION['admin'];
                                    
                                 if(isset($_POST["sub"]))
                                    {
                                        if (is_uploaded_file($_FILES['img']['tmp_name'])) 
                                        {
                                            move_uploaded_file($_FILES['img']['tmp_name'],'books_image/'.$_FILES['img']['name']);
                                        }

                                        mysqli_query($link,"insert into books (name,author,publication,p_date,price,qty,a_qty,adm_name,image) values('$_POST[name]','$_POST[author]','$_POST[publication]','$_POST[pdate]',$_POST[price],$_POST[qty],$_POST[aqty],'$name','".$_FILES['img']['name']."')");

                                         ?>
                                       <div class="alert alert-success col-lg-6 col-lg-push-3">
                                                 Book Inserted successfully!!
                                         </div>

                                         <Script>
                                             window.setTimeout(function(){
                                                // Move to a new location or you can do something else
                                                window.location.href = "add_books.php";
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