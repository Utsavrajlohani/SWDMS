@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inbound Enquiries') }}
        </h2>
        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
            <span>🔙</span> Back to Dashboard
        </a>
    </div>
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                <tr>
                    <th class="px-6 py-4">From</th>
                    <th class="px-6 py-4">Subject</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($enquiries as $enquiry)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900 dark:text-white">{{ $enquiry->name }}</div>
                        <div class="text-xs text-gray-400">{{ $enquiry->email }}</div>
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400 truncate max-w-[200px]">{{ $enquiry->subject ?? 'General Enquiry' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-bold {{ $enquiry->status === 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($enquiry->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $enquiry->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">View Message</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <div class="text-4xl mb-4">📧</div>
                        <p>No new enquiries found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
