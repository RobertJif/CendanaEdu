package com.project.suci.sia_cendana;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.NavigationView;
import android.support.design.widget.Snackbar;
import android.support.v4.app.ActivityCompat;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class MainActivityDrawerSpp extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    private TextView tvname,tvhobby;
    private Button btnlogout;
    private String [] arrayItem = {Static.UPDATE, Static.DELETE,"Request"};
    private PreferenceHelper preferenceHelper;
    private String TAG = MainActivityDrawerSpp.class.getSimpleName();
    private ProgressDialog pDialog;
    private ListView lv;
    private TextView tvEmpty;
    private Button btnNew;
    ArrayList<Spp> listSpp = new ArrayList<Spp>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main_drawerspp);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        preferenceHelper = new PreferenceHelper(this);
        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);

        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        View headerView = navigationView.getHeaderView(0);
        tvname = (TextView) headerView.findViewById(R.id.tvname);
        tvname.setText(preferenceHelper.getName());
        lv = (ListView) findViewById(R.id.list);
        tvEmpty = (TextView) findViewById(R.id.tvEmpty);
        btnNew = (Button) findViewById(R.id.btnNew);
// Add new contact
// Load barangsm
        new GetBarang().execute();
// Show dialog for Update/Delete contact
}

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main_activity_drawer, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();
        switch (id) {
            case R.id.nav_home:
                preferenceHelper.putIsLogin(true);
                Intent intents = new Intent(MainActivityDrawerSpp.this, MainActivityDrawerPengumuman.class);
                startActivity(intents);
                break;
            case R.id.nav_profile:
                preferenceHelper.putIsLogin(true);
                Intent intent = new Intent(MainActivityDrawerSpp.this, MainActivityDrawerSiswa.class);
                startActivity(intent);
                break;
            case R.id.nav_logout:
                preferenceHelper.putIsLogin(false);
                preferenceHelper.putName("");
                preferenceHelper.putNISN("");
                Intent intentlog = new Intent(getApplicationContext(), LoginActivity.class);
                ActivityCompat.finishAffinity(this);
                startActivity(intentlog);
                break;
            case R.id.nav_absensi:
                preferenceHelper.putIsLogin(true);
                Intent intentabsensi = new Intent(MainActivityDrawerSpp.this, MainActivityDrawerSemesterAbsensi.class);
                startActivity(intentabsensi);
                break;
            case R.id.nav_spp:
                break;
            case R.id.nav_peminjaman:
                preferenceHelper.putIsLogin(true);
                Intent intentpeminjaman = new Intent(MainActivityDrawerSpp.this, MainActivityDrawerBuku.class);
                startActivity(intentpeminjaman);
                break;
            case R.id.nav_pelanggaran:
                preferenceHelper.putIsLogin(true);
                Intent intentpelanggaran = new Intent(MainActivityDrawerSpp.this, MainActivityDrawerPelanggaran.class);
                startActivity(intentpelanggaran);
                break;
            case R.id.nav_ekskul:
                preferenceHelper.putIsLogin(true);
                Intent intentekskul = new Intent(MainActivityDrawerSpp.this, MainActivityDrawerEkskul.class);
                startActivity(intentekskul);
                break;
            case R.id.nav_prestasi:
                preferenceHelper.putIsLogin(true);
                Intent intentprestasi = new Intent(MainActivityDrawerSpp.this, MainActivityDrawerPrestasi.class);
                startActivity(intentprestasi);
                break;
            case R.id.nav_nilai:
                preferenceHelper.putIsLogin(true);
                Intent intentnilai = new Intent(MainActivityDrawerSpp.this, MainActivityDrawerSemester.class);
                startActivity(intentnilai);
                break;
            case R.id.nav_diskusi:
                preferenceHelper.putIsLogin(true);
                Intent intentdiskusi = new Intent(MainActivityDrawerSpp.this, MainActivityDrawerDiskusi.class);
                startActivity(intentdiskusi);
                break;
            default:
                break;
        }
       /* if (id == R.id.nav_home) {

        }
        else if (id == R.id.nav_about) {
            preferenceHelper.putIsLogin(true);
            Intent intent = new Intent(MainActivityDrawer.this,MainActivityDrawerSiswa.class);
            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NEW_TASK);
            startActivity(intent);
        }
        else if (id == R.id.nav_logout) {
            preferenceHelper.putIsLogin(false);
            Intent intent = new Intent(MainActivityDrawer.this,LoginActivity.class);
            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NEW_TASK);
            startActivity(intent);
            MainActivityDrawer.this.finish();
        }*/

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
    private class GetBarang extends AsyncTask<Void, Void, Void> {

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
// Showing progress dialog
            pDialog = new ProgressDialog(MainActivityDrawerSpp.this);
            pDialog.setMessage("Please wait...");
            pDialog.setCancelable(false);
            pDialog.show();
        }
        @Override
        protected Void doInBackground(Void... params) {
            HttpHandler sh = new HttpHandler();
// Making a request to url and getting response
            String jsonStr = sh.callJson(preferenceHelper.getNISN(),"viewspp.php?id=");
            if (jsonStr != null) {
                try {
                    JSONObject jsonObj = new JSONObject(jsonStr);
// Getting JSON Array node
                    JSONArray barangs = jsonObj.getJSONArray(Static.SPP);
                    if (!barangs.getJSONObject(0).equals(Static.EMPTY)) {
// looping through All Contacts
                        for (int i = 0; i < barangs.length(); i++) {
                            JSONObject c = barangs.getJSONObject(i);
                            Spp spp = new Spp();
                            spp.setJumlahspp(c.getString(Static.JUMLAHSPP));
                            spp.setBulan(c.getString(Static.BULAN));
                            spp.setTanggalbayar(c.getString(Static.TANGGALBAYAR));
                            spp.setStatus(c.getString(Static.STATUS));
                            spp.setTahun(c.getString(Static.TAHUN));
                            spp.setSemester(c.getString(Static.SEMESTER));

// adding spp to spp list
                            listSpp.add(spp);
                        }
                    }
                } catch (final JSONException e) {
                    Log.e(TAG, "Json parsing error: " + e.getMessage());
                }
            } else {

                Log.e(TAG, "Couldn't get json from server.");
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(
                                getApplicationContext(),
                                "Couldn't get json from server. Check LogCat for possible errors!",
                                Toast.LENGTH_LONG).show();
                    }
                });
            }
            return null;
        }
        @Override
        protected void onPostExecute(Void result) {
            super.onPostExecute(result);
// Dismiss the progress dialog
            if (pDialog.isShowing())
                pDialog.dismiss();
/**
 * Updating parsed JSON data into ListView
 * */
            if (listSpp.size() > 0) {
                AdapterSpp adapter = new AdapterSpp(getApplicationContext(), listSpp);
                lv.setAdapter(adapter);
            } else {
                tvEmpty.setText("Table is Empty");
            }
        }
    }
    /**
     * Async task class to send json
     */
}
