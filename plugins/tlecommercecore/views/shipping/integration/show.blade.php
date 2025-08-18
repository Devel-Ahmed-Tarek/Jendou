@extends('plugin/tlecommercecore::layouts.master')
@section('title')
    {{ translate('Shipment Details') }}
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ translate('Shipment Details') }}</h4>
                        <a href="{{ route('plugin.tlcommercecore.shipping.integration.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> {{ translate('Back to List') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>{{ translate('Order Information') }}</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>{{ translate('Order Code') }}:</strong></td>
                                    <td>
                                        <a href="{{ route('plugin.tlcommercecore.orders.details', $shipment->order_id) }}">
                                            {{ $shipment->order->order_code ?? 'N/A' }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>{{ translate('Order Date') }}:</strong></td>
                                    <td>{{ $shipment->order->created_at->format('Y-m-d H:i:s') ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ translate('Customer') }}:</strong></td>
                                    <td>{{ $shipment->order->customer_info->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ translate('Product') }}:</strong></td>
                                    <td>{{ $shipment->orderProduct->product_details->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ translate('Quantity') }}:</strong></td>
                                    <td>{{ $shipment->orderProduct->quantity ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>{{ translate('Shipping Information') }}</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>{{ translate('Carrier') }}:</strong></td>
                                    <td>{{ $shipment->carrier_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ translate('Tracking Number') }}:</strong></td>
                                    <td>
                                        @if($shipment->tracking_number)
                                            <span class="badge bg-info">{{ $shipment->tracking_number }}</span>
                                        @else
                                            <span class="text-muted">{{ translate('N/A') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>{{ translate('Status') }}:</strong></td>
                                    <td>
                                        @if($shipment->status === 'success')
                                            <span class="badge bg-success">{{ translate('Success') }}</span>
                                        @elseif($shipment->status === 'failed')
                                            <span class="badge bg-danger">{{ translate('Failed') }}</span>
                                        @else
                                            <span class="badge bg-warning">{{ translate('Pending') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>{{ translate('Created At') }}:</strong></td>
                                    <td>{{ $shipment->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ translate('Updated At') }}:</strong></td>
                                    <td>{{ $shipment->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($shipment->shipping_address)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>{{ translate('Shipping Address') }}</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <p><strong>{{ translate('Name') }}:</strong> {{ $shipment->order->shipping_details->name ?? 'N/A' }}</p>
                                        <p><strong>{{ translate('Phone') }}:</strong> {{ $shipment->order->shipping_details->phone ?? 'N/A' }}</p>
                                        <p><strong>{{ translate('Email') }}:</strong> {{ $shipment->order->shipping_details->email ?? 'N/A' }}</p>
                                        <p><strong>{{ translate('Address') }}:</strong> {{ $shipment->order->shipping_details->address ?? 'N/A' }}</p>
                                        <p><strong>{{ translate('City') }}:</strong> {{ $shipment->order->shipping_details->city ?? 'N/A' }}</p>
                                        <p><strong>{{ translate('State') }}:</strong> {{ $shipment->order->shipping_details->state ?? 'N/A' }}</p>
                                        <p><strong>{{ translate('Country') }}:</strong> {{ $shipment->order->shipping_details->country ?? 'N/A' }}</p>
                                        <p><strong>{{ translate('Postal Code') }}:</strong> {{ $shipment->order->shipping_details->postal_code ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($shipment->api_response)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>{{ translate('API Response') }}</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <pre class="bg-light p-3 rounded">{{ json_encode($shipment->api_response, JSON_PRETTY_PRINT) }}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>{{ translate('Actions') }}</h5>
                            <div class="d-flex gap-2">
                                @if($shipment->tracking_number)
                                    <a href="{{ route('plugin.tlcommercecore.shipping.integration.print') }}?tracking_number={{ $shipment->tracking_number }}" 
                                       class="btn btn-primary" target="_blank">
                                        <i class="fas fa-print"></i> {{ translate('Print Label') }}
                                    </a>
                                    
                                    <button class="btn btn-info track-shipment" data-tracking="{{ $shipment->tracking_number }}">
                                        <i class="fas fa-search"></i> {{ translate('Track Shipment') }}
                                    </button>
                                    
                                    <form action="{{ route('plugin.tlcommercecore.shipping.integration.cancel') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="tracking_number" value="{{ $shipment->tracking_number }}">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('{{ translate('Are you sure you want to cancel this shipment?') }}')">
                                            <i class="fas fa-times"></i> {{ translate('Cancel Shipment') }}
                                        </button>
                                    </form>
                                @endif
                                
                                @if($shipment->status === 'failed')
                                    <form action="{{ route('plugin.tlcommercecore.shipping.integration.retry', $shipment->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-redo"></i> {{ translate('Retry Shipment') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tracking Modal -->
    <div class="modal fade" id="trackingModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ translate('Shipment Tracking') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="tracking-content">
                    <!-- Tracking content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_scripts')
    <script>
        $(document).ready(function() {
            // Track shipment
            $('.track-shipment').click(function() {
                var trackingNumber = $(this).data('tracking');
                var modal = $('#trackingModal');
                var content = $('#tracking-content');
                
                content.html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> {{ translate("Loading...") }}</div>');
                modal.modal('show');
                
                $.ajax({
                    url: '{{ route("plugin.tlcommercecore.shipping.integration.track") }}',
                    method: 'POST',
                    data: {
                        tracking_number: trackingNumber,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            content.html(formatTrackingData(response.data));
                        } else {
                            content.html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function() {
                        content.html('<div class="alert alert-danger">{{ translate("An error occurred while tracking shipment") }}</div>');
                    }
                });
            });

            function formatTrackingData(data) {
                var html = '<div class="tracking-info">';
                html += '<h6>{{ translate("Tracking Information") }}</h6>';
                html += '<div class="table-responsive">';
                html += '<table class="table table-sm">';
                html += '<tr><td><strong>{{ translate("Status") }}:</strong></td><td>' + (data.status || 'N/A') + '</td></tr>';
                html += '<tr><td><strong>{{ translate("Location") }}:</strong></td><td>' + (data.location || 'N/A') + '</td></tr>';
                html += '<tr><td><strong>{{ translate("Last Update") }}:</strong></td><td>' + (data.last_update || 'N/A') + '</td></tr>';
                html += '</table>';
                html += '</div>';
                
                if (data.events && data.events.length > 0) {
                    html += '<h6 class="mt-3">{{ translate("Tracking Events") }}</h6>';
                    html += '<div class="timeline">';
                    data.events.forEach(function(event) {
                        html += '<div class="timeline-item">';
                        html += '<div class="timeline-date">' + (event.date || 'N/A') + '</div>';
                        html += '<div class="timeline-content">';
                        html += '<strong>' + (event.status || 'N/A') + '</strong><br>';
                        html += '<small>' + (event.description || 'N/A') + '</small>';
                        html += '</div>';
                        html += '</div>';
                    });
                    html += '</div>';
                }
                
                html += '</div>';
                return html;
            }
        });
    </script>

    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        .timeline-item:before {
            content: '';
            position: absolute;
            left: -25px;
            top: 5px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #007bff;
        }
        .timeline-item:after {
            content: '';
            position: absolute;
            left: -20px;
            top: 15px;
            width: 2px;
            height: calc(100% + 5px);
            background: #e9ecef;
        }
        .timeline-item:last-child:after {
            display: none;
        }
        .timeline-date {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 5px;
        }
        .timeline-content {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
@endsection
