<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="pageStyle.css">                        
        <title>Submit news</title>        
    </head>
    <body>
        <?php 
            require_once('DB_Connection.php');
            require('DB_Insert.php');
            
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST['sub_button'])) {
                    $title = $_POST["title"];
                    $url = $_POST["url"];
                    post_news($title,$url);
                }
            }
        ?>
            <div class="centerPage">            
            <form class="formIn" method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
                <div class="formIn">
                    <h1>Submit</h1>
                    <label>Title: </label>
                </div>
                <div>
                    <input type="text" name="title">
                </div>
                    <label> URL:</label>
                <div>
                   <input type="text" name="url">
                </div>
                <div class="formIn">                        
                    <h3>or</h3>
                </div>
                <div>
                    <label>Text:</label>
                </div>
                <div>
                    <textarea rows="4" cols="50" name="text"></textarea>
                </div>
                <div>
                    <button type="button" class="sub" name="sub_button">Submit</button>  
                </div>  
            </form>
        </div>

        <script>
            var title = document.querySelector("input[name=title]");
            var url = document.querySelector("input[name=url]");
            var text = document.querySelector("textarea");
            var sub = document.querySelector("button.sub");
            var cpage = document.querySelector("div.centerPage");
            
            var warning = document.createElement("div");
            warning.style = 'visibility: hidden;width = 100%; background-color: red; color: white;';    

            var post1 = document.createElement("p");
            var titleWarn = document.createTextNode("Title must be filled  out!");
            post1.style = "visibility: hidden; padding-top: 10px;";
            post1.appendChild(titleWarn);
            var post2 = document.createElement("p");
            var textWarn = document.createTextNode("Either the URL or text field must be filled out!");
            post2.style = "visibility: hidden; padding-bottom: 10px;";
            post2.appendChild(textWarn);

            warning.appendChild(post1);
            warning.appendChild(post2);
            cpage.appendChild(warning);

          
            sub.addEventListener("click", function(){
                warning.style.visibility = "hidden";
                post1.style.visibility = "hidden";
                post2.style.visibility = "hidden";
                if(title.value == "" && url.value == "" && text.value == ""){
                    warning.style.visibility = "visible";
                    post1.style.visibility = "visible";
                    post2.style.visibility = "visible";
                    return false;
                }
                if(title.value == "" ){
                    warning.style.visibility = "visible";
                    post1.style.visibility = "visible";
                    return false;
                }
                if(url.value == "" && text.value == ""){
                    warning.style.visibility = "visible";
                    post2.style.visibility = "visible";
                    return false;
                }
                this.type="submit"
            })
        </script>
    </body>
</html>