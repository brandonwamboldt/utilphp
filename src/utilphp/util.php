<?php

namespace utilphp;

/**
 * util.php
 *
 * util.php is a library of helper functions for common tasks such as
 * formatting bytes as a string or displaying a date in terms of how long ago
 * it was in human readable terms (E.g. 4 minutes ago). The library is entirely
 * contained within a single file and hosts no dependencies. The library is
 * designed to avoid any possible conflicts.
 *
 * @author Brandon Wamboldt <brandon.wamboldt@gmail.com>
 * @link   http://github.com/brandonwamboldt/utilphp/ Official Documentation
 */
class util
{
    /**
     * A constant representing the number of seconds in a minute, for
     * making code more verbose
     *
     * @var integer
     */
    const SECONDS_IN_A_MINUTE = 60;

    /**
     * A constant representing the number of seconds in an hour, for making
     * code more verbose
     *
     * @var integer
     */
    const SECONDS_IN_A_HOUR = 3600;
    const SECONDS_IN_AN_HOUR = 3600;

    /**
     * A constant representing the number of seconds in a day, for making
     * code more verbose
     *
     * @var integer
     */
    const SECONDS_IN_A_DAY = 86400;

    /**
     * A constant representing the number of seconds in a week, for making
     * code more verbose
     *
     * @var integer
     */
    const SECONDS_IN_A_WEEK = 604800;

    /**
     * A constant representing the number of seconds in a month (30 days),
     * for making code more verbose
     *
     * @var integer
     */
    const SECONDS_IN_A_MONTH = 2592000;

    /**
     * A constant representing the number of seconds in a year (365 days),
     * for making code more verbose
     *
     * @var integer
     */
    const SECONDS_IN_A_YEAR = 31536000;

    /**
     * A collapse icon, using in the dump_var function to allow collapsing
     * an array or object
     *
     * @var string
     */
    public static $icon_collapse = 'iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAMAAADXT/YiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA2RpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo3MjlFRjQ2NkM5QzJFMTExOTA0MzkwRkI0M0ZCODY4RCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFNzFDNDQyNEMyQzkxMUUxOTU4MEM4M0UxRDA0MUVGNSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFNzFDNDQyM0MyQzkxMUUxOTU4MEM4M0UxRDA0MUVGNSIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IFdpbmRvd3MiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo3NDlFRjQ2NkM5QzJFMTExOTA0MzkwRkI0M0ZCODY4RCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo3MjlFRjQ2NkM5QzJFMTExOTA0MzkwRkI0M0ZCODY4RCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PuF4AWkAAAA2UExURU9t2DBStczM/1h16DNmzHiW7iNFrypMvrnD52yJ4ezs7Onp6ejo6P///+Tk5GSG7D9h5SRGq0Q2K74AAAA/SURBVHjaLMhZDsAgDANRY3ZISnP/y1ZWeV+jAeuRSky6cKL4ryDdSggP8UC7r6GvR1YHxjazPQDmVzI/AQYAnFQDdVSJ80EAAAAASUVORK5CYII=';

    /**
     * A collapse icon, using in the dump_var function to allow collapsing
     * an array or object
     *
     * @var string
     */
    public static $icon_expand = 'iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAMAAADXT/YiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA2RpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo3MTlFRjQ2NkM5QzJFMTExOTA0MzkwRkI0M0ZCODY4RCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFQzZERTJDNEMyQzkxMUUxODRCQzgyRUNDMzZEQkZFQiIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFQzZERTJDM0MyQzkxMUUxODRCQzgyRUNDMzZEQkZFQiIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IFdpbmRvd3MiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo3MzlFRjQ2NkM5QzJFMTExOTA0MzkwRkI0M0ZCODY4RCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo3MTlFRjQ2NkM5QzJFMTExOTA0MzkwRkI0M0ZCODY4RCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PkmDvWIAAABIUExURU9t2MzM/3iW7ubm59/f5urq85mZzOvr6////9ra38zMzObm5rfB8FZz5myJ4SNFrypMvjBStTNmzOvr+mSG7OXl8T9h5SRGq/OfqCEAAABKSURBVHjaFMlbEoAwCEPRULXF2jdW9r9T4czcyUdA4XWB0IgdNSybxU9amMzHzDlPKKu7Fd1e6+wY195jW0ARYZECxPq5Gn8BBgCr0gQmxpjKAwAAAABJRU5ErkJggg==';

    private static $hasArray = false;

    /**
     * Map of special non-ASCII characters and suitable ASCII replacement
     * characters.
     *
     * @see https://github.com/jbroadway/urlify/blob/master/URLify.php
     */
    public static $maps = array(
        'de' => array( /* German */
            'Ä' => 'Ae', 'Ö' => 'Oe', 'Ü' => 'Ue', 'ä' => 'ae', 'ö' => 'oe', 'ü' => 'ue', 'ß' => 'ss',
            'ẞ' => 'SS'
        ),
        'latin' => array(
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A','Ă' => 'A', 'Æ' => 'AE', 'Ç' =>
            'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
            'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' =>
            'O', 'Ő' => 'O', 'Ø' => 'O','Ș' => 'S','Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U',
            'Ý' => 'Y', 'Þ' => 'TH', 'ß' => 'ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' =>
            'a', 'å' => 'a', 'ă' => 'a', 'æ' => 'ae', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
            'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' =>
            'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 'ø' => 'o', 'ș' => 's', 'ț' => 't', 'ù' => 'u', 'ú' => 'u',
            'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 'ÿ' => 'y'
        ),
        'latin_symbols' => array(
            '©' => '(c)'
        ),
        'el' => array( /* Greek */
            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
            'Ϋ' => 'Y'
        ),
        'tr' => array( /* Turkish */
            'ş' => 's', 'Ş' => 'S', 'ı' => 'i', 'İ' => 'I', 'ç' => 'c', 'Ç' => 'C', 'ü' => 'u', 'Ü' => 'U',
            'ö' => 'o', 'Ö' => 'O', 'ğ' => 'g', 'Ğ' => 'G'
        ),
        'ru' => array( /* Russian */
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
            'Я' => 'Ya',
            '№' => ''
        ),
        'uk' => array( /* Ukrainian */
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G', 'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g'
        ),
        'cs' => array( /* Czech */
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z', 'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T',
            'Ů' => 'U', 'Ž' => 'Z'
        ),
        'pl' => array( /* Polish */
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
            'ż' => 'z', 'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'O', 'Ś' => 'S',
            'Ź' => 'Z', 'Ż' => 'Z'
        ),
        'ro' => array( /* Romanian */
            'ă' => 'a', 'â' => 'a', 'î' => 'i', 'ș' => 's', 'ț' => 't', 'Ţ' => 'T', 'ţ' => 't'
        ),
        'lv' => array( /* Latvian */
            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
            'š' => 's', 'ū' => 'u', 'ž' => 'z', 'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i',
            'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z'
        ),
        'lt' => array( /* Lithuanian */
            'ą' => 'a', 'č' => 'c', 'ę' => 'e', 'ė' => 'e', 'į' => 'i', 'š' => 's', 'ų' => 'u', 'ū' => 'u', 'ž' => 'z',
            'Ą' => 'A', 'Č' => 'C', 'Ę' => 'E', 'Ė' => 'E', 'Į' => 'I', 'Š' => 'S', 'Ų' => 'U', 'Ū' => 'U', 'Ž' => 'Z'
        ),
        'vn' => array( /* Vietnamese */
            'Á' => 'A', 'À' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A', 'Ă' => 'A', 'Ắ' => 'A', 'Ằ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ặ' => 'A', 'Â' => 'A', 'Ấ' => 'A', 'Ầ' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A', 'Ậ' => 'A',
            'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a',
            'É' => 'E', 'È' => 'E', 'Ẻ' => 'E', 'Ẽ' => 'E', 'Ẹ' => 'E', 'Ê' => 'E', 'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E',
            'é' => 'e', 'è' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e', 'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e',
            'Í' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i',
            'Ó' => 'O', 'Ò' => 'O', 'Ỏ' => 'O', 'Õ' => 'O', 'Ọ' => 'O', 'Ô' => 'O', 'Ố' => 'O', 'Ồ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O',
            'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o',
            'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U', 'Ư' => 'U', 'Ứ' => 'U', 'Ừ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U',
            'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u',
            'Ý' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y',
            'Đ' => 'D', 'đ' => 'd'
        ),
        'ar' => array( /* Arabic */
            'أ' => 'a', 'ب' => 'b', 'ت' => 't', 'ث' => 'th', 'ج' => 'g', 'ح' => 'h', 'خ' => 'kh', 'د' => 'd',
            'ذ' => 'th', 'ر' => 'r', 'ز' => 'z', 'س' => 's', 'ش' => 'sh', 'ص' => 's', 'ض' => 'd', 'ط' => 't',
            'ظ' => 'th', 'ع' => 'aa', 'غ' => 'gh', 'ف' => 'f', 'ق' => 'k', 'ك' => 'k', 'ل' => 'l', 'م' => 'm',
            'ن' => 'n', 'ه' => 'h', 'و' => 'o', 'ي' => 'y'
        ),
        'sr' => array( /* Serbian */
            'ђ' => 'dj', 'ј' => 'j', 'љ' => 'lj', 'њ' => 'nj', 'ћ' => 'c', 'џ' => 'dz', 'đ' => 'dj',
            'Ђ' => 'Dj', 'Ј' => 'j', 'Љ' => 'Lj', 'Њ' => 'Nj', 'Ћ' => 'C', 'Џ' => 'Dz', 'Đ' => 'Dj'
        ),
        'az' => array( /* Azerbaijani */
            'ç' => 'c', 'ə' => 'e', 'ğ' => 'g', 'ı' => 'i', 'ö' => 'o', 'ş' => 's', 'ü' => 'u',
            'Ç' => 'C', 'Ə' => 'E', 'Ğ' => 'G', 'İ' => 'I', 'Ö' => 'O', 'Ş' => 'S', 'Ü' => 'U'
        ),
    );

