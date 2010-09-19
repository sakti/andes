<?php

function lp_getTotalPKMinggu($thn,$week){
    $query="SELECT sum(a.biaya) jml,date_format(b.tglwaktu,'%w') hari FROM transaksi a, historystatus b WHERE a.id=b.idtransaksi and b.idstatus=1 and week(b.tglwaktu,5)=$week and date_format(b.tglwaktu,'%Y')=$thn group by  hari order by hari";
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
    //parsing
    $hasil2=array();
    foreach($hasil as $data){
        $hasil2[]=array((int)$data['hari'],(int)$data['jml']);
    }
    sort($hasil2);
    return $hasil2;    
}

function lp_getTotalPKBulan($thn,$bln){
    $query="SELECT sum(a.biaya) jml,date_format(b.tglwaktu,'%e') tgl FROM transaksi a, historystatus b WHERE a.id=b.idtransaksi and b.idstatus=1 and date_format(b.tglwaktu,'%c')=$bln and date_format(b.tglwaktu,'%Y')=$thn group by  tgl order by tgl";
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
    //parsing
    $hasil2=array();
    foreach($hasil as $data){
        $hasil2[]=array((int)$data['tgl'],(int)$data['jml']);
    }
    sort($hasil2);
    return $hasil2;       
}
function lp_getTotalPKTahun($thn){
    $query="SELECT sum(a.biaya) jml,date_format(b.tglwaktu,'%c') bln FROM transaksi a, historystatus b WHERE a.id=b.idtransaksi and b.idstatus=1  and date_format(b.tglwaktu,'%Y')=$thn group by  bln order by bln";
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
    //parsing
    $hasil2=array();
    foreach($hasil as $data){
        $hasil2[]=array((int)$data['bln'],(int)$data['jml']);
    }
    sort($hasil2);
    return $hasil2;     
}
function lp_getLaporan(){
    $hasil=array();
    $hasil['minggu']=lp_getTotalPKMinggu(date('Y'),date('W'));
    $hasil['bulan']=lp_getTotalPKBulan(date('Y'),date('n'));
    $hasil['tahun']=lp_getTotalPKTahun(date('Y'));
    return $hasil;
}
