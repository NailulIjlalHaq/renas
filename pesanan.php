<?php include 'header.php';
// HITUNG JUMLAH PESANAN
$h1 = mysqli_query($conn, "select * from pesanan");
$h2 = mysqli_num_rows($h1);
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Pesanan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Pesanan: <?= $h2 ?></div>
                                </div>
                            </div>
                        </div>

                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-info mb-4" data-toggle="modal" data-target="#myModal">
                          Tambah Pesanan Baru
                        </button>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Pesanan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID Pesanan</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $get = mysqli_query($conn, "SELECT * FROM pesanan p, pelanggan pl where p.idpelanggan=pl.idpelanggan");

                                        while ($p=mysqli_fetch_array($get)) {
                                        $idorder = $p['idorder'];
                                        $tanggal = $p['tanggal'];
                                        $namapelanggan = $p['namapelanggan'];
                                        $alamat = $p['alamat'];

                                        // Hitung Jumlah
                                        $hitungjumlah =mysqli_query($conn, "SELECT * FROM detailpesanan where idpesanan='$idorder'");
                                        $jumlah = mysqli_num_rows($hitungjumlah);
                                        
                                        ?>

                                        <tr>
                                            <td><?= $idorder ?></td>
                                            <td><?= $tanggal ?></td>
                                            <td><?= $namapelanggan ?> - <?= $alamat ?></td>
                                            <td><?= $jumlah ?></td>
                                            <td>
                                                <a href="kelolapesanan.php?idp=<?= $idorder ?>" class="btn btn-primary" target="blank">Tampilkan</a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idorder ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                          <!-- The Modal Delete -->
                                          <div class="modal fade" id="delete<?= $idorder ?>">
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
                                                    Apakah Anda Yakin Ingin Menghapus Pesanan Ini?
                                                    <input type="hidden" name="ido" value="<?= $idorder ?>">
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-success" name="hapusorder">Submit</button>
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

    <!-- MODAL TAMBAH PESANAN BARU -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pesanan Baru</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form method="post">

      <!-- Modal body -->
      <div class="modal-body">
            Pilih Pelanggan
            <select name="idpelanggan" class="form-control">
                <?php
                $getpelanggan = mysqli_query($conn, "select * from pelanggan");

                while ($pl=mysqli_fetch_array($getpelanggan)) {
                    $namapelanggan = $pl['namapelanggan'];
                    $idpelanggan = $pl['idpelanggan'];
                    $alamat = $pl['alamat'];
                ?>

                <option value="<?=$idpelanggan?>"><?=$namapelanggan?> - <?=$alamat?></option>

                <?php } ?>
            </select>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="tambahpesanan">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

      </form>

    </div>
  </div>
</div>

<!-- ___________________________________________________________________________________________________________________________________________________________________________________ -->

</html>
