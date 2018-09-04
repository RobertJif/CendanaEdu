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

public class AdapterSemester extends BaseAdapter {
    private static ArrayList<Semester> listSemester;
    private LayoutInflater mInflater;
    public AdapterSemester(Context context, ArrayList<Semester> con) {
        listSemester = con;
        mInflater = LayoutInflater.from(context);
    }
    @Override
    public int getCount() {
        return listSemester.size();
    }
    @Override
    public Object getItem(int position) {
        return listSemester.get(position);
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
            convertView = mInflater.inflate(R.layout.list_itemsemester, null);
            mHolder = new ViewHolder();
            mHolder.tvtahun = (TextView) convertView.findViewById(R.id.tvtahun);
            mHolder.tvsemesterc = (TextView) convertView.findViewById(R.id.tvsemesterc);

            mHolder.tvkelas = (TextView) convertView.findViewById(R.id.tvkelas);
            mHolder.tvkategorikelas = (TextView) convertView.findViewById(R.id.tvkategorikelas);
            mHolder.tvjurusan = (TextView) convertView.findViewById(R.id.tvjurusan);
            convertView.setTag(mHolder);
        } else {
            mHolder = (ViewHolder)convertView.getTag();
        }
// set view content
        mHolder.tvtahun.setText("Tahun Ajaran : "+listSemester.get(position).getTahun());
        mHolder.tvsemesterc.setText("Semester : "+ listSemester.get(position).getSemesterc());
        mHolder.tvkategorikelas.setText(listSemester.get(position).getKategorikelas());
        mHolder.tvkelas.setText(listSemester.get(position).getKelas());
        mHolder.tvjurusan.setText(listSemester.get(position).getJurusan());
        return convertView;
    }
    static class ViewHolder {
        TextView tvtahun;
        TextView tvsemesterc;
        TextView tvkategorikelas;
        TextView tvkelas;
        TextView tvjurusan;



    }
}