<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    //variável que representa a contagem de items na navbar
    public $total_count = 0;

    public function mount() {
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
    }

    /*função que é acionada na página de produto
    * em $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
    */
    #[On('update-cart-count')]
    public function updateCartCount($total_count) {
        $this->total_count = $total_count;
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
