<?php

namespace Sypo\Delivery\Providers;

use Aero\Admin\AdminModule;
use Aero\Common\Providers\ModuleServiceProvider;
use Aero\Common\Facades\Settings;
use Aero\Common\Settings\SettingGroup;
use Spatie\Valuestore\Valuestore;

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
    }
}