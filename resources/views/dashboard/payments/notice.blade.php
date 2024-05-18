<x-dashboard.page title="Make a payment">

    <div class="row">
        <div class="col-12 col-xl-5 mb-4">
            <div class="card border shadow-xs h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0 font-weight-semibold text-lg">Make a Payment</h6>
                    <p class="text-sm mb-1"></p>
                </div>
                <div class="card-body p-3">
                    <x-success-message />

                    <p>You will be redirected to checkout...</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('url'))
    <script>
        setTimeout(() => {
            window.location.href = "{{ session('url') }}"
        }, 2000);
    </script>
    @endif
</x-dashboard.page>
