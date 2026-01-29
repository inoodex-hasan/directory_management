@extends('layouts.master')

@section('title', 'Select a Plan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pricing</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Pricing</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Upgrade Your Account</h2>
            <p class="section-lead">Choose a plan that fits your needs. Premium members get instant approval!</p>

            <div class="row">
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing">
                        <div class="pricing-title">Free</div>
                        <div class="pricing-padding">
                            <div class="pricing-price">
                                <div>$0</div>
                                <div>per month</div>
                            </div>
                            <div class="pricing-details">
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div> 3 Link Submissions
                                </div>
                                <div class="pricing-item">
                                    <div class="pricing-item-icon bg-danger text-white"><i class="fas fa-times"></i></div>
                                    Manual Admin Review
                                </div>
                                <div class="pricing-item">
                                    <div class="pricing-item-icon bg-danger text-white"><i class="fas fa-times"></i></div>
                                    Priority Support
                                </div>
                            </div>
                        </div>
                        <div class="pricing-cta">
                            <a href="#" class="btn btn-secondary disabled">Current Plan <i
                                    class="fas fa-check"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing pricing-highlight">
                        <div class="pricing-title">Premium</div>
                        <div class="pricing-padding">
                            <div class="pricing-price">
                                <div>$19</div>
                                <div>per month</div>
                            </div>
                            <div class="pricing-details">
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <strong>Unlimited</strong> Submissions
                                </div>
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <strong>Instant</strong> Approval
                                </div>
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div> Priority Support
                                </div>
                            </div>
                        </div>
                        <div class="pricing-cta">
                            <div id="paypal-button-container" style="padding: 10px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing">
                        <div class="pricing-title">Agency</div>
                        <div class="pricing-padding">
                            <div class="pricing-price">
                                <div>$49</div>
                                <div>per month</div>
                            </div>
                            <div class="pricing-details">
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div> All Premium Features
                                </div>
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div> Featured Badge on
                                    Links
                                </div>
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div> 24/7 Phone Support
                                </div>
                            </div>
                        </div>
                        <div class="pricing-cta">
                            <a href="#" class="btn btn-primary">Contact Sales <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=USD"></script>

    <script>
        paypal.Buttons({
            createOrder: function() {
                return fetch("{{ route('paypal.create') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(res => res.json())
                    .then(data => data.id);
            },
            onApprove: function(data) {
                return fetch("{{ route('paypal.capture') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            orderID: data.orderID
                        })
                    })
                    .then(res => res.json())
                    .then(details => {
                        if (details.status === 'success') {
                            location.href = "{{ route('links.index') }}";
                        }
                    });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
