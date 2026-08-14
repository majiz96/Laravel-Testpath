<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class TestObject
{
    public string $name = 'Majid';
    public int $age = 29;
}

class Products extends Component
{
//    use WithPagination;
//    protected $paginationTheme = 'bootstrap';

    #[Validate('required|string|min:3')]
    public $name;

    #[Validate('nullable|numeric')]
    public $price;
    #[Validate('nullable|string|max:1000')]
    public $description;

    public $editing = false;

//    public $search = '';
//    public $perPage = 5;
//    public $orderBy = 'id';
//    public $direction = 'asc';

    public function mount()
    {
//        Cache::forget('test-products');
//
//        $products = Product::all()->toArray();
//
//        Cache::put('test-products', $products, 60);
//
//        $data = Cache::get('test-products');
//
//        dd($data);
    }

    public function save()
    {

        if ($this->editing)
        {
            $this->validate();

            $data = ['name' => $this->name,'price' => $this->price ?: null, 'description' => $this->description];

            Product::findOrFail($this->editing)->update($data);

            $this->reset(['editing','name','price','description']);
        }
        else
        {
            $this->validate();

            $data = ['name' => $this->name,'price' => $this->price ?: null, 'description' => $this->description];

            Product::create($data);

            $this->reset();
        }

        Cache::forget('all-products');

    }

    public function edit(Product $product)
    {
        $this->editing = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
    }

    public function cancel()
    {
        $this->editing = false;
        $this->reset();
    }

    public function delete(Product $product)
    {
        $product->delete();

        Cache::forget('all-products');
    }

    #[Computed]
    public function Products()
    {
        $product = Cache::remember('all-products', 600, function () {
            return Product::all()->toArray();
        });


        return $product;
    }

    public function forget()
    {
        Cache::forget('all-products');
    }


    public function render()
    {
        return view('livewire.dashboard.products');
    }
}
