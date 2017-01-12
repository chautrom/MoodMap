package com.example.mapaide.moodmap;

import android.content.Context;
import android.graphics.Color;
import android.graphics.drawable.Drawable;
import android.support.v4.content.ContextCompat;

/**
 * Created by Marouane on 12/01/2017.
 */
public class TabCouleurs {

    int[][] couleurs;

    public TabCouleurs(){
        couleurs = new int[][]{
                {
                        Color.argb(127, 255, 255, 255),
                        Color.argb(127, 195, 255, 195),
                        Color.argb(127, 130, 255, 130),
                        Color.argb(127, 65, 255, 65),
                        Color.argb(127, 0, 255, 0)
                },
                {
                        Color.argb(127, 255, 255, 255),
                        Color.argb(127, 195, 195, 255),
                        Color.argb(127, 130, 130, 255),
                        Color.argb(127, 65, 65, 255),
                        Color.argb(127, 0, 0, 255)
                }
        };
    }

}
