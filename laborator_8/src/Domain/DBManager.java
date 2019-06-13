package Domain;

import java.sql.*;
import java.util.ArrayList;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

public class DBManager {
    private Statement statement;
    private String driver = "com.mysql.jdbc.Driver";
    private String url = "jdbc:mysql://localhost/laborator_8";
    private String user = "root";
    private String password = "";

    public DBManager() {
        connect();
    }

    private void connect() {
        try {
            Class.forName(driver);
            Connection conn = DriverManager.getConnection(this.url, this.user, this.password);
            statement = conn.createStatement();
        } catch (ClassNotFoundException | SQLException e) {
            e.printStackTrace();
        }
    }

    public User authenticate(String username, String password) {
        ResultSet resultSet;
        User user = null;
        try {
            resultSet = statement.executeQuery("select * from users where username = '" + username + " 'and password = '" + password + "'");
            if (resultSet.next()) {
                user = new User(resultSet.getInt("id"), resultSet.getString("username"), resultSet.getString("password"), resultSet.getInt("bestScore"));
            }
            resultSet.close();
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return user;
    }

    public int getBestScoreForUser(String username) {
        ResultSet resultSet;
        User user = null;
        try {
            resultSet = statement.executeQuery("select * from users where username = '" + username + "'");
            if (resultSet.next()) {
                user = new User(resultSet.getInt("id"), resultSet.getString("username"), resultSet.getString("password"), resultSet.getInt("bestScore"));
            }
            resultSet.close();
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        assert user != null;
        return user.getBestScore();
    }

    public List<Question> selectQuestions(int start, int testQuestions, int pageQuestion) {
        ResultSet resultSet;
        List<Question> result = new ArrayList<>();
        try {
            resultSet = statement.executeQuery("select * from (select * from questions limit " + testQuestions + ") as quest limit " + (start - 1) + "," + pageQuestion);
            while (resultSet.next()) {
                Question question = new Question(resultSet.getInt("id"), resultSet.getString("text"), resultSet.getString("answer1"), resultSet.getString("answer2"), resultSet.getString("answer3"), resultSet.getString("answer4"), resultSet.getString("correct_answer"));
                result.add(question);
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return result;
    }

    public List<Answer> selectAnswersForQuestion(int questionID) {
        ResultSet resultSet;
        List<Answer> result = new ArrayList<>();
        try {
            resultSet = statement.executeQuery("select * from answers where questionID = " + questionID);
            while (resultSet.next()) {
                Answer answer = new Answer(resultSet.getInt("id"), resultSet.getInt("questionID"), resultSet.getString("text"), resultSet.getBoolean("isCorrect"));
                result.add(answer);
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return result;
    }

    public List<Answer> selectAnswers() {
        ResultSet resultSet;
        List<Answer> result = new ArrayList<>();
        try {
            resultSet = statement.executeQuery("select * from answers");
            while (resultSet.next()) {
                Answer answer = new Answer(resultSet.getInt("id"), resultSet.getInt("questionID"), resultSet.getString("text"), resultSet.getBoolean("isCorrect"));
                result.add(answer);
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return result;
    }

     public void setBestScore(int score, int id) {
        try {
            statement.executeUpdate("update users set bestScore = " + score + " where id =" + id);
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
     }
}
