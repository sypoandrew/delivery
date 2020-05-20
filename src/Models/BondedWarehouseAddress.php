<?php

namespace Sypo\Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Aero\Common\Models\Country;
use Aero\Catalog\Models\Product;
use Aero\Catalog\Events\ProductCreated;

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
		$models = self::getModels();
        foreach($items as $item){
			if(in_array($item->sku, $models)){
				$cart->remove($item->id);
			}
		}
    }

    /**
     * Get all unique models
     *
     * @return array
     */
    public static function getModels(): array
    {
        return self::select('model')->distinct()->whereNotNull('model')->where('model', '!=', '')->pluck('model')->toArray();
    }

    /**
     * Create all unique models
     *
     * @return void
     */
    public static function createModels(): void
    {
        $language = config('app.locale');
        $vat_rate = \Aero\Common\Models\TaxRate::where('name', 'like', '%VAT%')->first()->rate;
        $models = self::getModels();
        foreach($models as $model){
			$p = Product::where('model', $model)->first();
			if($p === null){
				#create delivery product
				$p = new Product;
				$p->model = $model;
				$p->name = 'Bonded warehouse charge';
				$p->active = true;
				$p->type = 'simple';
				if($p->save()){
					#Internal tag for quick searching of API items in admin
					$tag_group = \Aero\Catalog\Models\TagGroup::where("name->{$language}",'Internal')->first();
					$tag = self::findOrCreateTag('Storage charge', $tag_group);
					$p->tags()->syncWithoutDetaching($tag);
					
					$variant = new \Aero\Catalog\Models\Variant;
					$variant->product_id = $p->id;
					$variant->shippable = 0;
					$variant->infinite_stock = 1;
					$variant->minimum_quantity = 0;
					$variant->sku = $p->model;
					$variant->product_tax_group_id = 1; #taxable
					if($variant->save()){
						
						$modelx = explode('-', $model);
						$item_price = $modelx[1] * (1 + ($vat_rate/100));
						
						#add the variant price
						$price = new \Aero\Catalog\Models\Price([
							'variant_id' => $variant->id,
							'product_tax_group_id' => $variant->product_tax_group_id,
							'product_id' => $p->id,
							'quantity' => 1,
							'currency_code' => 'GBP',
							'value' => ($item_price*100),
						]);
						
						if($price->save()){
							#Log::debug('variant price created successfully');
						}
					}
					event(new ProductCreated($p));
				}
			}
		}
    }

    /**
     * @param $name
     * @param \Aero\Catalog\Models\TagGroup $group
     * @return \Aero\Catalog\Models\Tag
     */
    protected static function findOrCreateTag($name, \Aero\Catalog\Models\TagGroup $group)
    {
        $language = config('app.locale');
        $tag = $group->tags()->where("name->{$language}", $name)->first();

        if (! $tag) {
            $tag = new \Aero\Catalog\Models\Tag();
            $tag->setTranslation('name', $language, $name);

            $group->tags()->save($tag);
        }

        return $tag;
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
