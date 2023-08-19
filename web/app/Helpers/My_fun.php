<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

if (!function_exists('my_encrypt')) {
    function my_encrypt($value)
    {
        $encryption_key = '0SampaI1';
        $encryption_iv  = '09876543211234567890';

        $ciphering      = "AES-256-CBC";
        $options        = 0;
        $key            = hash('sha256', $encryption_key);
        $iv             = substr(hash('sha256', $encryption_iv), 0, 16);
        $encryption     = openssl_encrypt($value, $ciphering, $key, $options, $iv);
        return base64_encode($encryption);
    }
}

if (!function_exists('my_decrypt')) {
    function my_decrypt($encryption)
    {
        $encryption = base64_decode($encryption);

        $encryption_key = '0SampaI1';
        $encryption_iv  = '09876543211234567890';

        $ciphering      = "AES-256-CBC";
        $options        = 0;
        $key            = hash('sha256', $encryption_key);
        $iv             = substr(hash('sha256', $encryption_iv), 0, 16);
        $decryption     = openssl_decrypt($encryption, $ciphering, $key, $options, $iv);
        return $decryption;
    }
}

if (!function_exists('get_acak_id')) {
    function get_acak_id($table = NULL, $pk = NULL)
    {
        $id = 0;
        do {
            $id = rand();
        } while (!empty($table::where($pk, $id)->first()));
        return $id;
    }
}

if (!function_exists('get_kode_urut')) {
    function get_kode_urut($table, $key, $kd)
    {
        $result  = DB::select("SELECT MAX( SUBSTRING( $key,- 4)) AS kd FROM $table WHERE $key LIKE '%$kd%'");
        $kd_urut = $result[0]->kd;

        if ($kd_urut !== null) {
            $kode  = $kd_urut + 1;
            $add_k = str_pad($kode, 4, "0", STR_PAD_LEFT);
            return "{$kd}{$add_k}";
        } else {
            return "{$kd}0001";
        }
    }
}

if (!function_exists('remove_point_space')) {
    function remove_point_space($string)
    {
        return preg_replace('/\.|\s/', '', $string);
    }
}

if (!function_exists('generate_random_name_file')) {
    function generate_random_name_file($file)
    {
        return uniqid() . '-' . date('YmdHi') . '.' . $file->extension();
    }
}

if (!function_exists('tgl_indo')) {
    function tgl_indo($tgl)
    {
        if ($tgl == "0000-00-00") {
            return "-";
        } else {
            $tanggal = substr($tgl, 8, 2);
            $bulan   = get_bulan(substr($tgl, 5, 2));
            $tahun   = substr($tgl, 0, 4);

            return $tanggal . ' ' . $bulan . ', ' . $tahun;
        }
    }
}

if (!function_exists('get_bulan')) {
    function get_bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
}

if (!function_exists('year')) {
    function year($start, $finish)
    {
        $result = [];
        for ($i = $start; $i <= $finish; $i++) {
            $result[] = $i;
        }
        return $result;
    }
}

if (!function_exists('penyebut')) {
    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }
}

if (!function_exists('terbilang')) {
    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }
        return "{$hasil} rupiah";
    }
}

if (!function_exists('huruf')) {
    function huruf($angka)
    {
        $angka = str_replace("1", " SATU", $angka);
        $angka = str_replace("2", " KEDUA", $angka);
        $angka = str_replace("3", " KETIGA", $angka);
        $angka = str_replace("4", " KEEMPAT", $angka);
        $angka = str_replace("5", " KELIMA", $angka);
        $angka = str_replace("6", " KEENAM", $angka);
        $angka = str_replace("7", " KETUJUH", $angka);
        $angka = str_replace("8", " KEDELAPAN", $angka);
        $angka = str_replace("9", " KESEMBILAN", $angka);
        $angka = str_replace("0", " NOL", $angka);
        $angka = str_replace(".", " koma", $angka);
        return $angka;
    }
}

if (!function_exists('get_waktu')) {
    function get_waktu($tgl)
    {
        return date("H : i : s", strtotime($tgl));
    }
}

if (!function_exists('random_color_part')) {
    function random_color_part()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('random_color')) {
    function random_color()
    {
        return random_color_part() . random_color_part() . random_color_part();
    }
}

