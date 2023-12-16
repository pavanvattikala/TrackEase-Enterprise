@if (session('success'))
<div class="alert alert-success">
    <ul>
        <li>{{ session('success') }}</li>
    </ul>
</div>
    
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif