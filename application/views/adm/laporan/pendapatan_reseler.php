<div class="row">

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Laporan Pendapatan Reseler
               </div>
               <div class="col-md-4">
                  <div class="float-right">
                     <a href="<?= base_url(); ?><?= $menu_link; ?>" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-body">
            <form id="pendReseler">
               <fieldset style="padding-bottom: 0px;">
                  <div class="row justify-content-between mb-4">
                     <div class="col-md-8 align-self-end">
                        <strong>Filter Data</strong>
                     </div>
                     <div class="col-md-4">
                        <div class="float-right">
                           <button id="submit" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> <span id="srcText"></span></button>

                           <button id="cetak" class="btn btn-sm btn-success" style="display:none;" onclick="window.print()"><i class="fa fa-print"></i> Cetak Data</button>
                        </div>
                     </div>
                  </div>

                  <input type="hidden" name="search_data" value="cari">

                  <div class="form-group row">
                     <div class="col-sm-3">
                        <select id="reseler" name="reseler" class="form-control m-b" required>
                           <option selected="selected" value="all">Semua Reseler</option>
                           <?php foreach ($data_reseler->result_array() as $reseler) : ?>
                              <option value="<?= $reseler['id_user']; ?>"><?= $reseler['nm_toko']; ?> (<?= $reseler['nm_reseler']; ?>)</option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                              <input type="text" id="date" name="date_start" placeholder="Mulai tanggal.." autocomplete="off" required />
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                              <input type="text" id="date" name="date_end" placeholder="Sampai tanggal.." autocomplete="off" required />
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-1 text-center align-self-center">
                        atau
                     </div>
                     <div class="col-sm-2">
                        <select id="tgl_lainnya" name="tgl_lainnya" class="form-control m-b" required>
                           <option value="0">-Pilihan Lainnya-</option>
                           <option value="1">Hari Ini</option>
                           <option value="2">Bulan Ini</option>
                           <option value="3">Tahun Ini</option>
                        </select>
                     </div>
                  </div>
               </fieldset>
            </form>

            <table style="width: 100%;">
               <tbody>
                  <tr>
                     <th class="text-center" style="font-size: 18px; font-weight:600;" colspan="2">Laporan Pendapatan Reseler</th>
                  </tr>
                  <tr style="border-bottom: 1px dashed #e9ecef;">
                     <td style="font-size: 14px; padding-bottom: 10px;">Tanggal : <span id="tglPend"></span></td>
                     <td class="text-right" style="font-size: 14px; padding-bottom: 10px;">Jumlah : <span id="jumPend"></span> Data</td>
                  </tr>
               </tbody>
            </table>

            <table class="table mt-3">
               <thead>
                  <tr>
                     <th width="40">No.</th>
                     <th>Tanggal</th>
                     <th>Reseler</th>
                     <th>Deskripsi</th>
                     <th>Penjualan</th>
                     <th>Pengeluaran</th>
                     <th>Keuntungan</th>
                  </tr>
               </thead>
               <tbody id="tblDataRes">
               </tbody>
               <tfoot id="htDataRes">
               </tfoot>
            </table>
         </div>
      </div>
   </div>
</div>