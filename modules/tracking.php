<?php
function track_getRuteById($id){
    $query="SELECT id,nama FROM rute WHERE id=".$id;
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $hasil = mysql_fetch_assoc($result);
    
    $query="SELECT a.id,a.idkecamatan,a.idkantorcabang,b.nama nmkec,c.nama nmkab FROM rutedetail a, kecamatan b, kabupaten c where a.idkecamatan=b.id and b.idkabupaten=c.id and a.idrute=".$hasil['id'];
    $result=mysql_query($query);
    while($baris = mysql_fetch_assoc($result)){
        if($baris['idkantorcabang']!=NULL){
            $nmkc=kc_getNamaKC($baris['idkantorcabang']);
            $baris['nmkc']=$nmkc;
        }
        $hasil['detail'][]=$baris;
    }
    
    return $hasil; 
}
function track_getRuteByIdPeg($id){
    $query="SELECT * FROM detailpegpengiriman WHERE id=".$id;
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $hasil = mysql_fetch_assoc($result);
    $pos=$hasil['idrutedetail'];
    $hasil2= track_getRuteById($hasil['idrute']);
    $hasil2['pos']=$pos;
    return $hasil2;    
}
function track_cekIdRute($id){
    $query = sprintf("SELECT id FROM rute WHERE id='%s'",
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
function track_getDaftarRute(){
    $query="SELECT id,nama FROM rute ";
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
    foreach($hasil as &$data){           
        $query="SELECT a.idkecamatan,a.idkantorcabang,b.nama nmkec,c.nama nmkab FROM rutedetail a, kecamatan b, kabupaten c where a.idkecamatan=b.id and b.idkabupaten=c.id and a.idrute=".$data['id'];
        $result=mysql_query($query);
        while($baris = mysql_fetch_assoc($result)){
            if($baris['idkantorcabang']!=NULL){
                $nmkc=kc_getNamaKC($baris['idkantorcabang']);
                $baris['nmkc']=$nmkc;
            }        
            $data['detail'][]=$baris;
        }
    }
    
    return $hasil; 
}
function track_getDaftarKab(){
    $query="SELECT id,nama FROM kabupaten";
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

function track_getDaftarKecByKab($id){
    $query="SELECT id,nama FROM kecamatan where idkabupaten=".$id;
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
function track_inputRute($nama,$detail){
    $query = sprintf("insert into rute values(NULL,'%s');",
        mysql_real_escape_string($nama));        
    $result = mysql_query($query);
    if (!$result) {
        return false;
    }
    $no=mysql_insert_id();
    foreach($detail as $tmp){
        list($idkc,$idkec)=explode(',',$tmp);
        if($idkc=='kosong'){
        $query = sprintf("insert into rutedetail values(NULL,'%s','%s',NULL)",
            mysql_real_escape_string($no),
            mysql_real_escape_string($idkec));        
        
        }else{
        $query = sprintf("insert into rutedetail values(NULL,'%s',%s,'%s')",
            mysql_real_escape_string($no),
            mysql_real_escape_string($idkec),
            mysql_real_escape_string($idkc));        
        }
        $result = mysql_query($query);        
    }
    
    return true;
}
function track_calculateDistance($a,$b){
    $query="SELECT lat,lon FROM kecamatan where id=".$a;
    $result = mysql_query($query);
    if (!$result) {
        $message  = 'Queri salah: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $hasil = mysql_fetch_assoc($result);
    $lata=$hasil['lat'];
    $lona=$hasil['lon'];
    
    $query="SELECT lat,lon FROM kecamatan where id=".$b;
    $result = mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $hasil=mysql_fetch_assoc($result);
    $latb=$hasil['lat'];
    $lonb=$hasil['lon'];
    $jaribumi=6371;
    $dlat=deg2rad($latb-$lata);
    $dlon=deg2rad($lonb-$lona);
    $a=sin($dlat/2)*sin($dlat/2)+cos(deg2rad($lata))*cos(deg2rad($latb))*sin($dlon/2)*sin($dlon/2);
    $c=2*atan2(sqrt($a),sqrt(1-$a));
    $d=$jaribumi*$c;
    $hasil=array();
    $hasil['jarak']=round($d,2);
    $hasil['lat1']=$lata;
    $hasil['lon1']=$lona;
    $hasil['lat2']=$latb;
    $hasil['lon2']=$lonb;
    return $hasil;
}

function track_editRute($id,$nama,$detail){
    $query="DELETE FROM rutedetail WHERE idrute=".$id;
    $result = mysql_query($query);
    if (!$result) {
        return false;
    }
    $query = sprintf("UPDATE rute SET nama='%s' WHERE id='%s'",
        mysql_real_escape_string($nama),
        mysql_real_escape_string($id));        
    $result = mysql_query($query);
    if (!$result) {
        return false;
    }        
    foreach($detail as $tmp){
        list($idkc,$idkec)=explode(',',$tmp);
        if($idkc=='kosong'){
        $query = sprintf("insert into rutedetail values(NULL,'%s','%s',NULL)",
            mysql_real_escape_string($id),
            mysql_real_escape_string($idkec));        
        
        }else{
        $query = sprintf("insert into rutedetail values(NULL,'%s',%s,'%s')",
            mysql_real_escape_string($id),
            mysql_real_escape_string($idkec),
            mysql_real_escape_string($idkc));        
        }
        $result = mysql_query($query);        
    }
    return true;    
}
function track_getDetailStatus($id){
    $query="SELECT h.id,h.idtransaksi,h.idstatus, h.tglwaktu, h.idkecamatan, h.idkantorcabang, a.nama nmkec, b.nama nmkab, c.deskripsi FROM historystatus h,kecamatan a, kabupaten b, tblstatus c where h.idkecamatan=a.id and a.idkabupaten=b.id and h.idstatus=c.id and idtransaksi=$id order by h.tglwaktu";
    $result=mysql_query($query);
    $hasil=array();
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    while($row = mysql_fetch_assoc($result)){
        if($row['idkantorcabang']!=NULL){
            $nmkc=kc_getNamaKC($row['idkantorcabang']);
            $row['nmkc']=$nmkc;
        }
        $hasil[]=$row;
    }
    return $hasil; 
}
