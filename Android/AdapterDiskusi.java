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

public class AdapterDiskusi extends BaseAdapter {
    private static ArrayList<Diskusi> listDiskusi;
    private LayoutInflater mInflater;
    public AdapterDiskusi(Context context, ArrayList<Diskusi> con) {
        listDiskusi = con;
        mInflater = LayoutInflater.from(context);
    }
    @Override
    public int getCount() {
        return listDiskusi.size();
    }
    @Override
    public Object getItem(int position) {
        return listDiskusi.get(position);
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
            convertView = mInflater.inflate(R.layout.list_itemdiskusi, null);
            mHolder = new ViewHolder();
            mHolder.tvjuduldiskusi = (TextView) convertView.findViewById(R.id.tvjuduldiskusi);
            mHolder.tvtanggaldiskusi = (TextView) convertView.findViewById(R.id.tvtanggaldiskusi);
         convertView.setTag(mHolder);
        } else {
            mHolder = (ViewHolder)convertView.getTag();
        }
// set view content
        mHolder.tvjuduldiskusi.setText(listDiskusi.get(position).getJuduldiskusi());
        mHolder.tvtanggaldiskusi.setText("Dimulai "+ listDiskusi.get(position).getTanggaldiskusi());
        return convertView;
    }
    static class ViewHolder {
        TextView tvjuduldiskusi;
        TextView tvtanggaldiskusi;



    }
}