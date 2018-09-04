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

public class AdapterSpp extends BaseAdapter {
    private static ArrayList<Spp> listSpp;
    private LayoutInflater mInflater;
    public AdapterSpp(Context context, ArrayList<Spp> con) {
        listSpp = con;
        mInflater = LayoutInflater.from(context);
    }
    @Override
    public int getCount() {
        return listSpp.size();
    }
    @Override
    public Object getItem(int position) {
        return listSpp.get(position);
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
            convertView = mInflater.inflate(R.layout.list_itemspp, null);
            mHolder = new ViewHolder();
            mHolder.tvtahun = (TextView) convertView.findViewById(R.id.tvtahun);
            mHolder.tvsemester = (TextView) convertView.findViewById(R.id.tvsemester);
            mHolder.tvbulan = (TextView) convertView.findViewById(R.id.tvbulan);
            mHolder.tvjumlahspp = (TextView) convertView.findViewById(R.id.tvjumlahspp);
            mHolder.tvstatus = (TextView) convertView.findViewById(R.id.tvstatus);
            mHolder.tvtanggalbayar = (TextView) convertView.findViewById(R.id.tvtanggalbayar);

            convertView.setTag(mHolder);
        } else {
            mHolder = (ViewHolder)convertView.getTag();
        }
// set view content
        mHolder.tvtahun.setText(" "+listSpp.get(position).getTahun());
        mHolder.tvsemester.setText(" Semester "+ listSpp.get(position).getSemester());
        mHolder.tvbulan.setText(" "+listSpp.get(position).getBulan());
        mHolder.tvjumlahspp.setText(" Rp."+listSpp.get(position).getJumlahspp()+",-");
        mHolder.tvstatus.setText(" "+listSpp.get(position).getStatus());
        mHolder.tvtanggalbayar.setText(" "+listSpp.get(position).getTanggalbayar());
        return convertView;
    }
    static class ViewHolder {
        TextView tvtahun;
        TextView tvsemester;
        TextView tvstatus;
        TextView tvbulan;
        TextView tvtanggalbayar;
        TextView tvjumlahspp;


    }
}