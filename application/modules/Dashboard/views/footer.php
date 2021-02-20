

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  
  <!-- Default to the left -->
  <strong>Copyright &copy; <?php echo year.'.'.title;?>.</strong> All rights reserved. {elapsed_time}
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/')?>dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url('assets/')?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url('assets/')?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>

$("#tableView").DataTable();
</script>
<script>
function token(){
    const url = "<?php echo base_url('Dashboard/Support/generateToken');?>";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("demo").innerHTML =
        this.responseText;
        }
    };
    xhttp.open("GET",url, true);
    xhttp.send();
}
</script>
</body>
</html>
