<?php
session_start();
require_once('../../lib/koneksi.php');
require_once('../../lib/auth.php');
require_once('../../modules/kantor_cabang.php');
require_once('../../modules/tracking.php');
require_once('../../modules/pegawai.php');
require_once('../../modules/keluhan.php');
auth_page('administratif');
$daftarkc=kc_getDaftarKC();
$daftarrute=track_getDaftarRute();
$daftarpegawai=pg_getDaftarPeg();
$daftarkab=track_getDaftarKab();
$daftarkec=track_getDaftarKecByKab($daftarkab[0]['id']);
$daftarkelopen=kel_getKelByStatus('open');
$daftarkelclose=kel_getKelByStatus('closed');
?>

<!DOCTYPE html>
<html>
<head>
    <title>andes bagian administratif</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" href="../../css/south-street/jquery-ui-1.8.1.custom.css" rel="stylesheet" />
    <link type="text/css" href="../../css/main.css" rel="stylesheet" />
    <link type="text/css" href="../../css/dashboard.css" rel="stylesheet" />
    <style type="text/css">
    </style>
</head>
<body>
    <div id="iduser" style="display:none"><?php echo $_SESSION['id']; ?></div>
    <div id="wrapper">
        <div id="header">
            <div id="panelid" class="ui-widget-content ui-corner-all">
                <h1>Administratif Dashboard</h1>
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
	        <p>Silahkan pilih menu.</p>
        </div>        
        <div id="content">
            <div id="tabs">
	            <ul>
		            <li><a href="#man_peg">Man. Pegawai</a></li>
		            <li><a href="#man_kc">Man. Kantor Cabang</a></li>
		            <li><a href="#man_kel" id="tabkeluhan">Man. Keluhan</a></li>
		            <li><a href="#man_rute">Man. Rute</a></li>
		            <li><a href="#laporan" id="tablaporan">Laporan PK</a></li>
		            <li><a href="#faq" id="tabfaq">FAQ</a></li>
	            </ul>
	            <div id="man_peg">
                    <form>
		                <div class="submenu">
			                <input type="radio" id="input_peg" name="rmman_peg" /><label for="input_peg">Input Pegawai</label>
			                <input type="radio" id="lihat_peg" name="rmman_peg" /><label for="lihat_peg">Lihat Data Pegawai</label>
			                <input type="radio" id="edit_peg" name="rmman_peg" /><label for="edit_peg">Edit Pegawai</label>
			                <input type="radio" id="delete_peg" name="rmman_peg" /><label for="delete_peg">Delete Pegawai</label>
		                </div>
	                </form>	   
