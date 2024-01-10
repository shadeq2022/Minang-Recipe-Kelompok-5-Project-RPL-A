  <!-- FOOTER -->
  <footer class="text-center p-3 bg-body-tertiary">
    <div>Copyright 2023 || Kelompok 5 RPL || 
      <a href="#login" data-bs-toggle="modal" data-bs-target="#adminLoginModalCenter">Administrator Login</a>
    </div>
</footer>

<!-- MODAL ADMIN LOGIN -->
<div class="modal fade" id="adminLoginModalCenter" tabindex="-1" aria-labelledby="adminLoginModalCenterLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="adminLoginModalCenterLabel">Admin Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
          <form id="adminLoginForm">
            <div class="mb-3">
              <label for="adminLogemail" class="form-label">Email address</label>
              <input type="email" class="form-control" name="adminLogemail" id="adminLogemail">
            </div>
            <div class="mb-3">
              <label for="adminLogpass" class="form-label">Password</label>
              <input type="password" class="form-control" name="adminLogpass" id="adminLogpass">
            </div>
          </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary d-grid gap-4 col-11 mx-auto" id="adminLoginBtn" onclick="checkAdminLogin()">Masuk</button>
          <div class="d-grid gap-4 col-11 mx-auto">
            <div id = "statusAdminLogMsg"></div>
          </div>
      </div>
    </div>
  </div>
</div>
<!--End MODAL ADMIN LOGIN-->


  <!-- END -->

  <!-- JQuery Link -->
  <script src="../assets/js/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/slider.js"></script>
  <script src="../assets/js/all.min.js"></script>
  <script src="../assets/js/adminajaxrequest.js?v=<?php echo time();?>"></script>
  <script src="../preview/script-prev.js"></script>
  

  <!-- Tabel js -->
  
  
  
  <!-- Page level plugins -->
  <script src="../assets/vendor-tables/datatables/jquery.dataTables.min.js"></script>
  <script src="../assets/vendor-tables/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
  <script>
      $('#dataTableHover').DataTable({
        "lengthMenu": [5, 10, 15, 20]
      });
      $('#dataTable').DataTable({
        "lengthMenu": [5, 10, 15, 20]
      });
    </script>

  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>

</body>

</html>