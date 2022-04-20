<?php
    require("../models/adminfunctions.php");
    
    GeneralFunctions::check_session();
    GeneralFunctions::check_menu_permission("users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Dashboard 2</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= SERVER_BASE_URL ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= SERVER_BASE_URL ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= SERVER_BASE_URL ?>assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <script src="<?= SERVER_BASE_URL ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?= SERVER_BASE_URL ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= SERVER_BASE_URL ?>assets/dist/js/adminlte.min.js"></script>

    <script src="<?= SERVER_BASE_URL ?>assets/dist/js/demo.js"></script>
    <script src="<?= SERVER_BASE_URL ?>assets/dist/js/custom.js"></script>

    <!-- SWEETALERT -->
    <link rel="stylesheet" href="<?= SERVER_BASE_URL ?>assets/plugins/sweetalert/sweetalert.min.css">
    <script src="<?= SERVER_BASE_URL ?>assets/plugins/sweetalert/sweetalert.min.js"></script>        

    <!-- DataTables -->
    <script src="<?= SERVER_BASE_URL ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= SERVER_BASE_URL ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= SERVER_BASE_URL ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= SERVER_BASE_URL ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        
    </script>
  
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>        
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

  <div class="wrapper">
    <?= include_once('../header.php') ?>
    <?= include_once('../sidebar.php') ?>
    
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Contact Info</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Contact Info</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>

            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:10px;">#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Aadhar</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $contacts = AdminFunctions::get_contacts();
                                    
                                    if(mysqli_num_rows($contacts) > 0)
                                    {
                                        $i = 1;
                                        foreach($contacts as $contact)
                                        {
                                            ?>
                                            <tr>
                                                <td align="center"><?php echo $i++; ?></td>
                                                <td><?php echo $contact['name']; ?></td>
                                                <td><?php echo $contact['aadhar_no']; ?></td>
                                                <td><?php echo $contact['phone']; ?></td>
                                                <td align="center">
                                               <?php                                               
											   if(!empty($contact['phone']))
                                               { ?>											   
										   <img src="photos/<?php echo $contact['photo'];?>" width="100" height="100">
                                               <?php										       
											   }
                                               ?>												
											</td>
                                                <td align="center">
                                                    <?php
                                                        if($contact['active'] == YES)
                                                        {
                                                            ?><b class="text-primary">Active</b><?php
                                                        }
                                                        else
                                                        {
                                                            ?><b class="text-danger">Inactive</b><?php
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.container-fluid -->
            </section>

        </div>
            
            <div id="overlay" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>

        <script src="<?php echo SERVER_BASE_URL; ?>assets/js/main.js"></script>
    </body>
</html>