
    <?php
session_start();
if (!isset($_SESSION['uid'])) {
  
  header("location:../index.php?logginfirst");
}
include("../db.php");

error_reporting(0);
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{
$order_id=$_GET['order_id'];




/*this is delet query*/
mysqli_query($con,"delete from orders_info where order_id='$order_id'")or die("delete query is incorrect...");
} 

///pagination
$page=$_GET['page'];

if($page=="" || $page=="1")
{
$page1=0;	
}
else
{
$page1=($page*10)-10;	
}

include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          <div class="col-md-14">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Orders  / Page <?php echo $page;?> </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive ps">
            <table class="table table-hover tablesorter " id="">
                    <thead class=" text-primary">
                      <tr><th>Customer Name</th><th>Contact | Email</th><th>Address</th><th>city</th><th>product_count</th><th>Time</th>
                    <td>Action</td> </tr></thead>
                    <tbody>
                      <?php 
                        $result=mysqli_query($con,"SELECT * FROM orders_info ")or die ("query 1 incorrect.....");

                                if($result-> num_rows>0) {
                                while ($row=$result->fetch_assoc()) {
                                  $id=$row['order_id'];
                        
                                    ?>
                                <tr>

                                    <td><?php echo $row['f_name'];?></td>
                                     <td><?php echo $row['email'];?></td>
                               
                                    <td><?php echo $row['address'];?></td>
                                     <td><?php echo $row['city'];?></td>
                                     <td><?php echo $row['prod_count'];?></td>
                                     <td><?php echo $row['expdate'];?></td>
                          

                               <td>
                            <a class=' btn btn-danger' href='orders.php?order_id=<?php echo $id ?>&action=delete'>Delete</a>
                            </td>                                  
                                <?php
                               }
                            }
                                        
                            else {
                                    ?>

                                    <tr>
                                        <th colspan="6" >there is No data found</th>
                                     </tr>
                                    <?php
                                    }?>
                                </tr>
                            </tbody>
                        </table>
                      
                    </tbody>
                  </table>
                  
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <?php
include "footer.php";
?>