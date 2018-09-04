package com.project.suci.sia_cendana;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * Created by Robert on 01/11/2016.
 */

public class AdapterSiswa extends BaseAdapter {
    private static ArrayList<Siswa> listSiswa;
    private LayoutInflater mInflater;
    public AdapterSiswa(Context context, ArrayList<Siswa> con) {
        listSiswa = con;
        mInflater = LayoutInflater.from(context);
    }
    @Override
    public int getCount() {
        return listSiswa.size();
    }
    @Override
    public Object getItem(int position) {
        return listSiswa.get(position);
    }
    @Override
    public long getItemId(int position) {
        return position;
    }
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        ViewHolder mHolder;
// Initiate view holder
        if (convertView == null) {
            convertView = mInflater.inflate(R.layout.list_itemsiswa, null);
            mHolder = new ViewHolder();
            mHolder.tvNisn = (TextView) convertView.findViewById(R.id.tvNISN);
            mHolder.tvNamasiswa = (TextView) convertView.findViewById(R.id.tvNamasiswa);
            mHolder.tvTempatlahir = (TextView) convertView.findViewById(R.id.tvTempatlahir);
            mHolder.tvTanggallahir = (TextView) convertView.findViewById(R.id.tvTanggallahir);
            mHolder.tvAgama = (TextView) convertView.findViewById(R.id.tvAgama);
            mHolder.tvJeniskelamin = (TextView) convertView.findViewById(R.id.tvJeniskelamin);
            mHolder.tvAlamat = (TextView) convertView.findViewById(R.id.tvAlamat);
            mHolder.tvNamaayah = (TextView) convertView.findViewById(R.id.tvNamaayah);
            mHolder.tvNamaibu = (TextView) convertView.findViewById(R.id.tvNamaibu);
            mHolder.tvTelepon = (TextView) convertView.findViewById(R.id.tvTelepon);


            convertView.setTag(mHolder);
        } else {
            mHolder = (ViewHolder)convertView.getTag();
        }
        mHolder.tvNisn.setText(listSiswa.get(position).getNisn());
        mHolder.tvNamasiswa.setText(listSiswa.get(position).getNama_siswa());
        mHolder.tvTempatlahir.setText(listSiswa.get(position).getTempatlahir());
        mHolder.tvTanggallahir.setText(listSiswa.get(position).getTanggallahir());
        mHolder.tvAgama.setText(listSiswa.get(position).getAgama());
        mHolder.tvJeniskelamin.setText(listSiswa.get(position).getJeniskelamin());
        mHolder.tvAlamat.setText(listSiswa.get(position).getAlamat());
        mHolder.tvNamaayah.setText(listSiswa.get(position).getNama_ayah());
        mHolder.tvNamaibu.setText(listSiswa.get(position).getNama_ibu());
        mHolder.tvTelepon.setText(listSiswa.get(position).getTelepon());

        return convertView;
    }
    static class ViewHolder {
        TextView tvNisn;
        TextView tvNamasiswa;
        TextView tvTempatlahir;
        TextView tvTanggallahir;
        TextView tvAgama;
        TextView tvJeniskelamin;
        TextView tvAlamat;
        TextView tvNamaayah;
        TextView tvNamaibu;
        TextView tvTelepon;


    }
}