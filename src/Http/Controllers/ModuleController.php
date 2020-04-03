<?php

namespace Sypo\Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Aero\Admin\Facades\Admin;
use Aero\Admin\Http\Controllers\Controller;
use Sypo\Delivery\Models\Delivery;
use Illuminate\Http\RedirectResponse;

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
		
		if($request->isMethod('post')) {
			$validator = \Validator::make($request->all(), [
				'problem_postcodes' => 'required',
			]);
			
			if($validator->fails()){
				$res['error'] = $validator->errors()->all();
				#return response()->json($res);
				return Redirect::back()->withErrors($res['error']);
			}
			
			$formdata = $request->all();
			Log::debug($formdata);
			#dd($formdata);
			Log::debug($formdata['problem_postcodes']);
			
			$formdata['enabled'] = (!isset($formdata['enabled'])) ? 0 : $formdata['enabled'];
			
			
			return redirect()->back()->with('message', 'Settings updated.');
		}
		else{
			abort(403);
		}
    }
}
