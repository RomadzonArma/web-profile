<?php
    function waktuBaca($text)
    {
        $var_x = str_word_count(strip_tags($text));
        $par_waktu = 90;
        $ht_mnt = floor($var_x / $par_waktu);
        $ht_dtk = floor($var_x % $par_waktu / ($par_waktu / 60));
        return $ht_mnt . ' menit' . ', ' . $ht_dtk . ' detik';
    }

    function limitText($text, $length) {
        if (strlen($text) >= $length) {
            $new_text = substr($text,0,$length) . '...';
        }else{
            $new_text = $text;
        }
        return $new_text;
    }

    function namaBulan($no) {
        if (empty($no)) {
            $no = 0;
        }
        if ($no == 0) {
            return 'Tidak Ada';
        }
        $arr = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return $arr[$no - 1];
    }

    function namaBulanSingkat($no) {
        $arr = ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES'];
        return $arr[$no - 1];
    }

    function checkNol($nilai){
        if($nilai == 0){
            return null;
        }elseif($nilai == ''){
            return null;
        }else{
            return $nilai;
        }
    }



    function tgl_indo_timestamp($tgl)
    {
        if (empty($tgl) || $tgl == '-') {
            echo "<span class='text-danger'>Tidak Ada</span>";
        }else{
            $inttime = date('Y-m-d H:i', strtotime($tgl)); //mengubah format menjadi tanggal biasa
            $tglBaru = explode(" ", $inttime); //memecah berdasarkan spaasi

            $tglBaru1 = $tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
            $tglBaru2 = $tglBaru[1]; //mendapatkan fotmat hh:ii:ss
            $tglBarua = explode("-", $tglBaru1); //lalu memecah variabel berdasarkan -

            $tgl = $tglBarua[2];
            $bln = $tglBarua[1];
            $thn = $tglBarua[0];

            $bln = namaBulan($bln); //mengganti bulan angka menjadi text dari fungsi bulan
            $ubahTanggal = "$tgl $bln $thn Pukul $tglBaru2 "; //hasil akhir tanggal

            return $ubahTanggal;
        }
    }

    function tanggalIndonesia($date) {
        if (empty($date) || $date == '-') {
            echo "<span class='text-danger'>Tidak Ada</span>";
        }else{
            $arr = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $date = \Carbon\Carbon::parse($date);
            return $date->format('d') .' '. $arr[$date->format('n') - 1] .' '. $date->format('Y');
        }
    }

    function encode_id($id_)
    {
        return substr(md5($id_), 0, 20) . $id_ . substr(md5($id_), 20, 12);
    }

    function decode_id($id_)
    {
        return substr($id_, 20, strlen($id_) - 32);
    }

    if (! function_exists('divnum')) {

        function divnum($numerator, $denominator)
        {
            return $denominator == 0 ? 0 : ($numerator / $denominator);
        }

    }

    function getNameFromNumber($num) {
        $numeric = ($num - 1) % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval(($num - 1) / 26);
        if ($num2 > 0) {
            return getNameFromNumber($num2) . $letter;
        } else {
            return $letter;
        }
    }

?>
