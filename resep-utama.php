<!-- Start Header-->
<?php
$currentPage = 'resep';
include('./mainInclude/header.php');
?>
<!-- End Header-->

<div class="container mt-4">
    <div class="row">
        <div class="card col-2 mb-3 bg-light">
            <div class="mt-4">
                <h3><i class="fa-solid fa-filter"></i> Filters</h3>
            </div>
            <hr>
            <h5>By category:</h5>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="all"
                    checked>
                <label class="form-check-label" for="flexRadioDefault1">
                    All
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="ori">
                <label class="form-check-label" for="flexRadioDefault2">
                    Ori
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3"
                    value="umum">
                <label class="form-check-label" for="flexRadioDefault3">
                    Umum
                </label>
            </div>
        </div>

        <div class="card col-9 mb-3">
            <div class="mt-4">
                <h3><img src="assets/img/resep-pot_food.svg" width="4%" class=""> Mau cari resep apa?</h3>
                <hr>
            </div>

            <div class="row">
                <div class="col-11">
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari judul resep...">
                </div>
                <div class="col-1">
                    <button class="btn btn-primary" onclick="searchRecipe()"><i class="fa fa-search"></i></button>
                </div>
            </div>


            <div class="row row-cols-1 row-cols-md-3 g-4 mt-2 mb-3" id="card-container">

                <!-- Container untuk menampilkan data dari PHP -->
            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end" id="pagination">
                    <!-- Konten pagination akan dimuat disini -->
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Start Footer & Including JS-->
<?php
$currentPage = 'resep';
include('./mainInclude/footer.php');
?>
<!-- End Footer-->

<script>
    // Function untuk memuat data berdasarkan kategori dan halaman
    $(document).ready(function () {
        let totalPages = 0;
        let currentPage = 1;


        function loadDataByCategoryAndPage(category, page) {
            $.ajax({
                url: "resep-load_data_by_category.php",
                type: "POST",
                data: {
                    category: category,
                    page: page
                },
                success: function (response) {
                    // Tangkap nilai totalPages dari respons JSON
                    var totalPages = response.totalPages;

                    // Memanggil fungsi loadPagination dengan nilai totalPages
                    loadPagination(totalPages);

                    // Setelah mendapatkan informasi tentang jumlah halaman, Anda bisa membuat fungsi untuk menampilkan resep
                    loadRecipeCards(category, page);
                },
                error: function (xhr, status, error) {
                    console.error(error); // Tangani kesalahan jika terjadi
                }
            });
        }



        function loadPagination(total) {
            totalPages = total;
            var pagination = $("#pagination");
            pagination.empty();

            if (totalPages > 1) {
                var prevButton = $("<li></li>").addClass("page-item").append(
                    $("<a></a>").addClass("page-link").attr("href", "#").text("Previous")
                );
                pagination.append(prevButton);
            }

            for (var i = 1; i <= totalPages; i++) {
                var li = $("<li></li>").addClass("page-item");
                var link = $("<a></a>").addClass("page-link pagination-link").attr("href", "#").attr("data-page", i).text(i);
                if (i === currentPage) {
                    li.addClass("active");
                }
                li.append(link);
                pagination.append(li);
            }

            if (totalPages > 1) {
                var nextButton = $("<li></li>").addClass("page-item").append(
                    $("<a></a>").addClass("page-link").attr("href", "#").text("Next")
                );
                pagination.append(nextButton);
            }
        }

        function resetCurrentPage() {
            currentPage = 1; // Reset ke halaman pertama saat mengubah kategori
        }

        // Function to handle pagination click events
        $("#pagination").on("click", ".pagination-link", function (e) {
            e.preventDefault();
            var page = parseInt($(this).attr("data-page"));
            if (page !== currentPage) {
                currentPage = page;
                var selectedCategory = $("input[name='flexRadioDefault']:checked").val();
                loadDataByCategoryAndPage(selectedCategory, currentPage);
            }
        });

        // Function to handle "Previous" and "Next" button click events
        $("#pagination").on("click", "li:contains('Previous')", function (e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                var selectedCategory = $("input[name='flexRadioDefault']:checked").val();
                loadDataByCategoryAndPage(selectedCategory, currentPage);
            }
        });

        $("#pagination").on("click", "li:contains('Next')", function (e) {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                var selectedCategory = $("input[name='flexRadioDefault']:checked").val();
                loadDataByCategoryAndPage(selectedCategory, currentPage);
            }
        });


        function loadRecipeCards(category, page) {
            $.ajax({
                url: "resep-load_recipe_cards.php", // Skrip yang menampilkan kartu resep dalam HTML
                type: "POST",
                data: {
                    category: category,
                    page: page
                },
                success: function (response) {
                    $("#card-container").html(response); // Tampilkan kartu resep
                },
                error: function (xhr, status, error) {
                    console.error(error); // Tangani kesalahan jika terjadi
                }
            });
        }

        $("input[name='flexRadioDefault']").change(function () {
            var selectedCategory = $("input[name='flexRadioDefault']:checked").val();
            resetCurrentPage(); // Reset halaman saat mengubah kategori
            loadDataByCategoryAndPage(selectedCategory, currentPage);
        });

        $(document).on("click", ".pagination-link", function (e) {
            e.preventDefault();
            var page = $(this).attr("data-page");
            var selectedCategory = $("input[name='flexRadioDefault']:checked").val();
            loadRecipeCards(selectedCategory, page);
        });

        loadDataByCategoryAndPage('all', 1); // Load data default
    });


    function searchRecipe() {
        var searchKeyword = document.getElementById("searchInput").value.trim();
        var selectedCategory = $("input[name='flexRadioDefault']:checked").val();
               

        currentPage = 1; // Reset halaman saat melakukan pencarian

        $.ajax({
            url: "resep-search_recipe.php", // Ubah ini sesuai dengan skrip PHP Anda untuk pencarian
            type: "POST",
            data: {
                category: selectedCategory,
                keyword: searchKeyword,
                page: currentPage
            },
            success: function (response) {
                $("#card-container").html(response); // Tampilkan hasil pencarian
                // Memuat pagination kembali jika diperlukan
                loadPagination(totalPages); // Pastikan totalPages sudah ada sebelumnya
            },
            error: function (xhr, status, error) {
                console.error(error); // Tangani kesalahan jika terjadi
            }
        });
    }

</script>
</body>

</html>