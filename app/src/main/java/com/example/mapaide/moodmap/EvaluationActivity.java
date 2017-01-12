package com.example.mapaide.moodmap;

import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.RatingBar;
import android.widget.Spinner;
import android.widget.Toast;

import org.json.JSONObject;


import java.io.BufferedInputStream;
import java.io.BufferedReader;

import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;

public class EvaluationActivity extends AppCompatActivity implements AdapterView.OnItemSelectedListener {
    private int mEvaluation;
    private String mCritere;
    private  RatingBar ratingBar;
    private Spinner spinner;
    private Button envoyer;
    private String mCritereSelectionne;
    private evaluationTask evalTask = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_evaluation);
        ratingBar = (RatingBar)findViewById(R.id.ratingBar);
        envoyer = (Button)findViewById(R.id.submitEvaluation);
        envoyer.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                envoyer();
            }

        });
        spinner = (Spinner)findViewById(R.id.spinnerCritères);
        // Create an ArrayAdapter using the string array and a default spinner layout
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this,
                R.array.critère_array, android.R.layout.simple_spinner_item);
// Specify the layout to use when the list of choices appears
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
// Apply the adapter to the spinner
        spinner.setAdapter(adapter);

    }
    public void onItemSelected(AdapterView<?> parent, View view,
                               int pos, long id) {
        // An item was selected. You can retrieve the selected item using
        // parent.getItemAtPosition(pos)
        mCritereSelectionne = parent.getItemAtPosition(pos).toString();
        Toast.makeText(parent.getContext(), "Selected: " + mCritereSelectionne, Toast.LENGTH_LONG).show();
    }

    public void onNothingSelected(AdapterView<?> parent) {
        // Another interface callback
    }
    public void envoyer(){
        Evaluation ev = new Evaluation();
        //GeoPoint location = new GeoPoint()
        ev.setCritere(String.valueOf(spinner.getSelectedItem()));
        ev.setScore(ratingBar.getNumStars());
        evalTask = new evaluationTask(ev);
        evalTask.execute(getString(R.string.url));



    }
    public static String POST(String string_url, Evaluation eval){
        StringBuffer response = new StringBuffer();

        BufferedInputStream bis = null;

        try {

            URL obj = new URL(string_url+"/createVote");
            HttpURLConnection con = (HttpURLConnection) obj.openConnection();

            con.setRequestMethod("POST");
            con.setRequestProperty( "Content-type", "application/json");
            con.setRequestProperty( "Accept", "*/*" );


            JSONObject jsonObject = new JSONObject();
            jsonObject.accumulate("userId",1);
            jsonObject.accumulate("x",28.2331);
            jsonObject.accumulate("y",19.4321);
            jsonObject.accumulate("idCriteria",1);
            jsonObject.accumulate("score", eval.getScore());

            con.setDoOutput(true);
            OutputStreamWriter wr = new OutputStreamWriter(con.getOutputStream());
            wr.write(jsonObject.toString());
            wr.flush();
            wr.close();

            int responseCode = con.getResponseCode();
            if(responseCode==201 || responseCode==200)
            {
                BufferedReader in = new BufferedReader(new InputStreamReader(con.getInputStream()));
                String inputLine;


                while ((inputLine = in.readLine()) != null) {
                    response.append(inputLine);
                }
                in.close();

            }

        } catch (Exception e) {
            Log.d("InputStream", e.getLocalizedMessage());
        }

        // 11. return result
        return response.toString();
    }
    public class evaluationTask extends AsyncTask<String, Void, String> {

        private final Evaluation eval;


        evaluationTask(Evaluation e) {
           eval = e;
        }

        @Override
        protected String doInBackground(String... urls) {
            // TODO: attempt authentication against a network service.

            return POST(urls[0],eval);

        }

        // TODO: register the new account here.


        @Override
        protected void onPostExecute(String result) {
            Toast.makeText(getBaseContext(), "Data Sent!", Toast.LENGTH_LONG).show();
        }


    }

}
