<?php

namespace Sypo\Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Aero\Common\Models\Country;
use Aero\Catalog\Models\Product;

class BondedWarehouseAddress extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'sypo_bonded_warehouse_address';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * The country name for this address.
     *
     * @return string|null
     */
    public function getCountryNameAttribute(): ?string
    {
        return optional($this->country)->name;
    }

    /**
     * The full name for this address.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return trim($this->first.' '.$this->last);
    }

    /**
     * Format the address fields.
     *
     * @return string
     */
    public function getFormattedAttribute(): string
    {
        return collect([
            $this->line1,
            $this->line2,
            $this->city,
            $this->county,
            $this->postcode,
            $this->country_name,
        ])->filter()->implode(', ');
    }

    /**
     * Format the address fields with an alternative layout.
     *
     * @return string
     */
    public function getFormattedAltAttribute(): string
    {
        return collect([
            $this->line1, $this->line2, $this->city, $this->county,
            str_replace(' ', '', $this->postcode), $this->country_code,
        ])->filter()->implode(', ');
    }

    /**
     * Clear current selected bonded delivery item from cart
     *
     * @return string|null
     */
    public function getPriceAttribute(): float
    {
        if($this->model){
			return Product::where('model', $this->model)->first()->lowest_price->value;
		}
		return 0.00;
    }

    /**
     * Clear current selected bonded delivery item from cart
     *
     * @return string|null
     */
    public static function removeBondedDeliveryItemFromOrder(\Aero\Cart\Cart $cart): void
    {
        $items = $cart->items();
        foreach($items as $item){
			if(substr($item->loadModel()->product()->first()->model, 0, 5) == 'BOND-'){
				$cart->remove($item->id);
			}
		}
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * The country for this address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
