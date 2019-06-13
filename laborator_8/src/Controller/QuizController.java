package Controller;

import Domain.Answer;
import Domain.DBManager;
import Domain.Question;
import Domain.User;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class QuizController extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        RequestDispatcher requestDispatcher = null;
        DBManager dbManager = new DBManager();

        String res = request.getParameter("results");
        String[] results = res.split(",");
        int score = 0;
        int correctQuestions = 0;
        List<Answer> allAnswers = dbManager.selectAnswers();
        for (String result : results) {
            int idAnswer = Integer.parseInt(result);
            for (Answer answer : allAnswers) {
                if (answer.getId() == idAnswer) {
                    if (answer.isCorrect()) {
                        score += 1;
                        correctQuestions += 1;
                    }
                }
            }
        }
        int incorrectQuestion = results.length - correctQuestions;
        HttpSession session = request.getSession();
        User user = (User)session.getAttribute("user");
        if (score > user.getBestScore()) {
            dbManager.setBestScore(score, user.getId());
        }

        requestDispatcher = request.getRequestDispatcher("/results-page.jsp");
        request.setAttribute("score", score);
        request.setAttribute("bestScore", user.getBestScore());
        request.setAttribute("correct", correctQuestions);
        request.setAttribute("incorrect", incorrectQuestion);
        requestDispatcher.forward(request, response);
    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        int testQuestions = Integer.parseInt(request.getParameter("testQuestions"));
        int pageQuestions = Integer.parseInt(request.getParameter("pageQuestions"));
        int start = Integer.parseInt(request.getParameter("start"));

        RequestDispatcher requestDispatcher = null;
        DBManager dbManager = new DBManager();
        List<Question> questions = dbManager.selectQuestions(start, testQuestions, pageQuestions);
        List<Answer> answers = new ArrayList<>();
        for(Question question : questions) {
            List<Answer> correspondingAnswers = dbManager.selectAnswersForQuestion(question.getId());
            answers.addAll(correspondingAnswers);
        }
        requestDispatcher = request.getRequestDispatcher("/quiz-page.jsp");
        request.setAttribute("page", 1);
        request.setAttribute("questions", questions);
        request.setAttribute("answers", answers);
        requestDispatcher.forward(request, response);
    }
}
