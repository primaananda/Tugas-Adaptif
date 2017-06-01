<?php

use Illuminate\Database\Seeder;
use App\Penduduk;

class PendudukSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penduduk = new Penduduk();
        $penduduk->noKtp = 1237687314692234;
        $penduduk->nama = "Febby Febriansyah";
        $penduduk->tglLahir = "17-02-1996";
		$penduduk->tmptLahir = "Bandung";
        $penduduk->jk = 1;
        $penduduk->agama = "islam";
        $penduduk->alamat = "jl. Randusari Raya VII  No.30D";
		$penduduk->noTelp = "081377881234";
        $penduduk->save();

        $penduduk = new Penduduk();
        $penduduk->noKtp = 1308304328420859;
        $penduduk->nama = "Agnes Monica";
        $penduduk->tglLahir = "20-04-1986";
		$penduduk->tmptLahir = "Jakarta";
        $penduduk->jk = 2;
        $penduduk->agama = "Kristen";
        $penduduk->alamat = "jl. Jakarta No.40";
		$penduduk->noTelp = "085689001290";
        $penduduk->save();

        $penduduk = new Penduduk();
        $penduduk->noKtp = 3019847323109487;
        $penduduk->nama = "Andhika Gilang";
        $penduduk->tglLahir = "12-02-1996";
		$penduduk->tmptLahir = "Bandung";
        $penduduk->jk = 1;
        $penduduk->agama = "islam";
        $penduduk->alamat = "jl. Astana Anyar No.20";
		$penduduk->noTelp = "081898910923";
        $penduduk->save();
    }
}
