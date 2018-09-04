package com.project.suci.sia_cendana;

import android.content.Context;
import android.graphics.Color;
import android.provider.CalendarContract;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * Created by Robert on 01/11/2016.
 */

public class AdapterKomentar extends BaseAdapter {
    private static ArrayList<Komentar> listKomentar;
    private LayoutInflater mInflater;
    public AdapterKomentar(Context context, ArrayList<Komentar> con) {
        listKomentar = con;
        mInflater = LayoutInflater.from(context);
    }
    @Override
    public int getCount() {
        return listKomentar.size();
    }
    @Override
    public Object getItem(int position) {
        return listKomentar.get(position);
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
            convertView = mInflater.inflate(R.layout.list_itemkomentar, null);
            mHolder = new ViewHolder();
            mHolder.tvnamakomentar = (TextView) convertView.findViewById(R.id.tvnamakomentar);
            mHolder.tvkomentar = (TextView) convertView.findViewById(R.id.tvkomentar);
            mHolder.tvtanggalkomentar = (TextView) convertView.findViewById(R.id.tvtanggalkomentar);
            convertView.setBackgroundColor(Color.parseColor("#f5f5f5"));
            convertView.setTag(mHolder);

        } else {
            mHolder = (ViewHolder)convertView.getTag();
        }
// set view content
        mHolder.tvnamakomentar.setText(listKomentar.get(position).getNamakomentar());
        mHolder.tvkomentar.setText(listKomentar.get(position).getKomentar());
        mHolder.tvtanggalkomentar.setText(listKomentar.get(position).getTanggalkomentar());
        return convertView;
    }
    static class ViewHolder {
        TextView tvnamakomentar;
        TextView tvkomentar;
        TextView tvtanggalkomentar;



    }
}