<!-- Common Plugins -->
<script src="<?= base_url(); ?>assets/desktop/lib/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/bootstrap/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/desktop/lib/bootstrap/js/bootstrap.min.js"></script>

<script>
   $(document).ready(function() {
      window.onafterprint = window.close;
      window.print();
   });
</script>

</body>

</html>