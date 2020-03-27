<?php

namespace Sypo\Delivery\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class Delivery
{
    /**
     * Check if selected postcode in the blacklist
     *
     * @var string
     * @return boolean
     */
    public static function allowed_postcode($postcode)
    {
		$codes = explode(',', setting('Delivery.problem_postcodes'));
		
		$rv = true;
		foreach($codes as $code){
			if(substr($postcode, 0, strlen($code)) == $code){
				$rv = false;
				break;
			}
		}
		
		return $rv;
    }
}
