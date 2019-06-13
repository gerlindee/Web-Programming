package Domain;

public class User {
    private int id;
    private String username;
    private String password;
    private int bestScore;

    public User(int id, String username, String password, int bestScore) {
        this.id = id;
        this.username = username;
        this.password = password;
        this.bestScore = bestScore;
    }

    public int getId() {
        return id;
    }

    public String getUsername() {
        return username;
    }

    public String getPassword() {
        return password;
    }

    public int getBestScore() {
        return bestScore;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public void setBestScore(int bestScore) {
        this.bestScore = bestScore;
    }
}
