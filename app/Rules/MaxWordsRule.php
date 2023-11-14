<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxWordsRule implements Rule
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
    public function passes( $attribute, $value)
    {
        //print( str_word_count($value));
        if(str_word_count($value) <= 300 && str_word_count($value) >= 150  ){
            //print( "simona la mona");
            return str_word_count($value);
        }
        //else{
            //print("nel pastel");
        //}


        
       
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo :attribute debe ser maximo 300 palabras o minimo 150 palabras.';
    }
}
