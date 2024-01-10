<!-- Start Header-->
<?php
$currentPage = 'bantuan';
include('./mainInclude/header.php');
?>
<!-- End Header-->
<style>
  .accordion {
    --bs-accordion-btn-bg: #AA6514;
    --bs-accordion-active-bg: #AA6514;
}
</style>
<div class="my-5">
        <h1 class="text-center">BANTUAN</h1>
</div>

<div class="containers p-3 mx-5 mb-5 bg-secondary">
        <div class="bg-white p-5">
            <div class="accordion p-3 mx-3" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header bg-primary text-white">
                    <button class="accordion-button text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Petunjuk Penggunaan Aplikasi
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Bagaimana cara menggunakan berbagai fitur aplikasi, navigasi, dan fungsi dasar.
                        <br>
                        <br>
                        <strong><a href="bantuan-petunjuk.php" class="text-decoration-none text-black">
                            Baca Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                            </svg>
                        </a></strong>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        FAQ (Pertanyaan yang Sering Diajukan)
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Jawaban atas pertanyaan umum yang mungkin timbul saat pengguna menggunakan aplikasi.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Informasi Kontak Dukungan
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <p> <b>HUBUNGI KAMI</b></p>
                    <p>Email : admin@gmail.com</p>
                    <p>No HP / WA: +62 812-3456-7890</p>
                    <a aria-label="Chat on WhatsApp" href="https://wa.me/+6281234567890"> <img alt="Chat on WhatsApp"
                        src="assets/img/WhatsAppButtonGreenSmall.svg" /> </a>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                        Kebijakan Privasi dan Syarat Penggunaan
                      </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        Bagaimana data pengguna akan diolah, dan syarat-syarat penggunaan aplikasi.
                      </div>
                    </div>
                  </div>
              </div>
        </div>
    </div>


<!-- Start Footer & Including JS-->
<?php
  $currentPage = 'resep';
  include('./mainInclude/footer.php');
?>
<!-- End Footer-->