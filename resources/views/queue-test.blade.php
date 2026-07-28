<!DOCTYPE html>
<html>
<head>
    <title>Queue Test</title>
</head>
<body bgcolor="{{ session('color', 'black') }}">

@if(session('success'))
    <p style="background: white">{{ session('success') }}</p>
@endif

<form method="POST">
    @csrf

    <input
        type="text"
        name="name"
        placeholder="Your name">

    <button type="submit">
        Send Job
    </button>

</form>


</body>
</html>
