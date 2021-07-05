<?php

$holidays = array("2020-12-08", "2020-12-25", "2020-12-26", "2021-01-01");

/**
 * @param $i
 * @return string
 */
function getPipeline($i)
{
    switch ($i):
        case 1:
            $str = 'Fijo';
            break;
        case 2:
            $str = 'Voz';
            break;
        case 3:
            $str = 'TI';
            break;
        default:
            $str = '';
            break;
    endswitch;

    return $str;
}

/**
 * STAGES
 * 1 : Fijo - Contactos
 * 2 : Fijo - Oportunidades
 * 3 : Fijo - Propuesta Preparada
 * 4 : Fijo - Propuesta Entregada
 * 5 : Fijo - Negociacion
 * 6 : Voz - Contactos
 * 7 : Voz - Oportunidades
 * 8 : Voz - Propuesta Preparada
 * 9 : Voz - Propuesta Entregada
 * 10 : Voz - Negociacion
 * @param $i
 * @return string
 */
function getStage($i)
{
    switch ($i):
        case 1:
        case 6:
        case 11:
            $str = 'Contactos';
            break;
        case 2:
        case 7:
        case 12:
            $str = 'Oportunidades';
            break;
        case 3:
        case 8:
        case 13:
            $str = 'Propuesta Preparada';
            break;
        case 4:
        case 9:
        case 14:
            $str = 'Propuesta Entregada';
            break;
        case 5:
        case 10:
        case 15:
            $str = 'Negociacion';
            break;
        default:
            $str = '';
            break;
    endswitch;

    return $str;
}

/**
 * @param $str
 * @return array
 */
function descom($str)
{
    return explode(',', $str);
}

/**
 * @param $id
 * @param $date
 * @return string
 */
function encryptLink($id, $date)
{
    $date_enc = str_replace(['-', ' ', ':'], '_', $date);
    return base64_encode($date_enc . '_id_' . $id);
}

/**
 * @param $str
 * @return mixed
 */
function decryptLink($str)
{
    $tmp = base64_decode($str);
    $arr = explode('_', $tmp);
    return $arr[7];
}

/**
 * @param $str
 * @return string
 */
function decrypt($str)
{
    $tmp = base64_decode($str);
    return utf8_encode($tmp);
}

/**
 * @param $d
 * @return string
 */
function getDateBD($d)
{
    $aux = explode('-', $d);
    return $aux[2] . '/' . $aux[1] . '/' . $aux[0];
}

/**
 * @param $d
 * @return string
 */
function getDateHourBD($d)
{
    $aux = explode(' ', $d);
    $aux2 = explode('-', $aux[0]);
    return $aux2[2] . '/' . $aux2[1] . '/' . $aux2[0] . ' ' . $aux[1];
}

/**
 * @param $d
 * @return string
 */
function getDateToForm($d)
{
    $aux = explode('-', $d);
    return $aux[2] . '/' . $aux[1] . '/' . $aux[0];
}

/**
 * @param $d
 * @return string
 */
function getDateHourToForm($d)
{
    $aux = explode(' ', $d);
    $aux2 = explode('-', $aux[0]);
    return $aux2[2] . '/' . $aux2[1] . '/' . $aux2[0] . ' ' . $aux[1];
}

/**
 * @param $d
 * @return string
 */
function getDateMonthToForm($d)
{
    $aux = explode('-', $d);
    return $aux[1] . '/' . $aux[0];
}

/**
 * @param $d
 * @return string
 */
function getFullDate($d)
{
    $date = strtotime($d);
    $week_days = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
    $months = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    $aux_d = date("w", $date);
    $day_w = $week_days[$aux_d];

    $day = date("d", $date);

    $aux_m = date("n", $date);
    $month = $months[$aux_m - 1];

    $year = date("Y", $date);
    $date = $day_w . ", " . $day . " de " . $month . " de " . $year;
    return $date;
}

/**
 * @param $d
 * @return false|int|string
 */
function getMonthDate($d)
{
    $date = strtotime($d);
    $months = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    $aux_m = date("n", $date);
    $month = $months[$aux_m - 1];

    $year = date("Y", $date);
    $date = $month . " de " . $year;
    return $date;
}

/**
 * @param $d
 * @return array
 */
function getArrayDate($d)
{
    $date = strtotime($d);
    $week_days = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
    $months = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    $aux_d = date("w", $date);
    $day_w = $week_days[$aux_d];

    $day = date("d", $date);

    $aux_m = date("n", $date);
    $month_w = $months[$aux_m - 1];

    $month = date("m", $date);

    $year = date("Y", $date);
    return array('day_w' => $day_w, 'day' => $day, 'month_w' => $month_w, 'month' => $month, 'year' => $year);
}

/**
 * @param $d1
 * @param $d2
 * @return string
 * @throws Exception
 */
function getDiffDates($d1, $d2)
{
    $datetime1 = new DateTime($d1);
    $datetime2 = new DateTime($d2);
    $interval = $datetime1->diff($datetime2);

    if ($interval->s > 0):
        if ($interval->i > 0):
            if ($interval->h > 0):
                if ($interval->d > 0):
                    if ($interval->m > 0):
                        if ($interval->y > 0):
                            return $interval->y . "a";
                        endif;
                        return $interval->m . "m";
                    endif;
                    return $interval->d . "d";
                endif;
                return $interval->h . " hrs";
            endif;
            return $interval->i . " mins";
        endif;
        return $interval->s . " secs";
    endif;
    return '';
}

