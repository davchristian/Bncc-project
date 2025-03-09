@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">My Invoices</h1>
    
    @if($invoices->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Invoice #</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->created_at->format('d M Y, H:i') }}</td>
                    <td>{{ $invoice->items->count() }}</td>
                    <td>Rp. {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info">
        You don't have any invoices yet. <a href="{{ route('products.index') }}">Start shopping</a>
    </div>
    @endif
</div>
@endsection