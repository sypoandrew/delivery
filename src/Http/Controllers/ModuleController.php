<?php

namespace Sypo\Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Aero\Admin\Facades\Admin;
use Aero\Admin\Http\Controllers\Controller;
use Sypo\Delivery\Models\Delivery;
use Illuminate\Http\RedirectResponse;
use Spatie\Valuestore\Valuestore;

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
		if($request->isMethod('post')) {
			$validator = \Validator::make($request->all(), [
				'problem_postcodes' => 'required',
			]);
			
			if($validator->fails()){
				return redirect()->back()->withErrors($validator->errors()->all());
			}
			
			$valuestore = Valuestore::make(storage_path('app/settings/Delivery.json'));
			$valuestore->put('enabled', (int) $request->input('enabled'));
			$valuestore->put('problem_postcodes', $request->input('problem_postcodes'));
			
			
			return redirect()->back()->with('message', 'Settings updated');
		}
		else{
			abort(403);
		}
    }
}
