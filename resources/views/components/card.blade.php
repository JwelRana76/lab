<div class="card">
    <div class="card-header">
        <h3>{{ $header }} <a href="{{ $link }}" class="btn btn-primary float-right btn-sm">{{ $title }}</a></h3>
        <p class="text-danger m-0">All * marks field must be fillable.</p>
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>