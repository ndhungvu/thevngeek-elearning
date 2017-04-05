<?php

if (!function_exists('str_search_limit')) {
    function str_search_limit($input = '', $limit = 0, $keyword = '')
    {
        if ($input) {
            if ($limit && $keyword) {
                $index = strrpos($input,$keyword);

                if (str_contains($input, $keyword) && $index && $limit < $index) {
                    $input = '...' . substr($input, $index);
                }
            }
            if ($limit) {
                $input = str_limit($input, $limit);
            }
            if ($keyword) {
                if (str_contains($input, $keyword)) {
                    $input = str_replace($keyword, '<b>' . $keyword . '</b>', $input);
                }
            }

            return $input;
        }

        return;
    }
}