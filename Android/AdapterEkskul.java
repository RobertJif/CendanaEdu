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

public class AdapterEkskul extends BaseAdapter {
    private static ArrayList<Ekskul> listEkskul;
    private LayoutInflater mInflater;
    public AdapterEkskul(Context context, ArrayList<Ekskul> con) {
        listEkskul = con;
        mInflater = LayoutInflater.from(context);
    }
    @Override
    public int getCount() {
        return listEkskul.size();
    }
    @Override
    public Object getItem(int position) {
        return listEkskul.get(position);
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
            convertView = mInflater.inflate(R.layout.list_itemekskul, null);
            mHolder = new ViewHolder();
            mHolder.tvtahun = (TextView) convertView.findViewById(R.id.tvtahun);
            mHolder.tvsemester = (TextView) convertView.findViewById(R.id.tvsemester);
            mHolder.tvnamaekskul = (TextView) convertView.findViewById(R.id.tvnamaekskul);

            convertView.setTag(mHolder);
        } else {
            mHolder = (ViewHolder)convertView.getTag();
        }
// set view content
        mHolder.tvtahun.setText(listEkskul.get(position).getTahun());
        mHolder.tvsemester.setText(" semester "+ listEkskul.get(position).getSemester());
        mHolder.tvnamaekskul.setText(listEkskul.get(position).getNamaekskul());
        return convertView;
    }
    static class ViewHolder {
        TextView tvtahun;
        TextView tvsemester;
        TextView tvnamaekskul;

    }
}