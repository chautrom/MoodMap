package com.example.mapaide.moodmap;

/**
 * Created by Sara on 12/01/2017.
 */
public class Evaluation {
    private int critere;
    private double longitude;
    private double latitude;
    private int score;

    public Evaluation(){

    }

    public Evaluation(int c, double log, double lt ,int s){
        this.critere = c;
        this.longitude = log;
        this.latitude = lt;
        this.score = s;
    }

    @Override
    public String toString(){
        return getCritere() + "," + getScore() + "," ;
    }

    public void setCritere(int crit) {
        this.critere =crit;
    }

    public void setScore(int s) {
        this.score = s;
    }

    public void setLongitude(double lg ) {
        this.longitude = lg;
    }

    public void setLatitude(double lat ) {
        this.latitude = lat;
    }

    public int getCritere() {
        return critere;
    }

    public int getScore() {
        return score;
    }

    public double getLongitude() {
        return longitude;
    }
    public double getLatitude(){
        return latitude;
    }
}
