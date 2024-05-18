<x-dashboard.page title="Make a payment">

    <div class="row">
        <div class="col-12 col-xl-5 mb-4">
            <div class="card border shadow-xs h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0 font-weight-semibold text-lg">Make a Payment</h6>
                    <p class="text-sm mb-1"></p>
                </div>
                <div class="card-body p-3">
                    @if(config('app.env') == 'local')
                        <div class="alert alert-info text-dark text-sm" role="alert">
                            Payment is on test environment, there won't be any debit
                        </div>
                    @endif

                    <x-error-message />
                    <x-success-message />

                    <form action="{{ route('dashboard.payments.create') }}" method="POST">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" class="form-control" name="amount" placeholder="Amount to pay" required/>
                        </div>

                        @csrf
                        <button type="submit" class="btn btn-dark btn-lg w-100">Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   {{-- <div class="form-group">
        <label>Payment Gateway</label>
        <ul class="list-group">
            <li class="list-group-item border-info d-flex justify-content-between mb-3 border-radius-md shadow-xs p-3">
                <div class="d-flex align-items-start">
                    <div class="icon icon-shape icon-sm bg-info text-white shadow-none text-center  border-radius-sm me-sm-2 me-3 mt-1 px-2 d-flex align-items-center justify-content-center">
                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="d-flex flex-column">
                        <h6 class="mb-0 text-sm text-info">Free Plan $0/month</h6>
                        <span class="text-sm text-info">Includes 1 user, 10GB individual data and access to all features.</span>
                    </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient">
                    <div class="form-check">
                        <input type="radio" id="radio3" name="radioDisabled" class="form-check-input form-check-input-info" checked="">
                    </div>
                </div>
            </li>
            @foreach(\App\Models\PaymentGateway::all() as $gateway)
                <li class="list-group-item border d-flex justify-content-between mb-3 border-radius-md shadow-xs p-3">
                    <div class="d-flex align-items-start">
                        <div class="icon icon-shape icon-sm bg-dark text-white shadow-none text-center  border-radius-sm me-sm-2 me-3 mt-1 px-2 d-flex align-items-center justify-content-center">
                            <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z"></path>
                            </svg>
                        </div>
                        <div class="d-flex flex-column">
                            <h6 class="mb-0 text-sm">Freelancer Plan $30/month</h6>
                            <span class="text-sm">Includes up to 10 users, 20GB individual data and access to all features.</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-danger text-gradient">
                        <div class="form-check">
                            <input type="radio" id="radio3" name="radioDisabled" class="form-check-input form-check-input-info">
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>--}}
</x-dashboard.page>
