// Fungsi preview
function previewBeforeUpload(ids) {
  ids.forEach((id) => {
    const element = document.querySelector("#" + id);
    if (element) {
      element.addEventListener("change", function (e) {
        if (e.target.files.length == 0) {
          return;
        }
        let file = e.target.files[0];
        let url = URL.createObjectURL(file);
        const previewDiv = document.querySelector("#" + id + "-preview div");
        const previewImg = document.querySelector("#" + id + "-preview img");
        if (previewDiv && previewImg) {
          previewDiv.innerText = file.name;
          previewImg.src = url;
        }
      });
    }
  });
}

// ID untuk thumbnail dan induk langkah
let fileIDs = ["file-0", "file-1"];

// Memanggil fungsi dengan array ID
previewBeforeUpload(fileIDs);

$('#add_langkah').click(function () {
  var ul = $('#langkah_list');
  var count = ul.children().length + 1;
  var li = $(`<li>
                <input type="text" class="form-control mt-3" name="langkah_nama[]" placeholder="Nama Step">
                <div class="prev">
                  <div class="grid">
                    <div class="prev-element">
                      <input type="file" id="file-${count}" name="langkah_gambar[]" accept="image/*">
                      <label for="file-${count}" id="file-${count}-preview">
                        <img src="../preview/preview.jpg" alt="">
                        <div><span>+</span></div>
                      </label>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-danger mt-3 remove-langkah">Remove</button>
                <hr>
              </li>`);
  ul.append(li);

// Menambah event listener ke elemen yang baru ditambahkan
previewBeforeUpload([`file-${count}`]);

// Hapus Langkah-langkah saat tombol "Remove" ditekan
$(document).on('click', '.remove-langkah', function () {
  $(this).parent().remove();
});
});
