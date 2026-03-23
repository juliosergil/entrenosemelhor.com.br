<?php
/**
 * Compat layer for PHP 8.x (tested for 8.2/8.3) to keep legacy code running.
 * Safe to include on older PHP too because all functions are guarded by function_exists().
 *
 * NOTE: This file intentionally provides polyfills for removed functions:
 * - each()
 * - split()
 * - mysql_* (very small subset + common helpers) mapped to mysqli
 */

/* =========================
   each() polyfill (removed in PHP 8)
   ========================= */
if (!function_exists('each')) {
    function each(&$array) {
        if (!is_array($array)) return false;
        $key = key($array);
        if ($key === null) return false;
        $value = current($array);
        next($array);
        return array(1 => $value, 'value' => $value, 0 => $key, 'key' => $key);
    }
}

/* =========================
   split() polyfill (removed; use preg_split)
   split($pattern, $string, $limit)
   ========================= */
if (!function_exists('split')) {
    function split($pattern, $subject, $limit = -1) {
        // legacy split() expects a regex pattern WITHOUT delimiters
        $delim = '#';
        $rx = $delim . str_replace($delim, '\\' . $delim, $pattern) . $delim;
        $lim = ($limit === 0) ? -1 : (int)$limit;
        return preg_split($rx, (string)$subject, $lim);
    }
}

/* =========================
   get_magic_quotes_gpc / set_magic_quotes_runtime (removed in PHP 8)
   ========================= */
if (!function_exists('get_magic_quotes_gpc')) {
    function get_magic_quotes_gpc() { return false; }
}
if (!function_exists('set_magic_quotes_runtime')) {
    function set_magic_quotes_runtime($new_setting) { return false; }
}

/* =========================
   Minimal mysql_* polyfill (ext/mysql removed)
   Mapped to mysqli. This is a best-effort shim.
   ========================= */
if (!function_exists('mysql_connect')) {
    $GLOBALS['__mysql_link'] = null;

    function mysql_connect($server = null, $username = null, $password = null, $new_link = false, $client_flags = 0) {
        $server = $server ?: ini_get('mysqli.default_host') ?: 'localhost';
        $username = $username ?? ini_get('mysqli.default_user');
        $password = $password ?? ini_get('mysqli.default_pw');

        $link = @mysqli_connect($server, $username, $password);
        if ($link) {
            // Keep a default link for calls that omit it
            $GLOBALS['__mysql_link'] = $link;
            // Try to default to utf8mb4 when possible
            @mysqli_set_charset($link, 'utf8mb4');
        }
        return $link;
    }

    function mysql_select_db($database_name, $link_identifier = null) {
        $link = $link_identifier ?: ($GLOBALS['__mysql_link'] ?? null);
        if (!$link) return false;
        return @mysqli_select_db($link, $database_name);
    }

    function mysql_db_query($database_name, $query, $link_identifier = null) {
        $link = $link_identifier ?: ($GLOBALS['__mysql_link'] ?? null);
        if (!$link) return false;
        @mysqli_select_db($link, $database_name);
        return @mysqli_query($link, $query);
    }

    function mysql_query($query, $link_identifier = null) {
        $link = $link_identifier ?: ($GLOBALS['__mysql_link'] ?? null);
        if (!$link) return false;
        return @mysqli_query($link, $query);
    }

    function mysql_num_fields($result) {
        if (!$result) return 0;
        return @mysqli_num_fields($result);
    }

    function mysql_num_rows($result) {
        if (!$result) return 0;
        return @mysqli_num_rows($result);
    }

    function mysql_fetch_assoc($result) {
        if (!$result) return false;
        return @mysqli_fetch_assoc($result);
    }

    function mysql_fetch_array($result, $result_type = MYSQLI_BOTH) {
        if (!$result) return false;
        // Map old constants if provided
        if ($result_type === 1 /* MYSQL_ASSOC */) $result_type = MYSQLI_ASSOC;
        if ($result_type === 2 /* MYSQL_NUM */) $result_type = MYSQLI_NUM;
        if ($result_type === 3 /* MYSQL_BOTH */) $result_type = MYSQLI_BOTH;
        return @mysqli_fetch_array($result, $result_type);
    }

    function mysql_fetch_row($result) {
        if (!$result) return false;
        return @mysqli_fetch_row($result);
    }

    function mysql_free_result($result) {
        if (!$result) return true;
        return @mysqli_free_result($result);
    }

    function mysql_insert_id($link_identifier = null) {
        $link = $link_identifier ?: ($GLOBALS['__mysql_link'] ?? null);
        if (!$link) return 0;
        return (int)@mysqli_insert_id($link);
    }

    function mysql_affected_rows($link_identifier = null) {
        $link = $link_identifier ?: ($GLOBALS['__mysql_link'] ?? null);
        if (!$link) return -1;
        return (int)@mysqli_affected_rows($link);
    }

    function mysql_real_escape_string($unescaped_string, $link_identifier = null) {
        $link = $link_identifier ?: ($GLOBALS['__mysql_link'] ?? null);
        if ($link) return @mysqli_real_escape_string($link, (string)$unescaped_string);
        return addslashes((string)$unescaped_string);
    }

    function mysql_escape_string($unescaped_string) {
        return addslashes((string)$unescaped_string);
    }

    function mysql_error($link_identifier = null) {
        $link = $link_identifier ?: ($GLOBALS['__mysql_link'] ?? null);
        return $link ? (string)@mysqli_error($link) : '';
    }

    function mysql_errno($link_identifier = null) {
        $link = $link_identifier ?: ($GLOBALS['__mysql_link'] ?? null);
        return $link ? (int)@mysqli_errno($link) : 0;
    }

    function mysql_close($link_identifier = null) {
        $link = $link_identifier ?: ($GLOBALS['__mysql_link'] ?? null);
        if (!$link) return true;
        $ok = @mysqli_close($link);
        if ($GLOBALS['__mysql_link'] === $link) $GLOBALS['__mysql_link'] = null;
        return $ok;
    }
}

