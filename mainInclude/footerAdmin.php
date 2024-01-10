  <!-- FOOTER -->
<footer class="text-center p-3 bg-body-tertiary">
    <div>Copyright 2023 || Kelompok 5 RPL
    </div>
</footer>

  <!-- END -->

  <!-- JQuery Link -->
  <script src="../assets/js/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/slider.js"></script>
  <script src="../assets/js/all.min.js"></script>
  <script src="../assets/js/ajaxrequest.js?v=<?php echo time();?>"></script>
  <script src="../assets/js/adminajaxrequest.js?v=<?php echo time();?>"></script>
  

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