package com.example.mapaide.moodmap;

import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.support.v4.content.res.ResourcesCompat;
import android.support.v7.app.AppCompatActivity;
import android.widget.Toast;

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
import org.osmdroid.views.overlay.Marker;
import org.osmdroid.views.overlay.Polyline;
import org.osmdroid.views.overlay.mylocation.GpsMyLocationProvider;
import org.osmdroid.views.overlay.mylocation.MyLocationNewOverlay;

import java.util.ArrayList;

public class TestMapActivity extends AppCompatActivity {

    MapView map;
    RoadManager roadManager;
    ArrayList<GeoPoint> waypoints;

    @Override public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_test_map);
        //important! set your user agent to prevent getting banned from the osm servers
        Configuration.getInstance().load(this, PreferenceManager.getDefaultSharedPreferences(this));

        map = (MapView) findViewById(R.id.map);
        //map.setTileSource(TileSourceFactory.MAPNIK);
        map.setBuiltInZoomControls(true);
        map.setMultiTouchControls(true);

        GeoPoint startPoint = new GeoPoint(49.1817, -0.3470);

        IMapController mapController = map.getController();
        mapController.setZoom(12);
        mapController.setCenter(startPoint);
/*
        Marker startMarker = new Marker(map);
        startMarker.setPosition(startPoint);
        startMarker.setAnchor(Marker.ANCHOR_CENTER, Marker.ANCHOR_BOTTOM);
        startMarker.setDraggable(true);
        map.getOverlays().add(startMarker);
*/
        GpsMyLocationProvider gpsLocationProvider = new GpsMyLocationProvider(this);
        MyLocationNewOverlay myLocationOverlay = new MyLocationNewOverlay(gpsLocationProvider, map);
        map.getOverlays().add(myLocationOverlay);
        myLocationOverlay.enableMyLocation();
        myLocationOverlay.enableFollowLocation();
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

    public void onResume(){
        super.onResume();
        //this will refresh the osmdroid configuration on resuming.
        //if you make changes to the configuration, use
        //SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(this);
        //Configuration.getInstance().save(this, prefs);
        Configuration.getInstance().load(this, PreferenceManager.getDefaultSharedPreferences(this));
    }
}
