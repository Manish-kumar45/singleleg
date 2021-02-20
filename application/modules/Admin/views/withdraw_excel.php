<?php
// pr($requests);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Withdraw Excel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <script>
 jQuery.fn.tableToCSV = function() {

    var clean_text = function(text){
        text = text.replace(/"/g, '\\"').replace(/'/g, "\\'");
        return '"'+text+'"';
    };

	$(this).each(function(){
			var table = $(this);
			var caption = $(this).find('caption').text();
			var title = [];
			var rows = [];

			$(this).find('tr').each(function(){
				var data = [];
				$(this).find('th').each(function(){
                    var text = clean_text($(this).text());
					title.push(text);
					});
				$(this).find('td').each(function(){
                    var text = clean_text($(this).text());
					data.push(text);
					});
				data = data.join(",");
				rows.push(data);
				});
			title = title.join(",");
			rows = rows.join("\n");

			var csv = title + rows;
			var uri = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
			var download_link = document.createElement('a');
			download_link.href = uri;
			var ts = new Date().getTime();
			if(caption==""){
				download_link.download = ts+".csv";
			} else {
				download_link.download = caption+"-"+ts+".csv";
			}
			document.body.appendChild(download_link);
			download_link.click();
			document.body.removeChild(download_link);
	});

};
$(function(){
    $("#export").click(function(){
        $("#export_table").tableToCSV();
    });
});
</script>
</head>
<body>

<div class="container">
  <h2>Withdraw Excel</h2>
  <button type="button" id="export">Export</button>
  <a href="<?php echo base_url('Admin/');?>" class="pull-right">Back</a>
  <table class="table" id="export_table">
    <thead>
      <tr>
        <th>#</th>

        <th>A/C No.</th>
        <th>Beneficiary Name</th>
        <th>Amount</th>
        <th>Payable Amount</th>
        <th>Payment Mode</th>
        <th>Date</th>
        <th>IFSC Code</th>
        <th>Payable Locaiton</th>
      </tr>
    </thead>
    <tbody>
        <?php
        foreach($requests as $key => $request)
        {
            echo'<tr>
                    <td>'.($key + 1).'</td>
                  
                    <td>'.$request['bank']['bank_account_number'].'</td>
                    <td>'.$request['bank']['account_holder_name'].'</td>
                    <td>'.$request['amount'].'</td>
                    <td>'.$request['payable_amount'].'</td>
                    <td>IMPS</td>
                    <td>'.$request['created_at'].'</td>
                    <td>'.$request['bank']['ifsc_code'].'</td>
                    <td></td>
                </tr>';
        }


        ?>

    </tbody>
  </table>
</div>

</body>
</html>
