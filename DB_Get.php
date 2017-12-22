<?php 
function get_News()
{
    $get_all_tasks_query = "SELECT * FROM news_posts ;";
    $response = $GLOBALS['conn']->query($get_all_tasks_query);
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
}
?>