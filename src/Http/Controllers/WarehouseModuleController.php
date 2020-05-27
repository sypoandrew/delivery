<?php

namespace Sypo\Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Aero\Admin\Facades\Admin;
use Aero\Admin\Http\Controllers\Controller;
use Sypo\Delivery\Models\Delivery;
use Sypo\Delivery\Models\BondedWarehouseAddress;
use Illuminate\Http\RedirectResponse;

class WarehouseModuleController extends Controller
{
    protected $data = []; // the information we send to the view

    /**
     * list view for addresses
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->data['bondedwarehouseaddress'] = BondedWarehouseAddress::get();
        return view('delivery::warehouse', $this->data);
    }
    
	/**
     * update/create address
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
		$res = ['success'=>false,'data'=>false,'error'=>[]];
		
		if($request->isMethod('post')) {
			$validator = \Validator::make($request->all(), [
				'name' => 'required',
			]);
			
			if($validator->fails()){
				$res['error'] = $validator->errors()->all();
				#return response()->json($res);
				return Redirect::back()->withErrors($res['error']);
			}
			
			if($request->input('id')){
				#update existing
				$b = BondedWarehouseAddress::find($request->input('id'));
			}
			else{
				#create new item
				$b = new BondedWarehouseAddress;
			}
			
			$b->name = $request->input('name');
			$b->first = $request->input('first');
			$b->last = $request->input('last');
			$b->line1 = $request->input('line1');
			$b->line2 = $request->input('line2');
			$b->city = $request->input('city');
			$b->county = $request->input('county');
			$b->postcode = $request->input('postcode');
			$b->country_code = $request->input('country_code');
			$b->model = $request->input('model');
			$b->allow_ep = ($request->input('allow_ep')) ? true : false;
			$b->is_tbc = ($request->input('is_tbc')) ? true : false;
			$b->save();
			
			return redirect()->back()->with('message', 'Address updated.');
		}
		else{
			abort(403);
		}
    }
    
	/**
     * Edit address
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function edit($id, Request $request)
    {
        $this->data['bondedwarehouseaddress'] = BondedWarehouseAddress::find($id);
        return view('delivery::editwarehouse', $this->data);
    }
    
	/**
     * Add new address
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $this->data['bondedwarehouseaddress'] = new BondedWarehouseAddress;
        return view('delivery::editwarehouse', $this->data);
    }
}
