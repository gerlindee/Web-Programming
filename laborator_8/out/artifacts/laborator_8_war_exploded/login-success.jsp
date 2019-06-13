<%--
  Created by IntelliJ IDEA.
  User: Gerlinde
  Date: 07/06/2019
  Time: 14:17
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Quiz Configuration Page</title>
</head>
<body>
    <form action="QuizController" method="get">
        <label> Number of test questions:
            <input type="number" name="testQuestions" required/>
        </label>

        <label> Number of questions per page:
            <input type="number" name="pageQuestions" required/>
        </label>

        <input type="hidden" name="start" value="1">

        <input type="submit" value="Start Test">
    </form>
</body>
</html>
