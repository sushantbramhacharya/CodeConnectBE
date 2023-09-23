
<?php
if (isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];

    require_once("../db_connect.php");
    if($_GET['profileSearch']=='true')
    {
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
    }else{
        $query='SELECT * FROM discussion WHERE post_description LIKE "%'.$searchTerm.'%" OR code_text LIKE "%'.$searchTerm.'%" LIMIT 5;';
        $result=$conn->query($query);
        $serch_results=array();
        while($row=$result->fetch_assoc())
        {
            $serch_results[]=array(
                "post_description"=>$row['post_description'],
                "code_text"=>$row['code_text']
            );
            
        }
        echo json_encode($serch_results);
    }
    exit();
}
?>
