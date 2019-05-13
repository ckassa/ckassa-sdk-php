<?php
namespace Ckassa\Helpers;

class DataHelper
{
    /**
     * Изменяет последовательность элементов в массиве
     * @param array $sequence
     * @param array $data
     * @return array
     */
    public static function transfigureData(array $sequence, array $data)
    {
        $result = [];
        foreach ($sequence as $item) {
            if (isset($data[$item])) {
                $result[$item] = $data[$item];
            }
        }
        return $result;
    }
}