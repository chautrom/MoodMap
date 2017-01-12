package com.example.mapaide.moodmap;

/**
 * Created by Sara on 12/01/2017.
 */
public class Evaluation {
    private String critere;
    private float longitude;
    private float latitude;
    private int score;

    public Evaluation(){

    }

    public Evaluation(String c, float log, float lt ,int s){
        this.critere = c;
        this.longitude = log;
        this.latitude = lt;
        this.score = s;
    }

    @Override
    public String toString(){
        return getCritere() + "," + getScore() + "," ;
    }

    public void setCritere(String crit) {
        this.critere =crit;
    }

    public void setScore(int s) {
        this.score = s;
    }

    public void setLongitude(float lg ) {
        this.longitude = lg;
    }

    public void setLatitude(float lat ) {
        this.latitude = lat;
    }

    public String getCritere() {
        return critere;
    }

    public int getScore() {
        return score;
    }

    public float getLongitude() {
        return longitude;
    }
    public float getLatitude(){
        return latitude;
    }
}
