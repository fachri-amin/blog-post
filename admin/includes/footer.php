<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= BASE_URL_ADMIN; ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= BASE_URL_ADMIN; ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= BASE_URL_ADMIN; ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= BASE_URL_ADMIN; ?>/assets/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= BASE_URL_ADMIN; ?>/assets/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= BASE_URL_ADMIN; ?>/assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= BASE_URL_ADMIN; ?>/assets/plugins/raphael/raphael.min.js"></script>
<script src="<?= BASE_URL_ADMIN; ?>/assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= BASE_URL_ADMIN; ?>/assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?= BASE_URL_ADMIN; ?>/assets/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?= BASE_URL_ADMIN; ?>/assets/dist/js/pages/dashboard2.js"></script>
<script src="<?= BASE_URL ?>node_modules/summernote/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
      $('#summernote').summernote({
        placeholder: 'Create your post',
        tabsize: 2,
        height: 500,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    });
  </script>
</body>
</html>
