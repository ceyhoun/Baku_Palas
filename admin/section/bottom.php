       <!-- Sticky Footer -->

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

    <script>




      fetch("apiAdmin.php").then(res=>res.json()).then(function(item){
            item.forEach(element => {
                country.innerHTML +=`<option value=${element.country}>${element.country}</option>`;
            });
        })

      //! confrim 
      document.querySelectorAll('.deleteRezervation').forEach(button => {
        button.addEventListener('click', function (event) {
          event.preventDefault(); 
          const confirmChange = confirm('Rezervasiya Silinsin mi?');
          if (confirmChange) {
            window.location.href = this.getAttribute('href');

          }else{
            event.preventDefault();

          }
        });
      });

      document.querySelectorAll('.deleteType').forEach(button => {
        button.addEventListener('click', function (event) {
          event.preventDefault(); 
          const confirmChange = confirm('Otaq Növü Silinsin mi?');
          if (confirmChange) {
            window.location.href = this.getAttribute('href');

          }else{
            event.preventDefault();

          }
        });
      });
      

      document.getElementById('alertsDropdown').addEventListener('click', function() {
    const badge = document.getElementById('notificationBadge');
    if (badge) {
        badge.innerHTML=0;
    }
});


    </script>

  </body>

</html>