<!-- letak disini--><p>Tempat manajemen pegawai</p>
	                <div id="inputdatapeg" class="panelop">         
		                <p>Input data Pegawai</p>
		                <form id="inputpeg" class="def_form" action="../control.php" method="post">
		                    <fieldset>
		                    <legend>Data Pegawai</legend>
		                    <input type="hidden" name="op" id="op_pegawai" value="inputpeg">
		                    <label for="idpeg">Id Pegawai</label><input type="text" name="idpeg" id="idpeg" size="9" maxlength="9"/>
		                    <label for="nmpeg">Nama Pegawai</label><input type="text" name="nmpeg" id="nmpeg" size="35" maxlength="60"/>
		                    <label for="jk">Jenis Kelamin</label>
		                    <select name="jk" id="jk">
		                        <option value="l">Laki-laki</option>
		                        <option value="p">Perempuan</option>
		                    </select>
		                    <label for="tgllhr">Tanggal Lahir</label><input type="text" name="tgllhr" id="tgllhr" size="14"/>
		                    <label for="jabatan">Jabatan</label>
		                    <select name="jabatan" id="jabatan">
		                        <option value="customer service">Customer Service</option>
		                        <option value="peg. pengiriman">Peg. Pengiriman</option>
		                        <option value="administratif">Administratif</option>
		                    </select>		                    
                            <label for="notelp">No Telp</label>
                            <input type="text" name="notelp" id="notelp" size="20" maxlength="20"/>
		                    <label for="idkc">Kantor Cabang</label>
		                    <select name="idkc" id="idkc">
		                        <?php foreach($daftarkc as $kc): ?>
		                        <option value="<?php echo $kc['id'];?>"><?php echo $kc['nama'];?></option>
		                        <?php endforeach;?>
		                    </select>                            
                            <label for="password">Password</label>
                            <input type="text" name="password" id="password" size="20" />
                            </fieldset>                                  
                            <fieldset id="detpp"> 
                                <legend>Detail Peg. Pengiriman</legend>
                                <label for="idrutepeg">Rute Pegawai</label>
                                <select name="idrutepeg" id="idrutepeg">
		                            <?php foreach($daftarrute as $rute): ?>
		                            <option value="<?php echo $rute['id'];?>"><?php echo $rute['nama'];?></option>
		                            <?php endforeach;?>
                                </select>
                            </fieldset>
                            <input type="submit"  name="kirim" value="Proses" />
                            <input type="reset"  name="hapus" value="Hapus" />
		                </form>
                    </div>
	                <div id="lihatdatapeg" class="panelop">         
		            <p>Lihat data Pegawai</p>
		            <table id="daftarpegawai" class="tabel">
		                <thead>
		                    <tr><th>ID Pegawai</th><th>Nama Pegawai</th><th>Jabatan</th><th>Kantor Cabang</th><th>---</th></tr>
		                </thead>
		                <tbody>
                            <?php foreach($daftarpegawai as $pegawai): ?>                                
                            <tr>
                                <td><?php echo $pegawai['id'];?></td>
                                <td><?php echo $pegawai['nama'];?></td>
                                <td><?php echo $pegawai['jabatan'];?></td>
                                <td><?php echo $pegawai['nkc'];?></td>
                                <td><a href="<?php echo $pegawai['id'];?>">Edit</a> &nbsp; &nbsp; <a href="<?php echo $pegawai['id'];?>">Delete</a></td>
                            </tr>                                
                            <?php endforeach;?>		                
		                </tbody>
		            </table>
                    </div>
	                <div id="editdatapeg" class="panelop">         
		                <form id="editpeg" class="def_form" action="../control.php" method="post">
		                    <fieldset>
		                    <legend>Cek Data Pegawai</legend>
		                    <label for="idpegedit">Id Pegawai yang akan diedit</label><input type="text" name="idpeg" id="idpegedit" size="9" maxlength="9"/>
                            </fieldset>                                  
		                         
                            <input type="submit" name="kirim" value="Proses" />
                            <input type="reset" name="hapus" value="Hapus" />
		                </form>
		                <form id="updatepeg" class="def_form" action="../control.php" method="post">	
		                    <fieldset>	                
                            <legend>Data Pegawai Baru</legend>
		                    <input type="hidden" name="op" value="editpeg">
		                    <input type="hidden" name="eidpeg" id="eidpeg" value="">
		                    <label for="enmpeg">Nama Pegawai</label><input type="text" name="enmpeg" id="enmpeg" size="35" maxlength="60"/>
		                    <label for="ejk">Jenis Kelamin</label>
		                    <select name="ejk" id="ejk">
		                        <option value="l">Laki-laki</option>
		                        <option value="p">Perempuan</option>
		                    </select>
		                    <label for="etgllhr">Tanggal Lahir</label><input type="text" name="etgllhr" id="etgllhr" size="14"/>
		                    <label for="ejabatan">Jabatan</label>
		                    <select name="ejabatan" id="ejabatan">
		                        <option value="customer service">Customer Service</option>
		                        <option value="peg. pengiriman">Peg. Pengiriman</option>
		                        <option value="administratif">Administratif</option>
		                    </select>		                    
                            <label for="enotelp">No Telp</label>
                            <input type="text" name="enotelp" id="enotelp" size="20" maxlength="20"/>
		                    <label for="eidkc">Kantor Cabang</label>
		                    <select name="eidkc" id="eidkc">
		                        <?php foreach($daftarkc as $kc): ?>
		                        <option value="<?php echo $kc['id'];?>"><?php echo $kc['nama'];?></option>
		                        <?php endforeach;?>
		                    </select>                            
                            <label for="epassword">Password</label>
                            <input type="text" name="epassword" id="epassword" size="20" />
                            </fieldset>                                  
                            <fieldset id="edetpp"> 
                                <legend>Detail Peg. Pengiriman Baru</legend>
                                <label for="eidrutepeg">Rute Pegawai</label>
                                <select name="eidrutepeg" id="eidrutepeg">
		                            <?php foreach($daftarrute as $rute): ?>
		                            <option value="<?php echo $rute['id'];?>"><?php echo $rute['nama'];?></option>
		                            <?php endforeach;?>
                                </select>
                            </fieldset>                      
                            <input type="submit"  name="kirim" value="Update" />
                            <input type="reset"  name="batal" id="batalUpdatePeg" value="Batal" />
		                </form>                            		                
                    </div>
                    
	                <div id="deletedatapeg" class="panelop">         
		                <form id="deletepeg" class="def_form" action="../control.php" method="post">
		                    <fieldset>
		                    <legend>Cek Data Pegawai</legend>
		                    <label for="idpegdelete">Id Pegawai yang akan dihapus</label><input type="text" name="idpeg" id="idpegdelete" size="9" maxlength="9"/>
                            </fieldset>                                  
                            
                            <input type="submit"  name="kirim" value="Proses" />
                            <input type="reset"  name="hapus" value="Hapus" />
		                </form>	
		                <form id="konfirmdelete" class="def_form" action="../control.php" method="post">
		                    <input type="hidden" name="didpeg" id="didpeg" value="">
		                    <input type="hidden" name="op" value="deletepeg">
		                    <fieldset>
		                    <legend>Info pegawai yang ingin dihapus</legend>
		                    <table id="infopeg" class="tabel">
		                        <tbody>
		                            <tr><td>ID Pegawai</td><td>Sakti Dwi Cahyono</td></tr>
		                            <tr><td>Nama Pegawai</td><td>Sakti Dwi Cahyono</td></tr>
		                            <tr><td>Jenis Kelamin</td><td>Sakti Dwi Cahyono</td></tr>
		                            <tr><td>Tgl Lahir</td><td>Sakti Dwi Cahyono</td></tr>
		                            <tr><td>Jabatan</td><td>Sakti Dwi Cahyono</td></tr>
		                            <tr><td>No telp</td><td>Sakti Dwi Cahyono</td></tr>
		                            <tr><td>Kantor Cabang</td><td>Sakti Dwi Cahyono</td></tr>
		                        </tbody>
		                    </table>		       
		                    </fieldset>
                            <input type="submit"  name="kirim" value="Delete" />
                            <input type="reset"  name="batal" id="batalDeletePeg" value="Batal" />		                    
		                </form>         
                    </div>                                                            
	            </div>
                <div id="man_kc">
                    <form>
		                <div class="submenu">
			                <input type="radio" id="input_kc" name="rmman_kc" /><label for="input_kc">Input Kan. Cabang</label>
			                <input type="radio" id="lihat_kc" name="rmman_kc" /><label for="lihat_kc">Lihat Kan. Cabang</label>
			                <input type="radio" id="edit_kc" name="rmman_kc" /><label for="edit_kc">Edit Kan. Cabang</label>
			                <input type="radio" id="delete_kc" name="rmman_kc" /><label for="delete_kc">Delete Kan. Cabang</label>
		                </div>
	                </form>	                 
	                <div id="inputdatakc" class="panelop">         
		                <p>Input data KC</p>
		                <form id="inputkc" class="def_form" action="../control.php" method="post">
		                    <fieldset>
		                    <legend>Data Kantor Cabang</legend>
		                        <input type="hidden" name="op" id="op_kc" value="inputkc">
		                        <label for="namakc">Nama Kantor Cabang</label><input type="text" name="namakc" id="namakc" size="30" maxlength="60"/>
		                        <label for="notelpkc">No. Telp</label><input type="text" name="notelpkc" id="notelpkc" size="20" maxlength="20"/>
		                        <label for="idkab">Kabupaten</label>
		                        <select name="idkab" id="idkab">
		                            <?php foreach($daftarkab as $kab): ?>
		                            <option value="<?php echo $kab['id'];?>"><?php echo $kab['nama'];?></option>
		                            <?php endforeach;?>		                        
		                        </select>
		                        <label for="idkec">Kecamatan</label>
		                        <select name="idkec" id="idkec">
		                            <?php foreach($daftarkec as $kec): ?>
		                            <option value="<?php echo $kec['id'];?>"><?php echo $kec['nama'];?></option>
		                            <?php endforeach;?>
		                        </select>	
		                        <label for="detalamatkc">Detail Alamat</label>
		                        <textarea name="detalamatkc" id="detalamatkc"></textarea>
	                    
                            </fieldset>
                            <input type="submit"  name="kirim" value="Simpan" />
                            <input type="reset"  name="hapus" value="Hapus" />
		                </form>
                    </div>	
	                <div id="lihatdatakc" class="panelop">         
		                <p>Lihat data KC</p>
		                <table id="daftarkantor" class="tabel">
		                    <thead>
		                        <tr><th>Id Kantor</th><th>Nama Kantor</th><th>Kabupaten</th><th>Kecamatan</th><th>Det. Alamat</th><th>No Telp</th><th>---</th></tr>
		                    </thead>
		                    <tbody>
                                <?php foreach($daftarkc as $kc): ?>                                
                                <tr>
                                    <td><?php echo $kc['id'];?></td>
                                    <td><?php echo $kc['nama'];?></td>
                                    <td><?php echo $kc['nmkab'];?></td>
                                    <td><?php echo $kc['nmkec'];?></td>
                                    <td><?php echo $kc['detalamat'];?></td>
                                    <td><?php echo $kc['notelp'];?></td>
                                    <td><a href="<?php echo $kc['id'];?>">Edit</a> &nbsp; &nbsp; <a href="<?php echo $kc['id'];?>">Delete</a></td>
                                </tr>                                
                                <?php endforeach;?>		                
		                    </tbody>
		                </table>
                    </div>		                    	            
	                <div id="editdatakc" class="panelop">         
		                <p>Edit data KC</p>
		                <form id="editkc" class="def_form" action="../control.php" method="post">
		                    <fieldset>
		                    <legend>Cek Data Kantor Cabang</legend>
		                    <label for="idpegedit">Id Kantor cabang yang akan diedit</label><input type="text" name="idkc" id="idkcedit" size="9"/>
                            </fieldset>                                  
		                         
                            <input type="submit"  name="kirim" value="Proses" />
                            <input type="reset"  name="hapus" value="Hapus" />
		                </form>
		                <form id="updatekc" class="def_form" action="../control.php" method="post">
		                    <fieldset>
		                    <legend>Data Kantor Cabang</legend>
		                        <input type="hidden" name="op" value="editkc">
		                        <input type="hidden" name="editidkc" id="editidkc" value="">
		                        <label for="enamakc">Nama Kantor Cabang</label><input type="text" name="enamakc" id="enamakc" size="30" maxlength="60"/>
		                        <label for="enotelpkc">No. Telp</label><input type="text" name="enotelpkc" id="enotelpkc" size="20" maxlength="20"/>
		                        <label for="eidkab">Kabupaten</label>
		                        <select name="eidkab" id="eidkab">
		                            <?php foreach($daftarkab as $kab): ?>
		                            <option value="<?php echo $kab['id'];?>"><?php echo $kab['nama'];?></option>
		                            <?php endforeach;?>		                        
		                        </select>
		                        <label for="eidkec">Kecamatan</label>
		                        <select name="eidkec" id="eidkec">
		                            <?php foreach($daftarkec as $kec): ?>
		                            <option value="<?php echo $kec['id'];?>"><?php echo $kec['nama'];?></option>
		                            <?php endforeach;?>
		                        </select>	
		                        <label for="edetalamatkc">Detail Alamat</label>
		                        <textarea name="edetalamatkc" id="edetalamatkc"></textarea>
	                    
                            </fieldset>
                            <input type="submit"  name="kirim" value="Update" />
                            <input type="reset"  name="hapus" id="batalUpdateKC" value="Batal" />
		                </form>		                
                    </div>	 
	                <div id="deletedatakc" class="panelop">         
		                <p>Delete data Kantor Cabang</p>
		                <form id="deletekc" class="def_form" action="../control.php" method="post">
		                    <fieldset>
		                    <legend>Cek Data Kantor Cabang</legend>
		                    <label for="idpegedit">Id Kantor cabang yang akan dihapus</label><input type="text" name="idkc" id="idkcdelete" size="9"/>
                            </fieldset>                                  
		                         
                            <input type="submit"  name="kirim" value="Proses" />
                            <input type="reset"  name="hapus" value="Hapus" />
		                </form>
		                <form id="konfirmdeletekc" class="def_form" action="../control.php" method="post">
		                    <input type="hidden" name="didkc" id="didkc" value="">
		                    <input type="hidden" name="op" value="deletekc">
		                    <fieldset>
		                    <legend>Info Kantor Cabang yang akan dihapus</legend>
		                    <table id="infokantor" class="tabel">
		                        <tbody>
		                            <tr><td>ID Kantor Cabang</td><td>Sakti Dwi Cahyono</td></tr>
		                            <tr><td>Nama Kantor Cabang</td><td>Sakti Dwi Cahyono</td></tr>
		                            <tr><td>Kabupaten</td><td>Sakti Dwi Cahyono</td></tr>
		                            <tr><td>Kecamatan</td><td>Sakti Dwi Cahyono</td></tr>
		                            <tr><td>Det. Alamat</td><td>Sakti Dwi Cahyono</td></tr>
		                            <tr><td>No telp</td><td>Sakti Dwi Cahyono</td></tr>
		                        </tbody>
		                    </table>		       
		                    </fieldset>
                            <input type="submit"  name="kirim" value="Delete" />
                            <input type="reset"  name="batal" id="batalDeleteKC" value="Batal" />		                    
		                </form> 		                
                    </div>	                                       
	            </div>  
                <div id="man_kel">