if (!function_exists('random_number')) {
    function random_number()
    {
        return sprintf("%06d", mt_rand(1, 999999));
    }
}

if (!function_exists('rupiah')) {
    function rupiah($harga)
    {
        return 'Rp. ' . create_separator($harga) . ',-';
    }
}

if (!function_exists('remove_separator')) {
    function remove_separator($harga)
    {
        return str_replace('.', '', $harga);
    }
}

if (!function_exists('create_separator')) {
    function create_separator($harga)
    {
        return number_format($harga, 0, ',', '.');
    }
}

if (!function_exists('add_picture')) {
    function add_picture($request_img)
    {
        // nama
        $picture = generate_random_name_file($request_img);

        // upload
        $request_img->move(upload_path('picture'), $picture);

        return $picture;
    }
}

if (!function_exists('upd_picture')) {
    function upd_picture($request_img, $picture_name)
    {
        del_picture($picture_name);

        $picture = add_picture($request_img);

        return $picture;
    }
}

if (!function_exists('del_picture')) {
    function del_picture($picture_name)
    {
        $file_picture = upload_path('picture/' . $picture_name);

        // hapus
        if (File::exists($file_picture)) {
            File::delete($file_picture);
        };
    }
}

if (!function_exists('add_doc')) {
    function add_doc($request_doc)
    {
        // nama
        $doc = generate_random_name_file($request_doc);

        // upload
        $request_doc->move(upload_path('doc'), $doc);

        return $doc;
    }
}

if (!function_exists('upd_doc')) {
    function upd_doc($request_doc, $doc_name)
    {
        del_doc($doc_name);

        $doc = add_doc($request_doc);

        return $doc;
    }
}

if (!function_exists('del_doc')) {
    function del_doc($doc_name)
    {
        $file_doc = upload_path('doc/' . $doc_name);

        // hapus
        if (File::exists($file_doc)) {
            File::delete($file_doc);
        };
    }
}

if (!function_exists('add_pdf')) {
    function add_pdf($request_pdf)
    {
        // nama
        $pdf = generate_random_name_file($request_pdf);

        // upload
        $request_pdf->move(upload_path('pdf'), $pdf);

        return $pdf;
    }
}

if (!function_exists('upd_pdf')) {
    function upd_pdf($request_pdf, $doc_name)
    {
        del_pdf($doc_name);

        $pdf = add_pdf($request_pdf);

        return $pdf;
    }
}

if (!function_exists('del_pdf')) {
    function del_pdf($doc_name)
    {
        $file_pdf = upload_path('pdf/' . $doc_name);

        // hapus
        if (File::exists($file_pdf)) {
            File::delete($file_pdf);
        };
    }
}

if (!function_exists('count_array_index')) {
    function count_array_index($array, $index)
    {
        $sum = 0;
        foreach ($array as $row) {
            $count = count($row[$index]);
            $sum += ($count === 0 ? 1 : $count);
        }
        return $sum;
    }
}

if (!function_exists('sum_index')) {
    function sum_index($array, $index)
    {
        $sum = 0;
        foreach ($array as $row) {
            $sum += $row[$index];
        }
        return $sum;
    }
}

if (!function_exists('count_age')) {
    function count_age($date_of_birth)
    {
        $result = Carbon::parse($date_of_birth)->diff(Carbon::now())->y;
        return $result;
    }
}

if (!function_exists('count_mounth')) {
    function count_mounth($to, $from)
    {
        $date_to   = Carbon::parse($to)->startOfMonth();
        $date_from = Carbon::parse($from)->startOfMonth();
        $result    = $date_to->diffInMonths($date_from) + 1;
        return $result;
    }
}

if (!function_exists('get_extension')) {
    function get_extension($file)
    {
        $tmp = explode(".", $file);
        $extension = end($tmp);
        return $extension ? $extension : false;
    }
}

if (!function_exists('paginate')) {
    function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}

if (!function_exists('search_multi_array')) {
    function search_multi_array($key, $val, $array)
    {
        $result = [];
        foreach ($array as $element) {
            if (stripos($element[$key], $val) !== FALSE) {
                $result[] = $element;
            }
        }
        return $result;
    }
}

if (!function_exists('get_uri_segment')) {
    function get_uri_segment($url)
    {
        $result = explode("/", parse_url($url, PHP_URL_PATH));
        return $result;
    }
}
