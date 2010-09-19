	$(function() {
	    var pnlInputDataPeg=$('#inputdatapeg'),pnlLihatDataPeg=$('#lihatdatapeg'),pnlEditDataPeg=$('#editdatapeg'),
	        pnlDeleteDataPeg=$('#deletedatapeg'),pnlInfo=$('#panelinfo'),dlghpspeg=$('#dialoghpspeg'),ftgllhr=$('#tgllhr'),fpassword=$('#password'),
	        pnlInputDataKC=$('#inputdatakc'),pnlEditDataKC=$('#editdatakc'),pnlLihatDataKC=$('#lihatdatakc'),pnlDeleteDataKC=$('#deletedatakc'),
	        pnlInputDataRute=$('#inputdatarute'),pnlLihatDataRute=$('#lihatdatarute'),pnlEditDataRute=$('#editdatarute'),
	        dlghpskc=$('#dialoghpskc'),dlgtbhrute=$('#dialogtbhrute'),dlgetbhrute=$('#dialogetbhrute'),
	        iduser=$('#iduser').text();
/********************
koding untuk Laporan PK

******************/	  
        function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css( {
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 5,
                border: '1px solid #16a61f',
                padding: '5px',
                'font-size':'13pt',
                'font-weight':'bold',
                'background-color': '#dfebb0',
                opacity: 0.50
            }).appendTo("body").fadeIn(200);
        }
        $('#tablaporan').click(function(){
            updateInfo('Laporan');
            setTimeout(buatLaporan,2000);
        });
        
        function buatLaporan(){
            $.ajax({
                url:'../../lib/ajax.php?op=getlaporan',
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                   $.plot($('#graphminggu'), [ data.minggu ], {
                        xaxis:{
                            ticks:[[0,"Minggu"],[1,"Senin"],[2,"Selasa"],[3,"Rabu"],[4,"Kamis"],[5,"Jum'at"],[6,"Sabtu"]],
                        },
                        grid: {
                            backgroundColor: { colors: ["#f8f8f8", "#ededed"] },
                            hoverable: true, clickable: true 
                        },
                        points: { show: true },
                        lines: { show: true }
                      });
                    var previousPoint = null; 
                    $('#graphminggu').bind("plothover", function (event, pos, item) {  
                        if (item) {           
                        if (previousPoint != item.datapoint) {
                                previousPoint = item.datapoint;                              
                                $("#tooltip").remove();
                                var y = item.datapoint[1].toFixed(2);
                                showTooltip(item.pageX, item.pageY,"Rp. " + y);
                            }
                        }else{
                            $("#tooltip").remove();
                            previousPoint = null;                 
                        }
                    }); 
                    
                    $.plot($('#graphbulan'), [ data.bulan ],  
                      { 
                        points: { show: true },
                        hoverable:true,
                        lines: { show: true },
                        grid: {
                            backgroundColor: { colors: ["#f8f8f8", "#ededed"] },
                            hoverable: true, clickable: true 
                        }                
                      });
                    var ppbln = null; 
                    $('#graphbulan').bind("plothover", function (event, pos, item) {  
                        if (item) {           
                        if (ppbln != item.datapoint) {
                                ppbln = item.datapoint;                              
                                $("#tooltip").remove();
                                var y = item.datapoint[1].toFixed(2);
                                showTooltip(item.pageX, item.pageY,"Rp. " + y);
                            }
                        }else{
                            $("#tooltip").remove();
                            ppbln = null;                 
                        }
                    });              
                    $.plot($('#graphtahun'), [ data.tahun ], { 
                        xaxis:{
                            ticks:[[1,"Januari"],[2,"Februari"],[3,"Maret"],[4,"April"],[5,"Mei"],[6,"Juni"],[7,"Juli"],[8,"Agustus"],[9,"September"],[10,"Oktober"],[11,"November"],[12,"Desember"]],
                        },
                        grid: {
                            backgroundColor: { colors: ["#f8f8f8", "#ededed"] },
                            hoverable: true, clickable: true 
                        },
                        points: { show: true },
                        hoverable:true,
                        lines: { show: true }
                      });
                    var ppthn = null; 
                    $('#graphtahun').bind("plothover", function (event, pos, item) {  
                        if (item) {           
                        if (ppthn != item.datapoint) {
                                ppthn = item.datapoint;                              
                                $("#tooltip").remove();
                                var y = item.datapoint[1].toFixed(2);
                                showTooltip(item.pageX, item.pageY,"Rp. " + y);
                            }
                        }else{
                            $("#tooltip").remove();
                            ppthn = null;                 
                        }
                    });                                              							                    
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });                         
        }
/********
akhir kode laporan pk
****/
	        
/********************
koding untuk man. keluhan

******************/	  
        var infokeluhan=$('#infokeluhan'),btntambahkel=$('#tambahkel'),isikeluhan=$('#isikeluhan'),daftarkeluhan=$('#daftarkeluhan'),
	        keluarkeluhan=$('#keluarkeluhan'),tmpidtran=0,btnstatkel=$('#statkel');
	        
	    btnstatkel.click(function(){
	        if(btnstatkel.attr('checked')){
                $.ajax({
                    url:'../../lib/ajax.php',
                    type:'POST',
                    timeout:10000,
                    dataType: 'json',
                    data:'op=setstatuskel&idtrans='+tmpidtran+'&status=closed',
                    success:function(data){
                        if(data){
                            updateInfo('Status keluhan telah diganti',false);
                        }else{
                            updateInfo('Update status keluhan gagal!',false);
                        }
                        $('body').scrollTop(0);
                        $('html').scrollTop(0);  
                        updateListKeluhan(tmpidtran);
                        $('#tabkeluhan').click();
                    },
                    error:function(e){                    
                        updateInfo('Terjadi kesalahan koneksi',false);
                    }
                });	            
	        }else{
                $.ajax({
                    url:'../../lib/ajax.php',
                    type:'POST',
                    timeout:10000,
                    dataType: 'json',
                    data:'op=setstatuskel&idtrans='+tmpidtran+'&status=open',
                    success:function(data){
                        if(data){
                            updateInfo('Status keluhan telah diganti',false);
                        }else{
                            updateInfo('Update status keluhan gagal!',false);
                        }
                        $('body').scrollTop(0);
                        $('html').scrollTop(0);  
                        updateListKeluhan(tmpidtran);
                        $('#tabkeluhan').click();
                    },
                    error:function(e){                    
                        updateInfo('Terjadi kesalahan koneksi',false);
                    }
                });
	        }
	    });   
        $('#tabkeluhan').click(function(){
            //alert('dipanggil');
            updateInfo("Refresh Data");
            $.ajax({
                url:'../../lib/ajax.php?op=getallkeltrans',
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                    var bodyopen=$('#headkelopen tbody'),bodyclosed=$('#headkelclosed tbody');
                    bodyopen.children().remove();
                    bodyclosed.children().remove();
                    for(i=0;i<data.length;i++){
                        if(data[i].stat=='open'){
                            $('<tr><td>'+data[i].idtransaksi+'</td><td>'+data[i].tglwaktu+'</td><td>'+data[i].deskripsi+'</td><td><a href="'+data[i].idtransaksi+'">Respon</a></td></tr>').appendTo(bodyopen);
                        }else{
                            $('<tr><td>'+data[i].idtransaksi+'</td><td>'+data[i].tglwaktu+'</td><td>'+data[i].deskripsi+'</td><td><a href="'+data[i].idtransaksi+'">Respon</a></td></tr>').appendTo(bodyclosed);
                        }
                    }
                    $('tbody tr:odd').css('background-color','#c0f090');
		            $('tbody tr:even').css('background-color','#f8f8f8');
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });            
        });
        $('#headkelopen a').live('click',function(e){
            updateInfo('Respon keluhan id ' + $(e.target).attr('href'));
            updateinfokirimankel($(e.target).attr('href'));
            updateListKeluhan($(e.target).attr('href'));
            tmpidtran=$(e.target).attr('href');
            return false;
        });
        $('#headkelclosed a').live('click',function(e){
            updateInfo('Respon keluhan id ' + $(e.target).attr('href'));
            updateinfokirimankel($(e.target).attr('href'));
            updateListKeluhan($(e.target).attr('href'));
            tmpidtran=$(e.target).attr('href');
            return false;
        });
	    function nl2br(kata){
	        return kata.replace(/\n/g,'<br>');
	    }
	    keluarkeluhan.click(function(){
	        infokeluhan.slideUp('slow');
	    });
	    function updateListKeluhan(id){
            $.ajax({
                url:'../../lib/ajax.php?op=getkeltrans&idtrans='+id,
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
                            btnstatkel.removeAttr('checked');
                        }else{
                            btnstatkel.attr('checked','checked');
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
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	    	    
	    }    
        btntambahkel.click(function(){
            if(isikeluhan.val().trim()==''){
                $('body').scrollTop(0);
                $('html').scrollTop(0);            
                updateInfo('Isikan pesan anda terlebih dahulu',false);
                return;
            }
            $.ajax({
                url:'../../lib/ajax.php',
                type:'POST',
                timeout:10000,
                dataType: 'json',
                data:'op=tambahpesankel&idtrans='+tmpidtran+'&pesan='+isikeluhan.val().trim()+'&idpeg='+iduser,
                success:function(data){
                    if(data){
                        updateInfo("Pesan keluhan berhasil ditambahkan");
                        updateListKeluhan(tmpidtran);
                        isikeluhan.val('');
                    }else{
                        updateInfo("Penambahan pesan keluhan gagal");
                    }
                },
                error:function(e){                    
                    updateInf('Terjadi kesalahan koneksi',false);
                }
            });            
        });	 
		infokeluhan.hide(); 
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
                    infokeluhan.slideDown('slow');
                },
                error:function(e){                   
                    updateInf('Terjadi kesalahan koneksi',false);
                }
            });		
		}				    
	            
