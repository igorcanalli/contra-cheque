<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cpf implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $cpf = preg_replace('/\D/', '', $value);
        //            
        if ($cpf < 99999) {
            return false;
        }

        $cpf = str_pad($cpf, 11, "0", STR_PAD_LEFT);

        $num = array();
        for ($i = 0; $i < (strlen($cpf)); $i++) {

            $num[] = $cpf[$i];
        }

        if (count($num) != 11) {
            return false;
        }

        for ($i = 0; $i < 10; $i++) {
            if ($num[0] == $i && $num[1] == $i && $num[2] == $i                 && $num[3] == $i && $num[4] == $i && $num[5] == $i                 && $num[6] == $i && $num[7] == $i && $num[8] == $i) {
                return false;
            }
        }
        $j = 10;
        for ($i = 0; $i < 9; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        if ($resto < 2) {
            $dg = 0;
        } else {
            $dg = 11 - $resto;
        }
        if ($dg != $num[9]) {
            return false;
        }

        $j = 11;
        for ($i = 0; $i < 10; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        if ($resto < 2) {
            $dg = 0;
        } else {
            $dg = 11 - $resto;
        }
        if ($dg != $num[10]) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'invalid cpf format';
    }
}
