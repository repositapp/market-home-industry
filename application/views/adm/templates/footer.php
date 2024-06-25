<footer class="footer">
   <span>Copyright &copy; 2022 HINDES</span>
</footer>

</section>

<script type="text/javascript">
   let url = '<?= base_url(); ?>';
</script>

<!-- Common Plugins -->
<script src="<?= base_url(); ?>assets/desktop/lib/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/js/app/search.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/bootstrap/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/pace/pace.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/nano-scroll/jquery.nanoscroller.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/metisMenu/metisMenu.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/js/custom.js"></script>

<!--Chart Script-->
<script src="<?= base_url(); ?>assets/desktop/lib/chartjs/chart.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/chartjs/chartjs-sass.js"></script>

<!-- Datatables-->
<script src="<?= base_url(); ?>assets/desktop/lib/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/toast/jquery.toast.min.js"></script>

<!-- Summernote -->
<script src="<?= base_url(); ?>assets/desktop/lib/summernote/summernote.js"></script>

<!-- DataTimePicker -->
<script type="text/javascript" src="<?= base_url(); ?>assets/desktop/lib/bootstrap-daterangepicker/moment.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/desktop/lib/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="<?= base_url(); ?>assets/desktop/js/script.js"></script>

<script>
   <?= $this->session->flashdata("msg"); ?>

   $(document).ready(function() {
      setInterval(function() {
         load_last_notification();
      }, 25000);

      function load_last_notification() {
         $.ajax({
            url: "<?php echo base_url(); ?>home/show_notif",
            method: "POST",
            dataType: 'json',
            data: {
               status: 0
            },
            success: function(data) {
               if (data.total > '0') {
                  $(".toastr1").show(function() {
                     $.toast({
                        heading: "Info!!!",
                        text: "Terdapat pesanan baru, mohon diperiksa...",
                        position: "top-right",
                        loaderBg: "#fff",
                        icon: "info",
                        hideAfter: 15000,
                        stack: 1
                     });
                  });
               }
            }
         })
      }
   });
</script>

</body>

</html>