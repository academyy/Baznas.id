<?php
error_reporting(~E_NOTICE);
session_start();
include 'config.php';
include 'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);

$mod = $_GET['m'];
$act = $_GET['act'];

$rows = $db->get_results("SELECT kode_alternatif, nama_alternatif FROM tb_alternatif ORDER BY kode_alternatif");
foreach ($rows as $row) {
    $ALTERNATIF[$row->kode_alternatif] = $row->nama_alternatif;
}

$rows = $db->get_results("SELECT * FROM tb_kriteria ORDER BY kode_kriteria");
foreach ($rows as $row) {
    $KRITERIA[$row->kode_kriteria] = $row;
}

$SAW_crips = SAW_get_crips();

function get_rank($array)
{
    $data = $array;
    arsort($data);
    $no = 1;
    $new = array();
    foreach ($data as $key => $val) {
        $new[$key] = $no++;
    }
    return $new;
}

function SAW_get_crips()
{
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_crips ORDER BY kode_crips");
    $data = array();
    foreach ($rows as $row) {
        $data[$row->kode_crips] = $row;
    }
    return $data;
}

function get_rel_alternatif()
{
    global $db;
    $rows = $db->get_results("SELECT a.kode_alternatif, k.kode_kriteria, c.kode_crips
        FROM tb_alternatif a 
        	INNER JOIN tb_rel_alternatif ra ON ra.kode_alternatif=a.kode_alternatif
        	INNER JOIN tb_kriteria k ON k.kode_kriteria=ra.kode_kriteria
        	LEFT JOIN tb_crips c ON c.kode_crips=ra.kode_crips
        ORDER BY a.kode_alternatif, k.kode_kriteria");
    $data = array();
    foreach ($rows as $row) {
        $data[$row->kode_alternatif][$row->kode_kriteria] = $row->kode_crips;
    }
    return $data;
}

function get_normal($rel_alternatif, $max = true)
{
    global $KRITERIA, $SAW_crips;

    $arr = array();
    foreach ($rel_alternatif as $key => $val) {
        $temp = array();
        foreach ($val as $k => $v) {
            $arr[$k]['l'][] = $SAW_crips[$v]->nilai_l;
            $arr[$k]['u'][] = $SAW_crips[$v]->nilai_u;
        }
    }
    $arr2 = array();
    foreach ($arr as $key => $val) {
        $arr2[$key]['min'] = min($val['l']);
        $arr2[$key]['max'] = max($val['u']);
    }

    $arr3 = array();
    foreach ($rel_alternatif as $key => $val) {
        foreach ($val as $k => $v) {
            if ($KRITERIA[$k]->atribut == 'benefit') {
                $arr3[$key][$k]['l'] = $SAW_crips[$v]->nilai_l / $arr2[$k]['max'];
                $arr3[$key][$k]['m'] = $SAW_crips[$v]->nilai_m / $arr2[$k]['max'];
                $arr3[$key][$k]['u'] = $SAW_crips[$v]->nilai_u / $arr2[$k]['max'];
            } else {
                $arr3[$key][$k]['l'] = $arr2[$k]['min'] / $SAW_crips[$v]->nilai_l;
                $arr3[$key][$k]['m'] = $arr2[$k]['min'] / $SAW_crips[$v]->nilai_m;
                $arr3[$key][$k]['u'] = $arr2[$k]['min'] / $SAW_crips[$v]->nilai_u;
            }
        }
    }
    //echo '<pre>' . print_r($arr3, 1) . '</pre>';
    return $arr3;
}

function get_terbobot($normal)
{
    global $KRITERIA;
    $arr = array();
    foreach ($normal as $key => $val) {
        foreach ($val as $k => $v) {
            foreach ($v as $a => $b) {
                $arr[$key][$k][$a] = $b * $KRITERIA[$k]->bobot;
            }
        }
    }
    return $arr;
}

function get_rata($terbobot)
{
    global $KRITERIA;
    $arr = array();
    foreach ($terbobot as $key => $val) {
        foreach ($val as $k => $v) {
            $arr[$key][$k] = array_sum($v) / count($v);
        }
    }
    return $arr;
}

function get_kriteria_option($selected = 0)
{
    global $KRITERIA;
    $a = '';
    foreach ($KRITERIA as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val->nama_kriteria</option>";
        else
            $a .= "<option value='$key'>$val->nama_kriteria</option>";
    }
    return $a;
}

function get_bobot_option($selected = '')
{
    global $NILAI;
    $a = '';
    foreach ($NILAI as $key => $val) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$key - $val</option>";
        else
            $a .= "<option value='$key'>$key - $val</option>";
    }
    return $a;
}

function get_atribut_option($selected = '')
{
    $atribut = array('benefit' => 'Benefit', 'cost' => 'Cost');
    $a = '';
    foreach ($atribut as $key => $val) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$val</option>";
        else
            $a .= "<option value='$key'>$val</option>";
    }
    return $a;
}

function get_total($terbobot)
{
    $arr = array();
    foreach ($terbobot as $key => $val) {
        $arr[$key] = array_sum($val);
    }
    return $arr;
}

function kode_oto($field, $table, $prefix, $length)
{
    global $db;
    $var = $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . (substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function set_value($key = null, $default = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];

    if (isset($_GET[$key]))
        return $_GET[$key];

    return $default;
}

function esc_field($str)
{
    return addslashes($str);
}

function get_option($option_name)
{
    global $db;
    return $db->get_var("SELECT option_value FROM tb_options WHERE option_name='$option_name'");
}

function update_option($option_name, $option_value)
{
    global $db;
    return $db->query("UPDATE tb_options SET option_value='$option_value' WHERE option_name='$option_name'");
}

function redirect_js($url)
{
    echo '<script type="text/javascript">window.location.replace("' . $url . '");</script>';
}

function alert($url)
{
    echo '<script type="text/javascript">alert("' . $url . '");</script>';
}

function print_msg($msg, $type = 'danger')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}

function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
