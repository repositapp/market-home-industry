<script src="<?= base_url(); ?>assets/mobile/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/toast/jquery.toast.min.js"></script>
<script>
   let url = '<?= base_url(); ?>';

   $(document).ready(function() {
      // upload bukti pengiriman
      $("#submit").on('click', function() {
         var data = new FormData();
         data.append('id_transaksi', $("#id_transaksi").val());

         $.ajax({
            url: '<?php echo base_url(); ?>transaksi/konfirmasi_packing',
            type: 'POST',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
               $('#Submission').offcanvas('hide');
               if (response.error) {
                  $.toast({
                     heading: "Konfirmasi Gagal",
                     position: "top-center",
                     loaderBg: "#fff",
                     icon: "error",
                     hideAfter: 8000,
                     stack: 1
                  });
               } else {
                  $('#konfirmasi').offcanvas('hide');
                  $.toast({
                     heading: "Konfirmasi Berhasil",
                     position: "top-center",
                     loaderBg: "#fff",
                     icon: "success",
                     hideAfter: 3000,
                     stack: 1
                  });
               }
            }
         })
      });
   });
</script>