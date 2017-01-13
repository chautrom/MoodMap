package com.example.mapaide.moodmap;

import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.graphics.drawable.Drawable;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v4.content.res.ResourcesCompat;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.osmdroid.api.IMapController;
import org.osmdroid.bonuspack.routing.OSRMRoadManager;
import org.osmdroid.bonuspack.routing.Road;
import org.osmdroid.bonuspack.routing.RoadManager;
import org.osmdroid.bonuspack.routing.RoadNode;
import org.osmdroid.tileprovider.tilesource.TileSourceFactory;
import org.osmdroid.util.GeoPoint;
import org.osmdroid.views.MapView;
import org.osmdroid.config.Configuration;
import org.osmdroid.views.overlay.FolderOverlay;
import org.osmdroid.views.overlay.ItemizedIconOverlay;
import org.osmdroid.views.overlay.Marker;
import org.osmdroid.views.overlay.OverlayItem;
import org.osmdroid.views.overlay.Polygon;
import org.osmdroid.views.overlay.Polyline;
import org.osmdroid.views.overlay.mylocation.GpsMyLocationProvider;
import org.osmdroid.views.overlay.mylocation.MyLocationNewOverlay;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;

public class TestMapActivity extends AppCompatActivity implements LocationListener {

    MapView map;
    RoadManager roadManager;
    ArrayList<GeoPoint> waypoints;
    GeoPoint currentLocation;
    LocationManager locationManager;
    Marker startMarker;
    IMapController mapController;
    private GetInfoZoneTask infoZoneTask = null;
    TabCouleurs colors;
    public Position posToDisplay;

    @Override public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_test_map);
        //important! set your user agent to prevent getting banned from the osm servers
        Configuration.getInstance().load(this, PreferenceManager.getDefaultSharedPreferences(this));

        map = (MapView) findViewById(R.id.map);
        map.setTileSource(TileSourceFactory.MAPNIK);
        //map.setBuiltInZoomControls(true);
        map.setMultiTouchControls(true);

        //GeoPoint startPoint = new GeoPoint(49.1817, -0.3470);

        mapController = map.getController();
        mapController.setZoom(20);
        //**************************************************************
        if ( ContextCompat.checkSelfPermission( this, android.Manifest.permission.ACCESS_COARSE_LOCATION ) != PackageManager.PERMISSION_GRANTED ) {
            ActivityCompat.requestPermissions( this, new String[] {  android.Manifest.permission.ACCESS_COARSE_LOCATION  }, 11 );
        }
        locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 0, 0, this);
        Location location = locationManager.getLastKnownLocation(LocationManager.GPS_PROVIDER);
        if( location != null ) {
            currentLocation = new GeoPoint(location.getLatitude(), location.getLongitude());
        }
         colors = new TabCouleurs();
        //mapController.setCenter(startPoint);
        infoZoneTask = new GetInfoZoneTask();
        infoZoneTask.execute(getString(R.string.url));
        //map.invalidate();

        startMarker = new Marker(map);
        //startMarker.setPosition(startPoint);
        startMarker.setAnchor(Marker.ANCHOR_CENTER, Marker.ANCHOR_BOTTOM);
        startMarker.setDraggable(true);
        map.getOverlays().add(startMarker);




        /*
        GpsMyLocationProvider gpsLocationProvider = new GpsMyLocationProvider(this);
        gpsLocationProvider.setLocationUpdateMinTime(1000);
        gpsLocationProvider.setLocationUpdateMinDistance(2.0f);
        MyLocationNewOverlay myLocationOverlay = new MyLocationNewOverlay(gpsLocationProvider, map);
        myLocationOverlay.enableMyLocation(gpsLocationProvider);
        myLocationOverlay.enableFollowLocation();
        map.getOverlays().add(myLocationOverlay);
        map.invalidate();
        */
