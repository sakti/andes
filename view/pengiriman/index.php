<?php
require_once('header.php');
if($_POST['update']=="Update"){
    if(pg_updatePosPegPengiriman($_SESSION['id'],$_POST['posisi'])){
        $info="Posisi anda telah terupdate";
        $_SESSION['rute']['pos']=$_POST['posisi'];
    }
    else
        $info="Gagal mengupdate posisi";   
}
?>
            <div id="nav">
	            <ul>
	                <li><a href="index.php" style="background:#8dd952;">Lihat Rute</a></li>
		            <li><a href="info.php">Info barang diangkut</a></li>
		            <li><a href="update.php">Update status barang</a></li>
		            <li><a href="faq.php">FAQ</a></li>
	            </ul>
            </div>   
            <div id="isi">
                <div id="panelinfo">
                    <?php echo $info;
                        //echo date('o-m-d H:i:s');
                    ?>
                </div>
                <h2>Lihat Rute</h2>
	            <p>Anda memiliki rute dengan nama rute '<?php echo $_SESSION['rute']['nama'];?>' yang mempunyai jalur sebagai berikut :</p>
	            <ul>
	            <?php foreach($_SESSION['rute']['detail'] as $pos): ?>
	                <li><?php echo $pos['nmkab'];?> -- <?php echo $pos['nmkec'];?> (<?php echo $pos['nmkc'];?>)</li>
	            <?php endforeach; ?>
	            </ul>
	            <h3>Set Posisi</h3>
	            <p>
	            Posisi anda 
	            <?php
	            if($_SESSION['rute']['pos']==NULL)
	                echo 'belum diset';
	            else{
	                $jmlrute=count($_SESSION['rute']['detail']);
	                for($i=0;$i<$jmlrute;$i++){
	                    //echo "<h1>aa{".$_SESSION['rute']['detail'][$i]['id']."}</h1>";
	                    if($_SESSION['rute']['detail'][$i]['id']==$_SESSION['rute']['pos']){
	                        echo "(".$_SESSION['rute']['detail'][$i]['nmkc'].") ".$_SESSION['rute']['detail'][$i]['nmkab']." - ".$_SESSION['rute']['detail'][$i]['nmkec'];
	                        
	                        $_SESSION['idkec']=$_SESSION['rute']['detail'][$i]['idkecamatan'];
	                        $_SESSION['poskc']=$_SESSION['rute']['detail'][$i]['idkantorcabang'];
	                        $_SESSION['posnmkc']=$_SESSION['rute']['detail'][$i]['nmkc'];
	                        break;
	                    }    
	                }
	            }
	            //echo $_SESSION['rute']['pos'];
                //print_r($_SESSION);
	            ?>
	            <p>	            
	            <form class="def_form" action="index.php" method="post">
	                <fieldset>
	                <label for="posisi">Update Posisi</label>
	                <select name="posisi" id="posisi">
	                <?php foreach($_SESSION['rute']['detail'] as $pos): ?>
	                    <option value="<?php echo $pos['id'];?>"> <?php echo ($pos['nmkc'])?"KC ".$pos['nmkc']:$pos['nmkab']."-".$pos['nmkec'];?></option>
	                <?php endforeach; ?>    
	                </select>
	                </fieldset>
	                <input type="submit" value="Update" name="update">
	            </form>
            </div>                         
<?php
require_once('footer.php');
?>

