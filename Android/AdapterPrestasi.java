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

public class AdapterPrestasi extends BaseAdapter {
    private static ArrayList<Prestasi> listPrestasi;
    private LayoutInflater mInflater;
    public AdapterPrestasi(Context context, ArrayList<Prestasi> con) {
        listPrestasi = con;
        mInflater = LayoutInflater.from(context);
    }
    @Override
    public int getCount() {
        return listPrestasi.size();
    }
    @Override
    public Object getItem(int position) {
        return listPrestasi.get(position);
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
            convertView = mInflater.inflate(R.layout.list_itemprestasi, null);
            mHolder = new ViewHolder();
            mHolder.tvtahun = (TextView) convertView.findViewById(R.id.tvtahun);
            mHolder.tvsemester = (TextView) convertView.findViewById(R.id.tvsemester);
            mHolder.tvnamaprestasi = (TextView) convertView.findViewById(R.id.tvnamaprestasi);

            convertView.setTag(mHolder);
        } else {
            mHolder = (ViewHolder)convertView.getTag();
        }
// set view content
        mHolder.tvtahun.setText(listPrestasi.get(position).getTahun());
        mHolder.tvsemester.setText(" semester "+ listPrestasi.get(position).getSemester());
        mHolder.tvnamaprestasi.setText(listPrestasi.get(position).getNamaprestasi());
        return convertView;
    }
    static class ViewHolder {
        TextView tvtahun;
        TextView tvsemester;
        TextView tvnamaprestasi;

    }
}