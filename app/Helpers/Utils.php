<?php

class Utils
{
    /**
     * Funcao para validar uma data
     *
     * @param string $date
     * @param string $format
     * @return boolean
     */
    public static function validateDate(string $date, string $format = 'Y-m-d') : bool
    {
        $dt = DateTime::createFromFormat($format, $date);
        return $dt && $dt->format($format) === $date;
    }

    /**
     * Função para validar se um numero é float
     *
     * @param [type] $value
     * @return boolean
     */
    public static function validateFloat($value) : bool
    {
        return \is_numeric($value) && \is_float($value + 0);
    }

    /**
     * Função para validar se um numero é int
     *
     * @param [type] $value
     * @return boolean
     */
    public static function validateInt($value) : bool
    {
        return \is_numeric($value) && \is_int($value + 0);
    }
    
}