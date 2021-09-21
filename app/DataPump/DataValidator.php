<?php

namespace App\DataPump;

trait DataValidator
{
    public function sanatizeData(string $type, string $value)
    {
        if ($type === 'int') {
            return intval($value);
        }
        if ($type === 'date') {
            return date('Y-m-d', strtotime($value));
        }
        if ($type === 'time') {
            $date = \Carbon\Carbon::parse('2016-11-01 ' . $value);
            return $date->format('H:i');
        }
        if ($type === 'bool') {
            if (in_array(strtolower($value), ['false', 'no', 'none'])) {
                return false;
            }
            return true;
        }

        return $value;
    }
}
