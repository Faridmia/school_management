@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>WooCommerce Checkout Settings</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-8">

                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Checkout & Shipping Options</h3>
                    </div>

                    @include('admin.layouts._message')

                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="card-body">

                            <!-- Guest Checkout -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Guest Checkout</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="guest_checkout" id="guest_checkout_yes" value="yes" {{ $guest_checkout === 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="guest_checkout_yes">
                                        Allow customers to place orders without an account
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="guest_checkout" id="guest_checkout_no" value="no" {{ $guest_checkout === 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="guest_checkout_no">
                                        Require customers to be logged in to checkout
                                    </label>
                                </div>
                                <small class="text-muted">Controls whether users can checkout as a guest or must have an account.</small>
                            </div>

                            <hr>

                            <!-- Account Creation -->
                            <div class="mb-4 text-start">
                                <label class="form-label fw-bold">Account Creation</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="account_creation" id="account_creation_yes" value="yes" {{ $account_creation === 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="account_creation_yes">
                                        Allow customers to create an account during checkout
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="account_creation" id="account_creation_no" value="no" {{ $account_creation === 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="account_creation_no">
                                        Disable account creation during checkout
                                    </label>
                                </div>
                                <small class="text-muted">Controls whether a password input is shown during checkout to create an account.</small>
                            </div>

                            <hr>

                            <!-- Shipping Destination (WooCommerce Style) -->
                            <div class="mb-4 text-start">
                                <label class="form-label fw-bold">Shipping Destination</label>
                                <select name="shipping_destination" class="form-select">
                                    <option value="billing_default" {{ $shipping_destination === 'billing_default' ? 'selected' : '' }}>
                                        Default to customer billing address
                                    </option>
                                    <option value="shipping_default" {{ $shipping_destination === 'shipping_default' ? 'selected' : '' }}>
                                        Default to customer shipping address
                                    </option>
                                    <option value="billing_only" {{ $shipping_destination === 'billing_only' ? 'selected' : '' }}>
                                        Force shipping to the customer billing address
                                    </option>
                                </select>
                                <small class="text-muted">
                                    - <strong>Default to billing address</strong>: Toggles "Ship to different address" off by default.
                                    <br>- <strong>Default to shipping address</strong>: Toggles "Ship to different address" on by default.
                                    <br>- <strong>Force shipping to billing address</strong>: Completely hides the "Ship to different address" option and uses the billing address for shipping rate calculation.
                                </small>
                            </div>

                            <hr>

                            <!-- Tax / VAT Settings -->
                            <div class="mb-4 text-start">
                                <h4 class="fw-bold mb-3">Tax & VAT Settings</h4>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Tax Status</label>
                                        <select name="tax_status" class="form-select">
                                            <option value="yes" {{ $tax_status === 'yes' ? 'selected' : '' }}>Enabled</option>
                                            <option value="no" {{ $tax_status === 'no' ? 'selected' : '' }}>Disabled</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Tax / VAT Percentage (%)</label>
                                        <input type="number" step="0.01" name="tax_percentage" value="{{ $tax_percentage }}" class="form-control" placeholder="e.g. 15">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Tax Type</label>
                                        <select name="tax_type" class="form-select">
                                            <option value="exclusive" {{ $tax_type === 'exclusive' ? 'selected' : '' }}>Exclusive (Add to subtotal)</option>
                                            <option value="inclusive" {{ $tax_type === 'inclusive' ? 'selected' : '' }}>Inclusive (Already in price)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- SMS Gateway Settings -->
                            <div class="mb-4 text-start">
                                <h4 class="fw-bold mb-3">SMS Gateway Settings</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">SMS Status</label>
                                        <select name="sms_status" class="form-select">
                                            <option value="yes" {{ ($sms_status ?? 'no') === 'yes' ? 'selected' : '' }}>Enabled</option>
                                            <option value="no" {{ ($sms_status ?? 'no') === 'no' ? 'selected' : '' }}>Disabled</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">SMS Gateway Provider</label>
                                        <select name="sms_gateway" class="form-select">
                                            <option value="twilio" {{ ($sms_gateway ?? 'twilio') === 'twilio' ? 'selected' : '' }}>Twilio (Global)</option>
                                            <option value="bulksmsbd" {{ ($sms_gateway ?? '') === 'bulksmsbd' ? 'selected' : '' }}>BulkSMS BD / GTSMS (Bangladesh)</option>
                                            <option value="greenweb" {{ ($sms_gateway ?? '') === 'greenweb' ? 'selected' : '' }}>Greenweb SMS (Bangladesh)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">API Key / Token / Auth Token</label>
                                        <input type="password" name="sms_api_key" value="{{ $sms_api_key ?? '' }}" class="form-control" placeholder="API Secret Key">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Username / Account SID</label>
                                        <input type="text" name="sms_username_or_sid" value="{{ $sms_username_or_sid ?? '' }}" class="form-control" placeholder="Account SID or Username">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Sender ID / From Number / Mask</label>
                                        <input type="text" name="sms_sender_id" value="{{ $sms_sender_id ?? '' }}" class="form-control" placeholder="e.g. +123456789 or Sender ID">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Save Settings
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection
