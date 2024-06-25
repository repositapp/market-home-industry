<div class="row">

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Laporan Pendapatan Kurir
               </div>
               <div class="col-md-4">
                  <div class="float-right">
                     <a href="<?= base_url(); ?><?= $menu_link; ?>" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-body">
            <form id="pendKurir">
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

                  <div class="form-group row">
                     <div class="col-sm-3">
                        <select id="kurir" name="kurir" class="form-control m-b" required>
                           <option selected="selected" value="all">Semua Kurir</option>
                           <?php foreach ($data_kurir as $kurir) : ?>
                              <option value="<?= $kurir['id_user']; ?>"><?= $kurir['nm_kurir']; ?></option>
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
                     <th class="text-center" style="font-size: 18px; font-weight:600;" colspan="2">Laporan Pendapatan Kurir</th>
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
                     <th>Invoice</th>
                     <th>Kurir</th>
                     <th>Tujuan</th>
                     <th>Jumlah</th>
                     <th>Upah</th>
                  </tr>
               </thead>
               <tbody id="tblDataKur">
               </tbody>
               <tfoot id="htDataKur">
               </tfoot>
            </table>
         </div>
      </div>
   </div>
</div>