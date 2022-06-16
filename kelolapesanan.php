<?php include 'header.php';
    
    if (isset($_GET['idp'])) {
        $idp = $_GET['idp'];

        $ambilnamapelanggan = mysqli_query($conn, "SELECT * FROM pesanan p, pelanggan pl WHERE p.idpelanggan=pl.idpelanggan AND p.idorder='$idp'");
        $np = mysqli_fetch_array($ambilnamapelanggan);
        $namapel = $np['namapelanggan'];
    } else {
        header('location:index.php');
    }
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Pesanan: <?= $idp ?></h1>
                        <h4 class="mt-4">Nama Pelanggan: <?= $namapel ?></h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-info mb-4" data-toggle="modal" data-target="#myModal">
                          Tambah Barang
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
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Satuan</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $get = mysqli_query($conn, "SELECT * FROM detailpesanan p, produk pr where p.idproduk=pr.idproduk and idpesanan='$idp'");
                                        $i = 1;

                                        while ($p=mysqli_fetch_array($get)) {
                                        $idpr = $p['idproduk'];
                                        $iddp = $p['iddetailpesanan'];
                                        $qty = $p['qty'];
                                        $harga = $p['harga'];
                                        $namaproduk = $p['namaproduk'];
                                        $desc = $p['deskripsi'];
                                        $total = $p['total'];
                                        ?>

                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $namaproduk ?> (<?= $desc ?>)</td>
                                            <td>Rp<?= number_format($harga) ?></td>
                                            <td><?= number_format($qty) ?></td>
                                            <td>Rp<?= number_format($total) ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idpr ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idpr ?>">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        

                                        <!-- The Modal Edit -->
                                          <div class="modal fade" id="edit<?= $idpr ?>">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                              
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Ubah Data Detail Pesanan</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <form method="post">
                                                
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <input type="text" name="namaproduk" class="form-control mt-2" placeholder="Nama Produk" value="<?= $namaproduk ?> : <?= $desc ?>" disabled>
                                                    <input type="number" name="qty" class="form-control mt-2" placeholder="Harga Produk" value="<?= $qty ?>">
                                                    <input type="hidden" name="iddp" value="<?= $iddp ?>">
                                                    <input type="hidden" name="idp" value="<?= $idp ?>">
                                                    <input type="hidden" name="idpr" value="<?= $idpr ?>">
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-success" name="editdetailpesanan">Submit</button>
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>

                                                </form>

                                              </div>
                                            </div>
                                          </div>


                                        <!-- The Modal Delete -->
                                        <div class="modal" id="delete<?= $idpr ?>">
                                          <div class="modal-dialog">
                                            <div class="modal-content">

                                              <!-- Modal Header -->
                                              <div class="modal-header">
                                                <h4 class="modal-title">Apakah Anda Yakin Untuk Mengapus Barang Ini?</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              </div>

                                              <form method="post">

                                              <!-- Modal body -->
                                              <div class="modal-body">
                                                    Apakah Anda Yakin Untuk Mengapus Barang Ini?
                                                    <input type="hidden" name="idp" value="<?= $iddp ?>">
                                                    <input type="hidden" name="idpr" value="<?= $idpr ?>">
                                                    <input type="hidden" name="idorder" value="<?= $idp ?>">
                                              </div>

                                              <!-- Modal footer -->
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="hapusprodukpesanan">Ya</button>
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

    <!-- The Modal TAMBAH DETAIL PESANAN BARU -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form method="post">

      <!-- Modal body -->
      <div class="modal-body">
            Pilih Barang
            <input type="hidden" name="idp" value="<?php echo $_GET['idp']; ?>">
            
            <select name="idproduk" class="form-control">
                <?php
                $getproduk = mysqli_query($conn, "select * from produk");
                
                while ($pl=mysqli_fetch_array($getproduk)) {
                    $namaproduk = $pl['namaproduk'];
                    $deskripsi = $pl['deskripsi'];
                    $idproduk = $pl['idproduk'];
                    $stock = $pl['stock'];
                ?>
                <option value="<?=$idproduk?>"><?=$namaproduk?> - <?=$deskripsi?> - (<?=$stock?>)</option>
                <?php } ?>
            </select>
            Jumlah
            <input type="number" name="qty" class="form-control mb-2" placeholder="Jumlah" min="1" required>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="addproduk">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

      </form>

    </div>
  </div>
</div>
</html>
