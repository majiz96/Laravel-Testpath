<div class="container-fluid bg-black">
    {{-- Simplicity is the ultimate sophistication. - Leonardo da Vinci --}}

    <div class="row border rounded w-25 mx-auto p-2">
        <div class="col-auto">Hello</div>
        <div class="col-auto text-danger">World</div>

    </div>
    <div class="row border rounded mt-5 mx-auto p-2">



        @auth

            <button class="btn btn-sm btn-success col-auto mx-2 text-white rounded-1" wire:click="toggleOptions">
               User : {{$user->name}}
                {{$option ? '<' : '>'}}
            </button>

            @if($option)
                <a wire:click="logout" class="col-auto mx-2 text-decoration-none nav-link link-danger" style="cursor: pointer">
                    Logout
                </a>
            @endif

            <button class="btn btn-sm btn-primary col-auto mx-2 bg-primary text-white rounded-1" wire:click="showSearch">
                Search
                {{$search ? '<' : '>'}}
            </button>

            @if($search)
                <input type="text" class="col-2">
            @endif

        @endauth

        @guest
                <a href="{{ route('login') }}" wire:click="logout" class="col-auto mx-auto text-decoration-none nav-link link-danger">
                    Login
                </a>

                <a href="{{ route('register') }}" wire:click="logout" class="col-auto mx-auto text-decoration-none nav-link link-danger">
                    Register
                </a>
        @endguest


    </div>

</div>
