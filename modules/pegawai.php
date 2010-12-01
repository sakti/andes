<?php
function pg_cekIdPegawai($id){
    $query = sprintf("SELECT id FROM pegawai WHERE id='%s'",
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
function pg_insertPegawai($id,$nama,$jk,$tgllhr,$jabatan,$notelp,$idkc,$password,$idrutepeg){
    $query = sprintf("INSERT INTO pegawai VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
        mysql_real_escape_string($id),
        mysql_real_escape_string($nama),
        mysql_real_escape_string($jk),
        mysql_real_escape_string($tgllhr),
        mysql_real_escape_string($jabatan),
        mysql_real_escape_string($notelp),
        mysql_real_escape_string($idkc),
        md5(mysql_real_escape_string($password)));        
   $result = mysql_query($query);
    if (!$result) {
        return false;
    }else if($jabatan=='peg. pengiriman'){
        $query = sprintf("INSERT INTO detailpegpengiriman VALUES ('%s', '%s', NULL)",
            mysql_real_escape_string($id),
            mysql_real_escape_string($idrutepeg));     
        $result = mysql_query($query);
        if(!$result) return false;
        return true;
    }else{
        return true;
    }
}
function pg_editPegawai($id,$nama,$jk,$tgllhr,$jabatan,$notelp,$idkc,$password,$idrutepeg){
    if(!empty($password)){
        $query = sprintf("UPDATE pegawai SET nama='%s',jk='%s',tgllahir='%s',jabatan='%s',notelp='%s',idkantorcabang='%s',password='%s'  WHERE id='%s'",
            mysql_real_escape_string($nama),
            mysql_real_escape_string($jk),
            mysql_real_escape_string($tgllhr),
            mysql_real_escape_string($jabatan),
            mysql_real_escape_string($notelp),
            mysql_real_escape_string($idkc),
            md5(mysql_real_escape_string($password)),
            mysql_real_escape_string($id));        
    }else{
        $query = sprintf("UPDATE pegawai SET nama='%s',jk='%s',tgllahir='%s',jabatan='%s',notelp='%s',idkantorcabang='%s' WHERE id='%s'",
            mysql_real_escape_string($nama),
            mysql_real_escape_string($jk),
            mysql_real_escape_string($tgllhr),
            mysql_real_escape_string($jabatan),
            mysql_real_escape_string($notelp),
            mysql_real_escape_string($idkc),
            mysql_real_escape_string($id)); 
    }
   $result = mysql_query($query);
    if (!$result) {
        return false;
    }else if($jabatan=='peg. pengiriman'){
        $query = sprintf("UPDATE detailpegpengiriman SET idrute='%s' WHERE id='%s'",
            mysql_real_escape_string($idrutepeg),
            mysql_real_escape_string($id));     
        $result = mysql_query($query);
        $jml=mysql_affected_rows($GLOBALS["link"]);
        if(!$result) return false;
        if($jml==0){
            $query = sprintf("INSERT INTO detailpegpengiriman values('%s',%s,NULL)",
            mysql_real_escape_string($id),
            mysql_real_escape_string($idrutepeg));
            $result = mysql_query($query);
            if(!$result&&mysql_errno()!=1062) return false;
        }
        return true;
    }else{
        return true;
    }
}
function pg_deletePegawai($id){
    $query = sprintf("DELETE FROM pegawai WHERE id='%s'",
        mysql_real_escape_string($id));        
    $result = mysql_query($query);
    if (!$result) {
        return false;
    }
    return true;
}

function pg_getDaftarPeg(){
    $query="SELECT p.id,p.nama,p.jabatan,p.idkantorcabang, kc.nama nkc FROM pegawai p, kantorcabang kc where p.idkantorcabang=kc.id order by id";
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
function pg_getPegawaiById($id){
    $query="select a.id,a.nama,a.jk,a.tgllahir,a.jabatan,a.notelp,a.idkantorcabang,c.nama nkc from pegawai a, kantorcabang c where a.id='$id' and idkantorcabang=c.id";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $hasil = mysql_fetch_assoc($result);
    if($hasil['jabatan']=='peg. pengiriman'){
        $query="select a.id,a.nama,a.jk,a.tgllahir,a.jabatan,a.notelp,a.idkantorcabang,b.idrute,b.idrutedetail,c.nama nkc from pegawai a natural join detailpegpengiriman b, kantorcabang c where a.id='$id' and idkantorcabang=c.id";
        $result=mysql_query($query);
        if (!$result) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }        
        $hasil = mysql_fetch_assoc($result);
    }
    return $hasil;
}
function pg_ambilPaketKiriman($idpkt,$idpengirim,$idkec,$idkc){
    $query="update transaksi set idpengirim='$idpengirim',idstatus=2,poskc=$idkc where id=$idpkt";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    } 
    $query="insert into historystatus values(NULL,$idpkt,2,'".date('o-m-d H:i:s')."',$idkec,$idkc)";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }               
    $query="insert into historypengirim values(NULL,$idpkt,'".date('o-m-d H:i:s')."',$idpengirim,$idkc)";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    return true;
    
}
function pg_updatePosPegPengiriman($idpeg,$pos){
    $query="select idkecamatan,idkantorcabang from rutedetail where id=$pos";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $p = mysql_fetch_assoc($result);    
    $query="select id from transaksi where idpengirim='$idpeg' and idstatus=2";
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
    $jml=count($hasil);
    for($i=0;$i<$jml;$i++){
        $tmp=($p['idkantorcabang']==NULL)?"NULL":$p['idkantorcabang'];
        $query="insert into historystatus values(NULL,".$hasil[$i]['id'].",2,'".date('o-m-d H:i:s')."',".$p['idkecamatan'].",".$tmp.")";
        $result=mysql_query($query);
        if (!$result) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }
        if($tmp!="NULL"){
            $query="update transaksi set poskc=".$p['idkantorcabang']." where id='".$hasil[$i]['id']."'";
            $result=mysql_query($query);
            if (!$result) {
                $message  = 'Invalid query: ' . mysql_error() . "\n";
                $message .= 'Whole query: ' . $query;
                die($message);
            }          
        }         
    }
    
    $query="update detailpegpengiriman set idrutedetail=$pos where id='$idpeg'";
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    return true;
}