/********
akhir kode man.keluhan
****/   
		dlgetbhrute.dialog({
		    autoOpen: false,
		    height: 350,
		    width: 300,
		    modal: true,
		    buttons: {
			    Tambahkan: function() {
			            var info='',nilai='';
			            if($('#eidkcrute').val()=='kosong'){
                            info=$('#eidkabrute :selected').text()+', '+$('#eidkecrute :selected').text();
                            nilai=$('#eidkcrute').val()+','+$('#eidkecrute').val();
			            }else{
			                info='Kantor Cabang :'+$('#eidkcrute :selected').text();			            
			                nilai=$('#eidkcrute').val();
			            }
			            
                        $('#edetailrute tbody').append('<tr>' +
							'<td>' + info + '</td>' + 
							'<td><input type="hidden" name="edetrute[]" value="'+nilai+'"><a href="#">Hapus</a></td>' + 
							'</tr>');
		                $('tbody tr:odd').css('background-color','#c0f090');
		                $('tbody tr:even').css('background-color','#f8f8f8');                            							
						$(this).dialog('close');
						$('tbody tr:odd').css('background-color','#c0f090');
						$('#ebooldetrute').val($('#eidkcrute').val());
			    },
			    Batal: function() {
				    $(this).dialog('close');
			    }
		    },
		    close: function() {
			    //alert('keluar');
		    }
		});
		
		dlgtbhrute.dialog({
		    autoOpen: false,
		    height: 350,
		    width: 300,
		    modal: true,
		    buttons: {
			    Tambahkan: function() {
			            var info='',nilai='';
			            if($('#idkcrute').val()=='kosong'){
                            info=$('#idkabrute :selected').text()+', '+$('#idkecrute :selected').text();
                            nilai=$('#idkcrute').val()+','+$('#idkecrute').val();
			            }else{
			                info='Kantor Cabang :'+$('#idkcrute :selected').text();			            
			                nilai=$('#idkcrute').val();
			            }
			            
                        $('#detailrute tbody').append('<tr>' +
							'<td>' + info + '</td>' + 
							'<td><input type="hidden" name="detrute[]" value="'+nilai+'"><a href="#">Hapus</a></td>' + 
							'</tr>');
						$(this).dialog('close');
			            $('tbody tr:odd').css('background-color','#c0f090');
			            $('tbody tr:even').css('background-color','#f8f8f8');    						
						$('tbody tr:odd').css('background-color','#c0f090');
						$('#booldetrute').val($('#idkcrute').val());
			    },
			    Batal: function() {
				    $(this).dialog('close');
			    }
		    },
		    close: function() {
			    //alert('keluar');
		    }
		});
        $('#detailrute tbody').live('click',function(e){
            if($(e.target).text()=='Hapus'){
	            $(e.target).parent().parent().remove();
	            if($('#detailrute tbody').children().first().text()==''){
	                $('#booldetrute').val('');
	            }
			    $('tbody tr:odd').css('background-color','#c0f090');
			    $('tbody tr:even').css('background-color','#f8f8f8');            
            }
	        return false;        
        });
        $('#edetailrute tbody').live('click',function(e){
            if($(e.target).text()=='Hapus'){
	            $(e.target).parent().parent().remove();
	            if($('#edetailrute tbody').children().first().text()==''){
	                $('#ebooldetrute').val('');
	            }
			    $('tbody tr:odd').css('background-color','#c0f090');
			    $('tbody tr:even').css('background-color','#f8f8f8');            
            }
	        return false;        
        });
        
		$('#idkcrute').change(function(){
		    if($(this).val()=='kosong'){
		        $('#optpos').fadeIn();
		    }else{
		        $('#optpos').fadeOut();
		    }
		});
		$('#eidkcrute').change(function(){
		    if($(this).val()=='kosong'){
		        $('#eoptpos').fadeIn();
		    }else{
		        $('#eoptpos').fadeOut();
		    }
		});
		$('#inputrute input[type=reset]').click(function(){
		    $('#detailrute tbody').children().remove();
		    return true;
		});
	    function updateListRute(){
            $.ajax({
                url:'../../lib/ajax.php?op=getallrute',
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                        var tbhtbl=$('#daftarrute tbody');
                        tbhtbl.children().remove();
                        $('#idrutepeg').children().remove();
                        $('#eidrutepeg').children().remove();
                        for(var i=0;i<data.length;i++){
                            var tmp='';
                            for(var j=0;j<data[i].detail.length;j++){
                                tmp+='(';
                                tmp+=(data[i].detail[j].nmkc!=undefined)?data[i].detail[j].nmkc:data[i].detail[j].nmkab;
                                tmp+=')'+data[i].detail[j].nmkec+' - ';
                            }
                            $('<tr><td>'+data[i].id+'</td><td>'+data[i].nama+'</td><td>'+tmp+'</td><td><a href="'+data[i].id+'">Edit</a></td></tr>').appendTo(tbhtbl);
                            $('<option value="'+data[i].id+'">'+data[i].nama+'</option>').appendTo($('#idrutepeg'));
                            $('<option value="'+data[i].id+'">'+data[i].nama+'</option>').appendTo($('#eidrutepeg'));
                        }
                        $('tbody tr:odd').css('background-color','#c0f090');
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	
	        
	    }		
		$('#inputrute').validate({		
	        rules:{
	            nmrute:"required",
	            booldetrute:"required"
	        },
	        messages:{
	            nmrute:"Masukkan nama rute",
	            booldetrute:"Pilih Kantor cabang/kecamatan terlebih dahulu"
	        },
            submitHandler: function() { 
                $('body').scrollTop(0);
                $('html').scrollTop(0);
                updateInfo('Proses simpan data rute',false);            
                $.ajax({
                    url:'../../lib/ajax.php',
                    type:'POST',
                    timeout:10000,
                    dataType: 'json',
                    data:$('#inputrute').serialize(),
                    success:function(data){
                        if(data.berhasil){
                            updateInfo('Rute baru '+data.nama+' berhasil ditambahkan',false);
                            $('#inputrute input[type=text]').val('');
                            $('#inputrute input[type=reset]').click();
                        }else{
                            updateInfo('Penyimpanan data rute baru gagal!',false);
                        }
                    },
                    error:function(e){                    
                        updateInfo('Terjadi kesalahan koneksi',false);
                    }
                });
            }	        			
		});
		
	    $('#editrute').validate({
	        rules:{
	            idrute:{
	                required:true,
	                remote:"../../lib/ajax.php?op=cekidrute"
	                }
	        },
	        messages:{
	            idrute:{
	                required:"Masukkan id rute",
	                remote:"Id rute tidak ditemukan"
	                }
	        },
            submitHandler: function() { 
                editRute($('#idruteedit').val());
                $('#idruteedit').val('');
            }
        });	
	    $('#daftarrute a').live('click',function(e){
	        if($(e.target).text()=='Edit'){
	            editRute($(e.target).attr('href'));
	            updateInfo('Mengedit Rute dengan id ' + $(e.target).attr('href'))
	            $('#edit_rute').attr('checked','checked').click();
	        }
	        return false;
	    });
	    function editRute(id){
            $.ajax({
                url:'../../lib/ajax.php?op=getinforute&id='+id,
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                    $('#updaterute').fadeIn();
                    $('#eidrute').val(data.id);
                    $('#enmrute').val(data.nama);
                    $('#edetailrute tbody').children().remove();
                    var nilai='',tmpnm='';
                    for(var i=0;i<data.detail.length;i++){
                        if(data.detail[i].idkantorcabang==null){
                            nilai='kosong,'+data.detail[i].idkecamatan;
                            tmpnm=data.detail[i].nmkab+', '+data.detail[i].nmkec;
                        }else{
                            nilai=data.detail[i].idkantorcabang+','+data.detail[i].idkecamatan;
                            tmpnm='Kantor Cabang :'+data.detail[i].nmkc;
                        }
                        $('#edetailrute tbody').append('<tr>' +
							'<td>' + tmpnm + '</td>' + 
							'<td><input type="hidden" name="edetrute[]" value="'+nilai+'"><a href="#">Hapus</a></td>' + 
							'</tr>');                                        
                    }
                    $('#editrute').fadeOut();

                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	        
	    }		
	    $("#batalUpdateRute").click(function(){
            $('#updaterute').slideUp(2000);
            $('#editrute').fadeIn(4000);	        
	    });
		$('#updaterute').hide().validate({		
	        rules:{
	            enmrute:"required",
	            ebooldetrute:"required"
	        },
	        messages:{
	            enmrute:"Masukkan nama rute",
	            ebooldetrute:"Pilih Kantor cabang/kecamatan terlebih dahulu"
	        },
            submitHandler: function() { 
                $('body').scrollTop(0);
                $('html').scrollTop(0)
                updateInfo('Proses update data rute',false);            
                $.ajax({
                    url:'../../lib/ajax.php',
                    type:'POST',
                    timeout:10000,
                    dataType: 'json',
                    data:$('#updaterute').serialize(),
                    success:function(data){
                        if(data.berhasil){
                            updateInfo('Rute '+data.nama+' berhasil diupdate',false);
                            $('#updaterute input[type=text]').val('');
                            $('#updaterute input[type=reset]').click();
                        }else{
                            updateInfo('Update data rute gagal!',false);
                        }
                    },
                    error:function(e){                    
                        updateInfo('Terjadi kesalahan koneksi',false);
                    }
                });
            }	        			
		});		
        $('#eidkabrute').change(function(){
            $.ajax({
                url:'../../lib/ajax.php',
                type:'POST',
                timeout:10000,
                dataType: 'json',
                data:'op=getkec&idkec='+$(this).val(),
                success:function(data){
                        var cmbkec=$('#eidkecrute');
                        cmbkec.children().remove();
                        for(var i=0;i<data.length;i++){
                            $('<option value="'+data[i].id+'">'+data[i].nama+'</option>').appendTo(cmbkec);
                        }
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	        
	    })		
	    $('#idkabrute').change(function(){
            $.ajax({
                url:'../../lib/ajax.php',
                type:'POST',
                timeout:10000,
                dataType: 'json',
                data:'op=getkec&idkec='+$(this).val(),
                success:function(data){
                        var cmbkec=$('#idkecrute');
                        cmbkec.children().remove();
                        for(var i=0;i<data.length;i++){
                            $('<option value="'+data[i].id+'">'+data[i].nama+'</option>').appendTo(cmbkec);
                        }
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	        
	    });		
		$('#tambahposrute').click(function(){
		    dlgtbhrute.dialog('open');
		});
        $('#etambahposrute').click(function(){
		    dlgetbhrute.dialog('open');
		});	        
	    function updateInfo(pesan,hide){
	        //alert(pesan);
	        if(hide==undefined){
	            hide=true;
	        }
	        if(hide==true){
	            pnlInfo.children().last().html(pesan);
	            pnlInfo.hide().stop().fadeIn('fast').delay(3000);
	            pnlInfo.fadeOut('slow');
	        }else{
	            pnlInfo.show();
	            pnlInfo.children().last().html(pesan);
	        }
	    }
	    
		$('#logout').button({
            icons: {
                primary: 'ui-icon-power'
            }}).click(function(){
               // $('#dialog').dialog('open');
            });
            $("#tabs").tabs();
        dlghpskc.dialog({
			autoOpen: false,
			modal: true,
			show: 'clip',
			hide: 'clip',
			resizable: false,
			buttons: {
				Ya: function() {
				    $(this).dialog('close');
					updateInfo('Data terhapus',false);
					$('#batalDeleteKC').click();
                    $.ajax({
                        url:'../../lib/ajax.php?op=deletekc&didkc='+$('#didkc').val(),
                        type:'GET',
                        timeout:10000,
                        dataType: 'json',
                        success:function(data){
                            if(data.berhasil){
                                updateInfo('Data Kantor dengan id '+data.id+' telah dihapus.',false);
                            }else{
                                updateInfo('Penghapusan Data Kantor Gagal',false);
                            }
                        },
                        error:function(e){                    
                            updateInfo('Terjadi kesalahan koneksi',false);
                        }
                    });						
				},
				Tidak:function(){
				    $(this).dialog('close');
				}
			}			
        
        });
		dlghpspeg.dialog({
			autoOpen: false,
			modal: true,
			show: 'clip',
			hide: 'clip',
			resizable: false,
			buttons: {
				Ya: function() {
				    $(this).dialog('close');
					updateInfo('Data terhapus',false);
					$('#batalDeletePeg').click();
                    $.ajax({
                        url:'../../lib/ajax.php?op=deletepeg&didpeg='+$('#didpeg').val(),
                        type:'GET',
                        timeout:10000,
                        dataType: 'json',
                        success:function(data){
                            if(data.berhasil){
                                updateInfo('Data pegawai dengan id '+data.id+' telah dihapus.',false);
                            }else{
                                updateInfo('Penghapusan Pegawai Gagal',false);
                            }
                        },
                        error:function(e){                    
                            updateInfo('Terjadi kesalahan koneksi',false);
                        }
                    });					
				},
				Tidak:function(){
				    $(this).dialog('close');
				}
			}			
		});            
		$('.submenu').buttonset();
		$('#input_peg').click(function(){
		    updateInfo('hua hua input lagi');
            pnlInputDataPeg.show();
            pnlLihatDataPeg.hide();
            pnlEditDataPeg.hide();
            pnlDeleteDataPeg.hide();
		});
		$('#lihat_peg').click(function(){
		    updateListPegawai();
            pnlInputDataPeg.hide();
            pnlLihatDataPeg.show();
            pnlEditDataPeg.hide();
            pnlDeleteDataPeg.hide();		
        });		
		$('#edit_peg').click(function(){
            pnlInputDataPeg.hide();
            pnlLihatDataPeg.hide();
            pnlEditDataPeg.show();
            pnlDeleteDataPeg.hide();
		});
		$('#delete_peg').click(function(){
            pnlInputDataPeg.hide();
            pnlLihatDataPeg.hide();
            pnlEditDataPeg.hide();
            pnlDeleteDataPeg.show();
		});		
		$('#input_kc').click(function(){
		    pnlInputDataKC.show();
		    pnlLihatDataKC.hide();
		    pnlEditDataKC.hide();
		    pnlDeleteDataKC.hide();
		});
		$('#lihat_kc').click(function(){
		    updateListKC();
		    pnlInputDataKC.hide();
		    pnlLihatDataKC.show();
		    pnlEditDataKC.hide();
		    pnlDeleteDataKC.hide();
		});		
		$('#edit_kc').click(function(){
		    pnlInputDataKC.hide();
		    pnlLihatDataKC.hide();
		    pnlEditDataKC.show();
		    pnlDeleteDataKC.hide();
		});		
		$('#delete_kc').click(function(){
		    pnlInputDataKC.hide();
		    pnlLihatDataKC.hide();
		    pnlEditDataKC.hide();
		    pnlDeleteDataKC.show();
		});		
		$('#input_rute').click(function(){
		    pnlInputDataRute.show();
		    pnlLihatDataRute.hide();
		    pnlEditDataRute.hide();
		});
		$('#lihat_rute').click(function(){
		    updateListRute();
		    pnlInputDataRute.hide();
		    pnlLihatDataRute.show();
		    pnlEditDataRute.hide();
		});
		$('#edit_rute').click(function(){
		    pnlInputDataRute.hide();
		    pnlLihatDataRute.hide();
		    pnlEditDataRute.show();
		});				
		$('#inputpeg').validate({
	        rules:{
	            idpeg:{
	                required:true,
	                digits:true,
	                minlength:9,
	                remote:"../../lib/ajax.php?op=cekidpeg"
	                },
	            nmpeg:"required",
	            tgllhr:"required",
	            notelp:"required",
	            password:"required"
	            },
	        messages:{
	            idpeg:{
	                required:"Masukkan id pegawai",
	                digits:"Masukkan angka",
	                minlength:"Panjang id pegawai 9 digit",
	                remote:"Id pegawai sudah ada"
	                },
	            nmpeg:"Isikan nama pegawai",
	            tgllhr:"Pilih tanggal lahir pegawai",
	            notelp:"Isikan nomor telp",
	            password:"Isikan password pegawai"
	        },
            submitHandler: function() { 
                $('body').scrollTop(0);
                $('html').scrollTop(0)
                updateInfo('Proses simpan data pegawai',false);            
                $.ajax({
                    url:'../../lib/ajax.php',
                    type:'POST',
                    timeout:10000,
                    dataType: 'json',
                    data:$('#inputpeg').serialize(),
                    success:function(data){
                        if(data.berhasil){
                            updateInfo('Pegawai baru '+data.nama+' berhasil ditambahkan',false);
                            $('#inputpeg input[type=text]').val('');
                        }else{
                            updateInfo('Penyimpanan data pegawai baru gagal!',false);
                        }
                    },
                    error:function(e){                    
                        updateInfo('Terjadi kesalahan koneksi',false);
                    }
                });
            }	        	    
	    });		
	    function editPegawai(id){
            $.ajax({
                url:'../../lib/ajax.php?op=getinfopeg&id='+id,
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                    $('#updatepeg').fadeIn();
                    $('#eidpeg').val(data.id);
                    $('#enmpeg').val(data.nama);
                    $('#etgllhr').val(data.tgllahir);
                    $('#enotelp').val(data.notelp);
                    $('#epassword').val('');
                    $('#ejabatan').val(data.jabatan);
                    if(data.jabatan=='peg. pengiriman'){
                        $('#edetpp').fadeIn();
                        $('#eidrutepeg').val(data.idrute);
                    }else{
                        $('#edetpp').fadeOut();
                    }
                    $('#ejk').val(data.jk);
                    $('#eidkc').val(data.idkantorcabang);
                    $('#editpeg').fadeOut();

                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	        
	    }
	    function deletePegawai(id){
            $.ajax({
                url:'../../lib/ajax.php?op=getinfopeg&id='+id,
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                    var nilai=[],i=0;
                    nilai[0]=data.id;
                    nilai[1]=data.nama;
                    nilai[2]=(data.jk=='l')?"Laki-laki":"Perempuan";
                    nilai[3]=data.tgllahir;
                    nilai[4]=data.jabatan;
                    nilai[5]=data.notelp;
                    nilai[6]=data.nkc;
                    $('#didpeg').val(data.id);
                    $('#deletepeg').fadeOut();
                    $('#infopeg tr').each(function(){
                        $(this).children().last().text(nilai[i++]);
                    });
                    $('#konfirmdelete').fadeIn();
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });
	    }
	    $('#editpeg').validate({
	        rules:{
	            idpeg:{
	                required:true,
	                digits:true,
	                minlength:9,
	                remote:"../../lib/ajax.php?op=notcekidpeg"
	                }
	        },
	        messages:{
	            idpeg:{
	                required:"Masukkan id pegawai",
	                digits:"Masukkan angka",
	                minlength:"Panjang id pegawai 9 digit",
	                remote:"Id pegawai Tidak ditemukan"
	                }
	        },
            submitHandler: function() { 
                    editPegawai($('#idpegedit').val());
                    $('#idpegedit').val('');
            }
        });    	  
	    $('#deletepeg').validate({
	        rules:{
	            idpeg:{
	                required:true,
	                digits:true,
	                minlength:9,
	                remote:"../../lib/ajax.php?op=notcekidpeg"
	                }
	        },
	        messages:{
	            idpeg:{
	                required:"Masukkan id pegawai",
	                digits:"Masukkan angka",
	                minlength:"Panjang id pegawai 9 digit",
	                remote:"Id pegawai Tidak ditemukan"
	                }
	        },
            submitHandler: function() { 
                    deletePegawai($('#idpegdelete').val());
                    $('#idpegdelete').val('');
            }
        });       
        $('#batalUpdatePeg').click(function(){
            $('#updatepeg').slideUp(2000);
            $('#editpeg').fadeIn(4000);
        });
        $('#updatepeg').hide().validate({
	        rules:{
	            enmpeg:"required",
	            etgllhr:"required",
	            enotelp:"required"
	            },
	        messages:{
	            enmpeg:"Isikan nama pegawai",
	            etgllhr:"Pilih tanggal lahir pegawai",
	            enotelp:"Isikan nomor telp"
	        },
            submitHandler: function() { 
                updateInfo('Updating data...',false);
                $('body').scrollTop(0);
                $('html').scrollTop(0);
                $.ajax({
                    url:'../../lib/ajax.php',
                    type:'POST',
                    timeout:10000,
                    dataType: 'json',
                    data:$('#updatepeg').serialize(),
                    success:function(data){
                        if(data.berhasil){
                            updateInfo('Pegawai '+data.nama+' berhasil diupdate',false);
                            $('#updatepeg input[type=text]').val('');
                            $('#batalUpdatePeg').click();
                        }else{
                            updateInfo('Update data pegawai gagal!',false);
                        }
                    },
                    error:function(e){                    
                        updateInfo('Terjadi kesalahan koneksi',false);
                    }
                });                
            }	        	    
	    });		  
	    
	    $('#detpp').hide();
	    $('#jabatan').change(function(){
	        if($(this).val()=='peg. pengiriman'){
	            $(this).parent().next().fadeIn();
	        }else{
                $(this).parent().next().fadeOut();
	        }
	    });
	    $('#edetpp').hide();
	    $('#ejabatan').change(function(){
            if($(this).val()=='peg. pengiriman'){
	            $('#edetpp').fadeIn();
	        }else{
                $('#edetpp').fadeOut();
	        }	    
	    });
	    $('#konfirmdelete').submit(function(){
	        dlghpspeg.dialog('open');
	        return false;
	    }).hide();
	    
	    $('#batalDeletePeg').click(function(){
            $('#konfirmdelete').slideUp();
            $('#deletepeg').fadeIn(4000);
	    });
	    function updateListPegawai(){
            $.ajax({
                url:'../../lib/ajax.php?op=getallpeg',
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                        var tbhtbl=$('#daftarpegawai tbody');
                        tbhtbl.children().remove();
                        
                        for(var i=0;i<data.length;i++){
                            $('<tr><td>'+data[i].id+'</td><td>'+data[i].nama+'</td><td>'+data[i].jabatan+'</td><td>'+data[i].nkc+'</td><td><a href="'+data[i].id+'">Edit</a>  &nbsp; &nbsp; <a href="'+data[i].id+'">Delete</a></td></tr>').appendTo(tbhtbl);
                        }
                        $('tbody tr:odd').css('background-color','#c0f090');
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	
	        
	    }
	    ftgllhr.change(function(){
	        fpassword.val($(this).val());
	    });
	    $('#daftarpegawai a').live('click',function(e){
	        if($(e.target).text()=='Edit'){
	            editPegawai($(e.target).attr('href'));
	            updateInfo('Mengedit pegawai dengan id ' + $(e.target).attr('href'))
	            $('#edit_peg').attr('checked','checked').click();
	        }else{
	            deletePegawai($(e.target).attr('href'));
	            updateInfo('Konfirmasi hapus pegawai dengan id ' + $(e.target).attr('href'))
	            $('#delete_peg').attr('checked','checked').click();
	        }
	        return false;
	    });
	    $.datepicker.setDefaults($.extend({changeMonth: true,changeYear: true}, $.datepicker.regional['id']));
	    $('#etgllhr').datepicker($.datepicker.regional['id'])
		    .datepicker('option',{dateFormat:'yy-mm-dd'})
		    .datepicker('option', {showAnim: 'fadeIn'});
	    ftgllhr.datepicker($.datepicker.regional['id'])
		    .datepicker('option',{dateFormat:'yy-mm-dd'})
		    .datepicker('option', {showAnim: 'fadeIn'});
		$('tbody tr:odd').css('background-color','#c0f090');
/***************************
** kantor_cabang
********/
	    $('#idkab').change(function(){
            $.ajax({
                url:'../../lib/ajax.php',
                type:'POST',
                timeout:10000,
                dataType: 'json',
                data:'op=getkec&idkec='+$(this).val(),
                success:function(data){
                        var cmbkec=$('#idkec');
                        cmbkec.children().remove();
                        for(var i=0;i<data.length;i++){
                            $('<option value="'+data[i].id+'">'+data[i].nama+'</option>').appendTo(cmbkec);
                        }
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	        
	    });
	    $('#eidkab').change(function(){
            $.ajax({
                url:'../../lib/ajax.php',
                type:'POST',
                timeout:10000,
                dataType: 'json',
                data:'op=getkec&idkec='+$(this).val(),
                success:function(data){
                        var cmbkec=$('#eidkec');
                        cmbkec.children().remove();
                        for(var i=0;i<data.length;i++){
                            $('<option value="'+data[i].id+'">'+data[i].nama+'</option>').appendTo(cmbkec);
                        }
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	        
	    });	    
	    $('#inputkc').validate({
	        rules:{
	            namakc:"required",
	            notelpkc:"required",
	            detalamatkc:"required"
	            },
	        messages:{
	            namakc:"Masukkan nama kantor cabang",
	            notelpkc:"Masukkan no telp kantor cabang",
	            detalamatkc:"Masukkan detail alamat kantor cabang"
	        },
            submitHandler: function() { 
                updateInfo('Updating data...',false);
                $('body').scrollTop(0);
                $('html').scrollTop(0);
                updateInfo('Proses simpan data kantor cabang',false);            
                $.ajax({
                    url:'../../lib/ajax.php',
                    type:'POST',
                    timeout:10000,
                    dataType: 'json',
                    data:$('#inputkc').serialize(),
                    success:function(data){
                        if(data.berhasil){
                            updateInfo('Kantor cabang baru '+data.nama+' berhasil ditambahkan',false);
                            $('#inputkc input[type=text],#inputkc textarea').val('');
                        }else{
                            updateInfo('Penyimpanan kantor cabang baru gagal!',false);
                        }
                    },
                    error:function(e){                    
                        updateInfo('Terjadi kesalahan koneksi',false);
                    }
                });            
            }	        	    
	    });	
	    function updateListKC(){
            $.ajax({
                url:'../../lib/ajax.php?op=getallkc',
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                        var tbhtbl=$('#daftarkantor tbody');
                        tbhtbl.children().remove();
                        
                        for(var i=0;i<data.length;i++){
                            $('<tr><td>'+data[i].id+'</td><td>'+data[i].nama+'</td><td>'+data[i].nmkab+'</td><td>'+data[i].nmkec+'</td><td>'+data[i].detalamat+'</td><td>'+data[i].notelp+'</td><td><a href="'+data[i].id+'">Edit</a>  &nbsp; &nbsp; <a href="'+data[i].id+'">Delete</a></td></tr>').appendTo(tbhtbl);
                        }
                        $('tbody tr:odd').css('background-color','#c0f090');
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	   
	    }	
	    $('#editkc').validate({
	        rules:{
	            idkc:{
	                required:true,
	                remote:"../../lib/ajax.php?op=cekidkc"
	                }
	        },
	        messages:{
	            idkc:{
	                required:"Masukkan id pegawai",
	                remote:"Id kantor cabang tidak ditemukan"
	                }
	        },
            submitHandler: function() { 
                    editKC($('#idkcedit').val());
                    $('#idkcedit').val('');
            }
        });    	  
	    $('#deletekc').validate({
	        rules:{
	            idkc:{
	                required:true,
	                remote:"../../lib/ajax.php?op=cekidkc"
	                }
	        },
	        messages:{
	            idkc:{
	                required:"Masukkan id pegawai",
	                remote:"Id kantor cabang tidak ditemukan"
	                }
	        },
            submitHandler: function() { 
                    deleteKC($('#idkcdelete').val());
                    $('#idkcdelete').val('');
            }
        });   	    
	    function editKC(id){
            $.ajax({
                url:'../../lib/ajax.php?op=getinfokc&id='+id,
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                    $('#updatekc').fadeIn();
                    $('#editidkc').val(data.id);
                    $('#enamakc').val(data.nama);
                    $('#eidkab').val(data.idkabupaten);
                    $('#eidkab').change();
                    $('#enotelpkc').val(data.notelp);
                    $('#edetalamatkc').val(data.detalamat);
                    $('#editkc').delay(2000).fadeOut('slow',function(){
                        $('#eidkec').val(data.idkecamatan);
                    });                    
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	        
	    }
	       
	    function deleteKC(id){
            $.ajax({
                url:'../../lib/ajax.php?op=getinfokc&id='+id,
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                    var nilai=[],i=0;
                    nilai[0]=data.id;
                    nilai[1]=data.nama;
                    nilai[2]=data.nmkab;
                    nilai[3]=data.nmkec;
                    nilai[4]=data.detalamat;
                    nilai[5]=data.notelp;
                    $('#didkc').val(data.id);
                    $('#deletekc').fadeOut();
                    $('#infokantor tr').each(function(){
                        $(this).children().last().text(nilai[i++]);
                    });
                    $('#konfirmdeletekc').fadeIn();
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });
	    }
        $('#batalUpdateKC').click(function(){
            $('#updatekc').slideUp(2000);
            $('#editkc').fadeIn(4000);
        });	    
	    $('#batalDeleteKC').click(function(){
            $('#konfirmdeletekc').slideUp();
            $('#deletekc').fadeIn(4000);
	    });        
	    $('#konfirmdeletekc').submit(function(){
	        dlghpskc.dialog('open');
	        return false;
	    }).hide();	
        $('#updatekc').hide().validate({
	        rules:{
	            enamakc:"required",
	            enotelpkc:"required",
	            edetalamatkc:"required"
	            },
	        messages:{
	            enamakc:"Masukkan nama kantor cabang",
	            enotelpkc:"Isikan no telp kantor cabang",
	            edetalamatkc:"Isikan detail alamat kantor cabang"
	        },
            submitHandler: function() { 
                updateInfo('Updating data...',false);
                $('body').scrollTop(0);
                $('html').scrollTop(0);
                $.ajax({
                    url:'../../lib/ajax.php',
                    type:'POST',
                    timeout:10000,
                    dataType: 'json',
                    data:$('#updatekc').serialize(),
                    success:function(data){
                        if(data.berhasil){
                            updateInfo('Kantor cabang '+data.nama+' berhasil diupdate',false);
                            $('#updatekc input[type=text], #updatekc textarea').val('');
                            $('#batalUpdateKC').click();
                        }else{
                            updateInfo('Update data pegawai gagal!',false);
                        }
                    },
                    error:function(e){                    
                        updateInfo('Terjadi kesalahan koneksi',false);
                    }
                });                
            }	        	    
	    });	        
	    $('#daftarkantor a').live('click',function(e){
	        if($(e.target).text()=='Edit'){
	            editKC($(e.target).attr('href'));
	            updateInfo('Mengedit kantor cabang dengan id ' + $(e.target).attr('href'))
	            $('#edit_kc').attr('checked','checked').click();
	        }else{
	            deleteKC($(e.target).attr('href'));
	            updateInfo('Konfirmasi hapus kantor cabang dengan id ' + $(e.target).attr('href'))
	            $('#delete_kc').attr('checked','checked').click();
	        }
	        return false;
	    });	        
	});
