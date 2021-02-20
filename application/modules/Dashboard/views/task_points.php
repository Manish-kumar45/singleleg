<?php include_once'header.php'; ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Task Points</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Task Points</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-white p-4 mb-4">
                        <?php
                        
                            ?>
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Points</td>
                                            <td>User ID</td>
                                            <td>Date</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($task_links as $key => $links) {
                                            echo'<tr>';
                                            echo'<td>' . ($key + 1) . '</td>';
                                            echo'<td> ' . $links['points'] . '</td>';
                                            echo'<td> ' . $links['user_id'] . '</td>';
                                            echo'<td> ' . $links['created_at'] . '</td>';
                                            echo'</tr>';
                                        }
                                        ?>
                                    </tbody>    
                                </table>

                                <div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once'footer.php'; ?>