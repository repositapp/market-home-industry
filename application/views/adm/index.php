<div class="row margin-b-0">
   <div class="col-md-3">
      <div class="widget widget-chart white-bg padding-0">
         <div class="widget-title">
            <span class="label label-primary float-right"><a href="<?= base_url(); ?>produk/data_produk" style="font-weight: 400;font-size: 10px;display: inline;vertical-align: middle;padding: 0.26em 0.6em;color: #fff;">View</a></span>
            <h2 class="margin-b-0">Produk</h2>
         </div>
         <div class="widget-content">
            <h1 class="margin-b-10  text-primary"><?= $produk->num_rows(); ?></h1>
            <div class="font-500 text-primary float-right"><i class="icon-layers"></i></div>
            <p class="text-muted margin-b-0">Total Produk</p>
         </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="widget widget-chart white-bg padding-0">
         <div class="widget-title">
            <span class="label label-success float-right"><a href="<?= base_url(); ?>user/data_admin" style="font-weight: 400;font-size: 10px;display: inline;vertical-align: middle;padding: 0.26em 0.6em;color: #fff;">View</a></span>
            <h2 class="margin-b-0">Admin</h2>
         </div>
         <div class="widget-content">
            <h1 class="margin-b-10 text-success"><?= $admin->num_rows(); ?></h1>
            <div class="font-500 text-success float-right"><i class="icon-people"></i></div>
            <p class="text-muted margin-b-0">Total Admin</p>
         </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="widget widget-chart white-bg padding-0">
         <div class="widget-title">
            <span class="label label-warning float-right"><a href="<?= base_url(); ?>user/data_kurir" style="font-weight: 400;font-size: 10px;display: inline;vertical-align: middle;padding: 0.26em 0.6em;color: #fff;">View</a></span>
            <h2 class="margin-b-0">Kurir</h2>
         </div>
         <div class="widget-content">
            <h1 class="margin-b-10 text-warning"><?= $kurir->num_rows(); ?></h1>
            <div class="font-500 text-warning float-right"><i class="icon-people"></i></div>
            <p class="text-muted margin-b-0">Total Kurir</p>
         </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="widget widget-chart white-bg padding-0">
         <div class="widget-title">
            <span class="label label-danger float-right"><a href="<?= base_url(); ?>user/data_costumer" style="font-weight: 400;font-size: 10px;display: inline;vertical-align: middle;padding: 0.26em 0.6em;color: #fff;">View</a></span>
            <h2 class="margin-b-0">Costumer</h2>
         </div>
         <div class="widget-content">
            <h1 class="margin-b-10 text-danger"><?= $costumer->num_rows(); ?></h1>
            <div class="font-500 text-danger float-right"><i class="icon-people"></i></div>
            <p class="text-muted margin-b-0">Total Costumer</p>
         </div>
      </div>
   </div>

   <div class="col-md-3">
      <div class="widget widget-chart white-bg padding-0">
         <div class="widget-title">
            <span class="label label-primary float-right"><a href="<?= base_url(); ?>transaksi/riwayat_transaksi" style="font-weight: 400;font-size: 10px;display: inline;vertical-align: middle;padding: 0.26em 0.6em;color: #fff;">View</a></span>
            <h2 class="margin-b-0">Transaksi</h2>
         </div>
         <div class="widget-content">
            <h1 class="margin-b-10  text-primary"><?= $transaksi->num_rows(); ?></h1>
            <div class="font-500 text-primary float-right"><i class="icon-shuffle"></i></div>
            <p class="text-muted margin-b-0">Total Transaksi</p>
         </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="widget widget-chart white-bg padding-0">
         <div class="widget-title">
            <span class="label label-success float-right"><a href="<?= base_url(); ?>transaksi/transaksi_baru" style="font-weight: 400;font-size: 10px;display: inline;vertical-align: middle;padding: 0.26em 0.6em;color: #fff;">View</a></span>
            <h2 class="margin-b-0">Order Terbaru</h2>
         </div>
         <div class="widget-content">
            <h1 class="margin-b-10 text-success"><?= $transaksi_baru->num_rows(); ?></h1>
            <div class="font-500 text-success float-right"><i class="icon-basket-loaded"></i></div>
            <p class="text-muted margin-b-0">Total Order Terbaru</p>
         </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="widget widget-chart white-bg padding-0">
         <div class="widget-title">
            <span class="label label-warning float-right"><a href="<?= base_url(); ?>transaksi/transaksi_proses" style="font-weight: 400;font-size: 10px;display: inline;vertical-align: middle;padding: 0.26em 0.6em;color: #fff;">View</a></span>
            <h2 class="margin-b-0">Order Proses</h2>
         </div>
         <div class="widget-content">
            <h1 class="margin-b-10 text-warning"><?= $transaksi_proses->num_rows(); ?></h1>
            <div class="font-500 text-warning float-right"><i class="icon-basket-loaded"></i></div>
            <p class="text-muted margin-b-0">Total Order Proses</p>
         </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="widget widget-chart white-bg padding-0">
         <div class="widget-title">
            <span class="label label-danger float-right"><a href="<?= base_url(); ?>transaksi/transaksi_proses" style="font-weight: 400;font-size: 10px;display: inline;vertical-align: middle;padding: 0.26em 0.6em;color: #fff;">View</a></span>
            <h2 class="margin-b-0">Delivery</h2>
         </div>
         <div class="widget-content">
            <h1 class="margin-b-10 text-danger"><?= $transaksi_pengiriman->num_rows(); ?></h1>
            <div class="font-500 text-danger float-right"><i class="icon-basket-loaded"></i></div>
            <p class="text-muted margin-b-0">Total Delivery</p>
         </div>
      </div>
   </div>
</div>