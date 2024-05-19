<x-dashboard.page title="Settings">
    <div class="row">
        <div class="col-12 col-xl-4 mb-4">
            <div class="card border shadow-xs h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0 font-weight-semibold text-lg">Payment settings</h6>
                    <p class="text-sm mb-1">Select payment providers</p>
                </div>
                <div class="card-body p-3">
                    <x-error-message />
                    <x-success-message />

                    <form action="{{ route('dashboard.settings.update') }}" method="POST">
                        <div class="form-group">
                            <label>Minimum Amount</label>
                            <input type="number" class="form-control" name="settings[payment_min_amount]" value="{{ $settings['payment_min_amount'] }}" required/>
                        </div>

                        <div class="form-group">
                            <label>Payment Gateway</label>
                            <select class="form-control form-select" name="settings[payment_gateway]" required>
                                <option>Select One</option>
                                @foreach(\App\Models\PaymentGateway::all() as $gateway)
                                    <option value="{{ $gateway->id }}" {{ $settings['payment_gateway'] == $gateway->id ? 'selected' : '' }}>{{ $gateway->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="group" value="{{ $group }}">
                        <button type="submit" class="btn btn-dark btn-lg w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.page>
