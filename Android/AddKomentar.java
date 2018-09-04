package com.project.suci.sia_cendana;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by Robert on 01/11/2016.
 */

public class AddKomentar extends Activity {
    private String TAG = AddKomentar.class.getName();
    private ProgressDialog pDialog;
    private PreferenceHelper preferenceHelper;
    private EditText etKomentar;
    private Button btnEdit;
    String mNisn;
    String iddis,judul,detail,tanggal;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.form_addkomentar);
        etKomentar = (EditText) findViewById(R.id.etKomentar);

        preferenceHelper = new PreferenceHelper(this);
        Intent iEdit = getIntent();
        iddis = iEdit.getStringExtra(Static.IDDISKUSI);
        detail = iEdit.getStringExtra(Static.DETAILDISKUSI);
        tanggal = iEdit.getStringExtra(Static.TANGGALDISKUSI);
        judul = iEdit.getStringExtra(Static.JUDULDISKUSI);
        mNisn = iEdit.getStringExtra(Static.NISN);

        btnEdit = (Button) findViewById(R.id.btnAdd);
        btnEdit.setText("Submit");
        btnEdit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(etKomentar.getText().toString().equals("")){
                    Toast.makeText(
                            getApplicationContext(),
                            "Komentar tidak boleh kosong!",
                            Toast.LENGTH_SHORT).show();
                }else {
                    new SendBarangs().execute(mNisn);
                }

            }
        });
    }
    /**
     * Async task class to send json
     */
    private class SendBarangs extends AsyncTask<String, Void, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
// Showing progress dialog
            pDialog = new ProgressDialog(AddKomentar.this);
            pDialog.setMessage("Updating your data...");
            pDialog.setCancelable(false);
            pDialog.show();
        }
        @Override
        protected String doInBackground(String... params) {

            Komentar komentar = new Komentar();
            komentar.setKomentar(etKomentar.getText().toString());
            komentar.setNamakomentar(preferenceHelper.getName());
            komentar.setId_diskusi(iddis);

            String result = "";
            try {
                HttpHandler sj = new HttpHandler();
                JSONObject resObj = new JSONObject(sj.sendJsonkomentar(HttpHandler.URL + HttpHandler.INSERT, komentar));
                JSONArray resArr = resObj.getJSONArray(Static.POSTS);
                result = resArr.getString(0);
            } catch (JSONException e) {
                Log.i(TAG, "JSON parse error " + e.getMessage());
            }
            return result;
        }
        @Override
        protected void onPostExecute(String result) {
            super.onPostExecute(result);
// Dismiss the progress dialog
            if (pDialog.isShowing())
                pDialog.dismiss();
            Log.d(TAG, result);
/**
 * Show insert information
 * */
            if (result.equals(Static.SUCCESS)) {
                Toast.makeText(AddKomentar.this, "Barang updated", Toast.LENGTH_LONG).show();
                Intent iEdit = new Intent(AddKomentar.this, MainActivityDrawerKomentar.class);
                iEdit.putExtra(Static.IDDISKUSI, iddis);
                iEdit.putExtra(Static.JUDULDISKUSI, judul);
                iEdit.putExtra(Static.DETAILDISKUSI, detail);
                iEdit.putExtra(Static.TANGGALDISKUSI, tanggal);
                iEdit.putExtra(Static.NISN, preferenceHelper.getNISN());
                startActivity(iEdit);
            } else if (result.equals(Static.FAIL)) {
                Toast.makeText(AddKomentar.this, "Fail to update barang", Toast.LENGTH_LONG).show();
            }
        }
    }
    public void backHome(View view){
        Intent iEdit = new Intent(AddKomentar.this, MainActivityDrawerKomentar.class);
        iEdit.putExtra(Static.IDDISKUSI, iddis);
        iEdit.putExtra(Static.JUDULDISKUSI, judul);
        iEdit.putExtra(Static.DETAILDISKUSI, detail);
        iEdit.putExtra(Static.TANGGALDISKUSI, tanggal);
        iEdit.putExtra(Static.NISN, preferenceHelper.getNISN());
        startActivity(iEdit);



    }
}
