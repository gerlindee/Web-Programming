<%--
  Created by IntelliJ IDEA.
  User: Gerlinde
  Date: 07/06/2019
  Time: 17:31
  To change this template use File | Settings | File Templates.
--%>
<%@ page import="Domain.User" %>
<%@ page import="Domain.Question" %>
<%@ page import="java.util.List" %>
<%@ page import="Domain.Answer" %>
<%@ page contentType="text/html;charset=UTF-8"%>
<html>
<head>
    <title>Quiz</title>

    <script type="text/javascript">

        function finishTest() {
            var answers = document.getElementsByName("question_checked");
            var answersIDs = [];
            for (idx = 0; idx < answers.length; idx++) {
                var fullID = answers[idx].id;
                var arrayID = fullID.split("checked");
                answersIDs.push(arrayID[1]);
            }
            document.getElementById("results").setAttribute("value", answersIDs.toLocaleString());
            console.log(document.getElementById("results").getAttribute("value"));
            // var url_string = window.location.href;
            // var url = new URL(url_string);
            // var testQuestions = url.searchParams.get("testQuestions");
            // var pageQuestions = url.searchParams.get("pageQuestions");
            // var numPages = (testQuestions + pageQuestions - 1) / pageQuestions;
            // var splitURL = window.location.href.split("&result=");
            // if (splitURL.length === 1) {
            //     var currentURL = splitURL[0];
            //     for (var idx = 1; idx <= numPages; idx++) {
            //         var pageID = "page" + idx.toLocaleString();
            //         var urlValue = currentURL + "&result=" + document.getElementById("results").getAttribute("value");
            //         document.getElementById(pageID).setAttribute("href", urlValue);
            //     }
            //     window.location = currentURL + "&result=" + document.getElementById("results").getAttribute("value");
            // } else {
            //     currentURL = splitURL[0];
            //     var partialResult = splitURL[1];
            //     for (idx = 1; idx <= numPages; idx++) {
            //         pageID = "page" + idx.toLocaleString();
            //         urlValue = currentURL + "&result=" + partialResult + "," + document.getElementById("results").getAttribute("value")
            //         document.getElementById(pageID).setAttribute("href", urlValue);
            //     }
            //     window.location = currentURL + "&result=" + partialResult + "," + document.getElementById("results").getAttribute("value");
            // }
        }

        function printValue(item) {
            console.log(item.id);
        }

        function handleClick(id) {
                var checkBox = document.getElementById(id);

                if (checkBox.checked === true){
                    checkBox.setAttribute("name", "question_checked");
                    console.log(checkBox.value);
                } else {
                    checkBox.setAttribute("name", "question");
                }
            }
    </script>

</head>
<body>
    <div class="header">
        <% User user; %>
        <% user = (User) session.getAttribute("user");
            if (user != null) {
        %>
        <h1 name="username"> Welcome,
            <%
                out.print(user.getUsername());
            %>
        </h1>
        <%
            }
        %>
    </div>

    <div class="container">
        <form action="QuizController" method="get">
            <%
                List<Question> questions = (List<Question>) request.getAttribute("questions");
                int testQuestions = Integer.parseInt(request.getParameter("testQuestions"));
                int pageQuestions = Integer.parseInt(request.getParameter("pageQuestions"));
                List<Answer> answers = (List<Answer>) request.getAttribute("answers");
                int idx = 0;
                for (Question question: questions) {
                    out.print("<h3>" + question.getText() + "</h3>");
                    int step = 0;
                    while (step < 4) {
                        out.print("<input type='checkbox' name='question' onclick='handleClick(id)' value='" + answers.get(idx).getText() + "' id='checked" + answers.get(idx).getId() + "'>" + answers.get(idx).getText() + "<br />");
                        step++;
                        idx++;
                    }
                }
                int numPages = (testQuestions + pageQuestions - 1) / pageQuestions;
                for (int start = 1; start <= numPages; start++) {
                    int startingRecord = (pageQuestions * start - (pageQuestions - 1));
                    out.print("<a id='page" + start + "' href='QuizController?testQuestions=" + testQuestions + "&pageQuestions=" + pageQuestions + "&start=" + startingRecord +"'>"+ start + "</a>");
                }
            %>
        </form>
        <form action="QuizController" method="post">
            <input type="button" value="Submit Answers" onclick="finishTest()">
            <input type="hidden" id="results" name="results" value="results" />
            <input type="submit" value="Finish Quiz">
        </form>
    </div>

</body>
</html>
