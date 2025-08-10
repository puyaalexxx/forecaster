<?php
declare(strict_types=1);


namespace App\Exception;

class LocationNotFoundException extends \Exception
{
    /**
     * @param string $string
     */
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}
