@extends('plugin/multivendor::seller.dashboard.layouts.seller_master')
@section('title')
    {{ translate('Shipping Carriers') }}
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/vendor/responsive.bootstrap4.min.css') }}">
    <style>
        .carrier-card {
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            transition: all 0.3s ease;
        }

        .carrier-card:hover {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .carrier-card.active {
            border-color: #1cc88a;
            background-color: #f8f9fc;
        }

        .carrier-logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .pricing-table {
            font-size: 0.875rem;
        }

        .zone-tag {
            display: inline-block;
            background: #e3e6f0;
            padding: 2px 8px;
            border-radius: 12px;
            margin: 2px;
            font-size: 0.75rem;
        }
    </style>
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ translate('Shipping Carriers Management') }}</h4>
                        <div class="d-flex gap-2">
                            <div class="card bg-primary text-white">
                                <div class="card-body p-2">
                                    <small>{{ translate('Total') }}</small>
                                    <div class="h5 mb-0">{{ $stats['total'] }}</div>
                                </div>
                            </div>
                            <div class="card bg-success text-white">
                                <div class="card-body p-2">
                                    <small>{{ translate('Active') }}</small>
                                    <div class="h5 mb-0">{{ $stats['active'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($activeCarrier)
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            {{ translate('Active Carrier') }}: <strong>{{ $activeCarrier->carrier->name }}</strong>
                            <a href="#" class="btn btn-sm btn-outline-primary ml-2"
                                onclick="editCarrier({{ $activeCarrier->carrier_id }})">
                                {{ translate('Edit Settings') }}
                            </a>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ translate('No active carrier found. Please activate a carrier to start shipping.') }}
                        </div>
                    @endif

                    <div class="row">
                        @foreach ($availableCarriers as $carrier)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div
                                    class="carrier-card card h-100 {{ $sellerCarriers->where('carrier_id', $carrier['id'])->where('is_active', true)->count() > 0 ? 'active' : '' }}">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            @if ($carrier['logo'])
                                                <img src="{{ asset($carrier['logo']) }}" alt="{{ $carrier['name'] }}"
                                                    class="carrier-logo mr-3">
                                            @else
                                                <div
                                                    class="carrier-logo bg-light d-flex align-items-center justify-content-center mr-3">
                                                    <i class="fas fa-truck fa-2x text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-1">{{ $carrier['name'] }}</h6>
                                                <small class="text-muted">{{ translate('Available') }}</small>
                                            </div>
                                        </div>

                                        @php
                                            $sellerCarrier = $sellerCarriers
                                                ->where('carrier_id', $carrier['id'])
                                                ->first();
                                        @endphp

                                        @if ($sellerCarrier)
                                            <div class="pricing-table mb-3">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <small class="text-muted">{{ translate('Base Cost') }}</small>
                                                        <div class="font-weight-bold">{{ $sellerCarrier->base_cost }}</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted">{{ translate('Min Cost') }}</small>
                                                        <div class="font-weight-bold">{{ $sellerCarrier->min_cost }}</div>
                                                    </div>
                                                </div>
                                                @if ($sellerCarrier->cost_per_kg > 0)
                                                    <div class="row mt-2">
                                                        <div class="col-12">
                                                            <small class="text-muted">{{ translate('Per KG') }}</small>
                                                            <div class="font-weight-bold">{{ $sellerCarrier->cost_per_kg }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            @if ($sellerCarrier->shipping_zones)
                                                <div class="mb-3">
                                                    <small
                                                        class="text-muted d-block mb-1">{{ translate('Shipping Zones') }}</small>
                                                    @foreach (array_slice($sellerCarrier->shipping_zones, 0, 3) as $zone)
                                                        <span class="zone-tag">{{ $zone }}</span>
                                                    @endforeach
                                                    @if (count($sellerCarrier->shipping_zones) > 3)
                                                        <span
                                                            class="zone-tag">+{{ count($sellerCarrier->shipping_zones) - 3 }}</span>
                                                    @endif
                                                </div>
                                            @endif

                                            <div class="d-flex gap-2">
                                                @if ($sellerCarrier->is_active)
                                                    <button class="btn btn-success btn-sm flex-fill" disabled>
                                                        <i class="fas fa-check"></i> {{ translate('Active') }}
                                                    </button>
                                                    <button class="btn btn-outline-secondary btn-sm"
                                                        onclick="deactivateCarrier({{ $carrier['id'] }})">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-primary btn-sm flex-fill"
                                                        onclick="activateCarrier({{ $carrier['id'] }})">
                                                        <i class="fas fa-plus"></i> {{ translate('Activate') }}
                                                    </button>
                                                    <button class="btn btn-outline-primary btn-sm"
                                                        onclick="editCarrier({{ $carrier['id'] }})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endif
                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="deleteCarrier({{ $carrier['id'] }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <p class="text-muted mb-3">{{ translate('Not configured yet') }}</p>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="activateCarrier({{ $carrier['id'] }})">
                                                    <i class="fas fa-plus"></i> {{ translate('Setup Carrier') }}
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal تفعيل/تعديل شركة الشحن -->
    <div class="modal fade" id="carrierModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carrierModalTitle">{{ translate('Carrier Settings') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="carrierForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="carrier_id" id="carrier_id">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ translate('Base Cost') }} *</label>
                                    <input type="number" name="base_cost" id="base_cost" class="form-control"
                                        step="0.01" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ translate('Minimum Cost') }} *</label>
                                    <input type="number" name="min_cost" id="min_cost" class="form-control"
                                        step="0.01" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ translate('Cost per KG') }}</label>
                                    <input type="number" name="cost_per_kg" id="cost_per_kg" class="form-control"
                                        step="0.01" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ translate('Cost per KM') }}</label>
                                    <input type="number" name="cost_per_km" id="cost_per_km" class="form-control"
                                        step="0.01" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ translate('Maximum Cost') }}</label>
                            <input type="number" name="max_cost" id="max_cost" class="form-control" step="0.01"
                                min="0">
                        </div>

                        <div class="form-group">
                            <label>{{ translate('API Credentials (Optional)') }}</label>
                            <textarea name="api_credentials" id="api_credentials" class="form-control" rows="3"
                                placeholder="{{ translate('Enter API credentials in JSON format') }}"></textarea>
                        </div>

                        <div class="form-group">
                            <label>{{ translate('Shipping Zones') }}</label>
                            <select name="shipping_zones[]" id="shipping_zones" class="form-control" multiple>
                                <option value="local">{{ translate('Local') }}</option>
                                <option value="national">{{ translate('National') }}</option>
                                <option value="international">{{ translate('International') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{ translate('Excluded Zones') }}</label>
                            <select name="excluded_zones[]" id="excluded_zones" class="form-control" multiple>
                                <option value="remote">{{ translate('Remote Areas') }}</option>
                                <option value="islands">{{ translate('Islands') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ translate('Save Settings') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal اختبار API -->
    <div class="modal fade" id="apiTestModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ translate('Test API Connection') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ translate('API Credentials') }}</label>
                        <textarea id="test_api_credentials" class="form-control" rows="4"
                            placeholder="{{ translate('Enter API credentials to test') }}"></textarea>
                    </div>
                    <div id="apiTestResult" class="mt-3"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ translate('Close') }}</button>
                    <button type="button" class="btn btn-primary"
                        onclick="testApiConnection()">{{ translate('Test Connection') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="{{ asset('public/backend/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/vendor/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        function activateCarrier(carrierId) {
            $('#carrier_id').val(carrierId);
            $('#carrierModalTitle').text('{{ translate('Activate Carrier') }}');
            $('#carrierForm').attr('action',
                '{{ route('plugin.multivendor.seller.dashboard.shipping.carriers.activate') }}');
            $('#carrierModal').modal('show');
        }

        function editCarrier(carrierId) {
            $('#carrier_id').val(carrierId);
            $('#carrierModalTitle').text('{{ translate('Edit Carrier Settings') }}');
            $('#carrierForm').attr('action',
            '{{ route('plugin.multivendor.seller.dashboard.shipping.carriers.update') }}');

            // تحميل بيانات الشركة
            $.post('{{ route('plugin.multivendor.seller.dashboard.shipping.carriers.info') }}', {
                carrier_id: carrierId,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.success) {
                    const data = response.data;
                    $('#base_cost').val(data.base_cost);
                    $('#cost_per_kg').val(data.cost_per_kg);
                    $('#cost_per_km').val(data.cost_per_km);
                    $('#min_cost').val(data.min_cost);
                    $('#max_cost').val(data.max_cost);
                    $('#api_credentials').val(data.api_credentials);

                    // تعيين المناطق
                    if (data.shipping_zones) {
                        $('#shipping_zones').val(data.shipping_zones);
                    }
                    if (data.excluded_zones) {
                        $('#excluded_zones').val(data.excluded_zones);
                    }
                }
            });

            $('#carrierModal').modal('show');
        }

        function deactivateCarrier(carrierId) {
            if (confirm('{{ translate('Are you sure you want to deactivate this carrier?') }}')) {
                $.post('{{ route('plugin.multivendor.seller.dashboard.shipping.carriers.deactivate') }}', {
                    carrier_id: carrierId,
                    _token: '{{ csrf_token() }}'
                }, function(response) {
                    location.reload();
                });
            }
        }

        function deleteCarrier(carrierId) {
            if (confirm(
                '{{ translate('Are you sure you want to delete this carrier? This action cannot be undone.') }}')) {
                $.post('{{ route('plugin.multivendor.seller.dashboard.shipping.carriers.delete') }}', {
                    carrier_id: carrierId,
                    _token: '{{ csrf_token() }}'
                }, function(response) {
                    location.reload();
                });
            }
        }

        function testApiConnection() {
            const credentials = $('#test_api_credentials').val();
            const carrierId = $('#carrier_id').val();

            if (!credentials) {
                alert('{{ translate('Please enter API credentials') }}');
                return;
            }

            $.post('{{ route('plugin.multivendor.seller.dashboard.shipping.carriers.test-api') }}', {
                carrier_id: carrierId,
                api_credentials: credentials,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.success) {
                    $('#apiTestResult').html('<div class="alert alert-success">' + response.message + '</div>');
                } else {
                    $('#apiTestResult').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            });
        }

        // حساب تكلفة الشحن
        function calculateShippingCost() {
            const weight = $('#weight').val();
            const distance = $('#distance').val();
            const zone = $('#zone').val();

            if (!weight) {
                alert('{{ translate('Please enter weight') }}');
                return;
            }

            $.post('{{ route('plugin.multivendor.seller.dashboard.shipping.carriers.calculate') }}', {
                weight: weight,
                distance: distance,
                zone: zone,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.success) {
                    $('#shippingCost').text(response.cost + ' ' + response.currency);
                } else {
                    $('#shippingCost').text('{{ translate('Error calculating cost') }}');
                }
            });
        }
    </script>
@endsection
