<?php
    require_once('DB_Connection.php');
    $sortBy = ($_GET['sortBy']);
    
    if($sortBy == 1){
        $query = "SELECT * FROM news_posts ORDER BY `date_posted` DESC ;";
    }elseif($sortBy == 2){
        $query = "SELECT * FROM news_posts ORDER BY `likes` DESC ;";
    }else{
        $query = "SELECT * FROM news_posts ORDER BY `comments` DESC ;";
    }
    $response = $GLOBALS['conn']->query($query);
    if ($response && $response->num_rows > 0) {
        while ($row = $response->fetch_array()) {
            echo "<li class='post'>";
            echo "<a href=".$row["url"]." target = '_blank'>".$row["title"]."</a>";
            echo "<ul class='sub'>";
            echo "<li>Like ".$row["likes"]."</li>";
            echo "<li> | ".$row["date_posted"]."</li>";
            echo "<li> | Comments ".$row["comments"]."<li>";
            echo "</ul>";
            echo "</li>";
        }
    } else {
        echo '<h2>News Posts are empty!</h2>';
    }
?>