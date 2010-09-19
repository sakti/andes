<?php
session_start();
error_reporting(0);
header('Content-type: text/javascript');
require_once('koneksi.php');
require_once('../modules/pegawai.php');
require_once('../modules/tracking.php');
require_once('../modules/kantor_cabang.php');
require_once('../modules/transaksi.php');
require_once('../modules/keluhan.php');
require_once('../modules/laporan.php');
if(!empty($_REQUEST['op'])){

    switch($_REQUEST['op']){
        case 'getkab':
            $tmp=track_getDaftarKab();
            echo json_encode($tmp);
            break;
        case 'getkec':
            $tmp=track_getDaftarKecByKab($_REQUEST['idkec']);
            echo json_encode($tmp);
            break;    
        case 'cekidtrans':
            if(!empty($_GET['idtrans'])){
                if(trans_cekIdTrans($_GET['idtrans'])){
                    echo "true";
                }else{
                    echo "false";
                }
            }
            break; 
        case 'cekkeltrans':
            if(!empty($_GET['idtrans'])){
                if(kel_cekAdaKel($_GET['idtrans'])){
                    echo "true";
                }else{
                    echo "false";
                }
            }
            break;   
        case 'getallkeltrans':
            $hasil=kel_getAllKel();
            echo json_encode($hasil);
            break;
        case 'getkeltrans':
            if(!empty($_GET['idtrans'])){
                if($hasil=kel_getKeluhan($_GET['idtrans'])){
                    echo json_encode($hasil);
                }else{
                    echo "false";
                }
            }        
            break;
        case 'getkeltransbystat':
            if(!empty($_GET['stat'])){
                if($hasil=kel_getKelByStatus($_GET['stat'])){
                    echo json_encode($hasil);
                }else{
                    echo "false";
                }
            }        
            break;                    
        case 'tambahpesankel':
            if(!empty($_POST['idtrans'])&&!empty($_POST['pesan'])){
                if(kel_tambahKeluhanCustomer(htmlentities($_POST['pesan'], ENT_QUOTES,"UTF-8"),$_POST['idtrans'],$_POST['idpeg'])){
                    echo "true";
                }else{
                    echo "false";
                }
            }        
            break;
        case 'setstatuskel':
            if(!empty($_POST['idtrans'])&&!empty($_POST['status'])){
                if(kel_setStatusKeluhan($_POST['idtrans'],$_POST['status'])){
                    echo "true";
                }else{
                    echo "false";
                }
            }
            break;
        case 'getinfotrans':
            if(!empty($_GET['id'])){
                if($hasil=trans_getTransById($_GET['id'])){
                    echo json_encode($hasil);
                }else{
                    echo 'false';
                }  
            }        
            break;
        case 'getdetailstattrans':
            if(!empty($_GET['id'])){
                if($hasil=track_getDetailStatus($_GET['id'])){
                    echo json_encode($hasil);
                }else{
                    echo 'false';
                }  
            }        
            break;        
            break;
        case 'cekvalidcustomer':
            if(!empty($_GET['idtrans'])&!empty($_GET['nmpengirim'])){
                if(trans_cekValidCustomer($_GET['idtrans'],$_GET['nmpengirim'])){
                    echo "true";
                }else{
                    echo "false";
                }
            }
            break;                  
        case 'cekidpeg':
            if(!empty($_GET['idpeg'])){
                if(pg_cekIdPegawai($_GET['idpeg'])){
                    echo "false";
                }else{
                    echo "true";
                }
            }
            break;
        case 'notcekidpeg':
            if(!empty($_GET['idpeg'])){
                if(pg_cekIdPegawai($_GET['idpeg'])){
                    echo "true";
                }else{
                    echo "false";
                }
            }
            break;
        case 'cekidkc':
            if(!empty($_GET['idkc'])){
                if(kc_cekIdKC($_GET['idkc'])){
                    echo "true";
                }else{
                    echo "false";
                }
            }
            break;   
        case 'cekidrute':
            if(!empty($_GET['idrute'])){
                if(track_cekIdRute($_GET['idrute'])){
                    echo "true";
                }else{
                    echo "false";
                }
            }
            break;                     
        case 'getinfopeg':
            if(!empty($_GET['id'])){
                if($hasil=pg_getPegawaiById($_GET['id'])){
                    echo json_encode($hasil);
                }else{
                    echo 'false';
                }  
            }
            break;
        case 'getinfokc':
            if(!empty($_GET['id'])){
                if($hasil=kc_getKantorCabangById($_GET['id'])){
                    echo json_encode($hasil);
                }else{
                    echo 'false';
                }  
            }
            break;        
        case 'getinforute':
            if(!empty($_GET['id'])){
                if($hasil=track_getRuteById($_GET['id'])){
                    echo json_encode($hasil);
                }else{
                    echo 'false';
                }  
            }
            break;  
            case 'getallpeg':
            if($hasil=pg_getDaftarPeg()){
                echo json_encode($hasil);
            }else{
                echo 'false';
            }                
            break;    
        case 'getallkc':
            if($hasil=kc_getDaftarKC()){
                echo json_encode($hasil);
            }else{
                echo 'false';
            }
            break;    
        case 'getallrute':
            if($hasil=track_getDaftarRute()){
                echo json_encode($hasil);
            }else{
                echo 'false';
            }                  
            break;
    }
    switch($_SESSION['jabatan']){
        case 'administratif':
            switch($_REQUEST['op']){
                case 'inputpeg':
                    $coba=pg_insertPegawai($_POST['idpeg'],$_POST['nmpeg'],$_POST['jk'],$_POST['tgllhr'],$_POST['jabatan'],$_POST['notelp'],$_POST['idkc'],$_POST['password'],$_POST['idrutepeg']);
                    if($coba){
                        echo '{"berhasil":true,"nama":"'.$_POST['nmpeg'].'"}';
                    }else{
                        echo '{"berhasil":false}';
                    }
                    break;         
                case 'editpeg':
                    $coba=pg_editPegawai($_POST['eidpeg'],$_POST['enmpeg'],$_POST['ejk'],$_POST['etgllhr'],$_POST['ejabatan'],$_POST['enotelp'],$_POST['eidkc'],$_POST['epassword'],$_POST['eidrutepeg']);
                    if($coba){
                        echo '{"berhasil":true,"nama":"'.$_POST['enmpeg'].'"}';
                    }else{
                        echo '{"berhasil":false}';
                    }                    
                    break;   
                case 'deletepeg':
                    $coba=pg_deletePegawai($_GET['didpeg']);
                    if($coba){
                        echo '{"berhasil":true,"id":"'.$_GET['didpeg'].'"}';
                    }else{
                        echo '{"berhasil":false}';
                    }
                    break;
                case 'inputkc':
                    $coba=kc_insertKC($_POST['namakc'],$_POST['idkec'],$_POST['detalamatkc'],$_POST['notelpkc']);
                    if($coba){
                        echo '{"berhasil":true,"nama":"'.$_POST['namakc'].'"}';
                    }else{
                        echo '{"berhasil":false}';
                    }                
                    break;
                case 'editkc':
                    $coba=kc_editKC($_POST['editidkc'],$_POST['enamakc'],$_POST['eidkec'],$_POST['edetalamatkc'],$_POST['enotelpkc']);
                    if($coba){
                        echo '{"berhasil":true,"nama":"'.$_POST['enamakc'].'"}';
                    }else{
                        echo '{"berhasil":false}';
                    }                
                    break;
                case 'deletekc':
                    $coba=kc_deleteKC($_GET['didkc']);
                    if($coba){
                        echo '{"berhasil":true,"id":"'.$_GET['didkc'].'"}';
                    }else{
                        echo '{"berhasil":false}';
                    }                
                    break;
                case 'inputrute':
                    $coba=track_inputRute($_POST['nmrute'],$_POST['detrute']);
                    if($coba){
                        echo '{"berhasil":true,"nama":"'.$_POST['nmrute'].'"}';
                    }else{
                        echo '{"berhasil":false}';
                    }               
                    break;                    
                case 'editrute':
                    $coba=track_editRute($_POST['eidrute'],$_POST['enmrute'],$_POST['edetrute']);
                    if($coba){
                        echo '{"berhasil":true,"nama":"'.$_POST['enmrute'].'"}';
                    }else{
                        echo '{"berhasil":false}';
                    }                
                    break;
                case 'getpkminggu':
                    if(!empty($_GET['thn'])&&!empty($_GET['week'])){
                        if($hasil=lp_getTotalPKMinggu($_GET['thn'],$_GET['week'])){
                            echo json_encode($hasil);
                        }else{
                            echo 'false';
                        }  
                    }                
                    break;
                case 'getpkbulan':
                    if(!empty($_GET['thn'])&&!empty($_GET['bulan'])){
                        if($hasil=lp_getTotalPKBulan($_GET['thn'],$_GET['bulan'])){
                            echo json_encode($hasil);
                        }else{
                            echo 'false';
                        }
                    }                
                    break;                    
                case 'getpktahun':
                    if(!empty($_GET['thn'])){
                        if($hasil=lp_getTotalPKTahun($_GET['thn'])){
                            echo json_encode($hasil);
                        }else{
                            echo 'false';
                        }  
                    }                
                    break; 
                case 'getlaporan':
                    $hasil=lp_getLaporan();
                    echo json_encode($hasil);
                    break;                                       
            }
            break;
        case 'customer service':
            switch($_REQUEST['op']){
                case 'x':  
                    echo 'x';
                    break;    
                case 'getallkat':
                    if($hasil=trans_getAllKat()){
                        echo json_encode($hasil);
                    }else{
                        echo 'false';
                    }                  
                    break; 
                case 'calculatedistance':
                    if(!empty($_GET['a'])&&!empty($_GET['b'])){
                        $hasil=track_calculateDistance($_GET['a'],$_GET['b']);
                        echo json_encode($hasil);
                    }
                    break;
                case 'gettransbykc':
                    if(!empty($_GET['idkc'])){
                        if($hasil=trans_getDaftarTransByKC($_GET['idkc'])){
                            echo json_encode($hasil);
                        }else{
                            echo 'false';
                        }
                    }                            
                    break;                     
                case 'inputtrans':
                    if(!empty($_GET['nmpengirim'])){
                        //cek biaya
                        $hasil=trans_calculateBiaya($_GET['kec_pengirim'],$_GET['kec_penerima'],$_GET['brtbrg'],$_GET['nilaibrg'],$_GET['katbrg'],$_GET['kilat'],$_GET['asuransi']);
                        echo json_encode($hasil);
                    }else if(!empty($_POST['nmpengirim'])){
                        //insert trans
                        //$coba=trans_insertTransaksi($_POST['nmpengirim'],$_POST['notelppengirim'],$_POST['kec_pengirim'],$_POST['det_alamat_pengirim'],$_POST['nmpenerima'],$_POST['notelppenerima'],$_POST['kec_penerima'],$_POST['det_alamat_penerima'],$_POST['nmbrg'],$_POST['brtbrg'],$_POST['nilaibrg'],$_POST['katbrg'],$_POST['tglkirim'],$_POST['waktukirim'],$_POST['asuransi'],$_POST['kilat'],$_POST['biaya'],$_POST['idcs'],$_POST['idkec'],$_POST['idkc']);
                        $coba=trans_insertTransaksi($_POST['nmpengirim'],$_POST['notelppengirim'],$_POST['kec_pengirim'],$_POST['det_alamat_pengirim'],$_POST['nmpenerima'],$_POST['notelppenerima'],$_POST['kec_penerima'],$_POST['det_alamat_penerima'],$_POST['nmbrg'],$_POST['brtbrg'],$_POST['nilaibrg'],$_POST['katbrg'],$_POST['asuransi'],$_POST['kilat'],$_POST['biaya'],$_POST['idcs'],$_POST['idkec'],$_POST['idkc']);
                        if($coba){
                            echo '{"berhasil":true,"nama":"'.$_POST['nmpengirim'].'"}';
                        }else{
                            echo '{"berhasil":false}';
                        }                           
                    }
                    break;                        
            }
            break;
    }
}else{
    print_r($_SESSION);
}

