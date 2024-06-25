<script src="<?= base_url(); ?>assets/mobile/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/toast/jquery.toast.min.js"></script>
<script>
   let url = '<?= base_url(); ?>';

   $(document).ready(function() {
      // upload bukti pengiriman
      $("#submit").on('click', function() {
         var data = new FormData();
         data.append('gambar', $('#gambar').prop('files')[0]);
         data.append('invoice', $("#invoice").val());
         data.append('costumer', $("#costumer").val());

         $.ajax({
            url: '<?php echo base_url(); ?>transaksi/upload_bukti_penyerahan',
            type: 'POST',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
               $('#Submission').offcanvas('hide');
               if (response.error) {
                  $.toast({
                     heading: "Receipt Invalid",
                     position: "top-center",
                     loaderBg: "#fff",
                     icon: "error",
                     hideAfter: 8000,
                     stack: 1
                  });
               } else {
                  $.toast({
                     heading: "Receipt Success",
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