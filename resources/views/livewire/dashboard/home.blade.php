<div class="container rounded-4 py-2 px-3 bg-black">
    {{-- Simplicity is the ultimate sophistication. - Leonardo da Vinci --}}

    <div class="row border rounded-4 my-5 mx-auto p-2">

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

            <div class="col-auto text-success fw-bold">
                {{$stats}}
            </div>

        @endauth

        @guest
                <a href="{{ route('login') }}" wire:click="logout" class="col-auto mx-auto text-decoration-none nav-link link-danger">
                    Login
                </a>

                <a href="{{ route('register') }}" wire:click="logout" class="col-auto mx-auto text-decoration-none nav-link link-danger">
                    Register
                </a>
        @endguest

        <div class="row my-5 mx-auto">

            <button type="button" class="btn btn-primary w-auto" wire:click="sayWelcome">
                say welcome
            </button>

            <button type="button" class="btn btn-warning w-auto mx-3" wire:click="sayWelcomeLater">
                say welcome later
            </button>

        </div>

            <form class="row my-3 mx-auto" wire:submit.prevent="sayWelcomeTo">

                <label for="address" class="col-auto text-light">Send To</label>

                <div class="col-3">
                    <input type="email" name="address" class="form-control" placeholder="destination..." wire:model="destination">
                </div>

                <button type="submit" class="btn btn-info w-auto mx-3">
                    say welcome to ...
                </button>

            </form>

        <div class="row my-5 mx-auto text-light">

            <h3>Messages</h3>

            @if($unread->isNotEmpty())
                @foreach($unread as $notification)

                    <div class="row p-2 my-2 mx-auto border rounded d-flex">
                        <div class="col-auto">{{ $notification->data['message']}}</div>
                        <div class="col-auto flex-fill"></div>

                        <div class="col-auto">
                            <button class="btn btn-sm btn-success" wire:click="markAsRead('{{$notification->id}}')"> read </button>
                        </div>

                    </div>

                @endforeach
            @else
                <span class="text-danger"> No messages </span>
            @endif

            <span>
                Unread: {{ $unread->count() }}
            </span>

        </div>


    </div>

</div>
