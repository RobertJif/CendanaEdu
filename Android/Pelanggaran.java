package com.project.suci.sia_cendana;

/**
 * Created by Robert on 01/11/2016.
 */

public class Pelanggaran {
    String namapelanggaran;
    String tahun;
    String semester;
    String tanggalpelanggaran;

    public String getTanggalpelanggaran() {
        return tanggalpelanggaran;
    }

    public void setTanggalpelanggaran(String tanggalpelanggaran) {
        this.tanggalpelanggaran = tanggalpelanggaran;
    }

    public String getNamapelanggaran() {
        return namapelanggaran;
    }

    public void setNamapelanggaran(String namapelanggaran) {
        this.namapelanggaran = namapelanggaran;
    }

    public String getTahun() {
        return tahun;
    }

    public void setTahun(String tahun) {
        this.tahun = tahun;
    }

    public String getSemester() {
        return semester;
    }

    public void setSemester(String semester) {
        this.semester = semester;
    }
}
