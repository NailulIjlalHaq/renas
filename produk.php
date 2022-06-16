<?php include 'header.php';
// HITUNG JUMLAH BARANG
$h1 = mysqli_query($conn, "select * from produk");
$h2 = mysqli_num_rows($h1);
?>
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Produk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Produk: <?= $h2 ?></div>
                                </div>
                            </div>
                        </div>

                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-info mb-4" data-toggle="modal" data-target="#myModal">
                        Tambah Produk Baru
                        </button>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Produk
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Deskripsi</th>
                                            <th>Stock</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      <?php
                                      $get = mysqli_query($conn, "SELECT * FROM produk");
                                      $i = 1;

                                      while ($p=mysqli_fetch_array($get)) {
                                      $namaproduk = $p['namaproduk'];
                                      $deskripsi = $p['deskripsi'];
                                      $harga = $p['harga'];
                                      $stock = $p['stock'];
                                        $idproduk = $p['idproduk'];
                                      
                                      ?>

                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $namaproduk ?></td>
                                            <td><?= $deskripsi ?></td>
                                            <td><?= $stock ?></td>
                                            <td>Rp<?= number_format($harga) ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idproduk ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idproduk ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- The Modal Edit -->
                                          <div class="modal fade" id="edit<?= $idproduk ?>">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                              
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Ubah <?= $namaproduk ?></h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <form method="post">
                                                
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Nama Produk
                                                    <input type="text" name="namaproduk" class="form-control mb-2" placeholder="Nama Produk" value="<?= $namaproduk ?>">
                                                    Deskripsi
                                                    <input type="text" name="deskripsi" class="form-control mb-2" placeholder="Deskripsi" value="<?= $deskripsi ?>">
                                                    Harga
                                                    <input type="num" name="harga" class="form-control mb-2" placeholder="Harga Produk" value="<?= $harga ?>">
                                                    <input type="hidden" name="idp" value="<?= $idproduk ?>">
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-success" name="editbarang">Submit</button>
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>

                                                </form>

                                              </div>
                                            </div>
                                          </div>

                                          <!-- The Modal Delete -->
                                          <div class="modal fade" id="delete<?= $idproduk ?>">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                              
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Hapus <?= $namaproduk ?></h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <form method="post">
                                                
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Apakah Anda Yakin Ingin Menghapus Produk Ini?
                                                    <input type="hidden" name="idp" value="<?= $idproduk ?>">
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-success" name="hapusbarang">Submit</button>
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

    <!-- The Modal TAMBAH BARANG BARU -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Produk Baru</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <form method="post">
        
        <!-- Modal body -->
        <div class="modal-body">
            Nama Produk
            <input type="text" name="namaproduk" class="form-control mb-2" placeholder="Nama Produk">
            Deskripsi
            <input type="text" name="deskripsi" class="form-control mb-2" placeholder="Deskripsi">
            Stock Masuk
            <input type="num" name="stock" class="form-control mb-2" placeholder="Stock Masuk">
            Harga
            <input type="num" name="harga" class="form-control mb-2" placeholder="Harga Produk">
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="tambahbarang">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

        </form>

      </div>
    </div>
  </div>

<!-- ___________________________________________________________________________________________________________________________________________________________________________________ -->

</html>
