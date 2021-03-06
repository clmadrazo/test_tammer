<?php
namespace Test\Util;

class TestUtils
{
    public function completeUrl($url)
    {
        $trimmedUrl = trim($url);
        if ($url != '') {
            $parsedUrl = parse_url($trimmedUrl);
            if (!isset($parsedUrl['scheme'])) {
                $parsedUrl['scheme'] = 'http';
            }
            $return = $this->_unparse_url($parsedUrl);
        } else {
            $return = '';
        }

        return $return;
    }

    private function _unparse_url($parsed_url) {
        $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
        $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
        $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
        $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
        $pass     = ($user || $pass) ? "$pass@" : '';
        $path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
        $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
        $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
        return "$scheme$user$pass$host$port$path$query$fragment";
    }
}
