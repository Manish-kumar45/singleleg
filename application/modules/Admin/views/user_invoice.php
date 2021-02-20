<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Paid users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users Invoices</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default" onclick="export_table_to_csv();">Export<i class="fa fa-download"></i></button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>details</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($users as $key => $user) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>

                                <td><h1 style="font-size:20px"><br><br><br>To, <br>
                                  <?php echo $user['name'] ; ?> ( <?php echo $user['user_id']; ?>) <br>
                                  <b>Address: </b>  <?php echo $user['address']; ?> <br>
                                  <b>  Postal Code: </b> <?php echo $user['postal_code']; ?> <br>
                                    <b>Mobile: </b> <?php echo $user['phone']; ?> <br>
                                    <b>Products: </b> <?php echo 'Jeans : ' .$user['jeans'] .'<br> T-shirt : ' . $user['t_shirt'] . '<br> Shoes : '.$user['shoes']; ?> </h1>
                                  <div style="text-align:right; width:100%; float:left; text-align:right">
                                    <h1 style="font-size:20px; font-weight:bold">From <br>
                                     <b>Amazing Deal India </b> <br>
                                      4/156, Vipul Khand, Gomti Nagar, Lucknow - 226010  <br> Helpline: 8957722777</h1>
                                    <br>
                                    <?php
                                    if($user['invoice_status'] == 1){
                                      echo'Courier Company Name :' .$user['courier_company'].'<br>';
                                      echo'Courier Company Name :' .$user['courier_number '];
                                    }
                                    
                                    ?>
                                  </div>
                                </td>
                             </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ?>
<script>
function download_csv(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV FILE
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanzamos
    downloadLink.click();
}

function export_table_to_csv() {
    var html = document.getElementById("tableView").outerHTML;
    var filename = 'invoice.csv';
	var csv = [];
	var rows = document.querySelectorAll("table tr");

    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");

        for (var j = 0; j < cols.length; j++)
            row.push(cols[j].innerText);

		csv.push(row.join(","));
	}

    // Download CSV
    download_csv(csv.join("\n"), filename);
}

// document.querySelector("button").addEventListener("click", function () {
//     var html = document.querySelector("table").outerHTML;
// 	export_table_to_csv(html, "table.csv");
// });

</script>
