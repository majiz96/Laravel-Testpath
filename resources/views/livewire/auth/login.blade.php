<form wire:submit="login" class="text-white">

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

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="remember"
            wire:model="remember">

        <label class="form-check-label" for="remember">
            Remember Me
        </label>
    </div>

    <button class="btn btn-primary">
        Login
    </button>

</form>
