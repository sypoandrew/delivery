<?php

namespace Sypo\Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Aero\Admin\Facades\Admin;
use Aero\Admin\Http\Controllers\Controller;
use Spatie\Valuestore\Valuestore;
use Sypo\Delivery\Models\Delivery;

class ModuleController extends Controller
{
    protected $data = []; // the information we send to the view

    /**
     * Show main settings form
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $valuestore = Valuestore::make(storage_path('app/delivery.json'));
		$this->data['valuestore'] = $valuestore->all();
		
		return view('delivery::delivery', $this->data);
    }
    
	/**
     * Update settings
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
		$res = ['success'=>false,'data'=>false,'error'=>[]];
		
        $validator = \Validator::make($request->all(), [
            'problem_postcodes' => 'required',
        ]);
		
		if($validator->fails()){
			$res['error'] = $validator->errors()->all();
			return response()->json($res);
		}
		
		$formdata = $request->json()->all();
		Log::debug($formdata);
		
		$valuestore = Valuestore::make(storage_path('app/delivery.json'));
		$valuestore->put('enabled', $formdata['enabled']);
		$valuestore->put('problem_postcodes', $formdata['problem_postcodes']);
		
		
        return redirect(route('admin.modules.delivery'));
    }
}
