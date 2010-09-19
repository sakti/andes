<!DOCTYPE html>
<html>
<head>
    <title>andes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" href="css/south-street/jquery-ui-1.8.1.custom.css" rel="stylesheet" />
    <link type="text/css" href="css/main.css" rel="stylesheet" />
    <style type="text/css">

    </style>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <a href="/index.php"><img src="images/logo.png"/></a>
            <p><strong>An</strong>dromeda <strong>De</strong>livery <strong>S</strong>ystem</p>
        </div>
        <div id="content">
            <div id="tabs">
	            <ul>
		            <li><a href="#welcome">Selamat Datang</a></li>
		            <li><a href="#cekstatus">Cek status Pengiriman</a></li>
		            <li><a href="#keluhan">Laporan keluhan</a></li>
		            <li><a href="#faq">FAQ</a></li>
		            <li><a href="#tentang">Tentang</a></li>
	            </ul>
	            <div id="welcome">
		            <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
	            </div>
                <div id="cekstatus">
		            <p> sadfasdf as stat us Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
		            <form id="frmcekbarang" class="def_form" action="cek_info_kirim.php" action="post">
                        <div class="error">

                        </div>		            
		                <fieldset>
		                <legend>info pengiriman anda</legend>
		                <label for="idtranscek">No Pengiriman</label><input type="text" name="idtrans" id="idtranscek" size="20" maxlength="20">
		                <label for="nmpengirimcek">Nama Pengirim</label><input type="text" name="nmpengirim" id="nmpengirimcek" size="35" maxlength="35">           
		                </fieldset>
                        <input type="submit" class="tombol" name="kirim" value="Proses" />
                        <input type="reset" class="tombol" name="hapus" value="Hapus" />
		            </form>		
		            <form id="info" class="def_form">   
		            <h3>Informasi Pengiriman</h3>		            
                    <table id="infokiriman" class="tabel">
                        <tbody>
                            <tr><td>ID/No Pengiriman</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Nama Pengirim</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Alamat Pengirim</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Notelp Pengirim</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Nama Penerima</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Alamat Penerima</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Notelp Penerima</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Asuransi</td><td>Sakti Dwi Cahyono</td></tr>                            
                            <tr><td>Kilat</td><td>Sakti Dwi Cahyono</td></tr>                            
                            <tr><td>Status</td><td>Sakti Dwi Cahyono</td></tr>                            
                            <tr><td>Biaya</td><td>Sakti Dwi Cahyono</td></tr>                            
                        </tbody>
                    </table>		                     
                    <h3>Detail Status Pengiriman</h3>
                    <table id="detailstatuskiriman" class="tabel">
                        <thead>
                            <tr><th>Tanggal Waktu</th><th>Status</th><th>Posisi</th></tr>
                        <thead>                    
                        <tbody>
                            <tr><td>ID/No Pengiriman</td><td>Sakti Dwi Cahyono</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Nama Pengirim</td><td>Sakti Dwi Cahyono</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Alamat Pengirim</td><td>Sakti Dwi Cahyono</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Notelp Pengirim</td><td>Sakti Dwi Cahyono</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Nama Penerima</td><td>Sakti Dwi Cahyono</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Alamat Penerima</td><td>Sakti Dwi Cahyono</td><td>Sakti Dwi Cahyono</td></tr>                           
                        </tbody>
                    </table>                    
                    <input type="button" id="refreshstatus" value="Refresh" /> <input type="button" id="kmblcekkiriman" value="Kembali" />
                    </form>
	            </div>
                <div id="keluhan">
		            <p> keluhane sdfad Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
		            <form id="frmcekkeluhan" class="def_form" action="post">
                        <div class="error">

                        </div>			                
		                <fieldset>
		                <legend>info pengiriman anda</legend>
		                <label for="idtranskel">No Pengiriman</label><input type="text" name="idtrans" id="idtranskel" size="20" maxlength="20">
		                <label for="nmpengirimkel">Nama Pengirim</label><input type="text" name="nmpengirim" id="nmpengirimkel" size="35" maxlength="35">           
		                </fieldset>
                        <input type="submit" class="tombol" name="kirim" value="Proses" />
                        <input type="reset" class="tombol" name="hapus" value="Hapus" />
		            </form>
		            <form id="infokeluhan" class="def_form">   
		            <h3>Informasi Pengiriman</h3>		            
                    <table id="infokirimankel" class="tabel">
                        <tbody>
                            <tr><td>ID/No Pengiriman</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Nama Pengirim</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Alamat Pengirim</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Notelp Pengirim</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Nama Penerima</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Alamat Penerima</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Notelp Penerima</td><td>Sakti Dwi Cahyono</td></tr>
                            <tr><td>Asuransi</td><td>Sakti Dwi Cahyono</td></tr>                            
                            <tr><td>Kilat</td><td>Sakti Dwi Cahyono</td></tr>                            
                            <tr><td>Status</td><td>Sakti Dwi Cahyono</td></tr>                            
                            <tr><td>Biaya</td><td>Sakti Dwi Cahyono</td></tr>                            
                        </tbody>
                    </table>		                     
                    <h3>Keluhan</h3>             
                    <div id="daftarkeluhan">
                        <p class="first"><span class="tgl">2010-05-14 03:28:01</span> <span class="anda">Anda</span>
                        <span class="open">open</span>
                        <span class="closed">closed</span>
                        <br/><br/>
                        <strong>Blm ada keluhan</strong>
                        et facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellen</p>
                        <p><span class="tgl">2010-05-16 04:32:21</span> <span class="ptgs">Petugas</span> <br/><br/>os, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libe</p>
                        <p><span class="tgl">2010-06-14 09:31:14</span> <span class="anda">Anda</span> <br/><br/>ante, blandit et, ultrices a, suscipit eget, quam. Integer
		                ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
		                amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
		                odio. Curabitur malesuada. V</p>
                    </div>
                    <fieldset id="paneltambahkel">      
                        <label for="isikeluhan">Isi Keluhan anda</label>
                        <textarea name="isikeluhan" id="isikeluhan" style="width:100%;max-width:650px">
                        </textarea>
                        <hr/>
                        <input type="button" id="tambahkel" value="Tambahkan info keluhan" /><input type="button" id="keluarkeluhan" value="Keluar" />
                    </fieldset>
                    </form>		            
	            </div>	            	            
	            <div id="faq">
		            <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
	            </div>
	            <div id="tentang">
		            <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
		            <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
	            </div>
            </div>    
            <div id="panel">        
                <div id="stat">
	                <h3><a href="#">Status Pengiriman</a></h3>
	                <div>
		                <p>
		                Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
		                ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
		                amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
		                odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
		                </p>
	                </div>
	                <h3><a href="#">Status Keluhan</a></h3>
	                <div>
		                <p>
		                Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
		                Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
		                ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
                        </p>
	                </div>	                
                </div>
                <div id="news" class="ui-widget ui-widget-content ui-corner-all">
                    <h1 class="ui-state-default ui-corner-all">Berita Terbaru</h1>
                    <div id="listnews">
                        <ul>
                            <li><span class="tgl">09 Mei 2010</span> dit et, ultrices a, suscipit eget, quam. Integer
		                    ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
		                    amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
		                    odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.</li>
                            <li><span class="tgl">09 Mei 2010</span> asjdfh ajsdk hfakjsd hfakjdhf akjdhfa
                            dit et, ultrices a, suscipit eget, quam. Intege
                            ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
		                    amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
		                    odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.fakjsdfcjasdhfjksadf
		                    </li>
                            <li><span class="tgl">09 Mei 2010</span> jubusdfa dfsna naruto nfadsf alkjasd fsdlkjsdf sdkflsajdfalsk;dfj dsaf sdfkj alsdfj asdf sd fasdf as fasdfadsfasdf dsfnte scelerisque vulputate.fakjsdf dfasdfaf df asdfcjasdhfjksadf
		                    </li>	
                            <li><span class="tgl">09 Mei 2010</span> ahala h dalah dslf jlkasdf lsdkfj asdf fads f risque vulputate.fakjsdfcjasdhfjksadf
		                    </li>		                    	                    
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer" class="ui-corner-all">
            Under development &copy; 2010
        </div>
        <div id="dlginf" title="Informasi">
	        <p>Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla .</p>
        </div>        
        
    </div>
