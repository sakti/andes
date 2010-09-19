<?php
require_once('tracking.php');
function trans_cekIdTrans($id){
    $query = sprintf("SELECT id FROM transaksi WHERE id='%s'",
        mysql_real_escape_string($id));        
    $result = mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    if(mysql_num_rows($result)!=1){
        return false;
    }else{
        return true;
    }    
}
function trans_cekValidCustomer($id,$namapengirim){
    $query = "SELECT id FROM transaksi WHERE id='$id' and namapengirim='$namapengirim'";
    $result = mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    if(mysql_num_rows($result)!=1){
        return false;
    }else{
        return true;
    }    

}
function trans_getAllKat(){
    $query="SELECT id,deskripsi,bobot FROM tblkategori";
    $result=mysql_query($query);
    $hasil=array();
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    while($row = mysql_fetch_assoc($result)){
        $hasil[]=$row;
    }
    return $hasil;
}

function trans_getDaftarTransByKC($idkc){
    $query="SELECT a.id, a.namapengirim, a.notelppengirim, a.idkecpengirim, a.detalamatpengirim, a.namapenerima, a.notelppenerima, a.idkecpenerima, a.detalamatpenerima, c.nama nmkecpenerima, d.nama nmkabpenerima, a.idcs, a.idpengirim, a.idstatus, a.biaya, a.asuransi, a.kilat, a.infopenerima, b.tglwaktu, e.nama nmcs FROM transaksi a, historystatus b, kecamatan c, kabupaten d,pegawai e WHERE (a.idstatus =1 OR a.idstatus =5) AND a.idkecpenerima = c.id AND c.idkabupaten = d.id AND b.idkantorcabang = a.poskc AND b.idtransaksi = a.id AND a.idstatus = b.idstatus AND e.id=a.idcs AND a.poskc =$idkc";
    $result=mysql_query($query);
    $hasil=array();
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    while($row = mysql_fetch_assoc($result)){
        $hasil[]=$row;
    }
    return $hasil;    
}
function trans_getTransById($id){
    $query="select tr.id, tr.namapengirim, tr.notelppengirim, tr.idkecpengirim, tr.detalamatpengirim, tr.namapenerima, tr.notelppenerima,tr.idkecpenerima, tr.detalamatpenerima, tr.kilat, tr.asuransi, tr.biaya, tr.idstatus, tr.infopenerima ,a.nama kecpengirim, b.nama kecpenerima, c.nama kabpengirim, d.nama kabpenerima, e.deskripsi from transaksi tr, kecamatan a, kecamatan b, kabupaten c, kabupaten d, tblstatus e where tr.id='$id' and a.id=tr.idkecpengirim and b.id=tr.idkecpenerima and a.idkabupaten=c.id and b.idkabupaten=d.id and tr.idstatus=e.id";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $hasil = mysql_fetch_assoc($result);    
    
    return $hasil;
}
function trans_getDaftarTransByIdPeng($id){
    $query="select tr.id, tr.namapengirim, tr.notelppengirim, tr.idkecpengirim, tr.detalamatpengirim, tr.namapenerima, tr.notelppenerima,tr.idkecpenerima, tr.detalamatpenerima, tr.kilat,a.nama kecpengirim, b.nama kecpenerima, c.nama kabpengirim, d.nama kabpenerima from transaksi tr, kecamatan a, kecamatan b, kabupaten c, kabupaten d where idpengirim='$id' and idstatus=2 and a.id=tr.idkecpengirim and b.id=tr.idkecpenerima and a.idkabupaten=c.id and b.idkabupaten=d.id";
    $result=mysql_query($query);
    $hasil=array();
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    while($row = mysql_fetch_assoc($result)){
        $hasil[]=$row;
    }
    return $hasil;    
}
function trans_calculateBiaya($idkeca,$idkecb,$brtbrg,$nilaibrg,$katbrg,$kilat,$asuransi){
    $hasil=array();
    $query="SELECT jarak,berat,asuransi,kategori,kilat FROM perhitunganbiaya WHERE digunakan='y' LIMIT 1";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $d = mysql_fetch_assoc($result);
    $tmp=track_calculateDistance($idkeca,$idkecb);
    $hasil['jarak']=$jarak=$tmp['jarak'];
    //perhitungan total nilai item
    $hasil['jmlitem']=$jmlitem=count($brtbrg);
    
    $totalnilaiitem=0;
    $nilaiitem=0;
    for($i=0;$i<$jmlitem;$i++){
        list($kat,$bobot)=explode(',',$katbrg[$i]);
        $totalnilaiitem+=($d['berat']*$brtbrg[$i]+$d['kategori']*$bobot);       
        $nilaiitem+=$nilaibrg[$i];
    }
    if($jarak==0)
        $total=100*$d['jarak']*$totalnilaiitem;
    else
        $total=$jarak*$d['jarak']*$totalnilaiitem;
        
    if($kilat=='on'){
        $total=$total*$d['kilat'];
        $hasil['kilat']='Ya';
    }else{
        $hasil['kilat']='Tidak';
    }
    if($asuransi=='on'){
        $total=$total+$nilaiitem*$d['asuransi'];
        $hasil['asuransi']='Ya';
    }else{
        $hasil['asuransi']='Tidak';
    }
    $hasil['total']=round($total,-2);
    
    return $hasil;
}
function trans_setTranDiterima($id,$idkc,$idkec,$idpeg,$info){
    //echo 'id ='.$id.' ; idkc='.$idkc.' ; idkec='.$idkec.' ; idpeg='.$idpeg.' ; info='.$info;
    if(!$idkc){
        $idkc="NULL";
    }
    $query="update transaksi set idstatus=3,infopenerima='$info',poskc=$idkc where id=$id";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $query="insert into historystatus values(NULL,$id,3,'".date('o-m-d H:i:s')."',$idkec,$idkc)";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }        
    return true;
    //die();
}
function trans_setTranDititipkan($id,$idkc,$idkec,$idpeg){
    $query="update transaksi set idstatus=4,poskc=$idkc where id=$id";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $query="insert into historystatus values(NULL,$id,4,'".date('o-m-d H:i:s')."',$idkec,$idkc)";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }        
    return true;
}
function trans_setTranDisinggahkan($id,$idkc,$idkec,$idpeg){
    $query="update transaksi set idstatus=5,poskc=$idkc where id=$id";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $query="insert into historystatus values(NULL,$id,5,'".date('o-m-d H:i:s')."',$idkec,$idkc)";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }        
    return true;
}
function trans_insertTransaksi($nma,$notelpa,$idkeca,$detalmta,$nmb,$notelpb,$idkecb,$detalmtb,$nmbrg,$brtbrg,$nilaibrg,$katbrg,$asuransi,$kilat,$biaya,$idcs,$idkec,$idkc){
    if($kilat=='on')
        $tkilat='y';
    else
        $tkilat='t';
    if($asuransi=='on')
        $tasuransi='y';
    else
        $tasuransi='t';
    $query = sprintf("INSERT INTO transaksi VALUES (NULL,'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s', NULL ,1,'%s','%s','%s','','%s')",
         mysql_real_escape_string($nma),
         mysql_real_escape_string($notelpa),
         mysql_real_escape_string($idkeca),
         mysql_real_escape_string($detalmta),
         mysql_real_escape_string($nmb),
         mysql_real_escape_string($notelpb),
         mysql_real_escape_string($idkecb),
         mysql_real_escape_string($detalmtb),
         mysql_real_escape_string($idcs),
         mysql_real_escape_string($biaya),
         mysql_real_escape_string($tasuransi),
         mysql_real_escape_string($tkilat),
         mysql_real_escape_string($idkc));        
    $result = mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
        return false;
    }
    $no=mysql_insert_id();
    //insert detailbrg
    $jmlbrg=count($nmbrg);
    for($i=0;$i<$jmlbrg;$i++){
        list($kat,$bobot)=explode(',',$katbrg[$i]);
        $query="INSERT INTO detailbrg VALUES (NULL,$no,'$nmbrg[$i]','$brtbrg[$i]',$kat)";
        $result = mysql_query($query);
        if (!$result) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
            return false;
        }        
    }
    $query="INSERT INTO historystatus VALUES (NULL,$no,1,NOW(),$idkec,$idkc)";
    $result = mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
        return false;
    }     
    return true;
}
