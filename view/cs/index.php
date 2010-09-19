<?php
session_start();
require_once('../../lib/koneksi.php');
require_once('../../lib/auth.php');
//require_once('../../modules/kantor_cabang.php');
require_once('../../modules/tracking.php');
//require_once('../../modules/pegawai.php');
require_once('../../modules/transaksi.php');
auth_page('customer service');
$daftarkab=track_getDaftarKab();
$daftarkec=track_getDaftarKecByKab($daftarkab[0]['id']);
$daftarkat=trans_getAllKat(); 
$daftartrans=trans_getDaftarTransByKC($_SESSION['idkantorcabang']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>andes customer service</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" href="../../css/south-street/jquery-ui-1.8.1.custom.css" rel="stylesheet" />
    <link type="text/css" href="../../css/main.css" rel="stylesheet" />
    <link type="text/css" href="../../css/dashboard.css" rel="stylesheet" />
    <style type="text/css">
    </style>
</head>
<body>
    <div id="idkantorcabang" style="display:none"><?php echo $_SESSION['idkantorcabang'];?></div>
    <div id="wrapper">
        <div id="header">
            <div id="panelid" class="ui-widget-content ui-corner-all">
                <h1>Customer Service Dashboard</h1>
                <div>
                    <a href="../control.php?op=logout"><button id="logout">Logout</button></a>
                    <p><span class="nama"><?php echo $_SESSION['nama'];?></span></p><hr/>
                    <p>Cabang: <?php echo $_SESSION['namakantorcabang'];?></p>
                </div>
            </div>
            <a href="/index.php"><img src="../../images/small_logo.png"/></a>
            <p><strong>An</strong>dromeda <strong>De</strong>livery <strong>S</strong>ystem</p>
        </div>
        <div id="panelinfo" class="ui-state-highlight ui-corner-all">
	        <p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span></p>
	        <p>Selamat Datang.</p>
        </div>        
        <div id="content">
            <div id="tabs">
	            <ul>
		            <li><a href="#input_trans">Input Transaksi</a></li>
		            <li><a href="#lihat_trans" id="lhttrans">Lihat Transaksi</a></li>
		            <li><a href="#faq">FAQ</a></li>
	            </ul>
	            <div id="input_trans">
		            <p>Masukkan data transaksi dari customer</p>
		            <form id="inputtrans" class="def_form" action="../control.php" method="post">
		                <input type="hidden" name="op" value="inputtrans" />
		                <input type="hidden" name="idcs" value="<?php echo $_SESSION['id']; ?>" />
		                <input type="hidden" name="idkec" value="<?php echo $_SESSION['idkecamatan']; ?>" />
		                <input type="hidden" name="idkc" value="<?php echo $_SESSION['idkantorcabang']; ?>" />
		                <fieldset>
		                <legend>Data Pengirim</legend>
		                <label for="nmpengirim">Nama Pengirim</label><input type="text" name="nmpengirim" id="nmpengirim" size="35" maxlength="60">
                        <label for="notelppengirim">No Telp</label><input type="text" name="notelppengirim" id="notelppengirim" size="20" maxlength="15">
                        <label for="kab_pengirim">Kabupaten</label>
                        <select name="kab_pengirim" id="kab_pengirim">
                            <?php foreach($daftarkab as $kab): ?>
                            <option value="<?php echo $kab['id'];?>"><?php echo $kab['nama'];?></option>
                            <?php endforeach;?>	
                        </select>
                        <label for="kec_pengirim">Kecamatan</label>
                        <select name="kec_pengirim" id="kec_pengirim">
                            <?php foreach($daftarkec as $kec): ?>
                            <option value="<?php echo $kec['id'];?>"><?php echo $kec['nama'];?></option>
                            <?php endforeach;?>
                        </select>    
                        <label for="det_alamat_pengirim">Detail alamat</label>
                        <textarea name="det_alamat_pengirim" id="det_alamat_pengirim"></textarea>                                   
                        </fieldset>

		                <fieldset>
		                <legend>Data Penerima</legend>
		                <label for="nmpenerima">Nama Penerima</label><input type="text" name="nmpenerima" id="nmpenerima" size="35" maxlength="60">
                        <label for="notelppenerima">No Telp</label><input type="text" name="notelppenerima" id="notelppenerima" size="20" maxlength="15">
                        <label for="kab_penerima">Kabupaten</label>
                        <select name="kab_penerima" id="kab_penerima">
                            <?php foreach($daftarkab as $kab): ?>
                            <option value="<?php echo $kab['id'];?>"><?php echo $kab['nama'];?></option>
                            <?php endforeach;?>
                        </select>
                        <label for="kec_penerima">Kecamatan</label>
                        <select name="kec_penerima" id="kec_penerima">
                            <?php foreach($daftarkec as $kec): ?>
                            <option value="<?php echo $kec['id'];?>"><?php echo $kec['nama'];?></option>
                            <?php endforeach;?>
                        </select>    
                        <label for="det_alamat_penerima">Detail alamat</label>
                        <textarea name="det_alamat_penerima" id="det_alamat_penerima"></textarea>                                   
                        </fieldset>                        

		                <fieldset>
		                <legend>Data Barang Kiriman</legend>
		                <input type="hidden" name="boolbrg" id="boolbrg" value="" />
		                <table id="daftarbarang" class="tabel">
		                    <thead>
		                        <tr><th>Nama</th><th>Berat</th><th>Nilai Barang</th><th>Kategori</th><th>---</th></tr>
		                    </thead>
		                    <tbody>                              
		                                                  
		                    </tbody>
		                </table>		                
		                <label for="nmbarang">Nama Barang</label><input type="text" name="nmbarang" id="nmbarang" size="35" maxlength="35">
                        <label for="beratbarang">Berat Barang dalam Kg.</label><input type="text" name="beratbarang" id="beratbarang" size="20" maxlength="20">
                        <label for="nilaibarang">Nilai Barang dalam Rp.</label><input type="text" name="nilaibarang" id="nilaibarang" size="20" maxlength="20">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori">
                            <?php foreach($daftarkat as $kat): ?>
                            <option value="<?php echo $kat['id'];?>,<?php echo $kat['bobot'];?>"><?php echo $kat['deskripsi'];?></option>
                            <?php endforeach;?>
                        </select> 
                        <input type="button" value="Tambahkan" id="tambahbarang">
                        </fieldset>
                        
                        <fieldset>
                        <legend>Informasi Pengirim</legend>
                        <!--
                        <label for="tglkirim">Tanggal&Waktu Pengiriman</label>
                        <input type="text" name="tglkirim" id="tglkirim" size="20" maxlength="20">
                        <input type="text" name="waktukirim" id="waktukirim" size="8" maxlength="8">
                        -->
                        <label for="asuransi">Asuransi</label>
                        <input type="checkbox" name="asuransi" id="asuransi" value="on" />
                        <label for="kilat">Layanan Kilat</label>
                        <input type="checkbox" name="kilat" id="kilat" value="on" />      
                        </fieldset>              
                            
                        <fieldset>
                        <legend>Informasi Biaya Pengiriman</legend>
                            <table class="tabel">
                                <tbody>
                                <tr><td>Jarak</td><td><span id="infojarak">0</span> km</td></tr>
                                <tr><td>Jml Item</td><td><span id="infojmlitem">0</span> buah</td></tr>
                                <tr><td>Layanan Asuransi</td><td><span id="infoasuransi">Tidak </span></td></tr>
                                <tr><td>Layanan Kilat</td><td><span id="infokilat">Tidak </span></td></tr>
                                <tr><td>Total Biaya</td><td>Rp. <span id="infobiaya">0</span></td></tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="biaya" id="biaya" value="0" />
                            <input type="button" value="Hitung Biaya" id="hitung">   
                        </fieldset>              
                                                    
                        <input type="submit" class="tombol" name="kirim" value="Proses" />
                        <input type="reset" class="tombol" name="hapus" value="Hapus" />
		            </form>
	            </div>
                <div id="lihat_trans">
		            <p> Daftar transaksi yang ada di kantorcabang ini baik itu dikirim dari kantorcabang ini atau disinggahkan ke kantorcabang ini.</p>
		            <table id="daftartransaksi" class="tabel">
		                <thead>
		                    <tr><th>ID Transaksi</th><th>Nama Pengirim</th><th>Nama Penerima</th><th>Biaya</th><th>Tgl Waktu Transaksi</th><th>Asuransi</th><th>Kilat</th><th>Customer Service</th></tr>
		                </thead>
		                <tbody>
                            <?php foreach($daftartrans as $tran): ?>
                            <tr>
                                <td><?php echo $tran['id']; ?></td>
                                <td><?php echo $tran['namapengirim']; ?></td>
                                <td><?php echo $tran['namapenerima']; ?></td>
                                <td><?php echo $tran['biaya']; ?></td>
                                <td><?php echo $tran['tglwaktu']; ?></td>
                                <td><?php echo $tran['asuransi']; ?></td>
                                <td><?php echo $tran['kilat']; ?></td>
                                <td><?php echo $tran['nmcs']; ?></td>
                            </tr>
                            <?php endforeach;?>		                
		                </tbody>
		            </table>
	            </div>           	            
	            <div id="faq">
		            <p>Berikut ini daftar pertanyaan yang sering muncul dari customer service.</p>
		            <h3>Apa itu customer service?</h3>
		            <p>Customer service yaitu anda<p>
		            <h3>Bagaimana jika terjadi kesalahan?</h3>
		            <p>Hubungi 081914947566<p>
	            </div>
            </div>                
        </div>
        <div id="footer" class="ui-corner-all">
            Under development &copy; 2010
        </div>
        <div id="konfirminsert" title="Konfirmasi input transaksi">
	        <p>Pastikan anda memastikan dahulu data sudah terisi dengan benar.</p>
	        <p>dan pastikan anda telah mengupdate biaya total.</p>
        </div>        
    </div>
</body>
<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.8.1.custom.min.js"></script>
<script type="text/javascript" src="../../js/jquery.bgiframe-2.1.1.js"></script>
<script type="text/javascript" src="../../js/jquery.ui.datepicker-id.js"></script>
<script type="text/javascript" src="../../js/jquery.validate.js"></script>
<script type="text/javascript" src="../../js/cs.js"></script>
</html>
