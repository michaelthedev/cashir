@if (session('message'))
    <div class="alert alert-success alert-dismissible text-sm p-2 fade show" role="alert">
        <span class="alert-text">{{ session('message') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
