<section class="px-15 top-space pt-0">
   <div class="help-img">
      <img src="<?= base_url(); ?>assets/mobile/images/help.jpg" class="img-fluid rounded-1 w-100" alt="">
   </div>
   <div class="faq-section section-t-space section-b-space">
      <h4 class="fw-bold mb-1">Dukungan Pelanggan</h4>
      <p class="content-color">Halo Costumer, jika anda mengalami masalah dalam penggunaan platform ini dan membutuhkan bantuan, anda dapat menguhubungi kami melalui kontak dibawah ini.</p>
   </div>
</section>

<div class="sidebar-content" style="margin-top: -50px;">
   <ul class="link-section">
      <li>
         <a href="tel:<?= $kontak['telepon_web']; ?>">
            <div class="content">
               <h4>Nomor Telepon</h4>
               <h6><?= $kontak['telepon_web']; ?></h6>
            </div>
         </a>
      </li>
      <li>
         <a href="tel:<?= $kontak['fax_web']; ?>">
            <div class="content">
               <h4>Nomor Fax</h4>
               <h6><?= $kontak['fax_web']; ?></h6>
            </div>
         </a>
      </li>
      <li>
         <a href="mailto:<?= $kontak['email_web']; ?>">
            <div class="content">
               <h4>Alamat Email</h4>
               <h6><?= $kontak['email_web']; ?></h6>
            </div>
         </a>
      </li>
   </ul>
</div>