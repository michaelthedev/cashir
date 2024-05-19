<x-dashboard-layout>
    <x-dashboard.navbar />

    <div class="container-fluid py-4 px-4" style="min-height: 80vh">
        <div class="row">
            <div class="col-md-12">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="font-weight-bold mb-0">{{ $title }}</h3>
                        <ol class="breadcrumb bg-transparent pb-0 mb-0 pt-1 px-0">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </div>
                    <div class="d-flex">
                        <button type="button"
                                class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 me-2">
                            <span class="btn-inner--icon">
                                <span class="p-1 bg-success rounded-circle d-flex ms-auto me-2">
                                    <span class="visually-hidden">New</span>
                                </span>
                            </span>
                            <span class="btn-inner--text">Messages</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0">
                            <span class="btn-inner--icon">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-block me-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                            </span>
                            <span class="btn-inner--text">Sync</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-1 mb-3">

        {{ $slot }}

    </div>

    <x-dashboard.footer />
</x-dashboard-layout>
