<?php

namespace Sypo\Delivery\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Spatie\Valuestore\Valuestore;

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
		$valuestore = Valuestore::make(storage_path('app/dutytax.json'));
		$codes = explode(',', $valuestore->get('problem_postcodes'));
		
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
