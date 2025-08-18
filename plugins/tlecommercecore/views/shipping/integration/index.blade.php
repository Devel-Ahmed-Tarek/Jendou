@extends('plugin/tlecommercecore::layouts.master')
@section('title')
    {{ translate('Shipping Integrations') }}
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/vendor/responsive.bootstrap4.min.css') }}">
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ translate('Shipping Integrations') }}</h4>
                        <div class="d-flex gap-2">
                            <select class="form-select" id="status-filter">
                                <option value="">{{ translate('All Status') }}</option>
                                <option value="pending">{{ translate('Pending') }}</option>
                                <option value="success">{{ translate('Success') }}</option>
                                <option value="failed">{{ translate('Failed') }}</option>
                            </select>
                            <select class="form-select" id="carrier-filter">
                                <option value="">{{ translate('All Carriers') }}</option>
                                <option value="Armex">Armex</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="shipping-integrations-table">
                            <thead>
                                <tr>
                                    <th>{{ translate('Order Code') }}</th>
                                    <th>{{ translate('Product') }}</th>
                                    <th>{{ translate('Carrier') }}</th>
                                    <th>{{ translate('Tracking Number') }}</th>
                                    <th>{{ translate('Status') }}</th>
                                    <th>{{ translate('Created At') }}</th>
                                    <th>{{ translate('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shipments as $shipment)
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('plugin.tlcommercecore.orders.details', $shipment->order_id) }}">
                                                {{ $shipment->order->order_code ?? 'N/A' }}
                                            </a>
                                        </td>
                                        <td>{{ $shipment->orderProduct->product_details->name ?? 'N/A' }}</td>
                                        <td>{{ $shipment->carrier_name }}</td>
                                        <td>
                                            @if ($shipment->tracking_number)
                                                <span class="badge bg-info">{{ $shipment->tracking_number }}</span>
                                            @else
                                                <span class="text-muted">{{ translate('N/A') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($shipment->status === 'success')
                                                <span class="badge bg-success">{{ translate('Success') }}</span>
                                            @elseif($shipment->status === 'failed')
                                                <span class="badge bg-danger">{{ translate('Failed') }}</span>
                                            @else
                                                <span class="badge bg-warning">{{ translate('Pending') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $shipment->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown">
                                                    {{ translate('Actions') }}
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('plugin.tlcommercecore.shipping.integration.show', $shipment->id) }}">
                                                            <i class="fas fa-eye"></i> {{ translate('View Details') }}
                                                        </a>
                                                    </li>
                                                    @if ($shipment->tracking_number)
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('plugin.tlcommercecore.shipping.integration.print') }}?tracking_number={{ $shipment->tracking_number }}"
                                                                target="_blank">
                                                                <i class="fas fa-print"></i> {{ translate('Print Label') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button class="dropdown-item track-shipment"
                                                                data-tracking="{{ $shipment->tracking_number }}">
                                                                <i class="fas fa-search"></i>
                                                                {{ translate('Track Shipment') }}
                                                            </button>
                                                        </li>
                                                    @endif
                                                    @if ($shipment->status === 'failed')
                                                        <li>
                                                            <form
                                                                action="{{ route('plugin.tlcommercecore.shipping.integration.retry', $shipment->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="fas fa-redo"></i> {{ translate('Retry') }}
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $shipments->links() }}
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
    <script src="{{ asset('public/backend/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/vendor/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/vendor/dataTables.responsive.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#shipping-integrations-table').DataTable({
                responsive: true,
                pageLength: 25,
                order: [
                    [5, 'desc']
                ]
            });

            // Status filter
            $('#status-filter').change(function() {
                var status = $(this).val();
                var url = new URL(window.location);
                if (status) {
                    url.searchParams.set('status', status);
                } else {
                    url.searchParams.delete('status');
                }
                window.location.href = url.toString();
            });

            // Carrier filter
            $('#carrier-filter').change(function() {
                var carrier = $(this).val();
                var url = new URL(window.location);
                if (carrier) {
                    url.searchParams.set('carrier', carrier);
                } else {
                    url.searchParams.delete('carrier');
                }
                window.location.href = url.toString();
            });

            // Track shipment
            $('.track-shipment').click(function() {
                var trackingNumber = $(this).data('tracking');
                var modal = $('#trackingModal');
                var content = $('#tracking-content');

                content.html(
                    '<div class="text-center"><i class="fas fa-spinner fa-spin"></i> {{ translate('Loading...') }}</div>'
                );
                modal.modal('show');

                $.ajax({
                    url: '{{ route('plugin.tlcommercecore.shipping.integration.track') }}',
                    method: 'POST',
                    data: {
                        tracking_number: trackingNumber,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            content.html(formatTrackingData(response.data));
                        } else {
                            content.html('<div class="alert alert-danger">' + response.message +
                                '</div>');
                        }
                    },
                    error: function() {
                        content.html(
                            '<div class="alert alert-danger">{{ translate('An error occurred while tracking shipment') }}</div>'
                        );
                    }
                });
            });

            function formatTrackingData(data) {
                var html = '<div class="tracking-info">';
                html += '<h6>{{ translate('Tracking Information') }}</h6>';
                html += '<div class="table-responsive">';
                html += '<table class="table table-sm">';
                html += '<tr><td><strong>{{ translate('Status') }}:</strong></td><td>' + (data.status || 'N/A') +
                    '</td></tr>';
                html += '<tr><td><strong>{{ translate('Location') }}:</strong></td><td>' + (data.location ||
                    'N/A') + '</td></tr>';
                html += '<tr><td><strong>{{ translate('Last Update') }}:</strong></td><td>' + (data.last_update ||
                    'N/A') + '</td></tr>';
                html += '</table>';
                html += '</div>';

                if (data.events && data.events.length > 0) {
                    html += '<h6 class="mt-3">{{ translate('Tracking Events') }}</h6>';
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