/*
        roadManager = new OSRMRoadManager(this);
        waypoints = new ArrayList<GeoPoint>();

        waypoints.add(startPoint);
        GeoPoint endPoint = new GeoPoint(49.1852, -0.3627);
        waypoints.add(endPoint);

        new Thread(new Runnable() {
            public void run() {
                Road road = roadManager.getRoad(waypoints);
                if (road.mStatus != Road.STATUS_OK);
                    //Toast.makeText(TestMapActivity.class, "Error when loading the road - status=" + road.mStatus, Toast.LENGTH_SHORT).show();
                Polyline roadOverlay = RoadManager.buildRoadOverlay(road);
                map.getOverlays().add(roadOverlay);
                FolderOverlay roadMarkers = new FolderOverlay();
                map.getOverlays().add(roadMarkers);
                Drawable nodeIcon = ResourcesCompat.getDrawable(getResources(), R.drawable.ic_menu_camera, null);
                for (int i = 0; i < road.mNodes.size(); i++) {
                    RoadNode node = road.mNodes.get(i);
                    Marker nodeMarker = new Marker(map);
                    nodeMarker.setPosition(node.mLocation);
                    nodeMarker.setIcon(nodeIcon);

                    //4. Filling the bubbles
                    nodeMarker.setTitle("Step " + i);
                    nodeMarker.setSnippet(node.mInstructions);
                    nodeMarker.setSubDescription(Road.getLengthDurationText(TestMapActivity.this, node.mLength, node.mDuration));
                    Drawable iconContinue = ResourcesCompat.getDrawable(getResources(), R.drawable.marker_default, null);
                    nodeMarker.setImage(iconContinue);
                    //4. end

                    roadMarkers.add(nodeMarker);
                }

            }
        }).start();

*/

    }
    public String GET(String sAddress) throws IOException {
        StringBuilder sb = new StringBuilder();

        BufferedInputStream bis = null;
        URL url = new URL(sAddress+"/getInfoZones");
        HttpURLConnection con = (HttpURLConnection) url.openConnection();
        con.connect();
        int responseCode;

        con.setConnectTimeout( 10000 );
        con.setReadTimeout( 10000 );
        responseCode = con.getResponseCode();

        if ( responseCode == 200)
        {
            bis = new java.io.BufferedInputStream(con.getInputStream());
            BufferedReader reader = new BufferedReader(new InputStreamReader(bis, "UTF-8"));
            String line = null;

            while ((line = reader.readLine()) != null)
                sb.append(line);

            bis.close();
        }
        return sb.toString();
    }
    public class GetInfoZoneTask extends AsyncTask<String, Void, String> {

        GetInfoZoneTask() {

        }

        @Override
        protected String doInBackground(String... urls) {
            // TODO: attempt authentication against a network service.

            String infoZones = null;
            try {
                infoZones = GET(urls[0]);
            } catch (IOException e) {
                e.printStackTrace();
            }
            return infoZones;
        }


        // TODO: register the new account here.

        @Override
        protected void onPostExecute(String infoZones) {
            try {
                JSONObject json = new JSONObject(infoZones);
                JSONArray content = new JSONArray(json.getString("content"));
                for (int i = 0; i < content.length(); i++) {
                    JSONObject jobject = new JSONObject(content.getString(i));
                    Evaluation eval = new Evaluation();
                    /*if (jobject.getInt("idCriteria") == 1) {
                        eval.setCritere(0);
                    } else {
                        eval.setCritere(1);
                    }*/
                    eval.setCritere(jobject.getInt("idCriteria"));
                    eval.setScore(jobject.getInt("score"));
                    eval.setLatitude(jobject.getDouble("y"));
                    eval.setLongitude(jobject.getDouble("x"));
                    GeoPoint test0 = new GeoPoint(eval.getLatitude(), eval.getLongitude());
                    drawCircle(test0, colors.couleurs[eval.getCritere()-1][eval.getScore()], 30.0f);
                    map.invalidate();
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }


        }
    }

    public void onResume(){
        super.onResume();
        //this will refresh the osmdroid configuration on resuming.
        //if you make changes to the configuration, use
        //SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(this);
        //Configuration.getInstance().save(this, prefs);
        Configuration.getInstance().load(this, PreferenceManager.getDefaultSharedPreferences(this));
    }

    @Override
    public void onLocationChanged(Location location) {
        currentLocation = new GeoPoint(location);
        startMarker.setPosition(currentLocation);
        mapController.setCenter(currentLocation);
    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {

    }

    @Override
    public void onProviderEnabled(String provider) {

    }

    @Override
    public void onProviderDisabled(String provider) {

    }
	
	public void drawCircle(GeoPoint position, int color, float rayon){
        Polygon overlay = new Polygon(this);
        overlay.setFillColor(color);
        overlay.setStrokeColor(color);
        overlay.setStrokeWidth(0);
        overlay.setPoints(Polygon.pointsAsCircle(position, rayon));
        map.getOverlays().add(overlay);
        map.invalidate();
    }

    public void launchEvaluation(View v){
        Intent i = new Intent(TestMapActivity.this, EvaluationActivity.class);
        i.putExtra("position", currentLocation.getLatitude() + ", " + currentLocation.getLongitude());
        startActivity(i);
    }

    public void zooomIn(View v){
        mapController.zoomIn();
    }
    public void zooomOut(View v){
        mapController.zoomOut();
    }

}
