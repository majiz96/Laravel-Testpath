<div class="container text-center text-light">
    <h1> Ticket Check </h1>
    <h3 class="text-danger"> </h3>

    <div class="row">
        <form class="col-5 my-5 border" wire:submit="save">

            <div class="row my-3">
                <label for="id" class="col-4"> ID </label>
                <div class="col-4">
                    <input type="number" class="form-control" name="id" wire:model.blur="id">
                </div>
                <div class="col-auto">@error('id') <small class="text-danger"> {{$message}} </small> @enderror</div>
            </div>

            <div class="row my-3">
                <label for="chair" class="col-4"> chair number </label>
                <div class="col-4">
                    <input type="number" class="form-control" name="chair" wire:model.blur="chair">
                </div>
                <div class="col-auto">@error('chair') <small class="text-danger"> {{$message}} </small> @enderror</div>
            </div>

            <div class="row my-3">
                <select class="col-4 mx-auto"wire:model.blur="type">
                    <option value=""> Type of ticket </option>
                </select>
                <div class="col-auto">@error('type') <small class="text-danger"> {{$message}} </small> @enderror</div>
            </div>


            <div class="row my-3">
                <label for="duration" class="col-4"> duration </label>
                <div class="col-4">
                    <input type="number" class="form-control" name="duration" wire:model.blur="duration">
                </div>
                <label for="duration" class="col-4"> hour </label>
                <div class="col-auto">@error('duration') <small class="text-danger"> {{$message}} </small> @enderror</div>
            </div>


            <div class="row my-3">
                <button type="submit" class="col-2 mx-auto w-4 btn btn-primary">save</button>
            </div>


        </form>


        <div class="col-7 my-5 border d-flex">

            @if($this->Tickets)

                <div class="row my-auto mx-auto border">
                    <div class="col-2">user name</div>
                    <div class="col-2">chair</div>
                    <div class="col-2">type</div>
                    <div class="col-2">duration</div>
                    <div class="col-2">del</div>
                    <div class="col-2">upd</div>
                </div>


            @else
                <div class="row my-auto mx-auto text-center text-danger">
                    <h2 class="mx-auto my-auto">There is no ticket</h2>
                </div>
            @endif




        </div>

    </div>



</div>
