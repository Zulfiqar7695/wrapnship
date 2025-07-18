{{-- Example: admin/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2>Shipper Dashboard</h2>
    </x-slot>
    <div class="py-4 px-6 bg-white shadow sm:rounded-lg">
        You are logged in as Shipper.
    </div>
    <a href="{{ route('shopify.orders') }}" class="btn btn-outline-primary">
    View Shopify Orders
</a>

</x-app-layout>
