package com.project.suci.sia_cendana;

/**
 * Created by Parsania Hardik on 19-Apr-17.
 */
import android.content.Context;
import android.content.SharedPreferences;

public class PreferenceHelper {

    private final String INTRO = "intro";
    private final String NAMA = "nama";
    private final String NISN = "nisn";
    private SharedPreferences app_prefs;
    private Context context;

    public PreferenceHelper(Context context) {
        app_prefs = context.getSharedPreferences("shared",
                Context.MODE_PRIVATE);
        this.context = context;
    }

    public void putIsLogin(boolean loginorout) {
        SharedPreferences.Editor edit = app_prefs.edit();
        edit.putBoolean(INTRO, loginorout);
        edit.commit();
    }
    public boolean getIsLogin() {
        return app_prefs.getBoolean(INTRO, false);
    }

    public void putName(String loginorout) {
        SharedPreferences.Editor edit = app_prefs.edit();
        edit.putString(NAMA, loginorout);
        edit.commit();
    }
    public String getName() {
        return app_prefs.getString(NAMA, "");
    }

    public void putNISN(String loginorout) {
        SharedPreferences.Editor edit = app_prefs.edit();
        edit.putString(NISN, loginorout);
        edit.commit();
    }
    public String getNISN() {
        return app_prefs.getString(NISN, "");
    }

 }