/* =========================
   PHP 8.x runtime guards (avoid TypeError on legacy nulls)
   ========================= */

/**
 * dv_count: PHP 7.x tolerated count(null) (warning + 0). PHP 8 throws TypeError.
 * This wrapper returns:
 * - 0 for null
 * - count() for arrays/Countable
 * - 1 for other values (matches legacy count('string') behavior)
 */
if (!function_exists('dv_count')) {
    function dv_count($value) {
        if ($value === null) return 0;
        if (is_array($value)) return count($value);
        if (is_object($value) && function_exists('is_countable') && is_countable($value)) return count($value);
        return 1;
    }
}

/**
 * dv_array_merge: treats null as empty array to avoid TypeError in PHP 8.
 */
if (!function_exists('dv_array_merge')) {
    function dv_array_merge(...$arrays) {
        $out = [];
        foreach ($arrays as $a) {
            if ($a === null) $a = [];
            if (is_array($a)) {
                $out = array_merge($out, $a);
            } elseif ($a instanceof Traversable) {
                $out = array_merge($out, iterator_to_array($a));
            } else {
                // legacy-ish fallback: cast scalars/objects to array
                $out = array_merge($out, (array)$a);
            }
        }
        return $out;
    }
}

/**
 * dv_in_array / dv_array_search: haystack null => []
 */
if (!function_exists('dv_in_array')) {
    function dv_in_array($needle, $haystack, $strict = false) {
        if ($haystack === null) $haystack = [];
        if (!is_array($haystack)) $haystack = (array)$haystack;
        return in_array($needle, $haystack, (bool)$strict);
    }
}
if (!function_exists('dv_array_search')) {
    function dv_array_search($needle, $haystack, $strict = false) {
        if ($haystack === null) $haystack = [];
        if (!is_array($haystack)) $haystack = (array)$haystack;
        return array_search($needle, $haystack, (bool)$strict);
    }
}

/**
 * dv_preg_match: subject null => '' to avoid TypeError in PHP 8
 */
if (!function_exists('dv_preg_match')) {
    function dv_preg_match($pattern, $subject, &$matches = null, $flags = 0, $offset = 0) {
        if ($subject === null) $subject = '';
        if (is_array($subject)) $subject = '';
        if (is_object($subject) && !method_exists($subject, '__toString')) $subject = '';
        if ($matches === null) $matches = [];
        return preg_match($pattern, (string)$subject, $matches, (int)$flags, (int)$offset);
    }
}

/**
 * dv_preg_replace: subject null => '' (preg_replace accepts string|array subject)
 */
if (!function_exists('dv_preg_replace')) {
    function dv_preg_replace($pattern, $replacement, $subject, $limit = -1, &$count = null) {
        if ($subject === null) $subject = '';
        if ($count === null) $count = 0;
        return preg_replace($pattern, $replacement, $subject, (int)$limit, $count);
    }
}

/**
 * dv_strpos: haystack/needle null => '' to avoid TypeError in PHP 8
 */
if (!function_exists('dv_strpos')) {
    function dv_strpos($haystack, $needle, $offset = 0) {
        if ($haystack === null) $haystack = '';
        if ($needle === null) $needle = '';
        if (is_array($haystack) || is_array($needle)) return false;
        if (is_object($haystack) && !method_exists($haystack, '__toString')) $haystack = '';
        if (is_object($needle) && !method_exists($needle, '__toString')) $needle = '';
        return strpos((string)$haystack, (string)$needle, (int)$offset);
    }
}
