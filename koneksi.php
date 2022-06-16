<?php

// KONEKSI
$conn = mysqli_connect('localhost','root','admin','kasir');

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

// FUNCTION (koneksi) TAMBAH BARANG
if(isset($_POST['tambahbarang'])){
	$namaproduk = $_POST['namaproduk'];
	$deskripsi = $_POST['deskripsi'];
	$stock = $_POST['stock'];
	$harga = $_POST['harga'];

	$insert = mysqli_query($conn, "insert into produk (namaproduk,deskripsi,harga,stock) values ('$namaproduk','$deskripsi','$harga','$stock')");

	if($insert){
		header('location:produk.php');
	} else {
		echo '
		<script>alert("Gagal Menambah Barang baru");
		window.location.href="produk.php"
		</script>
		';
	}
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

// FUNCTION (koneksi) TAMBAH PELANGGAN
if(isset($_POST['tambahpelanggan'])){
	$namapelanggan = $_POST['namapelanggan'];
	$notelp = $_POST['notelp'];
	$alamat = $_POST['alamat'];

	$insert = mysqli_query($conn, "insert into pelanggan (namapelanggan,notelp,alamat) values ('$namapelanggan','$notelp','$alamat')");

	if($insert){
		header('location:kelolapelanggan.php');
	} else {
		echo '
		<script>alert("Gagal Menambah Pelanggan Baru");
		window.location.href="kelolapelanggan.php"
		</script>
		';
	}
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

// FUNCTION (koneksi) TAMBAH PESANAN
if(isset($_POST['tambahpesanan'])){
	$idpelanggan = $_POST['idpelanggan'];

	$insert = mysqli_query($conn, "insert into pesanan (idpelanggan) values ('$idpelanggan')");

	if($insert){
		header('location:pesanan.php');
	} else {
		echo '
		<script>alert("Gagal Menambah Pesanan Baru");
		window.location.href="pesanan.php"
		</script>
		';
	}
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

// FUNCTION (koneksi) TAMBAH DETAIL PESANAN
if(isset($_POST['addproduk'])){
	$idproduk = $_POST['idproduk'];
	$idp = $_POST['idp']; // ID PESANAN
	$qty = $_POST['qty'];

	// mencari total
	$get = mysqli_query($conn, "SELECT * FROM produk where idproduk='$idproduk'");
	$ambil = mysqli_fetch_array($get);
	$harga = $ambil['harga'];

	$total = $harga*$qty;

	//HITUNG STOCK YANG ADA
	$hitung1 = mysqli_query($conn, "select * from produk where idproduk='$idproduk'");
	$hitung2 = mysqli_fetch_array($hitung1);
	$stocksekarang = $hitung2['stock'];

	// Kurangi Stocknya Dengan Jumlah Yang Akan Dikeluarkan
	$selisih = $stocksekarang-$qty;

	if ($stocksekarang>=$qty) {
		// Stocknya Cukup
		$insert = mysqli_query($conn, "insert into detailpesanan (idpesanan,idproduk,qty,total) values ('$idp','$idproduk','$qty','$total')");
		$update = mysqli_query($conn, "update produk set stock='$selisih' where idproduk='$idproduk'");

		if($insert&&$update){
			header('location:kelolapesanan.php?idp='.$idp);
		} else {
			echo '
			<script>alert("Gagal Menambah Pesanan Baru");
			window.location.href="kelolapesanan.php?idp='.$idp.'"
			</script>
			';
		}
	} else {
	// Stock Tidak Cukup
		echo '
		<script>alert("Stock Barang Tidak Cukup");
		window.location.href="kelolapesanan.php?idp='.$idp.'"
		</script>
		';
	}
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

// HAPUS PRODUK PESANAN
if (isset($_POST['hapusprodukpesanan'])) {
	$idp = $_POST['idp']; // ID PESANAN
	$idpr = $_POST['idpr']; // ID PRODUK
	$idorder = $_POST['idorder'];

	// CEK QTY SEKARANG
	$cek1 = mysqli_query($conn, "select * from detailpesanan where iddetailpesanan='$idp'");
	$cek2 = mysqli_fetch_array($cek1);
	$qtysekarang = $cek2['qty'];

	// CEK STOCK SEKARANG
	$cek3 = mysqli_query($conn, "select * from produk where idproduk='$idpr'");
	$cek4 = mysqli_fetch_array($cek3);
	$stocksekarang = $cek4['stock'];

	$hitung = $stocksekarang+$qtysekarang;

	$update = mysqli_query($conn, "update produk set stock='$hitung' where idproduk='$idpr'");
	$hapus = mysqli_query($conn, "delete from detailpesanan where idproduk='$idpr' and iddetailpesanan='$idp'");

	if ($update&&$hapus) {
		header('location:kelolapesanan.php?idp='.$idorder);
	} else {
		echo '
		<script>alert("Gagal Menghapus Barang");
		window.location.href="kelolapesanan.php?idp='.$idorder.'"
		</script>
		';
	}
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

// EDIT BARANG
if (isset($_POST['editbarang'])) {
	$np = $_POST['namaproduk'];
	$desc = $_POST['deskripsi'];
	$harga = $_POST['harga'];
	$idp = $_POST['idp']; // ID PRODUK

	$query = mysqli_query($conn, "update produk set namaproduk='$np', deskripsi='$desc', harga='$harga' where idproduk='$idp' ");

	if ($query) {
		header('location:produk.php');
	} else {
		echo '
		<script>alert("Gagal Edit Barang");
		window.location.href="produk.php"
		</script>
		';
	}
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

// HAPUS BARANG
if (isset($_POST['hapusbarang'])) {
	$idp = $_POST['idp']; // ID PRODUK

	$query = mysqli_query($conn, "delete from produk where idproduk='$idp' ");
	if ($query) {
		header('location:produk.php');
	} else {
		echo '
		<script>alert("Gagal Hapus Barang");
		window.location.href="produk.php"
		</script>
		';
	}
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

// EDIT PELANGGAN
if (isset($_POST['editpelanggan'])) {
	$np = $_POST['namapelanggan'];
	$nt = $_POST['notelp'];
	$a = $_POST['alamat'];
	$id = $_POST['idpl']; // ID PELANGGAN

	$query = mysqli_query($conn, "update pelanggan set namapelanggan='$np', notelp='$nt', alamat='$a' where idpelanggan='$id' ");

	if ($query) {
		header('location:kelolapelanggan.php');
	} else {
		echo '
		<script>alert("Gagal Edit Pelanggan");
		window.location.href="kelolapelanggan.php"
		</script>
		';
	}
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

// HAPUS PELANGGAN
if (isset($_POST['hapuspelanggan'])) {
	$idpl = $_POST['idpl']; // ID PELANGGAN

	$query = mysqli_query($conn, "delete from pelanggan where idpelanggan='$idpl' ");
	if ($query) {
		header('location:kelolapelanggan.php');
	} else {
		echo '
		<script>alert("Gagal Hapus Pelanggan");
		window.location.href="kelolapelanggan.php"
		</script>
		';
	}
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

// HAPUS ORDER (PESANAN)
if (isset($_POST['hapusorder'])) {
	$ido = $_POST['ido']; // ID ORDER

	$cekdata = mysqli_query($conn, "select * from detailpesanan dp where idpesanan='$ido'");

	while ($ok=mysqli_fetch_array($cekdata)) {
		// BALIKIN STOCK
		$qty = $ok['qty'];
		$idproduk = $ok['idproduk'];
		$iddp = $ok['iddetailpesanan'];

		// MENCARI TAHU STOCK YANG ADA SEKARANG
		$caristock = mysqli_query($conn, "select * from produk where idproduk='$idproduk' ");
		$caristock2 = mysqli_fetch_array($caristock);
		$stocksekarang = $caristock2['stock'];

		$newstock = $stocksekarang+$qty;

		$queryupdate = mysqli_query($conn, "update produk set stock='$newstock' where idproduk='$idproduk' ");

		// HAPUS DATA
		$querydelete = mysqli_query($conn, "delete from detailpesanan where iddetailpesanan='$iddp'");

	}

	$query = mysqli_query($conn, "delete from pesanan where idorder='$ido' ");
	if ($queryupdate&&$querydelete&&$query) {
		header('location:pesanan.php');
	} else {
		echo '
		<script>alert("Gagal Hapus Pesanan");
		window.location.href="pesanan.php"
		</script>
		';
	}
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

// MENGUBAH DATA DETAIL PESANAN
if (isset($_POST['editdetailpesanan'])) {
	$qty = $_POST['qty'];
	$iddp = $_POST['iddp']; // ID DETAIL PESANAN
	$idpr = $_POST['idpr']; // ID PRODUK
	$idp = $_POST['idp']; // ID PESANAN

	// MENCARI TAU TOTAL QTY YANG SEKARANG
	$caritahu = mysqli_query($conn, "select * from detailpesanan where iddetailpesanan='$iddp' ");
	$caritahu2 = mysqli_fetch_array($caritahu);
	$qtysekarang = $caritahu2['qty'];

	// MENCARI TAHU STOCK YANG ADA SEKARANG
	$caristock = mysqli_query($conn, "select * from produk where idproduk='$idpr' ");
	$caristock2 = mysqli_fetch_array($caristock);
	$stocksekarang = $caristock2['stock'];
	$harga = $caristock2['harga'];


	if ($qty >= $qtysekarang) {
		// KALAU INPUTAN USER LEBIH BSAR DARIPADA QTY YANG SEKARANG
		// HITUNG SELISIH
		$selisih = $qty-$qtysekarang;
		$newstock = $stocksekarang-$selisih;
		$total = $harga*$qty;

		$query1 = mysqli_query($conn, "update detailpesanan set qty='$qty', total='$total' where iddetailpesanan='$iddp' ");
		$query2 = mysqli_query($conn, "update produk set stock='$newstock' where idproduk='$idpr' ");

		if ($query1&&$query2) {
			header('location:kelolapesanan.php?idp='.$idp);
		} else {
			echo '
			<script>alert("Gagal Edit Pelanggan");
			window.location.href="kelolapesanan.php?idp='.$idp.'"
			</script>
			';
		}
	} else {
		// KALAU LEBIH KECIL
		// HITUNG SELISIH
		$selisih = $qtysekarang-$qty;
		$newstock = $stocksekarang+$selisih;
		$total = $harga*$qty;

		$query1 = mysqli_query($conn, "update detailpesanan set qty='$qty',  total='$total' where iddetailpesanan='$iddp' ");
		$query2 = mysqli_query($conn, "update produk set stock='$newstock' where idproduk='$idpr' ");

		if ($query1&&$query2) {
			header('location:kelolapesanan.php?idp='.$idp);
		} else {
			echo '
			<script>alert("Gagal Edit Pelanggan");
			window.location.href="kelolapesanan.php?idp='.$idp.'"
			</script>
			';
		}
	}
}
?>