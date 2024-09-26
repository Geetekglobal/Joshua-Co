<?php 

$stmt2 = $conn->prepare("SELECT * FROM courses limit 10");
$stmt2->execute();
$bookings = $stmt2->get_result();

?>

            <!-- start: Content -->

                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Course Title </th>
                                    <th>Descibtion</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($bookings as $row){?>
                                <tr>
                                    <td><?php echo $row['course_name'];?></td>
                                    <td><?php echo $row['description'];?></td>
                                    <td><?php echo $row['price'];?></td>
                                </tr>
                                <?php }?>

                            </tbody>
                        </table>
          <!-- end: content -->
          
      </div>

 

<!-- start: Javascript -->
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>



<!-- plugins -->
<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/jquery.datatables.min.js"></script>
<script src="asset/js/plugins/datatables.bootstrap.min.js"></script>
<script src="asset/js/plugins/jquery.nicescroll.js"></script>


<!-- custom -->
<script src="asset/js/main.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatables-example').DataTable();
  });
</script>
<!-- end: Javascript -->
</body>
</html>