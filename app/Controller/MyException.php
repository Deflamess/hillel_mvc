<?php

namespace Hillel\Controller;

class MyException extends \Exception
{
    public function __toString()
    {
        $string_ = parent::__toString();

        $pos = strripos($string_, "in ");

        if ( $pos ) {
            return substr($string_, 0, $pos - 1);
        } else {
            return $string_;
        }
    }
};