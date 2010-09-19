<?php
session_start();
require_once('../../lib/koneksi.php');
require_once('../../modules/transaksi.php');

if($_POST['update']=="Update"){
    list($idkc,$idkec)=explode(',',$_POST['kc']);
    switch($_POST['stat']){
        case 3:
            if(trans_setTranDiterima($_POST['id'],$_POST['idkc'],$_POST['idkec'],$_SESSION['id'],$_POST['info'])){
                $_SESSION['info']="kiriman telah diset diterima";
            }
            break;
        case 4:
            if(trans_setTranDititipkan($_POST['id'],$idkc,$idkec,$_SESSION['id'])){
                $_SESSION['info']="Kiriman telah dititipkan";    
            }
            break;
        case 5:
            if(trans_setTranDisinggahkan($_POST['id'],$idkc,$idkec,$_SESSION['id'])){
                $_SESSION['info']="Kiriman telah disinggahkan";
            }
            break;
    }
    header('Location: update.php');
}
if(!empty($_GET['id'])){
    unset($_SESSION['info']);
    $data=trans_getTransById($_GET['id']);
    if(!empty($_GET['stat'])){
        $stat=$_GET['stat'];
        $daftarkc=array();
        foreach($_SESSION['rute']['detail'] as $rute){
            if($rute['idkantorcabang']!=NULL){
                $daftarkc[]=array('id' => $rute['idkantorcabang'] ,'idkec' => $rute['idkecamatan'], 'nama' => $rute['nmkc']);
            }
        }
    }
}
require_once('header.php');
$daftartrans=trans_getDaftarTransByIdPeng($_SESSION['id']);
?>
            <div id="nav">
	            <ul>
	                <li><a href="index.php">Lihat Rute</a></li>
		            <li><a href="info.php">Info barang diangkut</a></li>
		            <li><a href="update.php" style="background:#8dd952;">Update status barang</a></li>
		            <li><a href="faq.php">FAQ</a></li>
	            </ul>
            </div>   
            <div id="isi">
                <div id="panelinfo">
                    <?php 
                    if($_SESSION['info']){
                        $tmp=$_SESSION['info'];
                        echo $tmp;
                        //unset($_SESSION['info']);
                    }
                    //print_r($_SESSION);
                    ?>
                </div>              
                <h2>Update status barang</h2>
                <?php if($data):?>
                <p id="path"><a href="update.php">daftar</a> <?php if($stat):?>> <a href="update.php?id=<?php echo $data['id']; ?>">operasi</a><?php endif;?> </p>
                <h3>Informasi barang yang akan diupdate</h3>
	                <table id="daftartransaksi" class="tabel">
	                    <thead>
	                        <tr><th>ID Transaksi</th><th>Info</th></tr>
	                    </thead>
	                    <tbody>      
                            <tr <?php 
                                    $gaya='';
                                    if($data['kilat']=='y') $gaya.='font-weight:bold;color:#a22d02;'; 
                                    echo 'style="'.$gaya.'"';
                                ?>>
                                <td><?php echo $data['id']; ?></td>
                                <td>[<?php echo $data['namapengirim']; ?>,
                                <?php echo $data['kabpengirim']; ?>-<?php echo $data['kecpengirim']; ?>-<?php echo $data['detalamatpengirim']; ?>,
                                <?php echo $data['notelppengirim']; ?>] -> 
                                [<?php echo $data['namapenerima']; ?>,
                                <?php echo $data['kabpenerima']; ?>-<?php echo $data['kecpenerima']; ?>-<?php echo $data['detalamatpenerima']; ?>,
                                <?php echo $data['notelppenerima']; ?>] 
                                (Kilat :<?php echo $data['kilat']; ?>)</td></tr>
	                    </tbody>
	                </table>                
                <?php if($stat):?>
                <h3>Informasi status baru</h3>
                    <?php if($stat==3): ?>
                        <form id="fditerima" class="def_form" action="update.php" method="post">
                            <fieldset>                         
                            <legend>Informasi diterima</legend>
                            <input type="hidden" name="stat" value="<?php echo $stat; ?>">
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                            <input type="hidden" name="idkc" value="<?php echo $_SESSION['poskc']; ?>">
                            <input type="hidden" name="idkec" value="<?php echo $_SESSION['idkec']; ?>">
                            <label for="info">Informasi tambahan</label>
                            <textarea name="info" id="info"></textarea>
                            </fieldset>
                            <input type="submit" name="update" value="Update" />
                        </form>
                    <?php elseif($stat==4): ?>
                        <form id="fdititipkan" class="def_form" action="update.php" method="post">                         
                            <fieldset>                         
                            <legend>Informasi dititipkan</legend>
                            <p>Jika penerima kiriman tidak ada dan tidak bisa diserahkan ke tetangga terdekat, maka kiriman dititipkan di kantor cabang terdekat</p>
                            <input type="hidden" name="stat" value="<?php echo $stat; ?>">
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                            <label for="kc">Kantor cabang penitipan barang</label>
                            <select name="kc" id="kc">
                                <?php foreach($daftarkc as $kc): ?>
                                <option value="<?php echo $kc['id']; ?>,<?php echo $kc['idkec']; ?>"><?php echo $kc['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            </fieldset>
                            <input type="submit" name="update" value="Update" />
                        </form>
                    <?php elseif($stat==5): ?>
                        <form id="fdisinggahkan" class="def_form" action="update.php" method="post">                         
                            <fieldset>                         
                            <legend>Informasi disinggahkan</legend>
                            <p>Jika penerima diluar jalur kiriman maka titipkan kepada kantor cabang yang mempunyai jalur(kc kab)</p>
                            <input type="hidden" name="stat" value="<?php echo $stat; ?>">
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                            <label for="kc">Kantor cabang persinggahan barang</label>
                            <select name="kc" id="kc">
                                <?php foreach($daftarkc as $kc): ?>
                                <option value="<?php echo $kc['id']; ?>,<?php echo $kc['idkec']; ?>"><?php echo $kc['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>                            
                            </fieldset>
                            <input type="submit" name="update" value="Update" />
                        </form>
                    <?php endif; ?>
                <?php else:?>                	       
	            <h3>Pilihan status baru</h3>                       
                <div id="operasi">
                    <ul>
                        <li><a href="update.php?id=<?php echo $data['id']; ?>&stat=3">Diterima</a></li>
                        <li><a href="update.php?id=<?php echo $data['id']; ?>&stat=4">Dititipkan</a></li>
                        <li><a href="update.php?id=<?php echo $data['id']; ?>&stat=5">Disinggahkan</a></li>
                    <ul>
                </div>
                <?php endif;?>
                <p id="path"><a href="update.php">daftar</a> <?php if($stat):?>> <a href="update.php?id=<?php echo $data['id']; ?>">operasi</a><?php endif;?> </p>
                <?php else: ?>
	            <p>Update status kiriman yang anda kirim. Ada tiga pilihan yaitu 'Diterima' ketika kiriman sudah diterima oleh penerima, 'Dititipkan' ketika kiriman dititipkan ke kantor cabang terdekat dikarenakan si penerima tidak ada ditempat dan tidak bisa diwakilkan oleh tetangga, yang terakhir 'Disinggahkan' jika anda kiriman yang anda kirim melalui rute yang berbeda</p>
	            <p>Hati-hati dalam melakukan update status karena operasi ini tidak dapat diulangi kembali, anda bertanggung jawab penuh atas apa yang anda lakukan</p>
	            <form action="update.php" class="def_form">
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
                                <td><a href="update.php?id=<?php echo $tran['id']; ?>" style="font-weight:bold;color:white;display:block;padding:10px 5px;color:black"><?php echo $tran['id']; ?></a></td>
                                <td>[<?php echo $tran['namapengirim']; ?>,
                                <?php echo $tran['kabpengirim']; ?>-<?php echo $tran['kecpengirim']; ?>-<?php echo $tran['detalamatpengirim']; ?>,
                                <?php echo $tran['notelppengirim']; ?>] -> 
                                [<?php echo $tran['namapenerima']; ?>,
                                <?php echo $tran['kabpenerima']; ?>-<?php echo $tran['kecpenerima']; ?>-<?php echo $tran['detalamatpenerima']; ?>,
                                <?php echo $tran['notelppenerima']; ?>]
                                (Kilat:<?php echo $tran['kilat']; ?>)</td></tr>   
                            <?php $i++; endforeach;?>		                
	                    </tbody>
	                </table>	            
	            </form>
	            <?php endif; ?>
            </div>                         
<?php
require_once('footer.php');
?>
