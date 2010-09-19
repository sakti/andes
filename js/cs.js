	$(function() {
	    var fnmbarang=$('#nmbarang'),fbrtbrg=$('#beratbarang'),fkategori=$('#kategori'),fnilaibrg=$('#nilaibarang'),
	    infbiaya=$('#infobiaya'),infjarak=$('#infojarak'),infkilat=$('#infokilat'),infjmlitem=$('#infojmlitem'),infasuransi=$('#infoasuransi'),
	    biaya=$('#biaya'),pnlInfo=$('#panelinfo'),idkantorcabang=$('#idkantorcabang').text();
	    
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
	    $('#lhttrans').click(updateListTransaksi);
	    
	    function updateListTransaksi(){
            $.ajax({
                url:'../../lib/ajax.php?op=gettransbykc&idkc='+idkantorcabang,
                type:'GET',
                timeout:10000,
                dataType: 'json',
                success:function(data){
                        var tbhtbl=$('#daftartransaksi tbody');
                        tbhtbl.children().remove();                        
                        for(var i=0;i<data.length;i++){
                            $('<tr><td>'+data[i].id+'</td><td>'+data[i].namapengirim+'</td><td>'+data[i].namapenerima+'</td><td>'+data[i].biaya+'</td><td>'+data[i].tglwaktu+'</td><td>'+data[i].asuransi+'</td><td>'+data[i].kilat+'</td><td>'+data[i].nmcs+'</td></tr>').appendTo(tbhtbl);
                        }
                        $('tbody tr:odd').css('background-color','#c0f090');
                },
                error:function(e){                   
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	
	        
	    } 
	    $('#tambahbarang').click(function(){
	        var benar=true;        
	        $('label.error').remove();
	        if(fnmbarang.val().trim()==""){
	            benar=false;
	            fnmbarang.after('<label for="nmbarang" generated="true" class="error">Isikan nama barang</label>');
	        }
    	    if(!/^\d+$/.test(fbrtbrg.val())){
    	        benar=false;
    	        fbrtbrg.after('<label for="beratbarang" generated="true" class="error">Masukkan berat barang yang benar, dibulatkan ke atas</label>');
    	    }
    	    if(!/^\d+$/.test(fnilaibrg.val())){
    	        benar=false;
    	        fnilaibrg.after('<label for="nilaibarang" generated="true" class="error">Masukkan nilai barang dalam Rupiah, tidak perlu tanda baca</label>');
    	    }
    	    if(benar){
    	        $('<tr><td>'+fnmbarang.val()+'<input type="hidden" name="nmbrg[]" value="'+fnmbarang.val()+'" / ></td>'+
    	        '<td>'+fbrtbrg.val()+'<input type="hidden" name="brtbrg[]" value="'+fbrtbrg.val()+'" / ></td>'+
    	        '<td>'+fnilaibrg.val()+'<input type="hidden" name="nilaibrg[]" value="'+fnilaibrg.val()+'" / ></td>'+
    	        '<td>'+fkategori.children().filter(':selected').text()+'<input type="hidden" name="katbrg[]" value="'+fkategori.val()+'" / ></td>'+
    	        '<td><a href="#">Delete</a></td></tr>').appendTo('#daftarbarang tbody');
    	        fnmbarang.val('');
    	        fbrtbrg.val('');
    	        fnilaibrg.val('');
			    $('tbody tr:odd').css('background-color','#c0f090');
			    $('tbody tr:even').css('background-color','#f8f8f8');  
			    $('#boolbrg').val('oke');  	        
    	    }	    
	    });
	    
	    $('#daftarbarang a').live('click',function(e){
	        if($(e.target).text()=='Delete'){
	            $(e.target).parent().parent().remove();
	            if($('#daftarbarang tbody').children().first().text()==''){
	                $('#boolbrg').val('');
	            }
			    $('tbody tr:odd').css('background-color','#c0f090');
			    $('tbody tr:even').css('background-color','#f8f8f8');
	        }
	        return false;
	    });	    
	    $('#hitung').click(function(){
	        if($('#boolbrg').val()==''){
                $('body').scrollTop(0);
                $('html').scrollTop(0);
                updateInfo('Masukkan barang terlebih dahulu');
                return;
	        }
	        if($('#nmpengirim').val()==''){
                $('body').scrollTop(0);
                $('html').scrollTop(0);
                updateInfo('Isi Form terlebih dahulu');
                return;	            
	        }
            $.ajax({
                url:'../../lib/ajax.php',
                type:'GET',
                timeout:10000,
                dataType: 'json',
                data:$('#inputtrans').serialize(),
                success:function(data){
                    infjarak.text(data.jarak);
                    infbiaya.text(data.total);
                    biaya.val(data.total);
                    infjmlitem.text(data.jmlitem);
                    infkilat.text(data.kilat);
                    infasuransi.text(data.asuransi);
                },
                error:function(e){                    
                    updateInfo('Terjadi kesalahan koneksi',false);
                }
            });	        
	    });
		$("#logout").button({
            icons: {
                primary: 'ui-icon-power'
            }}).click(function(){
                //$('#dialog').dialog('open');
            });
            $("#tabs").tabs();
		$('#konfirminsert').dialog({
			autoOpen: false,
			modal: true,
			show: 'clip',
			hide: 'clip',
			resizable: false,
			buttons: {
				Ya: function() {
					$(this).dialog('close');
                    updateInfo('Proses simpan simpan transaksi',false);   
                    $.ajax({
                        url:'../../lib/ajax.php',
                        type:'POST',
                        timeout:10000,
                        dataType: 'json',
                        data:$('#inputtrans').serialize(),
                        success:function(data){
                            if(data.berhasil){
                                $('#daftarbarang tbody').children().remove();
                                updateInfo('Transaksi baru '+data.nama+' berhasil ditambahkan',false);
                                $('#inputtrans input[type=text], textarea').val('');
                            }else{
                                updateInfo('Penyimpanan data transaksi baru gagal!',false);
                            }
                        },
                        error:function(e){                    
                            updateInfo('Terjadi kesalahan koneksi',false);
                        }
                    });					
				},
				'Tidak, saya belum yakin':function(){
				    $(this).dialog('close');
				}
			}			
		}); 
        $('#kab_pengirim').change(function(){
            $.ajax({
                url:'../../lib/ajax.php',
                type:'POST',
                timeout:10000,
                dataType: 'json',
                data:'op=getkec&idkec='+$(this).val(),
                success:function(data){
                        var cmbkec=$('#kec_pengirim');
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
        $('#kab_penerima').change(function(){
            $.ajax({
                url:'../../lib/ajax.php',
                type:'POST',
                timeout:10000,
                dataType: 'json',
                data:'op=getkec&idkec='+$(this).val(),
                success:function(data){
                        var cmbkec=$('#kec_penerima');
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
	    
		$('#inputtrans').validate({
	        rules:{
	            nmpengirim:"required",
	            notelppengirim:"required",
	            det_alamat_pengirim:"required",
	            nmpenerima:"required",
	            notelppenerima:"required",
	            det_alamat_penerima:"required",
	            tglkirim:"required",
	            waktukirim:"required",
	            boolbrg:"required"
	            },
	        messages:{
	            nmpengirim:"Isikan nama pengirim",
	            notelppengirim:"Isikan notelp pengirim",
	            det_alamat_pengirim:"Masukkan alamat lengkap pengirim",
	            nmpenerima:"Isikan nama penerima",
	            notelppenerima:"Isikan notelp penerima",
	            det_alamat_penerima:"Masukkan alamat lengkap penerima",
	            tglkirim:"Pilih tgl pengiriman",
	            waktukirim:"Masukkan waktu kirim",
	            boolbrg:"Tambahkan barang yang akan dikirim"
	        },
            submitHandler: function() { 
                $('body').scrollTop(0);
                $('html').scrollTop(0);
                $('#hitung').click();
                $('#konfirminsert').dialog('open');
            }
	    });
		$('tbody tr:odd').css('background-color','#c0f090');
		$('tbody tr:even').css('background-color','#f8f8f8');
		
		var tglkirim=$("#tglkirim"),waktukirim=$('#waktukirim');
		tglkirim.datepicker($.datepicker.regional['id'])
		.datepicker('option',{dateFormat:'yy-mm-dd'})
		.datepicker('option', {showAnim: 'fadeIn'});
		tglkirim.change(function(){
		    var waktu=new Date();
		    var jam=""+waktu.getHours(),menit=""+waktu.getMinutes(),detik=""+waktu.getSeconds();
		    jam=(jam.length==1)?"0"+jam:jam;
		    menit=(menit.length==1)?"0"+menit:menit;
		    detik=(detik.length==1)?"0"+detik:detik;
		    waktukirim.val(jam+':'+menit+':'+detik);
		});
	});
