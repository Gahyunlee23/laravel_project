<?php

namespace App\Models\Hotels;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Hotels\ProductCategory
 *
 * @property int $id
 * @property string|null $type 출력 위치 세팅
 * @property string|null $hotels 호텔 명으로 일반, 큐레이터 호텔 서칭 출력
 * @property int|null $order 출력 순서
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereHotels($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductCategory withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hotels\Products[] $Products
 * @property-read int|null $products_count
 * @property-read mixed $curator_hotel_count
 * @property-read mixed $hotel_count
 */
class ProductCategory extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $table = 'product_categories';
    protected $guarded = [];

    public function Products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Products::class,'category_id','id');
    }

    public function getHotelCountAttribute(){
        $count=0;
        if(isset($this->Products)){
            foreach ($this->Products as $product){
                if(isset($product->CategoryHotels)){
                    foreach ($product->CategoryHotels as $items){
                        if(isset($items->hotels)){
                            $count+=$items->hotels->where('hotel.curator', '=', 'N')->count();
                        }
                    }
                }
            }
        }
        return $count;
    }
    public function getCuratorHotelCountAttribute(){
        $count=0;
        if(isset($this->Products)){
            foreach ($this->Products as $product){
                if(isset($product->CategoryHotels)){
                    foreach ($product->CategoryHotels as $items){
                        if(isset($items->hotels)){
                            $count+=$items->hotels->where('hotel.curator', '=', 'Y')->count();
                        }
                    }
                }
            }
        }
        return $count;
    }
}
