$(document).ready(function() {
   $('#jumPend').html('0');
   $('#tglPend').html('Belum ditentukan');
   $('#srcText').html('Cari Data');

   // Pencarian Data Pendapatan Reseler
   $('#tblDataRes').html('<tr><td colspan="7" class="text-center"><h4 class="mt-3"><strong>Maaf, Retur Pendapatan tidak ditemukan !</strong></h4><h6>Silakan periksa ejaan atau filter parameter Anda</h6><h6>dan coba lagi</h6></td></tr>');
   $('#htDataRes').html('<tr><th colspan="4">Total</th><th>Rp. 0</th><th>Rp. 0</th><th>Rp. 0</th></tr>');
   $('#pendReseler').submit(function(e) {
      e.preventDefault();
      $('#cetak').hide();
      $('#srcText').html('Please Wait...');
      $('#tblDataRes').html('<tr><td colspan="7" class="text-center"><div class="spinner-border text-primary spinner-center"></div></td></tr>');
      $('#submit').prop('disabled', true);
      var laporan = $('#pendReseler').serialize();
      var pencarian = function() {
         $.ajax({
            type: 'POST',
            url: url + 'laporan/cari_pend_reseler',
            dataType: 'json',
            data: laporan,
            success: function(response) {
               $('#srcText').html('Cari Data');
               $('#submit').prop('disabled', false);
               if(response.pend_reseler == ''){
                  $('#tblDataRes').html('<tr><td colspan="7" class="text-center"><h4 class="mt-3"><strong>Maaf, Retur Pendapatan tidak ditemukan !</strong></h4><h6>Silakan periksa ejaan atau filter parameter Anda</h6><h6>dan coba lagi</h6></td></tr>');
                  $('#htDataRes').html('<tr><th colspan="4">Total</th><th>Rp. 0</th><th>Rp. 0</th><th>Rp. 0</th></tr>');
                  $('#jumPend').html(response.jumPendRes);
                  $('#tglPend').html(response.tglPendRes);
                  $('#cetak').hide();
               } else{
                  $('#tblDataRes').html(response.pend_reseler);
                  $('#htDataRes').html(response.total_keseluruhan);
                  $('#jumPend').html(response.jumPendRes);
                  $('#tglPend').html(response.tglPendRes);
                  $('#cetak').show();
               }
            }
         });
      };
      setTimeout(pencarian, 1000);
   });

   // Pencarian Data Pendapatan Reseler
   $('#tblDataPer').html('<tr><td colspan="7" class="text-center"><h4 class="mt-3"><strong>Maaf, Retur Pendapatan tidak ditemukan !</strong></h4><h6>Silakan periksa ejaan atau filter parameter Anda</h6><h6>dan coba lagi</h6></td></tr>');
   $('#htDataPer').html('<tr><th colspan="3">Total</th><th>0 Items</th><th>Rp. 0</th><th>0%</th><th>Rp. 0</th></tr>');
   $('#pendPerusahaan').submit(function(e) {
      e.preventDefault();
      $('#cetak').hide();
      $('#srcText').html('Please Wait...');
      $('#tblDataPer').html('<tr><td colspan="7" class="text-center"><div class="spinner-border text-primary spinner-center"></div></td></tr>');
      $('#submit').prop('disabled', true);
      var laporan = $('#pendPerusahaan').serialize();
      var pencarian = function() {
         $.ajax({
            type: 'POST',
            url: url + 'laporan/cari_pend_perusahaan',
            dataType: 'json',
            data: laporan,
            success: function(response) {
               $('#srcText').html('Cari Data');
               $('#submit').prop('disabled', false);
               if(response.pend_perusahaan == ''){
                  $('#tblDataPer').html('<tr><td colspan="7" class="text-center"><h4 class="mt-3"><strong>Maaf, Retur Pendapatan tidak ditemukan !</strong></h4><h6>Silakan periksa ejaan atau filter parameter Anda</h6><h6>dan coba lagi</h6></td></tr>');
                  $('#htDataPer').html('<tr><th colspan="3">Total</th><th>0 Items</th><th>Rp. 0</th><th>0%</th><th>Rp. 0</th></tr>');
                  $('#jumPend').html(response.jumPend);
                  $('#tglPend').html(response.tglPend);
                  $('#cetak').hide();
               } else{
                  $('#tblDataPer').html(response.pend_perusahaan);
                  $('#htDataPer').html(response.total_keseluruhan);
                  $('#jumPend').html(response.jumPend);
                  $('#tglPend').html(response.tglPend);
                  $('#cetak').show();
               }
            }
         });
      };
      setTimeout(pencarian, 1000);
   });

   // Pencarian Data Pendapatan Kurir
   $('#tblDataKur').html('<tr><td colspan="7" class="text-center"><h4 class="mt-3"><strong>Maaf, Retur Pendapatan tidak ditemukan !</strong></h4><h6>Silakan periksa ejaan atau filter parameter Anda</h6><h6>dan coba lagi</h6></td></tr>');
   $('#htDataKur').html('<tr><th colspan="5">Total</th><th>0 Items</th><th>Rp. 0</th></tr>');
   $('#pendKurir').submit(function(e) {
      e.preventDefault();
      $('#cetak').hide();
      $('#srcText').html('Please Wait...');
      $('#tblDataKur').html('<tr><td colspan="7" class="text-center"><div class="spinner-border text-primary spinner-center"></div></td></tr>');
      $('#submit').prop('disabled', true);
      var laporan = $('#pendKurir').serialize();
      var pencarian = function() {
         $.ajax({
            type: 'POST',
            url: url + 'laporan/cari_pend_kurir',
            dataType: 'json',
            data: laporan,
            success: function(response) {
               $('#srcText').html('Cari Data');
               $('#submit').prop('disabled', false);
               if(response.pend_kurir == ''){
                  $('#tblDataKur').html('<tr><td colspan="7" class="text-center"><h4 class="mt-3"><strong>Maaf, Retur Pendapatan tidak ditemukan !</strong></h4><h6>Silakan periksa ejaan atau filter parameter Anda</h6><h6>dan coba lagi</h6></td></tr>');
                  $('#htDataKur').html('<tr><th colspan="5">Total</th><th>0 Items</th><th>Rp. 0</th></tr>');
                  $('#jumPend').html(response.jumPend);
                  $('#tglPend').html(response.tglPend);
                  $('#cetak').hide();
               } else{
                  $('#tblDataKur').html(response.pend_kurir);
                  $('#htDataKur').html(response.total_keseluruhan);
                  $('#jumPend').html(response.jumPend);
                  $('#tglPend').html(response.tglPend);
                  $('#cetak').show();
               }
            }
         });
      };
      setTimeout(pencarian, 1000);
   });
});

