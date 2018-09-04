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

public class AdapterPengumuman extends BaseAdapter {
    private static ArrayList<Pengumuman> listPengumuman;
    private LayoutInflater mInflater;
    public AdapterPengumuman(Context context, ArrayList<Pengumuman> con) {
        listPengumuman = con;
        mInflater = LayoutInflater.from(context);
    }
    @Override
    public int getCount() {
        return listPengumuman.size();
    }
    @Override
    public Object getItem(int position) {
        return listPengumuman.get(position);
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
            convertView = mInflater.inflate(R.layout.list_itempengumuman, null);
            mHolder = new ViewHolder();
            mHolder.tvnamapengumuman = (TextView) convertView.findViewById(R.id.tvnamapengumuman);

            convertView.setTag(mHolder);
        } else {
            mHolder = (ViewHolder)convertView.getTag();
        }
// set view content
        mHolder.tvnamapengumuman.setText(listPengumuman.get(position).getNama_pengumuman());
        return convertView;
    }
    static class ViewHolder {
        TextView tvnamapengumuman;

    }
}