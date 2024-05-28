<?php
	require "../php/connection.php";
    session_start();
    if(!isset($_SESSION['login_role'])){
		    echo "<script language=javascript>document.location.href='login.php'</script>";
	}

    if(isset($_SESSION['login_role'])){
        if($_SESSION['login_role'] != 'Perusahaan')
		    echo "<script language=javascript>document.location.href='login.php'</script>";
	}

    $id = $_SESSION['perusahaan_id'];
    $nama = "";
    $alamat = "";
    $kota_id = "";
    $email = "";
    $telepon = "";
    $login_id = "";
    $username = "";
    $password = "";
    $strQuery = "SELECT p.perusahaan_id, p.perusahaan_nama, p.perusahaan_alamat, k.kota_id, k.kota_nama, 
                    p.perusahaan_email, p.perusahaan_telepon, l.login_id, l.login_username, l.login_password
                    FROM perusahaan p INNER JOIN kota k ON p.kota_id = k.kota_id
                    INNER JOIN login l ON p.perusahaan_id = l.login_id
                    WHERE p.perusahaan_id = '$id'";
    $query = mysqli_query($connection, $strQuery);
    if($query){
        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $id = $result['perusahaan_id'];
        $nama = $result['perusahaan_nama'];
        $alamat = $result['perusahaan_alamat'];
        $kota_id = $result['kota_id'];
        $email = $result['perusahaan_email'];
        $telepon = $result['perusahaan_telepon'];
        $login_id = $result['login_id'];
        $username = $result['login_username'];
        $password = $result['login_password'];
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>BKK Lensa</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="../css/bootstrap.min.css" rel="stylesheet" />
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:300,400' rel='stylesheet' type='text/css'>
    </head>

    <body>
        <div class="wrapper">
            <div class="main-panel" style="float: none; width: 100%;">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar bar1"></span>
                                <span class="icon-bar bar2"></span>
                                <span class="icon-bar bar3"></span>
                            </button>
                            <a class="navbar-brand" href="#" style="font-weight: 800;">BKK Lenssa</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-left" style="margin-left: 56px;">
                                <li>
                                    <a href="lowongan.php">
                                        Lowongan
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="lowongan_tambah.php">
                                        Tambah Lowongan
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#search">Cari Lowongan</a>
                                    <!-- Modal Search -->
                                    <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <form method="GET" action="lowongan.php">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Masukkan Judul Lowongan</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Judul Lowongan</label>
                                                            <input type="text" class="form-control border-input" name="nama" placeholder="Judul Lowongan" />
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-info btn-fill">Search</button>
                                                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="profil_edit.php">
                                        <p>
                                            <i class="fa fa-user-circle" style="font-size: 18px;"></i> Hallo,
                                            <?php echo $_SESSION['perusahaan_nama'];?>
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="../php/logout.php">
                                        <i class="fa fa-sign-out"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <form method="POST" action="php/perusahaan_edit_proses.php" enctype="multipart/form-data" >
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Login Info</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control border-input" name="username" placeholder="Username" value="<?php echo $username;?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 34px;">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control border-input" name="password" placeholder="Biarkan kosong jika anda tidak ingin mengganti password" />
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Data Perusahaan</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Nama Perusahaan</label>
                                                        <input type="text" class="form-control border-input" name="nama" placeholder="Nama Perusahaan"  value="<?php echo $nama;?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <input type="text" class="form-control border-input" name="alamat" placeholder="Alamat"  value="<?php echo $alamat;?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Kota</label>
                                                        <select class="form-control border-input" name="kota_id">
                                                            <?php
                                                                $strQuery = "SELECT kota_id, kota_nama FROM kota";
                                                                $query = mysqli_query($connection, $strQuery);
                                                                while($subresult = mysqli_fetch_assoc($query)){
                                                                    if($subresult['kota_id'] == $kota_id)
                                                                        echo "<option value=$subresult[kota_id] selected>$subresult[kota_nama]</option>";
                                                                    else
                                                                        echo "<option value=$subresult[kota_id]>$subresult[kota_nama]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control border-input" name="email" placeholder="Email" value="<?php echo $email;?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Telepon</label>
                                                        <input type="text" class="form-control border-input" name="telepon" placeholder="Telepon" value="<?php echo $telepon;?>"/>
                                                    </div>
                                                </div>                                                
                                                
                                                <div class="text-center" style="margin-bottom: 34px;">
                                                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                                                    <input type="hidden" name="login_id" value="<?php echo $login_id;?>" />
                                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Submit Data</button>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="copyright pull-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, Hak Cipta Dari <a href="#">Suku Gumai 3 | Universitas Amikom Yogyakarta </a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="../js/jquery.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/dashboard.js" type="text/javascript"></script>
        <!--  Modal  -->
        <script>
            $('#search').appendTo("body")
        </script>
    </body>

    </html>