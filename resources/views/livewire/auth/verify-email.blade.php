<div class="container bg-black text-white rounded-4 p-3">

    <h1 class="mx-auto">Verify Your Email Address 😉</h1>

    @if(session('success'))
        <p class="alert alert-success text-black"> {{session('success')}} </p>
    @endif


    <p class="mx-auto">
        Before proceeding, please check your email for a verification link.
    </p>

    <p class="mx-auto">
        If you did not receive the email, click the button below to request another.
    </p>

    <button type="button" class="mx-auto btn btn-primary" wire:click="resend">
        resend link
    </button>

    <button type="button" class="mx-auto btn btn-danger" wire:click="logout">
        logout
    </button>
</div>






