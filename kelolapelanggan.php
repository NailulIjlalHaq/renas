<?php include 'header.php';
// HITUNG JUMLAH PELANGGAN
$h1 = mysqli_query($conn, "select * from pelanggan");
$h2 = mysqli_num_rows($h1);
?>
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Pelanggan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Pelanggan: <?= $h2 ?></div>
                                </div>
                            </div>
                        </div>

                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-info mb-4" data-toggle="modal" data-target="#myModal">
                        Tambah Pelanggan Baru
                        </button>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Pelanggan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelanggan</th>
                                            <th>No Telepon</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $get = mysqli_query($conn, "SELECT * FROM pelanggan");
                                        $i = 1;

                                        while ($p=mysqli_fetch_array($get)) {
                                        $namapelanggan = $p['namapelanggan'];
                                        $notelp = $p['notelp'];
                                        $alamat = $p['alamat'];
                                        $idpl = $p['idpelanggan'];
                                        
                                        ?>

                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $namapelanggan ?></td>
                                            <td><?= $alamat ?></td>
                                            <td><?= $notelp ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idpl ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idpl ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- The Modal Edit -->
                                          <div class="modal fade" id="edit<?= $idpl ?>">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                              
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Ubah <?= $namapelanggan ?></h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <form method="post">
                                                
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Nama Pelanggan
                                                    <input type="text" name="namapelanggan" class="form-control mb-2" placeholder="Nama Pelanggan" value="<?= $namapelanggan ?>">
                                                    No Telepon
                                                    <input type="text" name="notelp" class="form-control mb-2" placeholder="No Telepon" value="<?= $notelp ?>">
                                                    Alamat
                                                    <input type="text" name="alamat" class="form-control mb-2" placeholder="Alamat" value="<?= $alamat ?>">
                                                    <input type="hidden" name="idpl" value="<?= $idpl ?>">
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-success" name="editpelanggan">Submit</button>
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>

                                                </form>

                                              </div>
                                            </div>
                                          </div>

                                          <!-- The Modal Delete -->
                                          <div class="modal fade" id="delete<?= $idpl ?>">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                              
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Hapus <?= $namapelanggan ?></h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <form method="post">
                                                
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Apakah Anda Yakin Ingin Menghapus Pelanggan Ini?
                                                    <input type="hidden" name="idpl" value="<?= $idpl ?>">
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-success" name="hapuspelanggan">Submit</button>
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>

                                                </form>

                                              </div>
                                            </div>
                                          </div>

                                         <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include 'footer.php';?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

<!-- ___________________________________________________________________________________________________________________________________________________________________________________ -->

    <!-- The Modal TAMBAH PELANGGAN -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Pelanggan Baru</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <form method="post">
        
        <!-- Modal body -->
        <div class="modal-body">
            Nama Pelanggan
            <input type="text" name="namapelanggan" class="form-control mb-2" placeholder="Nama Pelanggan" required>
            No Telepon
            <input type="text" name="notelp" class="form-control mb-2" placeholder="No Telepon" required>
            Alamat
            <input type="text" name="alamat" class="form-control mb-2" placeholder="Alamat" required>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="tambahpelanggan">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

        </form>

      </div>
    </div>
  </div>

  <!-- ___________________________________________________________________________________________________________________________________________________________________________________ -->

</html>
