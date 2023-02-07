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
                <button type="submit" class="btn btn-primary" name="kirim">Filter</button>
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