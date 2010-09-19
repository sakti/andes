<?php
function kel_cekAdaKel($idtrans){
    $query = sprintf("SELECT id FROM keluhantransaksi WHERE idtransaksi='%s'",
        mysql_real_escape_string($idtrans));        
    $result = mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    if(mysql_num_rows($result)!=1){
        return false;
    }else{
        $hasil = mysql_fetch_assoc($result);
        return $hasil['id'];
    }
}
function kel_tambahKel($id,$pesan){
    $query="insert into keluhantransaksi values(NULL,$id,NULL,'$pesan','open')";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
        return false;
    }        
    $no=mysql_insert_id();
    return $no;
}
function kel_tambahKeluhanCustomer($pesan,$idtrans,$idpeg){
    $ok=true;
    $id=kel_cekAdaKel($idtrans);
    if($id){
        $ok=kel_responKeluhan($id,$pesan,$idpeg);
    }else{
        $ok=kel_tambahKel($idtrans,$pesan);
    }
    return $ok;
}
function kel_responKeluhan($idkel,$pesan,$idpeg){
    //jika $idpeg null maka yang merespon consumer
    if(!$idpeg) $idpeg='NULL';
    $query="insert into responkeluhan values(NULL,$idkel,$idpeg,NULL,'$pesan')";
    $result=mysql_query($query);    
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
        return false;
    }    
    $no=mysql_insert_id();
    return $no;
}
function kel_getKeluhan($idtrans){
    $hasil=kel_getKelByIdTrans($idtrans);
    if($hasil){
        $hasil['respon']=kel_getResponKelByIdKel($hasil['id']);
    }
    return $hasil;
}
function kel_getKelByIdTrans($idtrans){
    $query="select * from keluhantransaksi where idtransaksi=$idtrans";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $hasil = mysql_fetch_assoc($result);    
    
    return $hasil;
}
function kel_getResponKelByIdKel($idkel){
    $query="SELECT * FROM responkeluhan where idkeluhan=".$idkel;
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
function kel_getKelByStatus($status){
    //status closed atau open
    $query="select * from keluhantransaksi where stat='$status'";
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
function kel_getAllKel(){
    $query="select * from keluhantransaksi";
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
function kel_setStatusKeluhan($idtrans,$status){
    $query="update keluhantransaksi set stat='$status' where idtransaksi=$idtrans";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
        return false;
    }    
    return true;

}
