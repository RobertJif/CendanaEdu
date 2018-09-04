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

public class AdapterMatpelAbsensi extends BaseAdapter {
    private static ArrayList<Absensi> listAbsensi;
    private LayoutInflater mInflater;
    public AdapterMatpelAbsensi(Context context, ArrayList<Absensi> con) {
        listAbsensi = con;
        mInflater = LayoutInflater.from(context);
    }
    @Override
    public int getCount() {
        return listAbsensi.size();
    }
    @Override
    public Object getItem(int position) {
        return listAbsensi.get(position);
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
            convertView = mInflater.inflate(R.layout.list_itemmatpelabsensi, null);
            mHolder = new ViewHolder();
            mHolder.tvmatapelajaran = (TextView) convertView.findViewById(R.id.tvmatapelajaran);
            convertView.setTag(mHolder);
        } else {
            mHolder = (ViewHolder)convertView.getTag();
        }
// set view content
        mHolder.tvmatapelajaran.setText(listAbsensi.get(position).getNama_matapelajaranabsensi());
        return convertView;
    }
    static class ViewHolder {
        TextView tvmatapelajaran;

    }
}