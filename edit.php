<?php
$conn = mysqli_connect("localhost", "root", "", "db_penduduk");
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

$id = $_GET['id'];
$query = "SELECT * FROM data_penduduk WHERE id='$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $query = "UPDATE data_penduduk SET nik='$nik', nama='$nama', alamat='$alamat' WHERE id='$id'";
    mysqli_query($conn, $query);
    echo "Data telah dikemas kini dengan berjaya!";
    header("Location: form.php");
    exit(); // tambahkan exit() untuk memastikan tidak ada kod lain yang dijalankan selepas redirect
}
?>

<!-- form edit -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2 class="text-center">Update Data Penduduk</h2>
      <form action="" method="post">
        <div class="form-group">
          <label for="nik" class="col-form-label">NIK:</label>
          <input type="text" name="nik" value="<?php echo $data['nik'];?>" class="form-control" id="nik">
        </div>
        <div class="form-group">
          <label for="nama" class="col-form-label">Nama:</label>
          <input type="text" name="nama" value="<?php echo $data['nama'];?>" class="form-control" id="nama">
        </div>
        <div class="form-group">
          <label for="alamat" class="col-form-label">Alamat:</label>
          <input type="text" name="alamat" value="<?php echo $data['alamat'];?>" class="form-control" id="alamat">
        </div>
        <button type="submit" name="update" class="btn btn-primary btn-block">UPDATE</button>
      </form>
    </div>
  </div>
</div>