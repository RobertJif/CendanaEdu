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

public class AdapterPelanggaran extends BaseAdapter {
    private static ArrayList<Pelanggaran> listPelanggaran;
    private LayoutInflater mInflater;
    public AdapterPelanggaran(Context context, ArrayList<Pelanggaran> con) {
        listPelanggaran = con;
        mInflater = LayoutInflater.from(context);
    }
    @Override
    public int getCount() {
        return listPelanggaran.size();
    }
    @Override
    public Object getItem(int position) {
        return listPelanggaran.get(position);
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
            convertView = mInflater.inflate(R.layout.list_itempelanggaran, null);
            mHolder = new ViewHolder();
            mHolder.tvtahun = (TextView) convertView.findViewById(R.id.tvtahun);
            mHolder.tvsemester = (TextView) convertView.findViewById(R.id.tvsemester);
            mHolder.tvnamapelanggaran = (TextView) convertView.findViewById(R.id.tvnamapelanggaran);
            mHolder.tvtanggalpelanggaran = (TextView) convertView.findViewById(R.id.tvtanggalpelanggaran);

            convertView.setTag(mHolder);
        } else {
            mHolder = (ViewHolder)convertView.getTag();
        }
// set view content
        mHolder.tvtahun.setText(listPelanggaran.get(position).getTahun());
        mHolder.tvtanggalpelanggaran.setText(listPelanggaran.get(position).getTanggalpelanggaran());
        mHolder.tvsemester.setText(" semester "+ listPelanggaran.get(position).getSemester());
        mHolder.tvnamapelanggaran.setText(listPelanggaran.get(position).getNamapelanggaran());
        return convertView;
    }
    static class ViewHolder {
        TextView tvtahun;
        TextView tvtanggalpelanggaran;
        TextView tvsemester;
        TextView tvnamapelanggaran;

    }
}