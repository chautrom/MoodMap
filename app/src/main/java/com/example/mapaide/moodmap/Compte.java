package com.example.mapaide.moodmap;

/**
 * Created by Marouane on 11/01/2017.
 */
public class Compte {

    private String email;
    private String identifiant;
    private String motDePasse;

    public Compte(){

    }

    public Compte(String e, String i, String m){
        this.email = e;
        this.identifiant = i;
        this.motDePasse = m;
    }

    @Override
    public String toString(){
        return getEmail() + "," + getIdentifiant() + "," + getMotDePasse();
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public void setIdentifiant(String identifiant) {
        this.identifiant = identifiant;
    }

    public void setMotDePasse(String motDePasse) {
        this.motDePasse = motDePasse;
    }

    public String getMotDePasse() {
        return motDePasse;
    }

    public String getIdentifiant() {
        return identifiant;
    }

    public String getEmail() {
        return email;
    }
}
