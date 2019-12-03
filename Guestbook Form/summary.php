<?php
require "guestbookDBconnect.php";
session_start();
//var_dump($_SESSION);
//Start a session



//If user is not logged in, reroute them to the login page
if(!isset($_SESSION['username'])){
    header('location: login.php');
}
?>

<!--Link CDN  for use of jQuery table-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Ropa+Sans&display=swap"
          rel="stylesheet">


    <!--Link CDN  for use of jQuery table-->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

<!--Title card for tab-->
<title>Guestbook Summary Page</title>
</head>
<body>
<!-- Construct table to display a summary of dreamers that have submitted to the database, via the volunteer page-->
<div class="container container-fluid">
<table id="myTable" class="display table table-striped ">
    <thead class="thead-dark">
    <?php
    //Create Query that selects the column names
    $columnSQL = "SELECT * FROM guestbook LIMIT 1";
    //Retrieve column names from database
    $columnResult = mysqli_query($cnxn, $columnSQL);
    //Iterate so long as we have data to pull
    while ($row = mysqli_fetch_assoc($columnResult)){
        //Construct the columns with the names
        echo "<tr>";
        //Iterate through the array and display each column name in a table head
        foreach ($row as $k => $v){
            echo "<th>$k</th>";
        }
        echo "</tr>";
    }
    ?>
    </thead>
    <tbody>
    <?php
    //Create query that selects data stored in each field and display the value each ethnicity rather than the key value
    $dataSQL ="SELECT * FROM `guestbook`";
    //Retrieve the data from the database
    $dataResult = mysqli_query($cnxn, $dataSQL);
    //Iterate so long as we have data to pull
    while ($row2 = mysqli_fetch_assoc($dataResult)){
        //Construct rows to insert retrieved data
        echo "<tr>";
        //Iterate through the array to display each data set related to each column
        foreach ($row2 as $k => $v){
            echo "<td>$v</td>";
        }
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
    <a href='logout.php'>logout</a></p>
<a href="guestbook.html">Guestbook Form</a>
</div>
<?php
//Search and execute footer php file
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<!--Call necessary DataTable method to format table to jQuery Data Table-->
<script src="../scripts/dataTableJS.js"></script>

<!--Call necessary DataTable method to format table to jQuery Data Table-->
<script>
    $('#myTable').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
</script>
</body>
</html>