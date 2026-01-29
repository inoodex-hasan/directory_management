@extends('layouts.master')
@section('content')
    <section class="section">

        {{-- Section Header --}}
        <div class="section-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h1 class="mb-0">Dashboard</h1>
            </div>
        </div>

        @if (auth()->user()->isAdmin() == 0)
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary"><i class="fas fa-link"></i></div>
                        <a href="{{ route('links.index') }}" style="text-decoration: none;">
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4 class="text-primary">My Links</h4>
                                </div>
                                <div class="card-body" style="color: #6777ef;">{{ $myLinksCount }}</div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning"><i class="fas fa-clock"></i></div>
                        <a href="{{ route('links.index', ['status' => 'pending']) }}" style="text-decoration: none;">
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4 class="text-warning">My Pending</h4>
                                </div>
                                <div class="card-body" style="color: #ffa426;">{{ $myPendingCount }}</div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success"><i class="fas fa-plus"></i></div>
                        <a href="{{ route('links.create') }}" style="text-decoration: none;">
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4 class="text-success">Submit New Link</h4>
                                </div>
                                <div class="card-body" style="color: #47c363;">+</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if (auth()->user()->isAdmin() == 1)
            <div class="col-md-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pending List</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.links.pending') }}" style="text-decoration: none; color: inherit;">
                                {{ $adminStats['total_pending_all'] }}
                                <small class="text-muted" style="font-size: 12px; display: block;">View All <i
                                        class="fas fa-chevron-right"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        </div>

    </section>
@endsection
