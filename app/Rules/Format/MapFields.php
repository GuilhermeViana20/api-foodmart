<?php

namespace App\Rules\Format;

class MapFields
{
    public function execute($array, $fields)
    {
        $response = $array->map(function ($item) use ($fields) {
            $result = [];
            foreach ($fields as $field) {
                $result[$field] = $item->$field;
            }
            return $result;
        });

        return $response;
    }
}
