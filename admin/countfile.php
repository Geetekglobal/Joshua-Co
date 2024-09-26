  <?php include('header.php');?>	
                            <div class="col-md-12 padding-0">
                                <div class="col-md-6">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Subcribed Users</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-user icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                      <?php 
                                            $sql = "SELECT COUNT(*) AS total_records FROM subscribers";
                                            $result = $conn->query($sql);
                                            
                                            if ($result->num_rows > 0) {
                                                // Fetch the result as an associative array
                                                $row = $result->fetch_assoc();
                                                
                                                // Access the total number of records
                                                $totalRecords = $row['total_records'];
                                        ?>
                                        <h1><?php echo $row['total_records']; ?></h1>
                                        <?php
                                        } else {
                                          echo "No records found";
                                      }
                                      ?>
                                        <a href="Subscribers.php">See all</a>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Booked Session</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-basket-loaded icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                        <?php 
                                            $sql = "SELECT COUNT(*) AS total_records FROM bookings";
                                            $result = $conn->query($sql);
                                            
                                            if ($result->num_rows > 0) {
                                                // Fetch the result as an associative array
                                                $row = $result->fetch_assoc();
                                                
                                                // Access the total number of records
                                                $totalRecords = $row['total_records'];
                                        ?>
                                        <h1><?php echo $row['total_records']; ?></h1>
                                        <?php
                                        } else {
                                          echo "No records found";
                                      }
                                      ?>
                                        <a href="Bookings.php">See all</a>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                            </div>