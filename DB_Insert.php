<?php
function post_news($title,$url)
{
    // validate the given task
    $title = validate_input($title);
    if(empty($title)){
        return;
    }
     if(empty($url)){
        $url = "#";
    }
    $insert_statement = $GLOBALS['conn']->prepare("insert into `news_posts`(`title`, `url`, `likes`, `comments`, `date_posted`) VALUES(?,?,0,0,now());");
    if ($insert_statement) {
        // Bind our variable to the prepared statement as a parameter
        $insert_statement->bind_param("ss", $title,$url); // s indicates the data type is string.
        /* execute the prepared statement, and check if it was successful
        * If it was inserted successfully, then the affected rows should be 1
        */
        if (!$insert_statement->execute() || $insert_statement->affected_rows !=1) {
            print_r('Error executing MySQL insert statement: ' . $insert_statement->err);
            return;
        }
        // close the prepared statement
        
        $insert_statement->close();
    } else {
        printf("Failed to insert into the database:Erro number: %d,  %s\n",
        $insert_statement->errorno, $insert_statement->error);
    }
}

// trim any extra white spaces and escape special HTML characters
function validate_input($data)
{
    $data = trim($data); 
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>