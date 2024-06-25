<script src="<?= base_url(); ?>assets/mobile/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/toast/jquery.toast.min.js"></script>
<script>
   $(document).ready(function() {
      cart_total();
      //Cart Total
      function cart_total() {
         $.ajax({
            url: '<?php echo base_url(); ?>produk/cart_total/<?php echo $this->session->userdata("id_user"); ?>',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
               if (response.total > '99') {
                  $('#cart_info').html('99+');
               } else if (response.total <= '99') {
                  $('#cart_info').html(response.total);
               }
            }
         });
      }

      // $("#add_cart").on('click', function() {
      //    var tambah_data = $('input[name="tambah_data"]').val();
      //    var quantity = $('input[name="quantity"]').val();
      //    var harga_produk = $('input[name="harga_produk"]').val();
      //    var variasi_produk = $('input[name="variasi_produk"]').val();
      //    var kode_produk = $('input[name="kode_produk"]').val();
      //    $.ajax({
      //       url: '<?php echo base_url(); ?>produk/produk_detail/' + kode_produk,
      //       type: 'POST',
      //       data: {
      //          tambah_data: tambah_data,
      //          quantity: quantity,
      //          harga_produk: harga_produk,
      //          variasi_produk: variasi_produk
      //       },
      //       success: function(response) {
      //          $('#addCart').offcanvas('hide');
      //          $.toast({
      //             heading: "Keranjang Bertambah",
      //             position: "top-center",
      //             loaderBg: "#fff",
      //             icon: "success",
      //             hideAfter: 3000,
      //             stack: 1
      //          });
      //          cart_total();
      //       }
      //    })
      // });

      $('#produkAddForm').submit(function(e) {
         e.preventDefault();
         // var kode_produk = $('input[name="kode_produk"]').val();
         var user = $('#produkAddForm').serialize();
         $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>produk/addCostumerCart',
            dataType: 'json',
            data: user,
            success: function(response) {
               $('#addCart').offcanvas('hide');
               if (response.error) {
                  $.toast({
                     heading: response.pesan,
                     position: "top-center",
                     loaderBg: "#fff",
                     icon: "error",
                     hideAfter: 3000,
                     stack: 1
                  });
               } else {
                  $.toast({
                     heading: response.pesan,
                     position: "top-center",
                     loaderBg: "#fff",
                     icon: "success",
                     hideAfter: 3000,
                     stack: 1
                  });
                  cart_total();
               }
            }
         });

      });

      // upload bukti terima pesanan
      $("#submit").on('click', function() {
         var data = new FormData();
         data.append('gambar', $('#gambar').prop('files')[0]);
         data.append('invoice', $("#invoice").val());
         data.append('jasa_pengiriman', $("#jasa_pengiriman").val());

         $.ajax({
            url: '<?php echo base_url(); ?>transaksi/upload_bukti',
            type: 'POST',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
               $('#receipt').offcanvas('hide');
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