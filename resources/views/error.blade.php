<div class="container mt-4">
    @error('email')
    <div class="alert alert-warning" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('password')
    <div class="alert alert-warning" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('error')
    <div class="alert alert-warning" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('success')
    <div class="alert alert-success" role="alert">
        {{ $message }}
    </div>
    @enderror
    
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-warning" role="alert">
        {{ session('error') }}
    </div>
    @endif

    @if(session('message'))
    <div class="alert alert-warning" role="alert">
        {{ session('message') }}
    </div>
    @endif
</div>