/**
 * @param $d
 * @return string
 */
function setDateBD($d)
{
    $aux = explode('/', $d);
    return $aux[2] . '-' . $aux[1] . '-' . $aux[0];
}

/**
 * @param $e
 * @return string
 */
function getExtension($e)
{
    switch (strtolower($e)):
        // Image
        case "gif":
        case "jpg":
        case "jpeg":
        case "png":
            $ext = "img";
            break;
        // Video
        case "wmv":
        case "mov":
        case "mp4":
        case "avi":
            $ext = "vid";
            break;
        // Zipped
        case "rar":
        case "zip":
            $ext = "rar";
            break;
        // Excel
        case "xls":
        case "xlsx":
        case "csv":
            $ext = "xls";
            break;
        // Powerpoint
        case "ppt":
        case "pptx":
            $ext = "ppt";
            break;
        // AReader
        case "pdf":
            $ext = "pdf";
            break;
        // Word
        case "doc":
        case "docx":
        case "rtf":
            $ext = "doc";
            break;
        // Other
        default:
            $ext = "unk";
            break;
    endswitch;

    return $ext;
}

/**
 * @param $f
 * @return string
 */
function getFilesize($f)
{
    $decimals = 2;
    $bytes = filesize($f);
    $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . $size[$factor];
}

/**
 * @param $str
 * @return mixed
 */
function removeAccents($str)
{
    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ',
        'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç',
        'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý',
        'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē',
        'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ',
        'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ',
        'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő',
        'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť',
        'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź',
        'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ',
        'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ',
        'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή', 'º', '°');
    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N',
        'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c',
        'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y',
        'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E',
        'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H',
        'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L',
        'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o',
        'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't',
        'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z',
        'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U',
        'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω',
        'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η', 'o', 'o');
    return str_replace($a, $b, $str);
}

/**
 * @param $string
 * @return string
 */
function strip_html($string)
{
    $desc = str_replace(array('</p><p>', '<br></p>', '<p>', '</p>', '<br>'), array("\n", '', '', '', "\n"), $string);
    return strip_tags($desc);
}

/**
 * @param $string
 * @param int $width
 * @param string $break
 * @return string
 */
function smart_wordwrap($string, $width = 75, $break = "\n")
{
    // split on problem words over the line length
    $pattern = sprintf('/([^ ]{%d,})/', $width);
    $output = '';
    $words = preg_split($pattern, $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

    foreach ($words as $word):
        if (false !== strpos($word, ' ')):
            // normal behaviour, rebuild the string
            $output .= $word;
        else:
            // work out how many characters would be on the current line
            $wrapped = explode($break, wordwrap($output, $width, $break));
            $count = $width - (strlen(end($wrapped)) % $width);

            // fill the current line and add a break
            $output .= substr($word, 0, $count) . $break;

            // wrap any remaining characters from the problem word
            $output .= wordwrap(substr($word, $count), $width, $break, true);
        endif;
    endforeach;

    // wrap the final output
    return wordwrap($output, $width, $break);
}

/**
 * @param $_rol
 * @return string
 */
function fullRut($_rol)
{
    while ($_rol[0] == "0"):
        $_rol = substr($_rol, 1);
    endwhile;

    $factor = 2;
    $suma = 0;

    for ($i = strlen($_rol) - 1; $i >= 0; $i--):
        $suma += $factor * $_rol[$i];
        $factor = $factor % 7 == 0 ? 2 : $factor + 1;
    endfor;

    $dv = 11 - $suma % 11;

    $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
    return number_format($_rol, 0, '', '.') . "-" . $dv;
}

/**
 * @param $_rol
 * @return bool
 */
function isRut($_rol)
{
    $rut_sin_puntos = str_replace('.', "", $_rol);
    $numerosentrada = explode("-", $rut_sin_puntos);
    $verificador = $numerosentrada[1];
    $numeros = strrev($numerosentrada[0]);
    $count = strlen($numeros);
    $count = $count - 1;
    $suma = 0;
    $recorreString = 0;
    $multiplo = 2;

    for ($i = 0; $i <= $count; $i++):
        $resultadoM = $numeros[$recorreString] * $multiplo;
        $suma = $suma + $resultadoM;
        if ($multiplo == 7) $multiplo = 1;
        $multiplo++;
        $recorreString++;
    endfor;

    $resto = $suma % 11;
    $dv = 11 - $resto;
    if ($dv == 11)
        $dv = 0;
    elseif ($dv == 10)
        $dv = 'K';

    return $verificador == $dv;
}

function getWorkingDays($from, $to, $holidays)
{
    $workingDays = [1, 2, 3, 4, 5];
    $holidayDays = array_merge(['*-12-25', '*-01-01'], $holidays);

    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);

    $days = 0;
    foreach ($periods as $period) {
        if (!in_array($period->format('N'), $workingDays)) continue;
        if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
        if (in_array($period->format('*-m-d'), $holidayDays)) continue;
        $days++;
    }
    return $days;
}