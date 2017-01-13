package com.example.mapaide.moodmap;

import android.app.Activity;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

public class EvaluationActivity extends AppCompatActivity implements View.OnClickListener{

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_evaluation);

        Position pos = new Position();
        TextView addresse = (TextView) findViewById(R.id.adTextView);
        Intent i = getIntent();
        addresse.setText(i.getStringExtra("position"));

        ImageView img1 = (ImageView) findViewById(R.id.evaluation1);
        img1.setOnClickListener(this);
        ImageView img2 = (ImageView) findViewById(R.id.evaluation2);
        img2.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.evaluation1:
                Intent i1 = new Intent(this, EvaluatVerdureActivity.class);
                startActivityForResult(i1, 1);
                break;
            case R.id.evaluation2:
                Intent i2 = new Intent(this, EvaluatBruitActivity.class);
                startActivityForResult(i2, 1);
                break;
        }
    }
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {

        if (requestCode == 1) {
            if(resultCode == Activity.RESULT_OK){
                int resultat = data.getIntExtra("resultat", 0);
                if (resultat == 1) Toast.makeText(EvaluationActivity.this, "Merci, votre avis a été envoyé au serveur", Toast.LENGTH_LONG).show();
            }
            if (resultCode == Activity.RESULT_CANCELED) {

            }
        }
    }//onActivityResult
}
