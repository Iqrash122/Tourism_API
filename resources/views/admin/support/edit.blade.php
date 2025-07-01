@extends('layouts.dashboard')

@section('content')
<div class="max-w-(--breakpoint-2xl) p-4 md:p-6 dark:border-gray-800  dark:text-white/90">
    <!-- Breadcrumb Start-->

    <div class="">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Query Support
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="#">Dashboard /</a>
                    </li>
                    <li class="font-medium text-success capitalize">Query</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-4">
        <form action="{{ route('support.update', $query->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row flex-wrap">
                <div class="w-full">
                    <label for="query_id" class="mb-2 block text-sm font-medium text-gray-700 dark:text-white">Query ID</label>
                    <input type="text" id="query_id" name="query_id" value="{{ $query->id }}" readonly
                         class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <div class="w-full">
                    <label for="customer_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-white">Customer Name</label>
                    <input type="text" id="customer_name" name="customer_name" value="{{ $query->customer_name}}" readonly
                         class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <div class="w-full">
                    <label for="customer_email" class="mb-2 block text-sm font-medium text-gray-700 dark:text-white">Customer Email</label>
                    <input type="text" id="customer_email" name="customer_email" value="{{ $query->customer_email}}" readonly
                         class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <div class="w-full">
                    <label for="type" class="mb-2 block text-sm font-medium text-gray-700 dark:text-white">Type</label>
                    <input type="text" id="type" name="type" value="{{ $query->type }}" readonly
                         class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <div class="w-full">
                    <label for="query" class="mb-2 block text-sm font-medium text-gray-700 dark:text-white">Query</label>
                    <textarea id="query" name="query" rows="4" readonly
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ $query->query }}</textarea>
                </div>

                <div class="w-full">
                    <label for="status" class="mb-2 block text-sm font-medium text-gray-700 dark:text-white">Status</label>
                    <select id="status" name="status"
                          class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <option value="Open" {{ $query->status === 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="Closed" {{ $query->status === 'Closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <div class="w-full">
                    <label for="reply" class="mb-2 block text-sm font-medium text-gray-700 dark:text-white">Reply</label>
                    <textarea id="response" name="response" rows="4"
                         class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ $query->response }}</textarea>
                </div>

                <div class="w-full flex items-center justify-center">
                    <button type="submit"
                        class="inline-flex h-12 items-center justify-center rounded border border-stroke bg-transparent px-6 text-base font-medium text-black transition hover:bg-opacity-90 focus:outline-none dark:border-strokedark dark:text-white">
                        Update Query
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection