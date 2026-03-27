@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('B2B Customers') }}
        </h2>
        <a class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{ route('users.create') }}">
            Add New Customer
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs uppercase text-gray-500 dark:text-gray-400 font-semibold">
                    <tr>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Email / Phone</th>
                        <th class="px-6 py-4">Current Due</th>
                        <th class="px-6 py-4">Credit Limit</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $user->address ?? 'No address' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-gray-700 dark:text-gray-300">{{ $user->email }}</div>
                            <div class="text-xs font-mono">{{ $user->phone ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-red-600 dark:text-red-400">₹{{ number_format($user->current_due, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 font-medium text-indigo-600 dark:text-indigo-400">
                            ₹{{ number_format($user->credit_limit, 2) }}
                        </td>
                        <td class="px-6 py-4">
                            @if($user->bnpl_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400">
                                    BNPL Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400">
                                    Prepaid Only
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <form action="{{ route('users.toggle-bnpl', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-{{ $user->bnpl_active ? 'orange' : 'green' }}-600 hover:text-{{ $user->bnpl_active ? 'orange' : 'green' }}-900 font-medium text-xs uppercase tracking-tighter decoration-dotted underline underline-offset-4">
                                    {{ $user->bnpl_active ? 'Disable BNPL' : 'Enable BNPL' }}
                                </button>
                            </form>
                            <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">No customers found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