</body>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.1.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.bgiframe-2.1.1.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
	$(function() {
	    var dlginf=$('#dlginf'),frmcekbarang=$('#frmcekbarang'),frmcekkeluhan=$('#frmcekkeluhan'),
	        idtranscek=$('#idtranscek'),nmpengirimcek=$('#nmpengirimcek'),idtranskel=$('#idtranskel'),
	        nmpengirimkel=$('#nmpengirimkel'),info=$('#info'),btnrefreshstat=$('#refreshstatus'),btnkmblcek=$('#kmblcekkiriman'),
	        infokeluhan=$('#infokeluhan'),btntambahkel=$('#tambahkel'),isikeluhan=$('#isikeluhan'),daftarkeluhan=$('#daftarkeluhan'),
	        keluarkeluhan=$('#keluarkeluhan');
	    function nl2br(kata){
	        return kata.replace(/\n/g,'<br>');
	    }
	    keluarkeluhan.click(function(){
	        nmpengirimkel.val('');
	        idtranskel.val('');
	        infokeluhan.slideUp('slow');
	        frmcekkeluhan.slideDown('slow');
	    });
	    function updateListKeluhan(){
            $.ajax({
                url:'lib/ajax.php?op=getkeltrans&idtrans='+idtranskel.val(),
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                    daftarkeluhan.children().remove();
                    var status='';
                    if(data==false){
                        $('<p class="first"><strong>Keluhan belum ada</strong></p>').appendTo(daftarkeluhan);      
                    }else{
                        if(data.stat=='open'){
                            status='<span class="open">open</span>';
                        }else{
                            status='<span class="closed">closed</span>';
                        }
                        $('<p class="first"><span class="tgl">'+data.tglwaktu+'</span>'+
                        '<span class="anda">Anda</span>'+status+
                        '<br><br>'+nl2br(data.deskripsi)+'</p>').appendTo(daftarkeluhan);                                                
                    }
                    for(var i=0;i<data.respon.length;i++){
                        var asal='';
                        if(data.respon[i].idpegawai==null){
                            asal='<span class="anda">Anda</span>';
                        }else{
                            asal='<span class="ptgs">Petugas</span>';
                        }
                        $('<p><span class="tgl">'+data.respon[i].tglwaktu+'</span>'+asal+'<br><br>'+
                        nl2br(data.respon[i].deskripsi)+'</p>').appendTo(daftarkeluhan);
                    }                    
                },
                error:function(e){                   
                    updateInf('Terjadi kesalahan koneksi',false);
                }
            });	    	    
	    }    
        btntambahkel.click(function(){
            if(isikeluhan.val().trim()==''){
                updateInf('Isikan pesan anda terlebih dahulu');
                return;
            }
            $.ajax({
                url:'lib/ajax.php',
                type:'POST',
                timeout:10000,
                dataType: 'json',
                data:'op=tambahpesankel&idtrans='+idtranskel.val()+'&pesan='+isikeluhan.val().trim(),
                success:function(data){
                    if(data){
                        updateInf("Pesan keluhan berhasil ditambahkan");
                        updateListKeluhan();
                        isikeluhan.val('');
                    }else{
                        updateInf("Penambahan pesan keluhan gagal");
                    }
                },
                error:function(e){                    
                    updateInf('Terjadi kesalahan koneksi',false);
                }
            });            
        });
		info.hide();	 
		infokeluhan.hide(); 
		dlginf.dialog({
		    autoOpen: false,
			modal: true,
			show: 'clip',
			hide: 'clip',
			resizable: false,
			buttons: {
			    Ok:function(){
			        $(this).dialog('close');
			    }
			}
		});
		btnrefreshstat.click(function(){
		    updatedetailinfokiriman(idtranscek.val());
		    updateInf('Berhasil diupdate');
		});
		btnkmblcek.click(function(){
		    info.slideUp(4000);
		    frmcekbarang.slideDown(4000);
		});
		function updateinfokirimankel(id){
            $.ajax({
                url:'../../lib/ajax.php?op=getinfotrans&id='+id,
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                    var nilai=[],i=0;
                    nilai[0]=data.id;
                    nilai[1]=data.namapengirim;
                    nilai[2]=data.kabpengirim+', '+data.kecpengirim+', '+data.detalamatpengirim;
                    nilai[3]=data.notelppengirim;
                    nilai[4]=data.namapenerima;
                    nilai[5]=data.kabpenerima+', '+data.kecpenerima+', '+data.detalamatpenerima;
                    nilai[6]=data.notelppenerima;
                    nilai[7]=(data.asuransi=='y')?'Ya':'Tidak';
                    nilai[8]=(data.kilat=='y')?'Ya':'Tidak';
                    nilai[9]=data.deskripsi;
                    nilai[10]=data.biaya;
                    $('#infokirimankel tr').each(function(){
                        $(this).children().last().text(nilai[i++]);
                    });
                    
                },
                error:function(e){                   
                    updateInf('Terjadi kesalahan koneksi',false);
                }
            });		
		}		
		function updatedetailinfokiriman(id){
            $.ajax({
                url:'../../lib/ajax.php?op=getdetailstattrans&id='+id,
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                    var tbhtbl=$('#detailstatuskiriman tbody');
                    tbhtbl.children().remove();            
                    for(var i=0;i<data.length;i++){

                        $('<tr><td>'+data[i].tglwaktu+'</td><td>'+data[i].deskripsi+'</td><td>'+data[i].nmkab+'-'+data[i].nmkec+' '+((data[i].nmkc)?'('+data[i].nmkc+')':'')+'</td></tr>').appendTo(tbhtbl);
                    }
                    $('tbody tr:odd').css('background-color','#c0f090');
                },
                error:function(e){                   
                    updateInf('Terjadi kesalahan koneksi',false);
                }
            });		
		}
		
		function updateInf($text){
		    dlginf.children().remove();
		    $('<p>'+$text+'</p>').appendTo(dlginf);
		    dlginf.dialog('open');
		}  
		
		$("#tabs").tabs();
		$("#stat").accordion();
		
		var daftarberita=$('#listnews ul li'),i=0;
		daftarberita.hide();
		daftarberita.eq(1).show();
		function tampilBerita(){
		    $(daftarberita[i]).fadeOut(0);
		    i++;
		    if(i==daftarberita.length) i=0;
		    $(daftarberita[i]).fadeIn(1000);
		}
		setInterval(tampilBerita,3000);
		
		frmcekbarang.validate({
		    errorLabelContainer: $("#frmcekbarang .error"),
	        rules:{
	            idtrans:{
	                required:true,
	                remote:'lib/ajax.php?op=cekidtrans'
	            },
	            nmpengirim:"required",
	            },
	        messages:{
			    idtrans: {
			        required:"Masukkan no pengiriman anda",
			        remote:"no pengiriman tidak ditemukan"
			    },
	            nmpengirim: "Isikan nama anda",
	        },
            submitHandler: function() { 
                $.ajax({
                    url:'../../lib/ajax.php?op=cekvalidcustomer&idtrans='+idtranscek.val()+'&nmpengirim='+nmpengirimcek.val(),
                    type:'GET',
                    timeout:10000,
                    dataType: 'json',
                    success:function(data){
                        if(data){
                            updateinfokiriman(idtranscek.val());
                            updatedetailinfokiriman(idtranscek.val());
                            updateInf("oke, data berhasil didapatkan");
                            info.fadeIn('slow');
                            frmcekbarang.slideUp('slow');
                        }else{
                            updateInf("Nama Pengirim tidak cocok");
                        }
                        
                    },
                    error:function(e){                   
                        updateInf('Terjadi kesalahan koneksi',false);
                    }
                });                
            }	
	        	    
	    });		
		frmcekkeluhan.validate({
		    errorLabelContainer: $("#frmcekkeluhan .error"),
	        rules:{
	            idtrans:{
	                required:true,
	                remote:'lib/ajax.php?op=cekidtrans'
	            },
	            nmpengirim:"required",
	            },
	        messages:{
			    idtrans: {
			        required:"Masukkan no pengiriman anda",
			        remote:"no pengiriman tidak ditemukan"
			    },
	            nmpengirim: "Isikan nama anda",
	        },
            submitHandler: function() { 
                $.ajax({
                    url:'lib/ajax.php?op=cekvalidcustomer&idtrans='+idtranskel.val()+'&nmpengirim='+nmpengirimkel.val(),
                    type:'GET',
                    timeout:10000,
                    dataType: 'json',
                    success:function(data){
                        if(data){
                            updateinfokirimankel(idtranskel.val());
                            updateInf("oke, data berhasil ditemukan");
                            infokeluhan.slideDown('slow');
                            frmcekkeluhan.slideUp('slow');
                            updateListKeluhan();
                        }else{
                            updateInf("Nama Pengirim tidak cocok");
                        }                       
                    },
                    error:function(e){                   
                        updateInf('Terjadi kesalahan koneksi',false);
                    }
                }); 
            }		    
	    });		
	    $('tbody tr:odd').css('background-color','#c0f090');
		$('tbody tr:even').css('background-color','#f8f8f8'); 
	});
</script>
</html>