    /**
     * The character map for the designated language
     *
     * @see https://github.com/jbroadway/urlify/blob/master/URLify.php
     */
    private static $map = array();

    /**
     * The character list as a string.
     *
     * @see https://github.com/jbroadway/urlify/blob/master/URLify.php
     */
    private static $chars = '';

    /**
     * The character list as a regular expression.
     *
     * @see https://github.com/jbroadway/urlify/blob/master/URLify.php
     */
    private static $regex = '';

    /**
     * The current language
     *
     * @see https://github.com/jbroadway/urlify/blob/master/URLify.php
     */
    private static $language = '';

    /**
     * Initializes the character map.
     *
     * @see https://github.com/jbroadway/urlify/blob/master/URLify.php
     */
    private static function initLanguageMap($language = '')
    {
        if (count(self::$map) > 0 && (($language == '') || ($language == self::$language))) {
            return;
        }

        // Is a specific map associated with $language?
        if (isset(self::$maps[$language]) && is_array(self::$maps[$language])) {
            // Move this map to end. This means it will have priority over others
            $m = self::$maps[$language];
            unset(self::$maps[$language]);
            self::$maps[$language] = $m;
        }

        // Reset static vars
        self::$language = $language;
        self::$map = array();
        self::$chars = '';

        foreach (self::$maps as $map) {
            foreach ($map as $orig => $conv) {
                self::$map[$orig] = $conv;
                self::$chars .= $orig;
            }
        }

        self::$regex = '/[' . self::$chars . ']/u';
    }


    /**
     * Access an array index, retrieving the value stored there if it
     * exists or a default if it does not. This function allows you to
     * concisely access an index which may or may not exist without
     * raising a warning.
     *
     * @param  array  $var     Array to access
     * @param  string $field   Index to access in the array
     * @param  mixed  $default Default value to return if the key is not
     *                         present in the array
     * @return mixed
     */
    public static function array_get( & $var, $default = NULL )
    {
        if ( isset( $var ) ) {
            return $var;
        }

        return $default;
    }

    /**
     * Display a variable's contents using nice HTML formatting and will
     * properly display the value of booleans as true or false
     *
     * @see var_dump_plain()
     *
     * @param  mixed $var The variable to dump
     * @return string
     */
    public static function var_dump( $var, $return = FALSE , $expandLevel = 1)
    {
        self::$hasArray = false;
        $toggScript = 'var colToggle = function(toggID) {var img = document.getElementById(toggID);if (document.getElementById(toggID + "-collapsable").style.display == "none") {document.getElementById(toggID + "-collapsable").style.display = "inline";setImg(toggID, 0);var previousSibling = document.getElementById(toggID + "-collapsable").previousSibling;while (previousSibling != null && (previousSibling.nodeType != 1 || previousSibling.tagName.toLowerCase() != "br")) {previousSibling = previousSibling.previousSibling;}} else {document.getElementById(toggID + "-collapsable").style.display = "none";setImg(toggID, 1);var previousSibling = document.getElementById(toggID + "-collapsable").previousSibling; while (previousSibling != null && (previousSibling.nodeType != 1 || previousSibling.tagName.toLowerCase() != "br")) {previousSibling = previousSibling.previousSibling;}}};';
        $imgScript = 'var setImg = function(objID,imgID,addStyle) {var imgStore = ["data:image/png;base64,' . self::$icon_collapse . '", "data:image/png;base64,' . self::$icon_expand . '"];if (objID) {document.getElementById(objID).setAttribute("src", imgStore[imgID]);if (addStyle){document.getElementById(objID).setAttribute("style", "position:relative;left:-5px;top:-1px;cursor:pointer;");}}};';
        $jsCode = preg_replace( '/ +/', ' ', '<script>' . $toggScript . $imgScript . '</script>');
        $html = '<pre style="margin-bottom: 18px;' .
            'background: #f7f7f9;' .
            'border: 1px solid #e1e1e8;' .
            'padding: 8px;' .
            'border-radius: 4px;' .
            '-moz-border-radius: 4px;' .
            '-webkit-border radius: 4px;' .
            'display: block;' .
            'font-size: 12.05px;' .
            'white-space: pre-wrap;' .
            'word-wrap: break-word;' .
            'color: #333;' .
            'font-family: Menlo,Monaco,Consolas,\'Courier New\',monospace;">';
        $done  = array();
        $html .= self::var_dump_plain( $var , intval($expandLevel), 0, $done);
        $html .= '</pre>';

        if (self::$hasArray) {
            $html = $jsCode . $html;
        }

        if ( ! $return ) {
            echo $html;
        }

        return $html;
    }

