<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Active Lease Info -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Active Lease</h3>
                    @if($activeLease)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Branch</p>
                                <p class="font-semibold">{{ $activeLease->room->branch->name }}</p>
                                <p class="text-sm text-gray-500">{{ $activeLease->room->branch->address }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Room</p>
                                <p class="font-semibold">{{ $activeLease->room->number }} ({{ $activeLease->room->type->name }})</p>
                                <p class="text-sm text-gray-500">Since {{ $activeLease->start_date->format('d M Y') }}</p>
                            </div>
                        </div>
                    @else
                        <p>No active lease found.</p>
                    @endif
                </div>
            </div>

            <!-- Invoices -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Billing History</h3>
                    @if($invoices->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($invoices as $invoice)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $invoice->due_date->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($invoice->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $invoice->status == 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $invoice->status == 'unpaid' ? 'bg-red-100 text-red-800' : '' }}
                                    ">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <p>No invoices found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