<!-- penambahan -->
                    <h3>Keluhan status OPEN</h3>
                    <table id="headkelopen" class="tabel">
                        <thead>
                            <tr><th>ID Transaksi</th><th>Tanggal Waktu</th><th>Deskripsi</th><th>----</th></tr>
                        <thead>
                        <tbody>
                            <?php foreach($daftarkelopen as $kel): ?>
                            <tr><td><?php echo $kel['idtransaksi']; ?></td><td><?php echo $kel['tglwaktu']; ?></td><td><?php echo $kel['deskripsi']; ?></td><td><a href="<?php echo $kel['idtransaksi']; ?>">Respon</a></td></tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>		            
                    <h3>Keluhan status CLOSED</h3>
                    <table id="headkelclosed" class="tabel">
                        <thead>
                            <tr><th>ID Transaksi</th><th>Tanggal Waktu</th><th>Deskripsi</th><th>----</th></tr>
                        <thead>
                        <tbody>
                            <?php foreach($daftarkelclose as $kel): ?>
                            <tr><td><?php echo $kel['idtransaksi']; ?></td><td><?php echo $kel['tglwaktu']; ?></td><td><?php echo $kel['deskripsi']; ?></td><td><a href="<?php echo $kel['idtransaksi']; ?>">Respon</a></td></tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                    
                    <form id="infokeluhan" class="def_form">   
		            <h3>Informasi Pengiriman</h3>		            
                    <table id="infokirimankel" class="tabel">
                        <tbody>
                            <tr><td>ID/No Pengiriman</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Nama Pengirim</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Alamat Pengirim</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Notelp Pengirim</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Nama Penerima</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Alamat Penerima</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Notelp Penerima</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Asuransi</td><td>Sakti Dwi Cahyono</td></tr>                            
                            <tr><td>Kilat</td><td>Sakti Dwi Cahyono</td></tr>                            
                            <tr><td>Status</td><td>Sakti Dwi Cahyono</td></tr>                            
                            <tr><td>Biaya</td><td>Sakti Dwi Cahyono</td></tr>                            
                        </tbody>
                    </table>		                     
                    <h3>Keluhan</h3>             
                    <div id="daftarkeluhan">
                        <p class="first"><span class="tgl">2010-05-14 03:28:01</span> <span class="anda">Anda</span>
                        <span class="open">open</span>
                        <span class="closed">closed</span>
                        <br/><br/>
                        <strong>Blm ada keluhan</strong>
                        et facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellen</p>
                    </div>
                    <fieldset id="paneltambahkel">      
                        <label for="isikeluhan">Isi Keluhan anda</label>
                        <textarea name="isikeluhan" id="isikeluhan" style="width:100%;max-width:650px">
                        </textarea>
                        <hr/>
                        <input type="checkbox" id="statkel" /><label for="statkel">CLOSED</label>
                        <hr/>
                        <input type="button" id="tambahkel" value="Respon keluhan" /><input type="button" id="keluarkeluhan" value="Keluar" />
                        
                    </fieldset>
                    </form>		            
