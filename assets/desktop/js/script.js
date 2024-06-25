$(document).ready(function() {
   $('#datatable').dataTable();
   $('#datatable2').dataTable();

   //summernote
   $(function() {
      $('.summernote').summernote({
         height: '300px',
      });

      $('.summernote1').summernote({
         placeholder: 'Tulis sesuatu disini...',
         height: '300px',
         toolbar: [
            ['headline', ['style']],
            ['fontname', ['fontname']],
            ['textsize', ['fontsize']],
            ['style', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
            ['color', ['color']],
            ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen']]
         ]
      });

      $('.summernote2').summernote({
         placeholder: 'Tulis sesuatu disini...',
         height: '300px',
         toolbar: [
            ['textsize', ['fontsize']],
            ['style', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
            ['color', ['color']],
            ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
            ['view', ['fullscreen']]
         ]
      });

      $('.summernote3').summernote({
         placeholder: 'Masukan alamat lengkap dan link lokasi menggunakan tollbar link diatas ini...',
         height: '100px',
         toolbar: [
            ['color', ['color']],
            ['insert', ['link']]
         ]
      });

      $('.summernote4').summernote({
         placeholder: 'Tulis sesuatu disini...',
         height: '300px',
         toolbar: [
            ['headline', ['style']],
            ['fontname', ['fontname']],
            ['textsize', ['fontsize']],
            ['style', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
            ['color', ['color']],
            ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
            ['insert', ['picture']],
            ['view', ['fullscreen']]
         ]
      });
   });

   //Melakukan proses multiple input
   var maxGroup = 5;
   var maxVariasiSize = 30;
   var maxAtributLainnya = 30;

   // Tambah Field Gambar
   $(".addMoreGambar").click(function() {
      if ($('body').find('.tambGambar').length < maxGroup) {
         var fieldHTML = '<div class="form-group row tambGambar">' + $(".tambGambarCopy").html() + '</div>';
         $('body').find('.tambGambar:last').after(fieldHTML);
      } else {
         alert('Maximum ' + maxGroup + ' groups are allowed.');
      }
   });

   // Tambah Field Variasi
   $(".addMoreVariasi").click(function() {
      if ($('body').find('.tambVariasi').length < maxVariasiSize) {
         var fieldHTML = '<div class="form-group row tambVariasi">' + $(".tambVariasiCopy").html() + '</div>';
         $('body').find('.tambVariasi:last').after(fieldHTML);
      } else {
         alert('Maximum ' + maxVariasiSize + ' groups are allowed.');
      }
   });

   // Tambah Field Atribut Lainnya
   $(".addMoreAtribut").click(function() {
      if ($('body').find('.tambAtribut').length < maxAtributLainnya) {
         var fieldHTML = '<div class="form-group row tambAtribut">' + $(".tambAtributCopy").html() + '</div>';
         $('body').find('.tambAtribut:last').after(fieldHTML);
      } else {
         alert('Maximum ' + maxAtributLainnya + ' groups are allowed.');
      }
   });

   // Hapus Field Gambar
   $("body").on("click", ".removeGambar", function() {
      $(this).parents(".tambGambar").remove();
   });

   // Hapus Field Variasi
   $("body").on("click", ".removeVariasi", function() {
      $(this).parents(".tambVariasi").remove();
   });

   // Hapus Field Atribut Lainnya
   $("body").on("click", ".removeAtribut", function() {
      $(this).parents(".tambAtribut").remove();
   });
});

// Datepicker
$(function() {
   /* Waktu Mulai Pembangunan */
   $('input[id="date"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true
   });
});

//Gambar
function Toggle() {
   var temp = document.getElementById("thresholdconfig");
   if (temp.type === "password") {
      temp.type = "text";
   } else {
      temp.type = "password";
   }
}

var _validFileExtensions = [".png", ".jpg", ".jpeg", ".mp4", ".avi", ".mkv", ".3gp", ".mpg", ".mpeg"];

function validate(file) {
   if (file.type == "file") {
      var sFileName = file.value;
      if (sFileName.length > 0) {
         var blnValid = false;
         for (var j = 0; j < _validFileExtensions.length; j++) {
            var sCurExtension = _validFileExtensions[j];
            if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
               var file_size = $('#gambar')[0].files[0].size;
               if (file_size > 15000000) {
                  alert("Maaf. File Terlalu Besar ! Maksimal Upload 3 MB");
                  break;
               } else {
                  blnValid = true;
                  break;
               }
            }
         }

         if (!blnValid) {
            alert("Maaf Hanya Boleh File yang Berextensi : " + _validFileExtensions.join(", "));
            file.value = "";
            return false;
         }
      }
   }
   return true;
}

var _validFileExtensionPictures = [".png", ".jpg", ".jpeg", ".ico"];

function validatePictures(file) {
   if (file.type == "file") {
      var sFileName = file.value;
      if (sFileName.length > 0) {
         var blnValid = false;
         for (var j = 0; j < _validFileExtensionPictures.length; j++) {
            var sCurExtension = _validFileExtensionPictures[j];
            if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
               var file_size = $('#gambar')[0].files[0].size;
               if (file_size > 3000000) {
                  alert("Maaf. File Terlalu Besar ! Maksimal Upload 3 MB");
                  break;
               } else {
                  blnValid = true;
                  break;
               }
            }
         }

         if (!blnValid) {
            alert("Maaf Hanya Boleh File yang Berextensi : " + _validFileExtensionPictures.join(", "));
            file.value = "";
            return false;
         }
      }
   }
   return true;
}

var _validFileExtensionsIkon = [".png"];

function validateIkon(file) {
   if (file.type == "file") {
      var sFileName = file.value;
      if (sFileName.length > 0) {
         var blnValid = false;
         for (var j = 0; j < _validFileExtensionsIkon.length; j++) {
            var sCurExtension = _validFileExtensionsIkon[j];
            if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
               var file_size = $('#gambar')[0].files[0].size;
               if (file_size > 100000) {
                  alert("Maaf. File Terlalu Besar ! Maksimal Upload 1 MB");
                  break;
               } else {
                  blnValid = true;
                  break;
               }
            }
         }

         if (!blnValid) {
            alert("Maaf Hanya Boleh File yang Berextensi : " + _validFileExtensionsIkon.join(", "));
            file.value = "";
            return false;
         }
      }
   }
   return true;
}