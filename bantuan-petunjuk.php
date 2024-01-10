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
    <div class="card">
      <div class="card-header bg-primary text-white">
        Petunjuk Penggunaan Aplikasi
      </div>
      <div class="card-body" style="max-height: 400px; overflow-y: auto;">
        <h5>1. Registrasi dan Login:</h5>
        <ul>
          <li>Pengguna guest dapat menjelajahi resep umum tanpa login.</li>
          <li> Pengguna harus mendaftar untuk membeli/mengakses resep original.</li>
          <li> Klik "Daftar" dan ikuti langkahlangkah pendaftaran.</li>
          <li> Masuk dengan mengklik "Masuk" setelah mendaftar .</li>
        </ul>
        <h5>2. Menu Beranda:</h5>
        <ul>
          <li> Setelah login, ditampilan menu beranda dengan resep umum dan original. </li>
          <li> Ditampilkan resep-resep yang menjadi rekomendasi begi pengguna. </li>
        </ul>
        <h5>3. Menu Resep:</h5>
        <ul>
          <li> Menu resep menyajikan daftar resep umum dan resep original. </li>
          <li> Dapat dilhat resep berdasarkan kategori umum dan original. </li>
          <li> Pencarian resep dengan kata kunci nama hidangan. </li>
        </ul>
        <h5>4. Detail Resep Umum:</h5>
        <ul>
          <li> Klik judul resep untuk melihat detail informasi resep. </li>
          <li> Informasi meliputi nama masakan, deskripsi singkat, author, waktu memasak, asal daerah masakan, bahan,
            alat, dan langkah-langkah. </li>
          <li> Panduan memasak ditampilkan berurutan dan mudah dipahami. </li>
        </ul>
        <h5>5. Beli Resep Original :</h5>
        <ul>
          <li> Klik judul resep original untuk melihat masuk ke halaman "Preview beli resep ori". </li>
          <li> Klik beli untuk melanjutkan pembelian resep ori. </li>
          <li> untuk membeli resep ori diharuskan daftar dan masuk aun terlebih dahulu. </li>
          <li> pada halaman "Pembelian resep ori" terdapat informasi order id, email pembeli, dan harga untuk resep ori.
            Kemudiaan klik "Beli". </li>
        </ul>
        <h5>6. Detail Resep Original:</h5>
        <ul>
          <li> Klik judul resep original untuk melihat detail informasi resep. </li>
          <li> Informasi meliputi nama masakan, deskripsi singkat, author, waktu memasak, asal daerah masakan, bahan,
            alat, dan langkah-langkah. </li>
          <li> Panduan memasak ditampilkan berurutan dan mudah dipahami. </li>
          <li> Dapat memberi rating dan ulasan untuk resep original. </li>
          <li> Ditampilkan ulasan dari pengguna lain. </li>
        </ul>
        <h5>7. Menu Profil Pengguna:</h5>
        <ul>
          <li> Akses profil untuk melihat, kelola postingan resep, melihat resep ori yang dibeli, meligat riwayat
            pembelian resep ori, mengubah password aun, dan keluar dari akun. </li>
          <li> Informasi akun atau profil dapat diedit atau ditambahkan. </li>
        </ul>
        <h5>8. Posting Resep:</h5>
        <ul>
          <li> Masuk ke menu "Profil" dan klik "postingan resep" </li>
          <li> Tambah resep pribadi dengan mengklik "Tambah resep" pada menu utama. </li>
          <li> Isi bahan, langkah-langkah, dan foto makanan jika ada. </li>
          <li> Ubah resep dengan klik "Edit". </li>
          <li> Hapus resep dengan klik "Hapus". </li>
        </ul>
        <h5>9. Lihat Resep Ori:</h5>
        <ul>
          <li> Masuk ke menu "Profil" dan klik "Resep Ori". </li>
          <li> Daftar resep original yang telah dibeli beserta informasinya akan ditampilkan. </li>
        </ul>
        <h5>10. Riwayat Pembelian Resep:</h5>
        <ul>
          <li> Masuk ke menu "Profil" dan klik "Riwayat Pembelian". </li>
          <li> Informasi berupa daftar riwayat pembelian resep original akan ditampilkan. </li>
        </ul>
        <h5>11. Ubah Password Akun:</h5>
        <ul>
          <li> Masuk ke menu "Profil" dan klik "Ubah Password". </li>
          <li> Masukkan informasi berupa "email" beserta "password baru" untuk mengubah password akun. </li>
        </ul>
        <h5>12. Keluar:</h5>
        <ul>
          <li> Untuk mengeluarkan akun dari aplikasi, masuk ke menu "Profil" dan klik "keluar". </li>
        </ul>
        <div class="d-flex justify-content-end">
          <a href="bantuan.php" class="btn btn-primary">Kembali</a>
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