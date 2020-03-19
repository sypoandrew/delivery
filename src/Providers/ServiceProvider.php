<?php

namespace Sypo\Delivery\Providers;

use Aero\Admin\AdminModule;
use Aero\Common\Providers\ModuleServiceProvider;
use Aero\Common\Facades\Settings;
use Aero\Common\Settings\SettingGroup;
use Aero\Payment\Models\PaymentMethod;
use Spatie\Valuestore\Valuestore;
use Illuminate\Support\Facades\Log;

class ServiceProvider extends ModuleServiceProvider
{
    public function register(): void 
    {
        AdminModule::create('Delivery')
            ->title('VinQuinn Delivery')
            ->summary('Custom delivery settings for Aero Commerce')
            ->routes(__DIR__ .'/../../routes/admin.php')
            ->route('admin.modules.delivery');
    }
	
    public function boot(): void 
    {
        Settings::group('Delivery', function (SettingGroup $group) {
            $group->boolean('enabled')->default(true);
            $group->string('problem_postcodes')->default('AB,BT,CA,DD,DG,EH,FK,G,HS,IM,IV,KA,KA,KW,KY,ML,NE,PA,PA,PH,PL,PO,SR,TD,TQ,TR,ZE');
        });
		
		$valuestore = Valuestore::make(storage_path('app/delivery.json'));
		$valuestore->put('enabled', '1');
		$valuestore->put('problem_postcodes', 'AB,BT,CA,DD,DG,EH,FK,G,HS,IM,IV,KA,KA,KW,KY,ML,NE,PA,PA,PH,PL,PO,SR,TD,TQ,TR,ZE');
		
		$this->loadViewsFrom(__DIR__ . '/../../resources/views/', 'delivery');
		
		PaymentMethod::setCartValidator(function ($method, $cart) {
			Log::debug('checking payment methods for problem postcodes');
			#Log::debug($method->driver);
			
			$order = $cart->order();
			$address = $order->shippingAddress;
			$delivery_postcode = $address->postcode;
			Log::debug($delivery_postcode);
			
			if($method->driver == 'realex'){
				#hide if postcode is in problem_postcodes
				$problem_postcodes_r = explode(',', setting('problem_postcodes'));
				Log::debug($problem_postcodes_r);
				foreach($problem_postcodes_r as $pp){
					if(substr($delivery_postcode, 0, strlen($pp)) == $pp){
						return false;
					}
				}
			}
			
			#default handling
			return true;
		});
    }
}