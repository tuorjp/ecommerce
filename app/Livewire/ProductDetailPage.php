<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail - Ecommerce Project')]
class ProductDetailPage extends Component
{
    public $slug;

    //passa o slug da url para o atributo slug da classe
    public function mount($slug) {
        $this->slug = $slug;
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}