    /**
     * Display a variable's contents using nice HTML formatting (Without
     * the <pre> tag) and will properly display the values of variables
     * like booleans and resources. Supports collapsable arrays and objects
     * as well.
     *
     * @param  mixed $var The variable to dump
     * @return string
     */
    public static function var_dump_plain( $var , $expLevel, $depth = 0, $done = array() )
    {
        $html = '';

        if ($expLevel > 0) {
            $expLevel--;
            $setImg = 0;
            $setStyle = 'display:inline;';
        } elseif ($expLevel == 0) {
            $setImg = 1;
            $setStyle='display:none;';
        } elseif ($expLevel < 0) {
            $setImg = 0;
            $setStyle = 'display:inline;';
        }

        if ( is_bool( $var ) ) {
            $html .= '<span style="color:#588bff;">bool</span><span style="color:#999;">(</span><strong>' . ( ( $var ) ? 'true' : 'false' ) . '</strong><span style="color:#999;">)</span>';
        } else if ( is_int( $var ) ) {
            $html .= '<span style="color:#588bff;">int</span><span style="color:#999;">(</span><strong>' . $var . '</strong><span style="color:#999;">)</span>';
        } else if ( is_float( $var ) ) {
            $html .= '<span style="color:#588bff;">float</span><span style="color:#999;">(</span><strong>' . $var . '</strong><span style="color:#999;">)</span>';
        } else if ( is_string( $var ) ) {
            $html .= '<span style="color:#588bff;">string</span><span style="color:#999;">(</span>' . strlen( $var ) . '<span style="color:#999;">)</span> <strong>"' . self::htmlentities( $var ) . '"</strong>';
        } else if ( is_null( $var ) ) {
            $html .= '<strong>NULL</strong>';
        } else if ( is_resource( $var ) ) {
            $html .= '<span style="color:#588bff;">resource</span>("' . get_resource_type( $var ) . '") <strong>"' . $var . '"</strong>';
        } else if ( is_array( $var ) ) {
            // Check for recursion
            if ($depth > 0) {
                foreach ($done as $prev) {
                    if ($prev === $var) {
                        $html .= '<span style="color:#588bff;">array</span>(' . count($var) . ') *RECURSION DETECTED*';
                        return $html;
                    }
                }

                // Keep track of variables we have already processed to detect recursion
                $done[] = &$var;
            }

            self::$hasArray = true;
            $uuid = 'include-php-' . uniqid() . mt_rand(1,1000000);

            $html .= (!empty( $var ) ? ' <img id="' . $uuid . '" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D" onclick="javascript:colToggle(this.id);" /><script>setImg("' . $uuid . '",'.$setImg.',1);</script>' : '') . '<span style="color:#588bff;">array</span>(' . count( $var ) . ')';
            if ( ! empty( $var ) ) {
                $html .= ' <span id="' . $uuid . '-collapsable" style="'.$setStyle.'"><br />[<br />';

                $indent = 4;
                $longest_key = 0;

                foreach( $var as $key => $value ) {
                    if ( is_string( $key ) ) {
                        $longest_key = max( $longest_key, strlen( $key ) + 2 );
                    } else {
                        $longest_key = max( $longest_key, strlen( $key ) );
                    }
                }

                foreach ( $var as $key => $value ) {
                    if ( is_numeric( $key ) ) {
                        $html .= str_repeat( ' ', $indent ) . str_pad( $key, $longest_key, ' ');
                    } else {
                        $html .= str_repeat( ' ', $indent ) . str_pad( '"' . self::htmlentities( $key ) . '"', $longest_key, ' ' );
                    }

                    $html .= ' => ';

                    $value = explode( '<br />', self::var_dump_plain($value, $expLevel, $depth + 1, $done) );

                    foreach ( $value as $line => $val ) {
                        if ( $line != 0 ) {
                            $value[$line] = str_repeat( ' ', $indent * 2 ) . $val;
                        }
                    }

                    $html .= implode( '<br />', $value ) . '<br />';
                }

                $html .= ']</span>';
            }
        } else if ( is_object( $var ) ) {
            // Check for recursion
            foreach ($done as $prev) {
                if ($prev === $var) {
                    $html .= '<span style="color:#588bff;">object</span>(' . get_class( $var ) . ') *RECURSION DETECTED*';
                    return $html;
                }
            }

            // Keep track of variables we have already processed to detect recursion
            $done[] = &$var;

            self::$hasArray=true;
            $uuid = 'include-php-' . uniqid() . mt_rand(1,1000000);;

            $html .= ' <img id="' . $uuid . '" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D" onclick="javascript:colToggle(this.id);" /><script>setImg("' . $uuid . '",'.$setImg.',1);</script><span style="color:#588bff;">object</span>(' . get_class( $var ) . ') <span id="' . $uuid . '-collapsable" style="'.$setStyle.'"><br />[<br />';

            $varArray = (array) $var;

            $indent = 4;
            $longest_key = 0;

            foreach( $varArray as $key => $value ) {
                if ( substr( $key, 0, 2 ) == "\0*" ) {
                    unset( $varArray[$key] );
                    $key = 'protected:' . substr( $key, 2 );
                    $varArray[$key] = $value;
                } else if ( substr( $key, 0, 1 ) == "\0" ) {
                    unset( $varArray[$key] );
                    $key = 'private:' . substr( $key, 1, strpos( substr( $key, 1 ), "\0" ) ) . ':' . substr( $key, strpos( substr( $key, 1 ), "\0" ) + 1 );
                    $varArray[$key] = $value;
                }

                if ( is_string( $key ) ) {
                    $longest_key = max( $longest_key, strlen( $key ) + 2 );
                } else {
                    $longest_key = max( $longest_key, strlen( $key ) );
                }
            }

            foreach ( $varArray as $key => $value ) {
                if ( is_numeric( $key ) ) {
                    $html .= str_repeat( ' ', $indent ) . str_pad( $key, $longest_key, ' ');
                } else {
                    $html .= str_repeat( ' ', $indent ) . str_pad( '"' . self::htmlentities( $key ) . '"', $longest_key, ' ' );
                }

                $html .= ' => ';

                $value = explode( '<br />', self::var_dump_plain($value, $expLevel, $depth + 1, $done) );

                foreach ( $value as $line => $val ) {
                    if ( $line != 0 ) {
                        $value[$line] = str_repeat( ' ', $indent * 2 ) . $val;
                    }
                }

                $html .= implode( '<br />', $value ) . '<br />';
            }

            $html .= ']</span>';
        }

        return $html;
    }

    /**
     * Converts any accent characters to their equivalent normal characters
     * and converts any other non-alphanumeric characters to dashes, then
     * converts any sequence of two or more dashes to a single dash. This
     * function generates slugs safe for use as URLs, and if you pass TRUE
     * as the second parameter, it will create strings safe for use as CSS
     * classes or IDs.
     *
     * @param   string  $string   A string to convert to a slug
     * @param   boolean $css_mode Whether or not to generate strings safe for
     *                            CSS classes/IDs (Default to false)
     * @return  string
     */
    public static function slugify( $string, $css_mode = FALSE )
    {
        $slug = preg_replace( '/([^a-z0-9]+)/', '-', strtolower( self::remove_accents( $string ) ) );

        if ( $css_mode ) {
            $digits = array( 'zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine' );

            if ( is_numeric( substr( $slug, 0, 1 ) ) ) {
                $slug = $digits[substr( $slug, 0, 1 )] . substr( $slug, 1 );
            }
        }

        return $slug;
    }

    /**
     * Checks to see if a string is utf8 encoded.
     *
     * NOTE: This function checks for 5-Byte sequences, UTF8
     *       has Bytes Sequences with a maximum length of 4.
     *
     * @param  string $string The string to be checked
     * @return boolean
     */
    public static function seems_utf8( $string )
    {
        if ( function_exists( 'mb_check_encoding' ) ) {
            // If mbstring is available, this is significantly faster than
            // using PHP regexps.
            return mb_check_encoding( $string, 'UTF-8' );
        }

        // @codeCoverageIgnoreStart
        return self::seems_utf8_worker( $string );
        // @codeCoverageIgnoreEnd
    }

    /**
     * A non-Mbstring UTF-8 checker.
     *
     * @param $string
     * @return bool
     */
    protected static function seems_utf8_worker( $string )
    {
        // Obtained from http://stackoverflow.com/a/11709412/430062 with permission.
        $regex = '/(
    [\xC0-\xC1] # Invalid UTF-8 Bytes
    | [\xF5-\xFF] # Invalid UTF-8 Bytes
    | \xE0[\x80-\x9F] # Overlong encoding of prior code point
    | \xF0[\x80-\x8F] # Overlong encoding of prior code point
    | [\xC2-\xDF](?![\x80-\xBF]) # Invalid UTF-8 Sequence Start
    | [\xE0-\xEF](?![\x80-\xBF]{2}) # Invalid UTF-8 Sequence Start
    | [\xF0-\xF4](?![\x80-\xBF]{3}) # Invalid UTF-8 Sequence Start
    | (?<=[\x0-\x7F\xF5-\xFF])[\x80-\xBF] # Invalid UTF-8 Sequence Middle
    | (?<![\xC2-\xDF]|[\xE0-\xEF]|[\xE0-\xEF][\x80-\xBF]|[\xF0-\xF4]|[\xF0-\xF4][\x80-\xBF]|[\xF0-\xF4][\x80-\xBF]{2})[\x80-\xBF] # Overlong Sequence
    | (?<=[\xE0-\xEF])[\x80-\xBF](?![\x80-\xBF]) # Short 3 byte sequence
    | (?<=[\xF0-\xF4])[\x80-\xBF](?![\x80-\xBF]{2}) # Short 4 byte sequence
    | (?<=[\xF0-\xF4][\x80-\xBF])[\x80-\xBF](?![\x80-\xBF]) # Short 4 byte sequence (2)
)/x';

