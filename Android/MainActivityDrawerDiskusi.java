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
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class MainActivityDrawerDiskusi extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    private TextView tvname,tvhobby;
    private Button btnlogout;
    private String [] arrayItem = {Static.UPDATE, Static.DELETE,"Request"};
    private PreferenceHelper preferenceHelper;
    private String TAG = MainActivityDrawerDiskusi.class.getSimpleName();
    private ProgressDialog pDialog;
    private ListView lv;
    private TextView tvEmpty;
    private Button btnNew;
    ArrayList<Diskusi> listDiskusi = new ArrayList<Diskusi>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main_drawerdiskusi);
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
        new MainActivityDrawerDiskusi.GetBarang().execute();
        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View v, int position, long id) {
                final Diskusi diskusi = listDiskusi.get(position);
                Intent iEdit = new Intent(MainActivityDrawerDiskusi.this, MainActivityDrawerKomentar.class);
                iEdit.putExtra(Static.IDDISKUSI, diskusi.getIddiskusi());
                iEdit.putExtra(Static.JUDULDISKUSI, diskusi.getJuduldiskusi());
                iEdit.putExtra(Static.DETAILDISKUSI, diskusi.getDetaildiskusi());
                iEdit.putExtra(Static.TANGGALDISKUSI, diskusi.getTanggaldiskusi());
                iEdit.putExtra(Static.NISN, preferenceHelper.getNISN());

                startActivity(iEdit);
            }
        });
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
                Intent intents = new Intent(MainActivityDrawerDiskusi.this, MainActivityDrawerPengumuman.class);
                startActivity(intents);
                break;
            case R.id.nav_profile:
                preferenceHelper.putIsLogin(true);
                Intent intent = new Intent(MainActivityDrawerDiskusi.this, MainActivityDrawerSiswa.class);
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
                Intent intentabsensi = new Intent(MainActivityDrawerDiskusi.this, MainActivityDrawerSemesterAbsensi.class);
                startActivity(intentabsensi);
                break;
            case R.id.nav_spp:
                preferenceHelper.putIsLogin(true);
                Intent intentspp = new Intent(MainActivityDrawerDiskusi.this, MainActivityDrawerSpp.class);
                startActivity(intentspp);
                break;
            case R.id.nav_peminjaman:
                preferenceHelper.putIsLogin(true);
                Intent intentpeminjaman = new Intent(MainActivityDrawerDiskusi.this, MainActivityDrawerBuku.class);
                startActivity(intentpeminjaman);
                break;
            case R.id.nav_pelanggaran:
                preferenceHelper.putIsLogin(true);
                Intent intentpelanggaran = new Intent(MainActivityDrawerDiskusi.this, MainActivityDrawerPelanggaran.class);
                startActivity(intentpelanggaran);
                break;
            case R.id.nav_ekskul:
                preferenceHelper.putIsLogin(true);
                Intent intentekskul = new Intent(MainActivityDrawerDiskusi.this, MainActivityDrawerEkskul.class);
                startActivity(intentekskul);
                break;
            case R.id.nav_prestasi:
                preferenceHelper.putIsLogin(true);
                Intent intentprestasi = new Intent(MainActivityDrawerDiskusi.this, MainActivityDrawerPrestasi.class);
                startActivity(intentprestasi);
                break;
            case R.id.nav_diskusi:
                break;
            case R.id.nav_nilai:
                preferenceHelper.putIsLogin(true);
                Intent intentdiskusi = new Intent(MainActivityDrawerDiskusi.this, MainActivityDrawerSemester.class);
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
            pDialog = new ProgressDialog(MainActivityDrawerDiskusi.this);
            pDialog.setMessage("Please wait...");
            pDialog.setCancelable(false);
            pDialog.show();
        }
        @Override
        protected Void doInBackground(Void... params) {
            HttpHandler sh = new HttpHandler();
// Making a request to url and getting response
            String jsonStr = sh.callJson(preferenceHelper.getNISN(),"viewdiskusi.php?id=");
            if (jsonStr != null) {
                try {
                    JSONObject jsonObj = new JSONObject(jsonStr);
// Getting JSON Array node
                    JSONArray barangs = jsonObj.getJSONArray(Static.DISKUSI);
                    if (!barangs.getJSONObject(0).equals(Static.EMPTY)) {
// looping through All Contacts
                        for (int i = 0; i < barangs.length(); i++) {
                            JSONObject c = barangs.getJSONObject(i);
                            Diskusi diskusi = new Diskusi();
                            diskusi.setIddiskusi(c.getString(Static.IDDISKUSI));
                            diskusi.setJuduldiskusi(c.getString(Static.JUDULDISKUSI));
                            diskusi.setDetaildiskusi(c.getString(Static.DETAILDISKUSI));
                            diskusi.setTanggaldiskusi(c.getString(Static.TANGGALDISKUSI));


// adding diskusi to diskusi list
                            listDiskusi.add(diskusi);
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
            if (listDiskusi.size() > 0) {
                AdapterDiskusi adapter = new AdapterDiskusi(getApplicationContext(), listDiskusi);
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
