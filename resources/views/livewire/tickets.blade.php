<div class="container text-center text-light">
    <h1> Ticket Check </h1>
    <h3 class="text-danger"> </h3>

    <div class="row">
        <form class="col-5 my-5 border" wire:submit="save">

            <div class="row my-3">

                <label for="id" class="col-4"> User </label>

                <select class="col-4 py-2" wire:model.blur="user">
                        <option value=""> Choose User </option>
                    @forelse($users as $user)
                        <option value="{{$user->id}}"> {{$user->name}} </option>
                    @empty
                        <option value="" class="bg-danger"> There is no user </option>
                    @endforelse

                </select>

                <div class="col-auto">@error('user') <small class="text-danger"> {{$message}} </small> @enderror</div>
            </div>

            <div class="row my-3">
                <label for="chair" class="col-4"> chair number </label>
                <div class="col-4">
                    <input type="number" class="form-control" wire:model.blur="chair">
                </div>
                <div class="col-auto">@error('chair') <small class="text-danger"> {{$message}} </small> @enderror</div>
            </div>

            <div class="row my-3">
                <label for="type" class="col-4"> Ticket type </label>
                <select name="type" class="col-4 py-2" wire:model.blur="type">
                    <option value=""> Type of ticket </option>

                    @if($types)
                        @foreach($types as $type)
                            <option value="{{$type->name}}"> {{$type->value}}</option>
                        @endforeach
                    @endif

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

                @if($editing)
                    <button type="submit" class="col-2 mx-auto w-4 btn btn-primary">update</button>
                    <button type="button" class="col-2 mx-auto w-4 btn btn-warning" wire:click="cancel">cancel</button>
                @else
                    <button type="submit" class="col-2 mx-auto w-4 btn btn-primary">save</button>
                @endif


            </div>


        </form>


        <div class="col-7 my-5 border px-0">

            @if($tickets->isNotEmpty())

                <div class="row mx-auto bg-white text-dark fw-bold py-1">
                    <div class="col-2">user name</div>
                    <div class="col-2">chair</div>
                    <div class="col-2">type</div>
                    <div class="col-2">duration</div>
                    <div class="col-2">del</div>
                    <div class="col-2">upd</div>
                </div>

            @foreach($tickets as $ticket)
                    <div class="row my-2 py-1 mx-auto border">
                        <div class="col-2">{{$ticket->user->id}}</div>
                        <div class="col-2">{{$ticket->chair}}</div>
                        <div class="col-2">{{$ticket->type}}</div>
                        <div class="col-2">{{$ticket->duration}} hour</div>

                        <div class="col-2">
                            <button class="btn btn-sm btn-primary" wire:click="edit({{$ticket->id}})">
                                edit
                            </button>
                        </div>

                        <div class="col-2">
                            <button class="btn btn-sm btn-danger" wire:click="delete({{$ticket->id}})" wire:confirm="Are you sure delete ({{$ticket->user->name}}) ticket">
                                delete
                            </button>
                        </div>

                    </div>
            @endforeach




            @else
                <div class="row my-auto mx-auto text-center text-danger d-flex">
                    <h2 class="mx-auto my-auto">There is no ticket</h2>
                </div>
            @endif




        </div>

    </div>



</div>
