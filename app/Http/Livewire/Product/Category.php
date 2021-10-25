<?php

namespace App\Http\Livewire\Product;

use App\Models\Hotels\ProductCategory;
use Livewire\Component;

class Category extends Component
{
    public $curator_check = 'N';
    public $curator;
    public $product_categories;

    public function mount()
    {
        if($this->curator){
            $this->curator_check ='Y';
            /*->curator($curator) 큐레이터 hotel 체크*/
        }else{
            $this->curator_check ='N';
        }
        $this->product_categories = ProductCategory::whereType('products')->orderBy('order')->get();
    }

	public function render()
	{
		return view('livewire.product.category');
	}
}