<!-- penambahan -->                    
	            </div>  
                <div id="man_rute">
                    <form>
		                <div class="submenu">
			                <input type="radio" id="input_rute" name="rmman_rute" /><label for="input_rute">Input Rute</label>
			                <input type="radio" id="lihat_rute" name="rmman_rute" /><label for="lihat_rute">Lihat Rute</label>
			                <input type="radio" id="edit_rute" name="rmman_rute" /><label for="edit_rute">Edit Rute</label>
		                </div>
	                </form>	                
	                <div id="inputdatarute" class="panelop">         
		                <p>Input data Rute</p>
		                <form id="inputrute" class="def_form" action="../control.php" method="post">
		                    <fieldset>
		                    <legend>Informasi Rute</legend>
		                    <label for="nmrute">Nama rute</label>
		                    <input type="text" name="nmrute" id="nmrute" size="25" maxlength="40"/>
		                    <input type="hidden" name="booldetrute" id="booldetrute" val="" />
		                    <input type="hidden" name="op" value="inputrute"/>
		                    <label>Jalur rute</label>
		                    <table id="detailrute" class="tabel">
		                        <thead>
		                            <tr><th>Kantor cabang atau kecamatan/kota</th><th>---</th></tr>
		                        </thead>
		                        <tbody>
		                                        
		                        </tbody>
		                    </table>	
		                    <input type="button"  value="Tambah" id="tambahposrute">	                    
                            </fieldset>                                  
		                         
                            <input type="submit"  name="kirim" value="Simpan" />
                            <input type="reset"  name="hapus" value="Hapus" />
		                </form>
                    </div>	
	                <div id="lihatdatarute" class="panelop">         
		                <p>Lihat data Rute</p>
		            <table id="daftarrute" class="tabel">
		                <thead>
		                    <tr><th>ID Rute</th><th>Nama Rute</th><th>Detail Rute</th><th>---</th></tr>
		                </thead>
		                <tbody>
                            <?php foreach($daftarrute as $rute): ?>
                            <tr>
                                <td><?php echo $rute['id'];?></td>
                                <td><?php echo $rute['nama'];?></td>                                
                                <td>
                                    <?php foreach($rute['detail'] as $detrut): ?>
                                        <?php echo '('.$detrut['nmkab'].')'.$detrut['nmkec']." - ";?>
                                    <?php endforeach;?>		                
                                </td>
                                <td><a href="<?php echo $rute['id'];?>">Edit</a></td>
                            </tr>                                
                            <?php endforeach;?>		                
		                </tbody>
		            </table>
                    </div>		                    	            
	                <div id="editdatarute" class="panelop">         
		                <p>Edit data Rute</p>
		                <form id="editrute" class="def_form" action="../control.php" method="post">
		                    <fieldset>
		                    <legend>Cek Data Rute</legend>
		                    <label for="idruteedit">Id rute yang akan diedit</label><input type="text" name="idrute" id="idruteedit" size="9"/>
                            </fieldset>                                      
                            <input type="submit"  name="kirim" value="Proses" />
                            <input type="reset"  name="hapus" value="Hapus" />
		                </form>
		                <form id="updaterute" class="def_form" action="../control.php" method="post">
		                    <fieldset>
		                    <legend>Informasi Rute</legend>
		                    <label for="enmrute">Nama rute</label>
		                    <input type="text" name="enmrute" id="enmrute" size="25" maxlength="40"/>
		                    <input type="hidden" name="ebooldetrute" id="ebooldetrute" val="" />
		                    <input type="hidden" name="eidrute" id="eidrute" val=""/>
		                    <input type="hidden" name="op" value="editrute"/>
		                    <label>Jalur rute</label>
		                    <table id="edetailrute" class="tabel">
		                        <thead>
		                            <tr><th>Kantor cabang atau kecamatan/kota</th><th>---</th></tr>
		                        </thead>
		                        <tbody>
		                                        
		                        </tbody>
		                    </table>	
		                    <input type="button"  value="Tambah" id="etambahposrute">	                    
                            </fieldset>                                  
		                         
                            <input type="submit"  name="kirim" value="Update" />
                            <input type="reset"  name="hapus" value="Batal" id="batalUpdateRute"/>
		                </form>		                
                    </div>	 			            
	            </div>  	            	            	            
                <div id="laporan">
		            <h3> Laporan Pendapatan kotor minggu ini. (Minggu ke-<span id="idminggu"><?php echo date('W');?></span>).</h3>
		            <div id="graphminggu" style="width:680px;height:300px">
	                </div>  

	                <hr/>
	                <h3> Laporan Pendapatan kotor bulan ini. (Bulan ke-<span id="idbulan"><?php echo date('n');?></span> <?php echo date('F');?>)</h3>
	                <div id="graphbulan" style="width:680px;height:300px">
	                </div>           	            

	                <hr/>
	                <h3> Laporan Pendapatan kotor tahun ini. (Tahun <span id="idtahun"><?php echo date('Y');?></span>)</h3>
	                <div id="graphtahun" style="width:680px;height:300px">
	                </div>
	            </div>
	            <div id="faq">
		            <h1>Fruquenly Asked Question.</h1>
		            <h3>sfjds; dsfs dfaf?</h3>
		            <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci</p>
		            <h3>Mauris mauris ante?</h3>
		            <p>Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate. </p>
		            <h3>Nam enim risus?</h3>
		            <p>Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis </p>
	            </div>
            </div>                
        </div>
        <div id="footer" class="ui-corner-all">
            Under development &copy; 2010
        </div>
        <div id="dialoghpspeg" title="Konfirmasi Hapus Pegawai">
	        <p>Operasi hapus data pegawai tidak dijamin berhasil 100% dikarenakan kemungkinan data yang ingin anda hapus masih dipakai dibeberapa tabel yang lain</p>
	        <p>Apakah anda yakin menghapus pegawai ini?</p>
        </div>        
        <div id="dialoghpskc" title="Konfirmasi Hapus Kantor Cabang">
	        <p>Operasi hapus tidak selamanya berhasil</p>
	        <p>Apakah anda yakin menghapus kantor cabang ini?</p>
        </div>
        <div id="dialogtbhrute" title="Pilih kantor cabang atau kecamatan">
	        <p>Silahkan pilih posisi untuk rute tambahan.</p>
	        <form class="def_form">
	        <fieldset>
	            <label for="idkcrute">Kantor Cabang</label>
                <select name="idkcrute" id="idkcrute">
                    <option value="kosong">--------</option>
                    <?php foreach($daftarkc as $kc): ?>
                    <option value="<?php echo $kc['id'];?>,<?php echo $kc['idkecamatan'];?>"><?php echo $kc['nama'];?></option>
                    <?php endforeach;?>
                </select>	        
            </fieldset>    
            <div id="optpos">
            <fieldset>
                <label for="idkabrute">Kabupaten</label>
                <select name="idkabrute" id="idkabrute">
                    <?php foreach($daftarkab as $kab): ?>
                    <option value="<?php echo $kab['id'];?>"><?php echo $kab['nama'];?></option>
                    <?php endforeach;?>		                        
                </select>
                <label for="idkecrute">Kecamatan</label>
                <select name="idkecrute" id="idkecrute">
                    <?php foreach($daftarkec as $kec): ?>
                    <option value="<?php echo $kec['id'];?>"><?php echo $kec['nama'];?></option>
                    <?php endforeach;?>
                </select>
            </fieldset>
            </div>                            
	        </form>
        </div>
        <div id="dialogetbhrute" title="Pilih kantor cabang atau kecamatan">
	        <p>Silahkan pilih posisi untuk rute selanjutnya.</p>
	        <form class="def_form">
	        <fieldset>
	            <label for="eidkcrute">Kantor Cabang</label>
                <select name="eidkcrute" id="eidkcrute">
                    <option value="kosong">--------</option>
                    <?php foreach($daftarkc as $kc): ?>
                    <option value="<?php echo $kc['id'];?>,<?php echo $kc['idkecamatan'];?>"><?php echo $kc['nama'];?></option>
                    <?php endforeach;?>
                </select>	        
            </fieldset>    
            <div id="eoptpos">
            <fieldset>
                <label for="eidkabrute">Kabupaten</label>
                <select name="eidkabrute" id="eidkabrute">
                    <?php foreach($daftarkab as $kab): ?>
                    <option value="<?php echo $kab['id'];?>"><?php echo $kab['nama'];?></option>
                    <?php endforeach;?>		                        
                </select>
                <label for="eidkecrute">Kecamatan</label>
                <select name="eidkecrute" id="eidkecrute">
                    <?php foreach($daftarkec as $kec): ?>
                    <option value="<?php echo $kec['id'];?>"><?php echo $kec['nama'];?></option>
                    <?php endforeach;?>
                </select>
            </fieldset>
            </div>                            
	        </form>
        </div>                 
    </div>
</body>
<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.8.1.custom.min.js"></script>
<script type="text/javascript" src="../../js/jquery.bgiframe-2.1.1.js"></script>
<script type="text/javascript" src="../../js/jquery.ui.datepicker-id.js"></script>
<script type="text/javascript" src="../../js/jquery.validate.js"></script>
<script type="text/javascript" src="../../js/jquery.flot.min.js"></script>
<!--[if IE]><script language="javascript" type="text/javascript" src="../../js/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="../../js/administratif.js"></script>
</html>
