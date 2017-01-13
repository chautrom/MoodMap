package com.example.mapaide.moodmap;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.Toast;

import org.json.JSONObject;


import java.io.BufferedInputStream;
import java.io.BufferedReader;

import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;

public class EvaluatBruitActivity extends AppCompatActivity implements View.OnClickListener{

    private evaluationTask evalTask = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_evaluat_bruit);

        ImageView fc1 = (ImageView) findViewById(R.id.face1b);
        ImageView fc2 = (ImageView) findViewById(R.id.face2b);
        ImageView fc3 = (ImageView) findViewById(R.id.face3b);
        ImageView fc4 = (ImageView) findViewById(R.id.face4b);
        ImageView fc5 = (ImageView) findViewById(R.id.face5b);

        fc1.setOnClickListener(this);
        fc2.setOnClickListener(this);
        fc3.setOnClickListener(this);
        fc4.setOnClickListener(this);
        fc5.setOnClickListener(this);

    }

    @Override
    public void onClick(View v) {
        int score = 0;
        switch (v.getId()){
            case R.id.face1b:
                score = 1;
                break;
            case R.id.face2b:
                score = 2;
                break;
            case R.id.face3b:
                score = 3;
                break;
            case R.id.face4b:
                score = 4;
                break;
            case R.id.face5b:
                score = 5;
                break;
        }

        Evaluation ev = new Evaluation();
        ev.setCritere(1);
        ev.setScore(score);
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
            Intent intent = new Intent();
            intent.putExtra("resultat", 1);
            setResult(Activity.RESULT_OK, intent);
            finish();
        }
    }
}
