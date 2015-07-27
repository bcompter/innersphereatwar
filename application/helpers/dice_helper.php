<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('roll_dice'))
{
    function roll_dice($number, $sides)
    {
        $sum = 0;
        for ($i = 0; $i < $number; $i++)
        {
            $sum += rand(1,$sides);
        }
        return $sum;
    }
}