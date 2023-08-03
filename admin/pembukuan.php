<?php 
session_start();
//koneksi
include '../koneksi.php';

if (!isset($_SESSION['user']))
{
    echo "<script>alert('Anda harus Login');</script>";
    echo "<script>location='login.php';</script>";
    header('location=login.php');
    exit();
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KNWFRUIT</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">KNWFRUIT</a> 
            </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
					
                    <li>
                        <a href="index.php"><i class="fa fa-dashboard fa-2x "></i>Home</a>
                    </li>
                    <li>
                        <a href="index.php?halaman=produk"><i class="fa fa-cube fa-2x "></i>Produk</a>
                    </li>
                     <li>
                        <a href="index.php?halaman=pemesanan"><i class="fa fa-shopping-cart fa-2x "></i>Pemesanan</a>
                    </li>
                    <li>
                        <a href="index.php?halaman=pelanggan"><i class="fa fa-user fa-2x "></i>Pelanggan</a>
                    </li>
                    <li>
                        <a href="pembukuan.php"><i class="fa fa-book fa-2x "></i>Pembukuan</a>
                    </li>
                    <li>
                        <a href="index.php?halaman=logout"><i class="fa fa-sign-out fa-2x "></i>Logout</a>
                    </li>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <h2>Halaman Pembukuan</h2>

<form action="" method="GET">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>From Date</label>
                <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>To Date</label>
                <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Click to Filter</label> <br>
                <button type="submit" class="btn btn-primary">Filter</button>
                <!-- <a href="index.php?halaman=pembukuan" type="submit" class="btn btn-primary">Filter</a> -->
                <!-- <input type="submit" value="Go to Google" /> -->
            </div>
        </div>
    </div>
</form>
<table class="table table-bordered">
	<thead>
		<tr>
            <th>No</th>
			<th>Nama Pelanggan</th>
			<th>Tanggal</th>
			<th>Status</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
    <?php $nomor=1; ?>
	<?php 
    if(isset($_GET['from_date']) && isset($_GET['to_date']))
    {
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $query = "SELECT * FROM pemesanan JOIN pelanggan ON pemesanan.id_pelanggan=pelanggan.id_pelanggan WHERE tanggal_pemesanan BETWEEN '$from_date' AND '$to_date' ";
        // $ambil=$koneksi->query("SELECT * FROM pemesanan JOIN pelanggan ON pemesanan.id_pelanggan=pelanggan.id_pelanggan");
        include '../koneksi.php';
        $query_run = mysqli_query($koneksi, $query);
        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $row)
            {
                ?>
                <tr>
                
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $row['nama_pelanggan']; ?></td>
                    <td><?php echo $row['tanggal_pemesanan']; ?></td>
                    <td><?php echo $row['status_pemesanan']; ?></td>
                    <td>Rp. <?php echo number_format($row['total_pemesanan']); ?>
                </tr>
                <?php $nomor++;
            }
        }
        else
        {
            echo "No Record Found";
        }
        
    
    ?>
	</tbody>
    <tbody>
        <?php 
    $total_query = "SELECT SUM(total_pemesanan) as total from pemesanan where tanggal_pemesanan BETWEEN '$from_date' AND '$to_date' ";
    $data = mysqli_query($koneksi, $total_query);

    if ($data) {
        $result = mysqli_fetch_assoc($data);
        $total = $result['total'];
?>
        <tr>
            <td colspan="4">total denda</td>
            <td>Rp. <?= number_format($total) ?></td>
        </tr>
<?php
    }
}
?>
    </tbody>
</table>
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>

<h2>Halaman Pembukuan</h2>

<form action="" method="GET">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>From Date</label>
                <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>To Date</label>
                <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Click to Filter</label> <br>
                <button type="submit" class="btn btn-primary">Filter</button>
                <!-- <a href="index.php?halaman=pembukuan" type="submit" class="btn btn-primary">Filter</a> -->
                <!-- <input type="submit" value="Go to Google" /> -->
            </div>
        </div>
    </div>
</form>
<table class="table table-bordered">
	<thead>
		<tr>
            <th>No</th>
			<th>Nama Pelanggan</th>
			<th>Tanggal</th>
			<th>Status</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
    <?php $nomor=1; ?>
	<?php 
    if(isset($_GET['from_date']) && isset($_GET['to_date']))
    {
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];

        $query = "SELECT * FROM pemesanan JOIN pelanggan ON pemesanan.id_pelanggan=pelanggan.id_pelanggan WHERE tanggal_pemesanan BETWEEN '$from_date' AND '$to_date' ";
        // $ambil=$koneksi->query("SELECT * FROM pemesanan JOIN pelanggan ON pemesanan.id_pelanggan=pelanggan.id_pelanggan");
        include '../koneksi.php';
        $query_run = mysqli_query($koneksi, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $row)
            {
                ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $row['nama_pelanggan']; ?></td>
                    <td><?php echo $row['tanggal_pemesanan']; ?></td>
                    <td><?php echo $row['status_pemesanan']; ?></td>
                    <td><?php echo $row['total_pemesanan']; ?></td>
                </tr>
                <?php $nomor++;
            }
        }
        else
        {
            echo "No Record Found";
        }
        
    }
    ?>
	</tbody>
</table>