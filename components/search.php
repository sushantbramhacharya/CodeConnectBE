
<?php
if (isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];

    require_once("../db_connect.php");
    $query='SELECT * FROM user WHERE Name LIKE "%'.$searchTerm.'%" LIMIT 5;';
    $result=$conn->query($query);
    $serch_results=array();
    while($row=$result->fetch_assoc())
    {
        $serch_results[]=array(
            "name"=>$row['Name'],
            "uid"=>$row['uid']
        );
        
    }
    echo json_encode($serch_results);
    exit();
}
?>