        return ! preg_match( $regex, $string );
    }

    /**
     * Nice formatting for computer sizes (Bytes).
     *
     * @param   integer $bytes    The number in bytes to format
     * @param   integer $decimals The number of decimal points to include
     * @return  string
     */
    public static function size_format( $bytes, $decimals = 0 )
    {
        $bytes = floatval( $bytes );

        if ( $bytes < 1024 ) {
            return $bytes . ' B';
        } else if ( $bytes < pow( 1024, 2 ) ) {
            return number_format( $bytes / 1024, $decimals, '.', '' ) . ' KiB';
        } else if ( $bytes < pow( 1024, 3 ) ) {
            return number_format( $bytes / pow( 1024, 2 ), $decimals, '.', '' ) . ' MiB';
        } else if ( $bytes < pow( 1024, 4 ) ) {
            return number_format( $bytes / pow( 1024, 3 ), $decimals, '.', '' ) . ' GiB';
        } else if ( $bytes < pow( 1024, 5 ) ) {
            return number_format( $bytes / pow( 1024, 4 ), $decimals, '.', '' ) . ' TiB';
        } else if ( $bytes < pow( 1024, 6 ) ) {
            return number_format( $bytes / pow( 1024, 5 ), $decimals, '.', '' ) . ' PiB';
        } else {
            return number_format( $bytes / pow( 1024, 5 ), $decimals, '.', '' ) . ' PiB';
        }
    }

    /**
     * Serialize data, if needed.
     *
     * @param  mixed $data Data that might need to be serialized
     * @return mixed
     */
    public static function maybe_serialize( $data )
    {
        if ( is_array( $data ) || is_object( $data ) ) {
            return serialize( $data );
        }

        return $data;
    }

    /**
     * Unserialize value only if it is serialized.
     *
     * @param  string $data A variable that may or may not be serialized
     * @return mixed
     */
    public static function maybe_unserialize( $data )
    {
         // Don't attempt to unserialize data that isn't serialized
        if ( self::is_serialized( $data ) ) {
            return @unserialize( $data );
        }

        return $data;
    }

    /**
     * Check value to find if it was serialized.
     *
     * If $data is not an string, then returned value will always be false.
     * Serialized data is always a string.
     *
     * @param  mixed $data Value to check to see if was serialized
     * @return boolean
     */
    public static function is_serialized( $data )
    {
        // If it isn't a string, it isn't serialized
        if ( ! is_string( $data ) ) {
            return FALSE;
        }

        $data = trim( $data );

        if ( 'N;' == $data ) {
            return TRUE;
        }

        $length = strlen( $data );

        if ( $length < 4 ) {
            return FALSE;
        }

        if ( ':' !== $data[1] ) {
            return FALSE;
        }

        $lastc = $data[$length - 1];

        if ( ';' !== $lastc && '}' !== $lastc ) {
            return FALSE;
        }

        $token = $data[0];

        switch ( $token ) {
            case 's' :
                if ( '"' !== $data[$length-2] ) {
                    return FALSE;
                }
            case 'a' :
            case 'O' :
                return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
            case 'b' :
            case 'i' :
            case 'd' :
                return (bool) preg_match( "/^{$token}:[0-9.E-]+;\$/", $data );
        }

        return FALSE;
    }

    /**
     * Unserializes partially-corrupted arrays that occur sometimes. Addresses specifically the
     * `unserialize(): Error at offset xxx of yyy bytes` error.
     *
     * NOTE: This error can *frequently* occur with mismatched character sets and higher-than-ASCII characters.
     *
     * @param $brokenSerializedData
     * @return string
     */
    public static function fix_broken_serialization( $brokenSerializedData )
    {
        $fixdSerializedData = preg_replace_callback('!s:(\d+):"(.*?)";!', function($matches) {
            $snip = $matches[2];
            return 's:' . strlen($snip) . ':"' . $snip . '";';
        }, $brokenSerializedData);

        return $fixdSerializedData;
    }

    /**
     * Checks to see if the page is being server over SSL or not
     *
     * @return boolean
     */
    public static function is_https()
    {
        if ( isset( $_SERVER['HTTPS'] ) && ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) {
            return true;
        }

        return false;
    }

    /**
     * Retrieve a modified URL query string.
     *
     * You can rebuild the URL and append a new query variable to the URL
     * query by using this function. You can also retrieve the full URL
     * with query data.
     *
     * Adding a single key & value or an associative array. Setting a key
     * value to an empty string removes the key. Omitting oldquery_or_uri
     * uses the $_SERVER value. Additional values provided are expected
     * to be encoded appropriately with urlencode() or rawurlencode().
     *
     * @param  mixed  $newkey          Either newkey or an associative
     *                                 array
     * @param  mixed  $newvalue        Either newvalue or oldquery or uri
     * @param  mixed  $oldquery_or_uri Optionally the old query or uri
     * @return string
     */
    public static function add_query_arg()
    {
        $ret = '';

        // Was an associative array of key => value pairs passed?
        if ( is_array( func_get_arg( 0 ) ) ) {

            // Was the URL passed as an argument?
            if ( func_num_args() == 2 && func_get_arg( 1 ) ) {
                $uri = func_get_arg( 1 );
            } else if ( func_num_args() == 3 && func_get_arg( 2 ) ) {
                $uri = func_get_arg( 2 );
            } else {
                $uri = $_SERVER['REQUEST_URI'];
            }
        } else {

            // Was the URL passed as an argument?
            if ( func_num_args() == 3 && func_get_arg( 2 ) ) {
                $uri = func_get_arg( 2 );
            } else {
                $uri = $_SERVER['REQUEST_URI'];
            }
        }

        // Does the URI contain a fragment section (The part after the #)
        if ( $frag = strstr( $uri, '#' ) ) {
            $uri = substr( $uri, 0, -strlen( $frag ) );
        } else {
            $frag = '';
        }

        // Get the URI protocol if possible
        if ( preg_match( '|^https?://|i', $uri, $matches ) ) {
            $protocol = $matches[0];
            $uri = substr( $uri, strlen( $protocol ) );
        } else {
            $protocol = '';
        }

        // Does the URI contain a query string?
        if ( strpos( $uri, '?' ) !== FALSE ) {
            $parts = explode( '?', $uri, 2 );
            $base  = $parts[0] . '?';
            $query = $parts[1];
        } else if ( ! empty( $protocol ) || strpos( $uri, '=' ) === FALSE ) {
            $base  = $uri . '?';
            $query = '';
        } else {
            $base  = '';
            $query = $uri;
        }

        // Parse the query string into an array
        parse_str( $query, $qs );

        // This re-URL-encodes things that were already in the query string
        $qs = self::array_map_deep( $qs, 'urlencode' );

        if ( is_array( func_get_arg( 0 ) ) ) {
            $kayvees = func_get_arg( 0 );
            $qs = array_merge( $qs, $kayvees );
        } else {
            $qs[func_get_arg( 0 )] = func_get_arg( 1 );
        }

        foreach ( (array) $qs as $k => $v ) {
            if ( $v === false )
                unset( $qs[$k] );
        }

        $ret = http_build_query( $qs );
        $ret = trim( $ret, '?' );
        $ret = preg_replace( '#=(&|$)#', '$1', $ret );
        $ret = $protocol . $base . $ret . $frag;
        $ret = rtrim( $ret, '?' );

        return $ret;
    }

    /**
     * Removes an item or list from the query string.
     *
     * @param  string|array  $keys Query key or keys to remove.
     * @param  bool          $uri  When false uses the $_SERVER value
     * @return string
     */
    public static function remove_query_arg( $keys, $uri = FALSE )
    {
        if ( is_array( $keys ) ) {
            foreach ( $keys as $key ) {
                $uri = self::add_query_arg( $key, FALSE, $uri );
            }

            return $uri;
        }

        return self::add_query_arg( $keys, FALSE, $uri );
    }

    /**
     * Converts many english words that equate to true or false to boolean.
     *
     * Supports 'y', 'n', 'yes', 'no' and a few other variations.
     *
     * @param  string $string  The string to convert to boolean
     * @param  bool   $default The value to return if we can't match any
     *                          yes/no words
     * @return boolean
     */
    public static function str_to_bool( $string, $default = FALSE )
    {
        $yes_words = 'affirmative|all right|aye|indubitably|most assuredly|ok|of course|okay|sure thing|y|yes+|yea|yep|sure|yeah|true|t|on|1|oui|vrai';
        $no_words = 'no*|no way|nope|nah|na|never|absolutely not|by no means|negative|never ever|false|f|off|0|non|faux';

        if ( preg_match( '/^(' . $yes_words . ')$/i', $string ) ) {
            return TRUE;
        } else if ( preg_match( '/^(' . $no_words . ')$/i', $string ) ) {
            return FALSE;
        }

        return $default;
    }

    /**
     * Check if a string starts with the given string.
     *
     * @param  string $string
     * @param  string $starts_with
     * @return boolean
     */
    public static function starts_with($string, $starts_with)
    {
        return (strpos($string, $starts_with) === 0);
    }

    /**
     * Check if a string ends with the given string.
     *
     * @param  string $string
     * @param  string $starts_with
     * @return boolean
     */
    public static function ends_with($string, $ends_with)
    {
        return substr($string, -strlen($ends_with)) === $ends_with;
    }

    /**
     * Check if a string contains another string.
     *
     * @param  string $haystack
     * @param  string $needle
     * @return boolean
     */
    public static function str_contains($haystack, $needle)
    {
        return (strpos($haystack, $needle) !== false);
    }

    /**
     * Check if a string contains another string. This version is case
     * insensitive.
     *
     * @param  string $haystack
     * @param  string $needle
     * @return boolean
     */
    public static function str_icontains($haystack, $needle)
    {
        return (stripos($haystack, $needle) !== false);
    }

    /**
     * Return the file extension of the given filename.
     *
     * @param  string $filename
     * @return string
     */
    public static function get_file_ext($filename)
    {
        return pathinfo($filename, PATHINFO_EXTENSION);
    }

    /**
     * Removes a directory (and its contents) recursively.
     *
     * @param  string $dir              The directory to be deleted recursively
     * @param  bool   $traverseSymlinks Delete contents of symlinks recursively
     * @return bool
     * @throws \RuntimeException
     */
    public static function rmdir($dir, $traverseSymlinks = false)
    {
        if (!file_exists($dir)) {
            return true;
        } elseif (!is_dir($dir)) {
            throw new \RuntimeException('Given path is not a directory');
        }

        if (!is_link($dir) || $traverseSymlinks) {
            foreach (scandir($dir) as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }

                $currentPath = $dir . '/' . $file;

                if (is_dir($currentPath)) {
                    self::rmdir($currentPath, $traverseSymlinks);
                } elseif (!unlink($currentPath)) {
                    // @codeCoverageIgnoreStart
                    throw new \RuntimeException('Unable to delete ' . $currentPath);
                    // @codeCoverageIgnoreEnd
                }
            }
        }

        // Windows treats removing directory symlinks identically to removing directories.
        if (is_link($dir) && !defined('PHP_WINDOWS_VERSION_MAJOR')) {
            if (!unlink($dir)) {
                // @codeCoverageIgnoreStart
                throw new \RuntimeException('Unable to delete ' . $dir);
                // @codeCoverageIgnoreEnd
            }
        } else {
            if (!rmdir($dir)) {
                // @codeCoverageIgnoreStart
                throw new \RuntimeException('Unable to delete ' . $dir);
                // @codeCoverageIgnoreEnd
            }
        }

        return true;
    }

    /**
     * Convert entities, while preserving already-encoded entities.
     *
     * @param  string $string The text to be converted
     * @return string
     */
    public static function htmlentities( $string, $preserve_encoded_entities = FALSE )
    {
        if ( $preserve_encoded_entities ) {
            if (defined('HHVM_VERSION')) {
                $translation_table = get_html_translation_table( HTML_ENTITIES, ENT_QUOTES );
            } else {
                $translation_table = get_html_translation_table( HTML_ENTITIES, ENT_QUOTES, self::mb_internal_encoding() );
            }

            $translation_table[chr(38)] = '&';
            return preg_replace( '/&(?![A-Za-z]{0,4}\w{2,3};|#[0-9]{2,3};)/', '&amp;', strtr( $string, $translation_table ) );
        }

        return htmlentities( $string, ENT_QUOTES, self::mb_internal_encoding() );
    }

    /**
     * Convert >, <, ', " and & to html entities, but preserves entities that
     * are already encoded.
     *
     * @param   string $string The text to be converted
     * @return  string
     */
    public static function htmlspecialchars( $string, $preserve_encoded_entities = FALSE  )
    {
        if ( $preserve_encoded_entities ) {
            if (defined('HHVM_VERSION')) {
                $translation_table = get_html_translation_table( HTML_SPECIALCHARS, ENT_QUOTES );
            } else {
                $translation_table = get_html_translation_table( HTML_SPECIALCHARS, ENT_QUOTES, self::mb_internal_encoding() );
            }

            $translation_table[chr( 38 )] = '&';

            return preg_replace( '/&(?![A-Za-z]{0,4}\w{2,3};|#[0-9]{2,3};)/', '&amp;', strtr( $string, $translation_table ) );
        }

        return htmlentities( $string, ENT_QUOTES, self::mb_internal_encoding() );
    }

    /**
     * Transliterates characters to their ASCII equivalents.
     *
     * @see https://github.com/jbroadway/urlify/blob/master/URLify.php
     *
     * @param  string $string   Text that might have not-ASCII characters
     * @param  string $language Specifies a priority for a specific language.
     * @return string Filtered string with replaced "nice" characters
     */
    public static function downcode($text, $language = '')
    {
        self::initLanguageMap($language);

        if (self::seems_utf8($text)) {
            if (preg_match_all(self::$regex, $text, $matches)) {
                for ($i = 0; $i < count($matches[0]); $i++) {
                    $char = $matches[0][$i];
                    if (isset(self::$map[$char])) {
                        $text = str_replace($char, self::$map[$char], $text);
                    }
                }
            }
        } else {
            // Not a UTF-8 string so we assume its ISO-8859-1
            $search  = "\x80\x83\x8a\x8e\x9a\x9e\x9f\xa2\xa5\xb5\xc0\xc1\xc2\xc3\xc4\xc5\xc7\xc8\xc9\xca\xcb\xcc\xcd";
            $search .= "\xce\xcf\xd1\xd2\xd3\xd4\xd5\xd6\xd8\xd9\xda\xdb\xdc\xdd\xe0\xe1\xe2\xe3\xe4\xe5\xe7\xe8\xe9";
            $search .= "\xea\xeb\xec\xed\xee\xef\xf1\xf2\xf3\xf4\xf5\xf6\xf8\xf9\xfa\xfb\xfc\xfd\xff";
            $text    = strtr($text, $search, 'EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy');

            // These latin characters should be represented by two characters so
            // we can't use strtr
            $complexSearch  = array("\x8c", "\x9c", "\xc6", "\xd0", "\xde", "\xdf", "\xe6", "\xf0", "\xfe");
            $complexReplace = array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
            $text           = str_replace($complexSearch, $complexReplace, $text);
        }

        return $text;
    }

    /**
     * Converts all accent characters to ASCII characters.
     *
     * If there are no accent characters, then the string given is just
     * returned.
     *
     * @param  string $string   Text that might have accent characters
     * @param  string $language Specifies a priority for a specific language.
     * @return string Filtered  string with replaced "nice" characters
     */
    public static function remove_accents($string, $language = '')
    {
        if (!preg_match('/[\x80-\xff]/', $string)) {
            return $string;
        }

        return self::downcode($string, $language);
    }

    /**
     * Strip all witespaces from the given string.
     *
     * @param  string $string The string to strip
     * @return string
     */
    public static function strip_space($string)
    {
        return preg_replace('/\s+/', '', $string);
    }

    /**
     * Sanitize a string by performing the following operation :
     * - Remove accents
     * - Lower the string
     * - Remove punctuation characters
     * - Strip whitespaces
     *
     * @param  string $string the string to sanitize
     * @return string
     */
    public static function sanitize_string($string)
    {
        $string = self::remove_accents($string);
        $string = strtolower($string);
        $string = preg_replace('/[^a-zA-Z 0-9]+/', '', $string);
        $string = self::strip_space($string);

        return $string;
    }

    /**
     * Pads a given string with zeroes on the left.
     *
     * @param  int  $number The number to pad
     * @param  int  $length The total length of the desired string
     * @return string
     */
    public static function zero_pad( $number, $length )
    {
        return str_pad( $number, $length, '0', STR_PAD_LEFT );
    }

    /**
     * Converts a unix timestamp to a relative time string, such as "3 days ago"
     * or "2 weeks ago".
     *
     * @param  int    $from   The date to use as a starting point
     * @param  int    $to     The date to compare to, defaults to now
     * @param  string $suffix The string to add to the end, defaults to " ago"
     * @return string
     */
    public static function human_time_diff( $from, $to = '', $as_text = FALSE, $suffix = ' ago' )
    {
        if ( $to == '' ) {
            $to = time();
        }

        $from = new \DateTime( date( 'Y-m-d H:i:s', $from ) );
        $to   = new \DateTime( date( 'Y-m-d H:i:s', $to ) );
        $diff = $from->diff( $to );

        if ( $diff->y > 1 ) {
            $text = $diff->y . ' years';
        } else if ( $diff->y == 1 ) {
            $text = '1 year';
        } else if ( $diff->m > 1 ) {
            $text = $diff->m . ' months';
        } else if ( $diff->m == 1 ) {
            $text = '1 month';
        } else if ( $diff->d > 7 ) {
            $text = ceil( $diff->d / 7 ) . ' weeks';
        } else if ( $diff->d == 7 ) {
            $text = '1 week';
        } else if ( $diff->d > 1 ) {
            $text = $diff->d . ' days';
        } else if ( $diff->d == 1 ) {
            $text = '1 day';
        } else if ( $diff->h > 1 ) {
            $text = $diff->h . ' hours';
        } else if ( $diff->h == 1 ) {
            $text = ' 1 hour';
        } else if ( $diff->i > 1 ) {
            $text = $diff->i . ' minutes';
        } else if ( $diff->i == 1 ) {
            $text = '1 minute';
        } else if ( $diff->s > 1 ) {
            $text = $diff->s . ' seconds';
        } else {
            $text = '1 second';
        }

        if ( $as_text ) {
            $text = explode( ' ', $text, 2 );
            $text = self::number_to_word( $text[0] ) . ' ' . $text[1];
        }

        return trim( $text ) . $suffix;
    }

    /**
     * Converts a number into the text equivalent. For example, 456 becomes four
     * hundred and fifty-six.
     *
     * @param  int|float $number The number to convert into text
     * @return string
     */
    public static function number_to_word( $number )
    {
        $number = (string) $number;

        if ( strpos( $number, '.' ) !== FALSE ) {
            list( $number, $decimal ) = explode( '.', $number );
        } else {
            $decimal = FALSE;
        }

        $output = '';

        if ( $number[0] == '-' ) {
            $output = 'negative ';
            $number = ltrim( $number, '-' );
        } else if ( $number[0] == '+' ) {
            $output = 'positive ';
            $number = ltrim( $number, '+' );
        }

        if ( $number[0] == '0' ) {
            $output .= 'zero';
        } else {
            $length = 19;
            $number = str_pad( $number, 60, '0', STR_PAD_LEFT );
            $group  = rtrim( chunk_split( $number, 3, ' ' ), ' ' );
            $groups = explode( ' ', $group );
            $groups2 = array();

            foreach ( $groups as $group ) {
                $groups2[] = self::_number_to_word_three_digits( $group[0], $group[1], $group[2] );
            }

            for ( $z = 0; $z < count( $groups2 ); $z++ ) {
                if ( $groups2[$z] != '' ) {
                    $output .= $groups2[$z] . self::_number_to_word_convert_group( $length - $z );
                    $output .= ( $z < $length && ! array_search( '', array_slice( $groups2, $z + 1, -1 ) ) && $groups2[$length] != '' && $groups[$length][0] == '0' ? ' and ' : ', ' );
                }
            }

            $output = rtrim( $output, ', ' );
        }

        if ( $decimal > 0 ) {
            $output .= ' point';

            for ( $i = 0; $i < strlen( $decimal ); $i++ ) {
                $output .= ' ' . self::_number_to_word_convert_digit( $decimal[$i] );
            }
        }

        return $output;
    }

    protected static function _number_to_word_convert_group( $index )
    {
        switch( $index ) {
            case 11:
                return ' decillion';
            case 10:
                return ' nonillion';
            case 9:
                return ' octillion';
            case 8:
                return ' septillion';
            case 7:
                return ' sextillion';
            case 6:
                return ' quintrillion';
            case 5:
                return ' quadrillion';
            case 4:
                return ' trillion';
            case 3:
                return ' billion';
            case 2:
                return ' million';
            case 1:
                return ' thousand';
            case 0:
                return '';
        }

        return '';
    }

    protected static function _number_to_word_three_digits( $digit1, $digit2, $digit3 )
    {
        $output = '';

        if ( $digit1 == '0' && $digit2 == '0' && $digit3 == '0') {
            return '';
        }

        if ( $digit1 != '0' ) {
            $output .= self::_number_to_word_convert_digit( $digit1 ) . ' hundred';

            if ( $digit2 != '0' || $digit3 != '0' ) {
                $output .= ' and ';
            }
        }
        if ( $digit2 != '0') {
            $output .= self::_number_to_word_two_digits( $digit2, $digit3 );
        } else if( $digit3 != '0' ) {
            $output .= self::_number_to_word_convert_digit( $digit3 );
        }

        return $output;
    }

    protected static function _number_to_word_two_digits( $digit1, $digit2 )
    {
        if ( $digit2 == '0' ) {
            switch ( $digit1 ) {
                case '1':
                    return 'ten';
                case '2':
                    return 'twenty';
                case '3':
                    return 'thirty';
                case '4':
                    return 'forty';
                case '5':
                    return 'fifty';
                case '6':
                    return 'sixty';
                case '7':
                    return 'seventy';
                case '8':
                    return 'eighty';
                case '9':
                    return 'ninety';
            }
        } else if ( $digit1 == '1' ) {
            switch ( $digit2 ) {
                case '1':
                    return 'eleven';
                case '2':
                    return 'twelve';
                case '3':
                    return 'thirteen';
                case '4':
                    return 'fourteen';
                case '5':
                    return 'fifteen';
                case '6':
                    return 'sixteen';
                case '7':
                    return 'seventeen';
                case '8':
                    return 'eighteen';
                case '9':
                    return 'nineteen';
            }
        } else {
            $second_digit = self::_number_to_word_convert_digit( $digit2 );

            switch ( $digit1 ) {
                case '2':
                    return "twenty-{$second_digit}";
                case '3':
                    return "thirty-{$second_digit}";
                case '4':
                    return "forty-{$second_digit}";
                case '5':
                    return "fifty-{$second_digit}";
                case '6':
                    return "sixty-{$second_digit}";
                case '7':
                    return "seventy-{$second_digit}";
                case '8':
                    return "eighty-{$second_digit}";
                case '9':
                    return "ninety-{$second_digit}";
            }
        }

        return '';
    }

    protected static function _number_to_word_convert_digit( $digit )
    {
        switch ( $digit ) {
            case '0':
                return 'zero';
            case '1':
                return 'one';
            case '2':
                return 'two';
            case '3':
                return 'three';
            case '4':
                return 'four';
            case '5':
                return 'five';
            case '6':
                return 'six';
            case '7':
                return 'seven';
            case '8':
                return 'eight';
            case '9':
                return 'nine';
        }
    }

    /**
     * Transmit UTF-8 content headers if the headers haven't already been sent.
     *
     * @param  string  $content_type The content type to send out
     * @return boolean
     */
    public static function utf8_headers( $content_type = 'text/html' )
    {
        // @codeCoverageIgnoreStart
        if ( ! headers_sent() ) {
            header( 'Content-type: ' . $content_type . '; charset=utf-8' );

            return TRUE;
        }

        return FALSE;
        // @codeCoverageIgnoreEnd
    }

    /**
     * Transmit headers that force a browser to display the download file
     * dialog. Cross browser compatible. Only fires if headers have not
     * already been sent.
     *
     * @param string $filename The name of the filename to display to
     *                         browsers
     * @param string $content  The content to output for the download.
     *                         If you don't specify this, just the
     *                         headers will be sent
     * @return boolean
     */
    public static function force_download( $filename, $content = FALSE )
    {
        // @codeCoverageIgnoreStart
        if ( ! headers_sent() ) {
            // Required for some browsers
            if ( ini_get( 'zlib.output_compression' ) ) {
                @ini_set( 'zlib.output_compression', 'Off' );
            }

            header( 'Pragma: public' );
            header( 'Expires: 0' );
            header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );

            // Required for certain browsers
            header( 'Cache-Control: private', FALSE );

            header( 'Content-Disposition: attachment; filename="' . basename( str_replace( '"', '', $filename ) ) . '";' );
            header( 'Content-Type: application/force-download' );
            header( 'Content-Transfer-Encoding: binary' );

            if ( $content ) {
               header( 'Content-Length: ' . strlen( $content ) );
            }

            ob_clean();
            flush();

            if ( $content ) {
                echo $content;
            }

            return TRUE;
        }

        return FALSE;
        // @codeCoverageIgnoreEnd
    }

    /**
     * Sets the headers to prevent caching for the different browsers.
     *
     * Different browsers support different nocache headers, so several
     * headers must be sent so that all of them get the point that no
     * caching should occur
     *
     * @return boolean
     */
    public static function nocache_headers()
    {
        // @codeCoverageIgnoreStart
        if ( ! headers_sent() ) {
            header( 'Expires: Wed, 11 Jan 1984 05:00:00 GMT' );
            header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
            header( 'Cache-Control: no-cache, must-revalidate, max-age=0' );
            header( 'Pragma: no-cache' );

            return TRUE;
        }

        return FALSE;
        // @codeCoverageIgnoreEnd
    }

    /**
     * Generates a string of random characters.
     *
     * @throws  LengthException  If $length is bigger than the available
     *                           character pool and $no_duplicate_chars is
     *                           enabled
     *
     * @param   integer $length             The length of the string to
     *                                      generate
     * @param   boolean $human_friendly     Whether or not to make the
     *                                      string human friendly by
     *                                      removing characters that can be
     *                                      confused with other characters (
     *                                      O and 0, l and 1, etc)
     * @param   boolean $include_symbols    Whether or not to include
     *                                      symbols in the string. Can not
     *                                      be enabled if $human_friendly is
     *                                      true
     * @param   boolean $no_duplicate_chars Whether or not to only use
     *                                      characters once in the string.
     * @return  string
     */
    public static function random_string( $length = 16, $human_friendly = TRUE, $include_symbols = FALSE, $no_duplicate_chars = FALSE )
    {
        $nice_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefhjkmnprstuvwxyz23456789';
        $all_an     = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $symbols    = '!@#$%^&*()~_-=+{}[]|:;<>,.?/"\'\\`';
        $string     = '';

        // Determine the pool of available characters based on the given parameters
        if ( $human_friendly ) {
            $pool = $nice_chars;
        } else {
            $pool = $all_an;

            if ( $include_symbols ) {
                $pool .= $symbols;
            }
        }

        if( ! $no_duplicate_chars ) {
            return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        }
        
        // Don't allow duplicate letters to be disabled if the length is
        // longer than the available characters
        if ( $no_duplicate_chars && strlen( $pool ) < $length ) {
            throw new \LengthException( '$length exceeds the size of the pool and $no_duplicate_chars is enabled' );
        }

        // Generate our string
        for ($i = 0; $i < $length; $i++) {
            $string .= $pool[mt_rand(0, strlen($pool) - 1)];
        }

        return $string;
    }

    /**
     * Generate secure random string of given length
     * If 'openssl_random_pseudo_bytes' is not available
     * then generate random string using default function
     *
     * @param int $length length of string
     * @return bool
     */
    public static function secure_random_string($length = 16)
    {
        if (function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes($length * 2);

            if ($bytes === false) {
                throw new \LengthException( '$length is not accurate, unable to generate random string' );
            }

            return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $length);
        }

        return static::random_string($length);
    }

    /**
     * Validate an email address.
     *
     * @param  string $possible_email An email address to validate
     * @return bool
     */
    public static function validate_email( $possible_email )
    {
        return (bool) filter_var( $possible_email, FILTER_VALIDATE_EMAIL );
    }

    /**
     * Return the URL to a user's gravatar.
     *
     * @param   string  $email The email of the user
     * @param   integer $size  The size of the gravatar
     * @return  string
     */
    public static function get_gravatar( $email, $size = 32 )
    {
        if ( self::is_https() ) {
            $url = 'https://secure.gravatar.com/';
        } else {
            $url = 'http://www.gravatar.com/';
        }

        $url .= 'avatar/' . md5( $email ) . '?s=' . (int) abs( $size );

        return $url;
    }

    /**
     * Turns all of the links in a string into HTML links.
     *
     * @param  string $text The string to parse
     * @return string
     */
    public static function linkify( $text )
    {
        $text = preg_replace( '/&apos;/', '&#39;', $text ); // IE does not handle &apos; entity!
        $section_html_pattern = '%# Rev:20100913_0900 github.com/jmrware/LinkifyURL
            # Section text into HTML <A> tags  and everything else.
              (                              # $1: Everything not HTML <A> tag.
                [^<]+(?:(?!<a\b)<[^<]*)*     # non A tag stuff starting with non-"<".
              |      (?:(?!<a\b)<[^<]*)+     # non A tag stuff starting with "<".
              )                              # End $1.
            | (                              # $2: HTML <A...>...</A> tag.
                <a\b[^>]*>                   # <A...> opening tag.
                [^<]*(?:(?!</a\b)<[^<]*)*    # A tag contents.
                </a\s*>                      # </A> closing tag.
              )                              # End $2:
            %ix';

        return preg_replace_callback( $section_html_pattern, array( __CLASS__, '_linkify_callback' ), $text );
    }

    /**
     * Callback for the preg_replace in the linkify() method.
     *
     * @param  array  $matches Matches from the preg_ function
     * @return string
     */
    protected static function _linkify( $text )
    {
        $url_pattern = '/# Rev:20100913_0900 github.com\/jmrware\/LinkifyURL
            # Match http & ftp URL that is not already linkified.
            # Alternative 1: URL delimited by (parentheses).
            (\() # $1 "(" start delimiter.
            ((?:ht|f)tps?:\/\/[a-z0-9\-._~!$&\'()*+,;=:\/?#[\]@%]+) # $2: URL.
            (\)) # $3: ")" end delimiter.
            | # Alternative 2: URL delimited by [square brackets].
            (\[) # $4: "[" start delimiter.
            ((?:ht|f)tps?:\/\/[a-z0-9\-._~!$&\'()*+,;=:\/?#[\]@%]+) # $5: URL.
            (\]) # $6: "]" end delimiter.
            | # Alternative 3: URL delimited by {curly braces}.
            (\{) # $7: "{" start delimiter.
            ((?:ht|f)tps?:\/\/[a-z0-9\-._~!$&\'()*+,;=:\/?#[\]@%]+) # $8: URL.
            (\}) # $9: "}" end delimiter.
            | # Alternative 4: URL delimited by <angle brackets>.
            (<|&(?:lt|\#60|\#x3c);) # $10: "<" start delimiter (or HTML entity).
            ((?:ht|f)tps?:\/\/[a-z0-9\-._~!$&\'()*+,;=:\/?#[\]@%]+) # $11: URL.
            (>|&(?:gt|\#62|\#x3e);) # $12: ">" end delimiter (or HTML entity).
            | # Alternative 5: URL not delimited by (), [], {} or <>.
            ( # $13: Prefix proving URL not already linked.
            (?: ^ # Can be a beginning of line or string, or
            | [^=\s\'"\]] # a non-"=", non-quote, non-"]", followed by
            ) \s*[\'"]? # optional whitespace and optional quote;
            | [^=\s]\s+ # or... a non-equals sign followed by whitespace.
            ) # End $13. Non-prelinkified-proof prefix.
            ( \b # $14: Other non-delimited URL.
            (?:ht|f)tps?:\/\/ # Required literal http, https, ftp or ftps prefix.
            [a-z0-9\-._~!$\'()*+,;=:\/?#[\]@%]+ # All URI chars except "&" (normal*).
            (?: # Either on a "&" or at the end of URI.
            (?! # Allow a "&" char only if not start of an...
            &(?:gt|\#0*62|\#x0*3e); # HTML ">" entity, or
            | &(?:amp|apos|quot|\#0*3[49]|\#x0*2[27]); # a [&\'"] entity if
            [.!&\',:?;]? # followed by optional punctuation then
            (?:[^a-z0-9\-._~!$&\'()*+,;=:\/?#[\]@%]|$) # a non-URI char or EOS.
            ) & # If neg-assertion true, match "&" (special).
            [a-z0-9\-._~!$\'()*+,;=:\/?#[\]@%]* # More non-& URI chars (normal*).
            )* # Unroll-the-loop (special normal*)*.
            [a-z0-9\-_~$()*+=\/#[\]@%] # Last char can\'t be [.!&\',;:?]
            ) # End $14. Other non-delimited URL.
            /imx';

        $url_replace = '$1$4$7$10$13<a href="$2$5$8$11$14">$2$5$8$11$14</a>$3$6$9$12';

        return preg_replace( $url_pattern, $url_replace, $text );
    }

    /**
     * Callback for the preg_replace in the linkify() method.
     *
     * @param  array  $matches Matches from the preg_ function
     * @return string
     */
    protected static function _linkify_callback( $matches )
    {
        if ( isset( $matches[2] ) ) {
            return $matches[2];
        }

        return self::_linkify( $matches[1] );
    }

    /**
     * Return the current URL.
     *
     * @return string
     */
    public static function get_current_url()
    {
        $url = '';

        // Check to see if it's over https
        $is_https = self::is_https();
        if ( $is_https ) {
            $url .= 'https://';
        } else {
            $url .= 'http://';
        }

        // Was a username or password passed?
        if ( isset( $_SERVER['PHP_AUTH_USER'] ) ) {
            $url .= $_SERVER['PHP_AUTH_USER'];

            if ( isset( $_SERVER['PHP_AUTH_PW'] ) ) {
                $url .= ':' . $_SERVER['PHP_AUTH_PW'];
            }

            $url .= '@';
        }


        // We want the user to stay on the same host they are currently on,
        // but beware of security issues
        // see http://shiflett.org/blog/2006/mar/server-name-versus-http-host
        $url .= $_SERVER['HTTP_HOST'];

        $port = $_SERVER['SERVER_PORT'];

        // Is it on a non standard port?
        if ( $is_https && ( $port != 443 ) ) {
            $url .= ':' . $_SERVER['SERVER_PORT'];
        } elseif ( !$is_https && ( $port != 80 ) ) {
            $url .= ':' . $_SERVER['SERVER_PORT'];
        }

        // Get the rest of the URL
        if ( ! isset( $_SERVER['REQUEST_URI'] ) ) {

            // Microsoft IIS doesn't set REQUEST_URI by default
            $url .= substr( $_SERVER['PHP_SELF'], 1 );

            if ( isset( $_SERVER['QUERY_STRING'] ) ) {
                $url .= '?' . $_SERVER['QUERY_STRING'];
            }
        } else {
            $url .= $_SERVER['REQUEST_URI'];
        }

        return $url;
    }

    /**
     * Returns the IP address of the client.
     *
     * @param   boolean $trust_proxy_headers Whether or not to trust the
     *                                       proxy headers HTTP_CLIENT_IP
     *                                       and HTTP_X_FORWARDED_FOR. ONLY
     *                                       use if your server is behind a
     *                                       proxy that sets these values
     * @return  string
     */
    public static function get_client_ip( $trust_proxy_headers = FALSE )
    {
        if ( ! $trust_proxy_headers ) {
            return $_SERVER['REMOTE_ADDR'];
        }

        if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    /**
     * Truncate a string to a specified length without cutting a word off.
     *
     * @param   string  $string  The string to truncate
     * @param   integer $length  The length to truncate the string to
     * @param   string  $append  Text to append to the string IF it gets
     *                           truncated, defaults to '...'
     * @return  string
     */
    public static function safe_truncate( $string, $length, $append = '...' )
    {
        $ret        = substr( $string, 0, $length );
        $last_space = strrpos( $ret, ' ' );

        if ( $last_space !== FALSE && $string != $ret ) {
            $ret     = substr( $ret, 0, $last_space );
        }

        if ( $ret != $string ) {
            $ret .= $append;
        }

        return $ret;
    }


    /**
     * Truncate the string to given length of charactes.
     *
     * @param $string
     * @param $limit
     * @param string $append
     * @return string
     */
    public static function limit_characters( $string, $limit = 100, $append = '...')
    {
        if (mb_strlen($string) <= $limit) {
            return $string;
        }

        return rtrim(mb_substr($string, 0, $limit, 'UTF-8')).$append;
    }

    /**
     * Truncate the string to given length of words.
     *
     * @param $string
     * @param $limit
     * @param string $append
     * @return string
     */
    public static function limit_words( $string, $limit = 100, $append = '...')
    {
        preg_match('/^\s*+(?:\S++\s*+){1,'.$limit.'}/u', $string, $matches);
        if ( ! isset($matches[0]) || strlen($string) === strlen($matches[0])) {
            return $string;
        }

        return rtrim($matches[0]).$append;
    }

    /**
     * Returns the ordinal version of a number (appends th, st, nd, rd).
     *
     * @param  string $number The number to append an ordinal suffix to
     * @return string
     */
    public static function ordinal( $number )
    {
        $test_c = abs ($number ) % 10;

        $ext = ( ( abs( $number ) % 100 < 21 && abs( $number ) % 100 > 4 ) ? 'th' : ( ( $test_c < 4 ) ? ( $test_c < 3 ) ? ( $test_c < 2 ) ? ( $test_c < 1 ) ? 'th' : 'st' : 'nd' : 'rd' : 'th' ) );

        return $number . $ext;
    }

    /**
     * Returns the file permissions as a nice string, like -rw-r--r--
     *
     * @param   string $file The name of the file to get permissions form
     * @return  string
     */
    public static function full_permissions( $file, $perms = null )
    {
        if (is_null($perms)) {
            $perms = fileperms( $file );
        }

        if ( ( $perms & 0xC000 ) == 0xC000 ) {
            // Socket
            $info = 's';
        } else if ( ( $perms & 0xA000 ) == 0xA000 ) {
            // Symbolic Link
            $info = 'l';
        } else if ( ( $perms & 0x8000 ) == 0x8000 ) {
            // Regular
            $info = '-';
        } else if ( ( $perms & 0x6000 ) == 0x6000 ) {
            // Block special
            $info = 'b';
        } else if ( ( $perms & 0x4000 ) == 0x4000 ) {
            // Directory
            $info = 'd';
        } else if ( ( $perms & 0x2000 ) == 0x2000 ) {
            // Character special
            $info = 'c';
        } else if ( ( $perms & 0x1000 ) == 0x1000 ) {
            // FIFO pipe
            $info = 'p';
        } else {
            // Unknown
            $info = 'u';
        }

        // Owner
        $info .= ( ( $perms & 0x0100 ) ? 'r' : '-' );
        $info .= ( ( $perms & 0x0080 ) ? 'w' : '-' );
        $info .= ( ( $perms & 0x0040 ) ?
                    ( ( $perms & 0x0800 ) ? 's' : 'x' ) :
                    ( ( $perms & 0x0800 ) ? 'S' : '-' ) );

        // Group
        $info .= ( ( $perms & 0x0020 ) ? 'r' : '-' );
        $info .= ( ( $perms & 0x0010 ) ? 'w' : '-' );
        $info .= ( ( $perms & 0x0008 ) ?
                    ( ( $perms & 0x0400 ) ? 's' : 'x' ) :
                    ( ( $perms & 0x0400 ) ? 'S' : '-' ) );

        // World
        $info .= ( ( $perms & 0x0004 ) ? 'r' : '-' );
        $info .= ( ( $perms & 0x0002 ) ? 'w' : '-' );
        $info .= ( ( $perms & 0x0001 ) ?
                    ( ( $perms & 0x0200 ) ? 't' : 'x' ) :
                    ( ( $perms & 0x0200 ) ? 'T' : '-' ) );

        return $info;
    }

    /**
     * Returns the first element in an array.
     *
     * @param  array $array
     * @return mixed
     */
    public static function array_first( array $array )
    {
        return reset( $array );
    }

    /**
     * Returns the last element in an array.
     *
     * @param  array $array
     * @return mixed
     */
    public static function array_last( array $array )
    {
        return end( $array );
    }

    /**
     * Returns the first key in an array.
     *
     * @param  array $array
     * @return int|string
     */
    public static function array_first_key( array $array )
    {
        reset( $array );

        return key( $array );
    }

    /**
     * Returns the last key in an array.
     *
     * @param  array $array
     * @return int|string
     */
    public static function array_last_key( array $array )
    {
        end( $array );

        return key( $array );
    }

    /**
     * Flatten a multi-dimensional array into a one dimensional array.
     *
     * @param  array   $array         The array to flatten
     * @param  boolean $preserve_keys Whether or not to preserve array keys.
     *                                Keys from deeply nested arrays will
     *                                overwrite keys from shallowy nested arrays
     * @return array
     */
    public static function array_flatten(array $array, $preserve_keys = TRUE)
    {
        $flattened = array();

        array_walk_recursive($array, function($value, $key) use (&$flattened, $preserve_keys) {
            if ($preserve_keys && !is_int($key)) {
                $flattened[$key] = $value;
            } else {
                $flattened[] = $value;
            }
        });

        return $flattened;
    }

    /**
     * Accepts an array, and returns an array of values from that array as
     * specified by $field. For example, if the array is full of objects
     * and you call util::array_pluck( $array, 'name' ), the function will
     * return an array of values from $array[]->name.
     *
     * @param  array   $array            An array
     * @param  string  $field            The field to get values from
     * @param  boolean $preserve_keys    Whether or not to preserve the
     *                                   array keys
     * @param  boolean $remove_nomatches If the field doesn't appear to be set,
     *                                   remove it from the array
     * @return array
     */
    public static function array_pluck( array $array, $field, $preserve_keys = TRUE, $remove_nomatches = TRUE )
    {
        $new_list = array();

        foreach ( $array as $key => $value ) {
            if ( is_object( $value ) ) {
                if ( isset( $value->{$field} ) ) {
                    if ( $preserve_keys ) {
                        $new_list[$key] = $value->{$field};
                    } else {
                        $new_list[] = $value->{$field};
                    }
                } else if ( ! $remove_nomatches ) {
                    $new_list[$key] = $value;
                }
            } else {
                if ( isset( $value[$field] ) ) {
                    if ( $preserve_keys ) {
                        $new_list[$key] = $value[$field];
                    } else {
                        $new_list[] = $value[$field];
                    }
                } else if ( ! $remove_nomatches ) {
                    $new_list[$key] = $value;
                }
            }
        }

        return $new_list;
    }

    /**
     * Searches for a given value in an array of arrays, objects and scalar
     * values. You can optionally specify a field of the nested arrays and
     * objects to search in.
     *
     * @param  array   $array  The array to search
     * @param  scalar  $search The value to search for
     * @param  string  $field  The field to search in, if not specified
     *                         all fields will be searched
     * @return boolean|scalar  False on failure or the array key on success
     */
    public static function array_search_deep( array $array, $search, $field = FALSE )
    {
        // *grumbles* stupid PHP type system
        $search = (string) $search;

        foreach ( $array as $key => $elem ) {

            // *grumbles* stupid PHP type system
            $key = (string) $key;

            if ( $field ) {
                if ( is_object( $elem ) && $elem->{$field} === $search ) {
                    return $key;
                } else if ( is_array( $elem ) && $elem[$field] === $search ) {
                    return $key;
                } else if ( is_scalar( $elem ) && $elem === $search ) {
                    return $key;
                }
            } else {
                if ( is_object( $elem ) ) {
                    $elem = (array) $elem;

                    if ( in_array( $search, $elem ) ) {
                        return $key;
                    }
                } else if ( is_array( $elem ) && in_array( $search, $elem ) ) {
                    return $key;
                } else if ( is_scalar( $elem ) && $elem === $search ) {
                    return $key;
                }
            }
        }

        return FALSE;
    }

    /**
     * Returns an array containing all the elements of arr1 after applying
     * the callback function to each one.
     *
     * @param  string  $callback     Callback function to run for each
     *                               element in each array
     * @param  array   $array        An array to run through the callback
     *                               function
     * @param  boolean $on_nonscalar Whether or not to call the callback
     *                               function on nonscalar values
     *                               (Objects, resources, etc)
     * @return array
     */
    public static function array_map_deep( array $array, $callback, $on_nonscalar = FALSE )
    {
        foreach ( $array as $key => $value ) {
            if ( is_array( $value ) ) {
                $args = array( $value, $callback, $on_nonscalar );
                $array[$key] = call_user_func_array( array( __CLASS__, __FUNCTION__ ), $args );
            } else if ( is_scalar( $value ) || $on_nonscalar ) {
                $array[$key] = call_user_func( $callback, $value );
            }
        }

        return $array;
    }

    public static function array_clean(array $array)
    {
        return array_filter($array);
    }

    /**
     * Wrapper to prevent errors if the user doesn't have the mbstring
     * extension installed.
     *
     * @param  string $encoding
     * @return string
     */
    protected static function mb_internal_encoding( $encoding = null )
    {
        if (function_exists('mb_internal_encoding')) {
            return $encoding ? mb_internal_encoding($encoding) : mb_internal_encoding();
        }

        return 'UTF-8';
    }
}
