<%--
  Created by IntelliJ IDEA.
  User: Gerlinde
  Date: 11/06/2019
  Time: 10:38
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Quiz Results</title>
</head>
<body>
    <h1> Results </h1>
    <h3>
        Best score of all time:
        <%
            out.print(request.getAttribute("bestScore"));
        %>
    </h3>
    <h3> Score:
        <%
            out.print(request.getAttribute("score"));
        %>
    </h3>
    <h3> Number of correctly answered questions:
        <%
            out.print(request.getAttribute("correct"));
        %>
    </h3>
    <h3> Number of mistakes:
        <%
            out.print(request.getAttribute("incorrect"));
        %>
    </h3>
</body>
</html>
