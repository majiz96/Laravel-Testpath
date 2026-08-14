<div class="container text-light">

    <div class="row text-center"> <h2> Managing Products </h2> </div>


    <form class="row border rounded" wire:submit="save">

        <div class="row py-2 mx-auto">

            <div class="col-4 mx-auto">
                <div class="row">
                    <label class="col-auto" for="name"> name : </label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="name" wire:model.blur="name">
                        @error('name') <small class="text-danger"> {{$message}} </small> @enderror
                    </div>
                </div>
            </div>


            <div class="col-4 mx-auto">
                <div class="row">
                    <label class="col-auto" for="price"> price : </label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="price" wire:model.blur="price">
                        @error('price') <small class="text-danger"> {{$message}} </small> @enderror
                    </div>
                </div>
            </div>

        </div>

        <div class="row mx-auto py-2">
            <label for="description"> description : </label>
            <textarea class="form-control" name="description" wire:model.blur="description" rows="2"></textarea>
            @error('description') <small class="text-danger"> {{$message}} </small> @enderror
        </div>

        <div class="row mx-auto my-3">
            <button type="submit" class="btn btn-primary mx-auto w-auto {{$editing ? 'col-auto mx-auto' : ''}}">
                {{$editing ? 'Update' : 'Save'}}
            </button>

            @if($editing)
                <button type="button" class="btn btn-danger mx-auto w-auto col-auto mx-auto" wire:click="cancel">
                    Cancel
                </button>
            @endif
        </div>

    </form>


    <div class="row border py-2 px-2 rounded my-5">

        @if(!empty($this->Products))
            <div class="row bg-secondary py-1 rounded text-dark fw-bold mx-auto">

                <div class="col-2 text-center">name</div>

                <div class="col-2 text-center">price</div>

                <div class="col-6 text-center"> description </div>

                <div class="col-1 text-center"> edit </div>

                <div class="col-1 text-center"> delete </div>

            </div>

            @foreach($this->Products as $product)
                <div class="row my-3">

                    <div class="col-2 text-center"> {{$product['name']}} </div>

                    <div class="col-2 text-center text-success">
                        @if($product['price'])
                            {{number_format($product['price'])}} $
                        @else
                            <span> N/A </span>
                        @endif
                    </div>

                    <div class="col-6 text-center">
                        @if($product['description'])
                            {{$product['description']}}
                        @else
                            <span class="text-warning"> Without description </span>
                        @endif

                    </div>

                    <div class="col-1 text-center">
                        <button class="btn btn-sm btn-primary mx-auto" wire:click="edit({{$product['id']}})">
                            edit
                        </button>
                    </div>


                    <div class="col-1 text-center">
                        <button class="btn btn-sm btn-danger mx-auto" wire:click="delete({{$product['id']}})"
                                wire:confirm="Are you sure delete {{$product['name']}} ?">
                            delete
                        </button>
                    </div>


                </div>
            @endforeach

        @else
            <div class="row text-center text-danger my-5">
                <h4> There is no product </h4>
            </div>
        @endif


    </div>

{{--    <button class="btn btn-sm btn-secondary py-0" wire:click="forget">...</button>--}}

</div>
