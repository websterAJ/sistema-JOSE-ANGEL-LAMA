    <?php if (Islogin() && $http != "404"):?>
        </section>
        <!-- /wrapper -->
      </section>
      <footer class="site-footer">
        <div class="text-center">
          <p>
            &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
          </p>
          <div class="credits">
          </div>
          <a href="index.html#" class="go-top">
            <i class="fa fa-angle-up"></i>
            </a>
        </div>
      </footer>
    <?php endif; ?>
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <?php if (!Islogin()):?>
    <script type="text/javascript" src="<?= $_ENV['_BASE_URL_']?>assests/lib/jquery.backstretch.min.js"></script>
    <script>
      $.backstretch("<?= $_ENV['_BASE_URL_']?>assests/img/login-bg.jpg", {
        speed: 500
      });
    </script>
  <?php else: ?>
    <script class="include" type="text/javascript" src="<?= $_ENV['_BASE_URL_']?>assests/lib/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/jquery.scrollTo.min.js"></script>
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/jquery.sparkline.js"></script>
    <!--common script for all pages-->
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/common-scripts.js"></script>
    <script type="text/javascript" src="<?= $_ENV['_BASE_URL_']?>assests/lib/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="<?= $_ENV['_BASE_URL_']?>assests/lib/gritter-conf.js"></script>
    <!--script for this page-->
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/sparkline-chart.js"></script>
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/zabuto_calendar.js"></script>
    <!--script for this page-->
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/jquery-ui-1.9.2.custom.min.js"></script>
    <script type="text/javascript" src="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <script type="text/javascript" src="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/advanced-form-components.js"></script>
    <?php if (Islogin() && $http != "404"):?>
      <script type="application/javascript">
        $(document).ready(function() {
          $("#date-popover").popover({
            html: true,
            trigger: "manual"
          });
          $("#date-popover").hide();
          $("#date-popover").click(function(e) {
            $(this).hide();
          });

          
        });

        function myNavFunction(id) {
          $("#date-popover").hide();
          var nav = $("#" + id).data("navigation");
          var to = $("#" + id).data("to");
          console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
      </script>
    <?php endif; ?>
  <?php endif; ?>
</body>
</html>