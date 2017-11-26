/*var newsPosts = [{title:"Report: Russian Hackers Penetrated Elite NSA Hacking Division", URL:"#", likes: 45, date_posted: "Sun Nov 12 2017 21:52:10", comments: 12}
,{title:"All-touchscreen BlackBerry Motion officially announced", URL:"#", likes: 70, date_posted: "Sun Nov 12 2017 20:40:26", comments: 41}
,{title:"Google Announces the Pixel 2 and Pixel 2 XL", URL:"#", likes: 174, date_posted: "Sat Nov 11 2017 19:15:36", comments: 95}
,{title:"WhatsApp Business' to be introduced as standalone app", URL:"#", likes: 43, date_posted: "Sat Nov 11 2017 12:55:39", comments: 19}
,{title:"Project Loon balloons from Google's Alphabet to aid Puerto Rico", URL:"#", likes: 65, date_posted: "Sat Nov 11 2017 10:35:16", comments: 9}
,{title:"With the Shell, You Can Go Wild(card) and Follow Your Pipe Dreamd", URL:"#", likes: 27, date_posted: "Fri Nov 10 2017 16:25:46", comments: 11}
,{title:"Roku Introduced Five New Streaming Media Players", URL:"#", likes: 51, date_posted: "Thu Nov 9 2017 22:14:50", comments: 20}
,{title:"Getting Started with Node.js", URL:"./nodejs.html", likes: 123, date_posted: "Thu Nov 9 2017 18:25:46", comments: 27}
,{title:"AWS S3 Open-source Alternative Written in Go", URL:"#", likes: 101, date_posted: "Wed Nov 8 2017 13:30:56", comments: 41}]*/
var NewsIDs;
var newsPosts = [];

var newsUL = document.getElementsByClassName("newsPost")[0];

var dispalyList = function () {
    for (var i = 0; i < newsPosts.length; i++) {
        var outerList = document.createElement("li");
        outerList.className = "post";
        var url = document.createElement("a");
        url.href = newsPosts[i].URL;
        url.innerText = newsPosts[i].title;
        url.target = "_blank";
        outerList.appendChild(url);
        var ulAttributes = document.createElement("ul");
        outerList.appendChild(ulAttributes);
        ulAttributes.className = "sub";
        var likes = document.createElement("li");
        likes.innerText = "Likes " + newsPosts[i].likes
        var date = document.createElement("li");
        date.innerText = " | " + (newsPosts[i].date_posted + "").replace('GMT+0300 (Arab Standard Time)', '');
        var comm = document.createElement("li");
        comm.innerText = " | Comments " + newsPosts[i].comments
        ulAttributes.appendChild(likes);
        ulAttributes.appendChild(date);
        ulAttributes.appendChild(comm);
        newsUL.appendChild(outerList);
    }
}

document.getElementsByTagName("body")[0].onload = function () {
    var date = new Date();
    var a = [];
    var newsObj;
    var pageDate = document.getElementsByTagName("time")[0];
    pageDate.innerText = (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            NewsIDs = JSON.parse(xhttp.response);
            for (i = 0; i < 30; i++) {
                a[i] = new XMLHttpRequest();
                a[i].open("GET", "https://hacker-news.firebaseio.com/v0/item/" + NewsIDs[i] + ".json", true);
                a[i].onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        newsObj = JSON.parse(this.response);
                        if (newsObj.descendants == null)
                            newsObj.descendants = 0;
                        newsPosts.push({
                            id: newsObj.id,
                            title: newsObj.title,
                            URL: newsObj.url,
                            likes: newsObj.score,
                            date_posted: new Date(newsObj.time * 1000),
                            comments: newsObj.descendants
                        })

                        if (newsPosts.length == 30)
                            dispalyList();
                    }
                };
                a[i].send();
            }
        }
    };
    xhttp.open("GET", "https://hacker-news.firebaseio.com/v0/topstories.json", true);
    xhttp.send();



}

var picked = 2;
document.getElementById("Sort").addEventListener("click", function () {
    if (this.value == "1" && picked != 1) {
        picked = 1;
        newsPosts.sort(function (a, b) {
            return new Date(b.date_posted) - new Date(a.date_posted);
        })
    } else if (this.value == "2" && picked != 2) {
        picked = 2;
        newsPosts.sort(function (a, b) {
            return b.likes - a.likes;
        })
    } else if (this.value == "3" && picked != 3) {
        picked = 3;
        newsPosts.sort(function (a, b) {
            return b.comments - a.comments;
        })
    }
    newsUL.innerHTML = "";
    dispalyList();
})


