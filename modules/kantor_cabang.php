<?php
function kc_cekIdKC($id){
    $query = sprintf("SELECT id FROM kantorcabang WHERE id='%s'",
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
function kc_getNamaKC($id){
    $query="SELECT nama FROM kantorcabang where id=".$id;
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    if(mysql_num_rows($result)!=1){
        return false;
    }
    $row = mysql_fetch_assoc($result);
    return $row['nama'];    
}
function kc_getIdKecKC($id){
    $query="SELECT idkecamatan FROM kantorcabang where id=".$id;
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    if(mysql_num_rows($result)!=1){
        return false;
    }
    $row = mysql_fetch_assoc($result);
    return $row['idkecamatan'];    
}
function kc_insertKC($namakc,$idkec,$detalamat,$notelp){
    $query = sprintf("INSERT INTO kantorcabang VALUES (NULL, '%s', '%s', '%s', '%s')",
        mysql_real_escape_string($namakc),
        mysql_real_escape_string($idkec),
        mysql_real_escape_string($detalamat),
        mysql_real_escape_string($notelp));     
    $result = mysql_query($query);
    if (!$result) {
        return false;
    }
    return true;    
}
function kc_getDaftarKC(){
    $query="SELECT a.id,a.nama,a.idkecamatan,b.idkabupaten, a.detalamat,a.notelp,b.nama nmkec, c.nama nmkab FROM kantorcabang a, kecamatan b, kabupaten c where a.idkecamatan=b.id and b.idkabupaten=c.id";
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

function kc_getKantorCabangById($id){
    $query="SELECT a.id,a.nama,a.idkecamatan,b.idkabupaten, a.detalamat,a.notelp,b.nama nmkec, c.nama nmkab FROM kantorcabang a, kecamatan b, kabupaten c where a.idkecamatan=b.id and b.idkabupaten=c.id and a.id=".$id;
    $result=mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    $hasil = mysql_fetch_assoc($result);
    return $hasil;
}
function kc_editKC($id,$nama,$idkec,$detalamat,$notelp){
     $query = sprintf("UPDATE kantorcabang SET nama='%s',idkecamatan='%s',detalamat='%s',notelp='%s' WHERE id='%s'",
        mysql_real_escape_string($nama),
        mysql_real_escape_string($idkec),
        mysql_real_escape_string($detalamat),
        mysql_real_escape_string($notelp),
        mysql_real_escape_string($id));            
    $result = mysql_query($query);
    if (!$result) {
        return false;
    }
    return true;
    
}

function kc_deleteKC($id){
    $query = sprintf("DELETE FROM kantorcabang WHERE id='%s'",
        mysql_real_escape_string($id));        
    $result = mysql_query($query);
    if (!$result) {
        return false;
    }
    return true;
}

