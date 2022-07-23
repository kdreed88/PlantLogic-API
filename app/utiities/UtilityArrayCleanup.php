<?php

namespace plantlogic\utilities;

class UtilityArrayCleanup
{
    public static function trimValues(array &$arr)
    {
        foreach ($arr as $k => $v)
        {
            if (is_array($v))
            {
                self::trimValues($arr[$k]);
            }
            else
            {
                $arr[$k] = trim($v);
            }
        }
    }

    public static function setMissingValues(array &$arr, array $replacements)
    {
        foreach ($arr as $k => $v)
        {
            if (is_array($v))
            {
                self::setMissingValues($arr[$k], $replacements);
            }
            else
            {
                if (array_key_exists($k, $replacements) && (is_null($v) || strlen(trim($v)) === 0))
                {
                    $arr[$k] = $replacements[$k];
                }
            }
        }
    }

    public static function convertToCase(array &$arr, array $conversions)
    {
        foreach ($arr as $k => $v)
        {
            if (is_array($v))
            {
                self::convertToCase($arr[$k], $conversions);
            }
            else
            {
                if (array_key_exists($k, $conversions) && (is_null($v) || strlen(trim($v)) === 0))
                {
                    switch ($conversions[$k])
                    {
                        case "lowercase":
                            $arr[$k] = strtolower($v);
                            break;

                        default:
                            break;
                    }
                }
            }
        }
    }
}