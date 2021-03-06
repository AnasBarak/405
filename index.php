<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="mainStyle.css">
        <title>TechNews</title>        
    </head>
    <body>
         <?php 
            require_once('DB_Connection.php');
            require('DB_Get.php');
        ?>
        <div id="mainSec">
          
        <header>
          <ul>
              <li ><a href="#" id="home"><img src="./Images/home.png" width=20 hight= 20 alt=""> TechNews</a></li>
              <li><a href="#" >News</a></li>
              <li><a href="#">Comments</a></li>
              <li><a href="#">Show</a></li>
              <li><a href="#">Ask</a></li>
              <li><a href="#">Jobs</a></li>
              <li><a href="./submit.php" target="_blank">Submit News</a></li>
          </ul>
        </header>
        <div id="mainTime">
            <h1>Main Stories <time>10/18/2017</time></h1>
            <label>Sort By
                <select name="" id="Sort" onchange="getSorted(this.value)">
                    <option value="1" >Newest</option>
                    <option value="2" selected>Like</option>
                    <option value="3" >Comment</option>                
                </select>
            </label>
        </div>        
        <ul class="newsPost">
            <?php get_News();?>
        </ul>
        <footer>
            <div>
                <p>&copy; 2017 HN inc. All Rights Reserved.</p>
                <a href="#">Privacy</a>
                | <a href="#">Terms of Use</a>
                | <a href="#">Contact</a>  
                <p>Written in pure HTML	| Hosted by: <a href="https://www.heroku.com/" target="_blank">Heroku</a></p>
                
            </div>
        </footer>
        </div>
    <script> 
        document.getElementsByTagName("body")[0].onload = function () {
            var date = new Date();
            var pageDate = document.getElementsByTagName("time")[0];
            pageDate.innerText = (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear();
        }
        
        function getSorted(sortBy) {
                xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementsByClassName("newsPost")[0].innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET","DB_Sort.php?sortBy="+sortBy,true);
                xhttp.send();
        }

    </script>
    </body>
</html>