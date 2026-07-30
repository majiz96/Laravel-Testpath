<form wire:submit="register" class="text-white">

    <div class="mb-3">
        <label>Name</label>

        <input type="text" class="form-control" wire:model="name"
               placeholder="Please enter you're name address here">

        @error('name') <small class="text-danger" dir="ltr">{{$message}}</small> @enderror
    </div>
    <div class="mb-3">
        <label>Email</label>

        <input type="email" class="form-control" wire:model="email"
               placeholder="Please enter you're email address here">

        @error('email') <small class="text-danger" dir="ltr">{{$message}}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Password</label>

        <input type="password" class="form-control" wire:model="password"
               placeholder="Please enter you're password here">

        @error('password') <small class="text-danger" dir="ltr">{{$message}}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Confirm Password</label>

        <input type="password" class="form-control" wire:model="password_confirmation"
               placeholder="Please repeat you're password here">

        @error('password_confirmation') <small class="text-danger" dir="ltr">{{$message}}</small> @enderror
    </div>



    <button class="btn btn-primary">
        Login
    </button>

</form>
