<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail - Ecommerce Project')]
class ProductDetailPage extends Component
{
    use LivewireAlert;
    public $slug;

    public $quantity = 1;

    //passa o slug da url para o atributo slug da classe
    public function mount($slug) {
        $this->slug = $slug;
    }

    public function increaseQty() {
        $this->quantity++;
    }

    public function decreaseQty() {
       if ($this->quantity > 1) {
            $this->quantity--;
       }
    }

    public function addToCart($product_id) {
        //dd($product_id); mostra o id na tela, só para ver como os dados estão chegando
        $total_count = CartManagement::addItemToCart($product_id);

        //cria um evento para atualizar a contagem de items no icone de carrinho
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Product added to cart!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}