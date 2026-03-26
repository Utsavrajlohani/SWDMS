@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Enquiry') }}
        </h2>
        <a href="{{ route('admin.enquiries.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center gap-2">
            <span>🔙</span> Back to List
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $enquiry->subject ?? 'General Enquiry' }}</h3>
                <p class="text-sm text-gray-500">Received on {{ $enquiry->created_at->format('M d, Y @ h:i A') }}</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $enquiry->status === 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-green-100 text-green-800' }}">
                {{ ucfirst($enquiry->status) }}
            </span>
        </div>
        <div class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Sender Information</h4>
                    <div class="space-y-1">
                        <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $enquiry->name }}</p>
                        <p class="text-gray-600 dark:text-gray-400">{{ $enquiry->email }}</p>
                        <p class="text-gray-600 dark:text-gray-400">{{ $enquiry->phone ?? 'No phone provided' }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Message Content</h4>
                <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 text-gray-800 dark:text-gray-200 whitespace-pre-line leading-relaxed">
                    {{ $enquiry->message }}
                </div>
            </div>

            <div class="pt-6 flex justify-between items-center border-t border-gray-100 dark:border-gray-700">
                <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST" onsubmit="return confirm('Delete this enquiry permanently?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium">Delete Enquiry</button>
                </form>
                <a href="mailto:{{ $enquiry->email }}?subject=Re: {{ $enquiry->subject }}" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-all shadow-md">
                    Reply via Email
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
