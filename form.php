<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}
$conn = mysqli_connect("localhost", "root", "", "db_penduduk");

if(isset($_POST['submit'])){
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $query = "INSERT INTO data_penduduk (nik,nama, alamat) VALUES ('$nik', '$nama', '$alamat')";
    mysqli_query($conn, $query);
    header("Location: form.php");
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM data_penduduk WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $query = "UPDATE data_penduduk SET nik='$nik', 'nama='$nama', alamat='$alamat' WHERE id='$id'";
    mysqli_query($conn, $query);
    header("Location: form.php");
}

if(isset($_GET['delete'])){
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id='$id'";
    mysqli_query($conn, $query);
    header("Location: delete.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>FORM PENGISIAN DATA PENDUDUK</h1>
                    
                <form action="" method="post">
                <div class="form-group">
                        <label for="nik">NIK:</label>
                        <input type="text" class="form-control" id="nik" name="nik" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Create</button>
                </form>

                <hr>

                <h2>Data Masuk</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM data_penduduk"; // changed from data_penduduk to users
                        $result = mysqli_query($conn, $query);
                        while($data = mysqli_fetch_assoc($result)){?>
                        <tr>
                            
                            <td><?php echo $data['nik'];?></td>
                            <td><?php echo $data['nama'];?></td>
                            <td><?php echo $data['alamat'];?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $data['id'];?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?delete=<?php echo $data['id'];?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>

                <a href="#" onclick="downloadPDF()" class="btn btn-success">Download as PDF</a>

                <?php if(isset($_GET['id'])){?>
                <h2>Update Data</h2>
                <form action="" method="post">

                <div class="form-group">
                        <label for="nama">NIK:</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $data['nik'];?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama'];?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data['alamat'];?>" required>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </form>
                <?php }?>

            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script>
        function downloadPDF() {
            var html = '<table border="1" cellpadding="5" cellspacing="0">';
            html += '<tr><th>NIK</th><th>Nama</th><th>Alamat</th></tr>';

            <?php
            $query = "SELECT * FROM data_penduduk";
            $result = mysqli_query($conn, $query);
            while($data = mysqli_fetch_assoc($result)){?>
                html += '<tr>';
                html += '<td><?= $data['nik'];?></td>';
                html += '<td><?= $data['nama'];?></td>';
                html += '<td><?= $data['alamat'];?></td>';
                html += '</tr>';
            <?php }?>

            html += '</table>';

            var pdf = new jsPDF();
            pdf.fromHTML(html, 15, 15);
            pdf.save('data_penduduk.pdf');
        }
    </script>

</body>
</html>