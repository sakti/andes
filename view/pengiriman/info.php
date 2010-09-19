<?php
session_start();
require_once('../../lib/koneksi.php');
require_once('../../modules/transaksi.php');
require_once('../../modules/pegawai.php');
if($_POST['ambil']=="Ambil"){
    $i=0;
    foreach($_POST as $data => $nilai){    
        if($data!='ambil'){
            pg_ambilPaketKiriman($nilai,$_SESSION['id'],$_SESSION['idkec'],$_SESSION['poskc']);
            $i++;
        }
    }
    $_SESSION['info']="$i paket telah diambil";
    header('Location: info.php');
}
require_once('header.php');
$daftartrans=trans_getDaftarTransByIdPeng($_SESSION['id']);
if(isset($_SESSION['poskc'])){
$daftarpaketbsdiambil=trans_getDaftarTransByKC($_SESSION['poskc']);
}

?>
            <div id="nav">
	            <ul>
	                <li><a href="index.php">Lihat Rute</a></li>
		            <li><a href="info.php" style="background:#8dd952;">Info barang diangkut</a></li>
		            <li><a href="update.php">Update status barang</a></li>
		            <li><a href="faq.php">FAQ</a></li>
	            </ul>
            </div>   
            <div id="isi">
                <div id="panelinfo">
                    <?php echo $_SESSION['info']; unset($_SESSION['info']);?>
                </div>            
                <h2>Info Barang yang anda kirim</h2>
	            <p>Info pengiriman yang saat ini anda kirim</p>
	            <table id="daftartransaksi" class="tabel">
	                <thead>
	                    <tr><th>ID Transaksi</th><th>Info</th></tr>
	                </thead>
	                <tbody>
                        <?php $i=0; foreach($daftartrans as $tran): ?>
                        <tr <?php 
                                $gaya='';
                                if($i%2==0) $gaya.='background-color: rgb(192, 240, 144);'; 
                                if($tran['kilat']=='y') $gaya.='font-weight:bold;color:#a22d02;'; 
                                echo 'style="'.$gaya.'"';
                            ?>>
                            <td><?php echo $tran['id']; ?></td>
                            <td>[<?php echo $tran['namapengirim']; ?>,
                            <?php echo $tran['kabpengirim']; ?>-<?php echo $tran['kecpengirim']; ?>-<?php echo $tran['detalamatpengirim']; ?>,
                            <?php echo $tran['notelppengirim']; ?>] ->
                            [<?php echo $tran['namapenerima']; ?>,
                            <?php echo $tran['kabpenerima']; ?>-<?php echo $tran['kecpenerima']; ?>-<?php echo $tran['detalamatpenerima']; ?>,
                            <?php echo $tran['notelppenerima']; ?>]
                             (Kilat :<?php echo $tran['kilat']; ?>)</td></tr>
                        <?php $i++; endforeach;?>		                
	                </tbody>
	            </table>
	            <h3>Ambil barang</h3>	            
	            <p>Ambil barang pada kantor cabang <?php echo $_SESSION['posnmkc']; ?><p>
	            <form action="info.php" method="post" class="def_form">
	            <table id="daftarpaket" class="tabel">
	                <thead>
	                    <tr><th>Ambil</th><th>Info</th></tr>
	                </thead>
	                <tbody>
	                    <?php if($daftarpaketbsdiambil): ?>
                        <?php $i=0; foreach($daftarpaketbsdiambil as $pkt): ?>
                        <tr <?php 
                                $gaya='';
                                if($i%2==0) $gaya.='background-color: rgb(192, 240, 144);'; 
                                if($pkt['kilat']=='y') $gaya.='font-weight:bold;color:#a22d02;'; 
                                echo 'style="'.$gaya.'"';
                            ?>>
                            <td><input type="checkbox" name="idtran<?php echo $i; ?>" value="<?php echo $pkt['id']; ?>"/></td>
                            <td>(id:<?php echo $pkt['id']; ?>) 
                            [<?php echo $pkt['namapengirim']; ?>,
                            <?php echo $pkt['notelppengirim']; ?>] -> 
                            [<?php echo $pkt['namapenerima']; ?>,
                            <?php echo $pkt['nmkabpenerima']; ?>-<?php echo $pkt['nmkecpenerima']; ?>-<?php echo $pkt['detalamatpenerima']; ?>,
                            <?php echo $pkt['notelppenerima']; ?>]
                            (Kilat :<?php echo $pkt['kilat']; ?>)</td></tr>
                        <?php $i++; endforeach;?>		   
                        <?php endif;?>             
	                </tbody>
	            </table>	     
	            <input type="submit" name="ambil" value="Ambil" />           
	            </form>
            </div>                         
<?php
require_once('footer.php');
?>
