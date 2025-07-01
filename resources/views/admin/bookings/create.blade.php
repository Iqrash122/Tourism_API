@extends('layouts.dashboard')

@section('content')

@section('styles')
<style>
    .date-picker .w-full .relative .flatpickr-wrapper {
        width: 100%;
    }
</style>
@endsection

{{-- Page Title --}}

{{-- CReate  Book Tour Main Section --}}
<main>

    <!-- Breadcrum Start -->

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 dark:border-gray-800  dark:text-white/90">
        <div class=" flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-[26px] font-bold ">
                Book Tour
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="{{ route('book_tour.index') }}">Dashboard /</a>
                    </li>
                    <li class="font-medium text-success capitalize"> Book Tour</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrum End -->

    <form id="BOOKINGForm" class="tour-form mx-auto max-w-screen-2xl p-6 my-8" action="{{ route('book_tour.store') }}"
        method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="space-y-6 border-gray-100 p-5 sm:p-6 dark:border-gray-800">

                        <!-- <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Booking Id</label>
                            <input name="booking_order_id" type="number"  placeholder="4512"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required />
                        </div> -->

                        <!-- Customer Dropdown -->
                        <div class="w-full ">
                            <div class="mb-1.5 flex items-center justify-between">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Select
                                    Customer</label>
                                <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-2 cursor-pointer"
                                    id="openCustomerModal">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add New Customer
                                </p>
                            </div>



                            <!-- Select -->
                            <select id="customerSelect" name="booking_customer"
                                data-hs-select='{
                                    "hasSearch": true, 
                                    "searchPlaceholder": "Search...",
                                    "searchClasses": "block w-full sm:text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-1 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-1.5 sm:py-2 px-3",
                                    "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
                                    "placeholder": "Customers",
                                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600",
                                    "toggleSeparators": {
                                    "betweenItemsAndCounter": "&"
                                    },
                                    "toggleCountText": "selected",
                                    "toggleCountTextMinItems": 3,
                                    "toggleCountTextMode": "nItemsAndCount",
                                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 pb-1 px-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                    }'
                                class="hidden">
                                <option value="">Choose</option>
                                <!-- <option value="guest">Guest</option> -->
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">
                                    {{ $customer->user ? $customer->user->first_name . ' ' . $customer->user->last_name : 'No User' }}
                                </option>
                                @endforeach
                            </select>

                        </div>





                        <!-- Booking Persons -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Number of
                                Persons</label>
                            <input name="booking_person" type="number" min="1" placeholder="e.g., 2"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required />
                        </div>

                        <!-- Status -->
                        <div>
                            <label
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Status</label>
                            <select name="booking_status"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="public">Public</option>
                                <option value="draft">Draft</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>

                    </div>
                </div>


                <!-- Submit Button -->
                <div class="w-full flex items-center justify-between">
                    <button type="submit"
                        class="w-full px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                        Submit
                    </button>
                </div>

            </div>
            <!-- right side  -->
            <div class="space-y-6" x-data="tourBooking()">
                <div class="flex flex-col gap-6 p-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

                    <!-- Tour and Package Selection -->
                    <div class="flex flex-row gap-4">
                        <!-- Select Tour -->
                        <div class="w-1/2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Select Tour</label>
                            <select id="tour_Activities" x-model="selectedTour" @change="handleTourChange($event)" name="booking_tour"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Select Tour</option>
                                @foreach ($tours as $tour)
                                <option value="{{ $tour->id }}"
                                    data-packages='@json($tour->packages)'
                                    data-times='@json($tour->times)'>
                                    {{ $tour->activity_title }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select Package -->
                        <div class="w-1/2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Select Package</label>
                            <select id="tour_packages" x-model="selectedPackage" name="booking_price"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Select Package</option>
                                <template x-for="pkg in availablePackages" :key="pkg.id">
                                    <option :value="pkg.sale_price || pkg.regular_price || pks.id" x-text="pkg.displayText || pkg.package_title"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <!-- Booking Date and Time -->
                    <div class="flex flex-row gap-4 date-picker">
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Booking Date
                            </label>
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-[#6e6e6e] dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="#6e6e6e" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="datepicker-format" type="text" name="booking_date"
                                    class="h-11 w-full indent-6 rounded-lg border border-gray-300 bg-white dark:bg-gray-900 dark:text-white text-sm px-4 py-2.5 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 focus:ring-3 focus:outline-hidden dark:border-gray-700"
                                    placeholder="YYYY-MM-DD">
                            </div>
                        </div>


                        <!-- Select Time -->
                        <div class="w-1/2">
                            <label class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">Select Time</label>
                            <select name="booking_time" x-model="selectedTime"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-white dark:bg-gray-900 dark:text-white text-sm px-4 py-2.5 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 focus:ring-3 focus:outline-hidden dark:border-gray-700">
                                <option value="">Select available time</option>
                                <template x-for="time in availableTimes" :key="time.id">
                                    <option :value="time.activity_start_time" x-text="time.label"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </form>


    <!-- Modal -->
    <div id="customerModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-white/70">
        <div class="w-1/2 max-w-2xl rounded-lg shadow-lg dark:bg-gray-800 bg-white">
            <div class="flex flex-col w-full gap-5">
                <div class="p-4 border-b dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Add New Customer</h3>
                </div>
                <div class="p-4">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <form id="addCustomerForm" enctype="multipart/form-data" method="POST"
                        action="{{ route('customers.store') }}">
                        @csrf
                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                            <div class="w-full xl:w-1/2">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    First Name<span class="text-meta-1">*</span>
                                </label>
                                <input type="text" name="first_name" id="hs-validation-name-error"
                                    placeholder="Enter Your First Name"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    required />
                            </div>

                            <div class="w-full xl:w-1/2">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Last Name<span class="text-meta-1">*</span>
                                </label>
                                <input name="last_name" type="text" placeholder="Enter Your Last Name"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    required />
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="customerEmail"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                            <input type="email" id="customerEmail" placeholder="Enter Email" name="email"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required />
                        </div>

                        <div class="mb-4">
                            <label for="customerPassword"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-400">Password</label>
                            <input type="password" id="customerPassword" name="password" placeholder="Password"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required />
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" id="cancelModalBtn"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg dark:bg-gray-700 dark:text-gray-300">Cancel</button>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg dark:bg-blue-500">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Guest Details -->
    <form id="guestForm" class="z-99999 flex justify-center items-center">
        @csrf
        <div id="guestDetails"
            class="  hidden w-1/3 mx-auto mb-8 grid-cols-1 gap-6 p-6 justify-center items-center z-999 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

            <!-- Full Name -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Full Name</label>
                <input name="guest_name" type="text" placeholder="Guest Name"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
            </div>
            <!-- Email -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Email <span
                        class="text-red-500">*</span></label>
                <input name="guest_email" type="email" placeholder="Guest Email"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                    required />
            </div>
            <!-- Phone -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Phone <span
                        class="text-red-500">*</span></label>
                <input name="guest_phone" type="tel" placeholder="Phone Number"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                    required />
            </div>

            <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg dark:bg-blue-500">Save </button>


        </div>
    </form>

    <div id="successMessage" class="text-green-600 mt-2 hidden">Guest added successfully!</div>



</main>



@section('scripts')
<script>
    function tourBooking() {
        return {
            selectedTour: '',
            selectedPackage: '',
            selectedTime: '',
            availablePackages: [],
            availableTimes: [],
            handleTourChange(event) {
                const selectedOption = event.target.selectedOptions[0];
                if (selectedOption) {
                    this.availablePackages = JSON.parse(selectedOption.getAttribute('data-packages') || '[]');
                    this.availableTimes = JSON.parse(selectedOption.getAttribute('data-times') || '[]');
                    this.selectedPackage = '';
                    this.selectedTime = '';

                    // If you want to show both regular and sale price in the dropdown:
                    this.availablePackages = this.availablePackages.map(pkg => ({
                        ...pkg,
                        displayText: `${pkg.package_title} (Regular: $${pkg.regular_price}, Sale: $${pkg.sale_price})`
                    }));
                } else {
                    this.availablePackages = [];
                    this.availableTimes = [];
                    this.selectedPackage = '';
                    this.selectedTime = '';
                }
            }
        }
    }
    //modal for adding new customer

    document.addEventListener('DOMContentLoaded', () => {
        // Cache DOM elements
        const elements = {
            csrfToken: document.querySelector('meta[name="csrf-token"]'),
            modal: document.getElementById('customerModal'),
            openModalBtn: document.getElementById('openCustomerModal'),
            cancelModalBtn: document.getElementById('cancelModalBtn'),
            closeModalBtn: document.getElementById('closeModalBtn'),
            addCustomerForm: document.getElementById('addCustomerForm'),
            customerSelect: document.getElementById('customerSelect'),
            errorContainer: document.getElementById('formErrors'),
            submitBtn: document.querySelector('#addCustomerForm button[type="submit"]')
        };

        // Validate essential elements
        if (!elements.csrfToken || !elements.modal || !elements.addCustomerForm || !elements.customerSelect) {
            console.error('Essential elements missing:', {
                csrfToken: !!elements.csrfToken,
                modal: !!elements.modal,
                form: !!elements.addCustomerForm,
                select: !!elements.customerSelect
            });
            return;
        }

        // Modal control functions
        const modalControl = {
            open: () => {
                elements.modal.classList.replace('hidden', 'flex');
                this.clearErrors();
            },
            close: () => {
                elements.modal.classList.replace('flex', 'hidden');
                elements.addCustomerForm.reset();
                this.clearErrors();
            }
        };

        // Error handling utilities
        const errorHandler = {
            clear: () => {
                if (elements.errorContainer) {
                    elements.errorContainer.innerHTML = '';
                    elements.errorContainer.classList.add('hidden');
                }
            },
            show: (errors) => {
                if (!elements.errorContainer) return;

                elements.errorContainer.innerHTML = Object.entries(errors)
                    .map(([field, messages]) => messages.map(
                        message => `<p class="text-red-500 text-sm mt-1">${field}: ${message}</p>`
                    ).join(''));

                elements.errorContainer.classList.remove('hidden');
            },
            log: (error) => {
                console.groupCollapsed('Customer Form Error');
                console.error('Message:', error.message);
                console.error('Stack:', error.stack);
                if (error.response) {
                    console.error('Response Status:', error.response.status);
                    console.error('Response Data:', error.response.data);
                }
                console.groupEnd();
            }
        };

        // Form submission handler
        const handleSubmit = async (e) => {
            e.preventDefault();
            errorHandler.clear();

            const originalBtnContent = elements.submitBtn.innerHTML;
            const formData = new FormData(elements.addCustomerForm);

            elements.submitBtn.disabled = true;
            elements.submitBtn.innerHTML = `
                    <span class="flex items-center justify-center">
                        <svg class="animate-spin h-4 w-4 mr-2 text-white" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing...
                    </span>
                `;

            try {
                const response = await fetch(elements.addCustomerForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': elements.csrfToken.content,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    if (response.status === 422) {
                        errorHandler.show(data.errors || {});
                        throw new Error('Form validation failed');
                    }
                    throw new Error(data.message || `HTTP error! status: ${response.status}`);
                }

                handleSuccess(data); // ✅ Fixed

            } catch (error) {
                errorHandler.log(error);
                showToast(error.message || 'An unexpected error occurred', 'error'); // ✅ Fixed
            } finally {
                elements.submitBtn.disabled = false;
                elements.submitBtn.innerHTML = originalBtnContent;
            }
        };



        // Success handler (update select + close modal + toast)
        const handleSuccess = (data) => {
            const {
                customer
            } = data;

            // Get full name from related user
            const firstName = customer.user?.first_name || '';
            const lastName = customer.user?.last_name || '';
            const fullName = `${firstName} ${lastName}`.trim();

            // Create new option and add to select
            const option = new Option(fullName, customer.id, true, true);
            elements.customerSelect.appendChild(option);

            // Unhide select if hidden
            elements.customerSelect.classList.remove('hidden');

            // Destroy and re-initialize HSSelect
            if (window.HSSelect) {
                const hsInstance = HSSelect.getInstance(elements.customerSelect);
                if (hsInstance) hsInstance.destroy();

                new HSSelect(elements.customerSelect, {
                    hasSearch: true,
                    searchPlaceholder: "Search customers...",
                    dropdownClasses: "mt-2 z-50",
                });
            }

            modalControl.close();
            showToast('Customer created successfully!', 'success');
        };



        // Toast notification function (not using `this`)
        const showToast = (message, type = 'info') => {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-4 py-2 rounded shadow-lg ${
        type === 'error' ? 'bg-red-500' : 
        type === 'success' ? 'bg-green-500' : 
        'bg-blue-500'
            } text-white z-[9999]`;
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => toast.remove(), 5000);
        };


        // Event listeners
        elements.openModalBtn?.addEventListener('click', modalControl.open);
        elements.cancelModalBtn?.addEventListener('click', modalControl.close);
        elements.closeModalBtn?.addEventListener('click', modalControl.close);
        elements.addCustomerForm.addEventListener('submit', handleSubmit);

        // Debug: Log initialization
        console.debug('Customer form handler initialized');
    });







    // auto generated slug

    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.querySelector('#bookingTitle');
        const slugInput = document.querySelector('#slug');

        titleInput.addEventListener('input', function() {
            const slug = titleInput.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-') // replace non-alphanumeric with dashes
                .replace(/^-+|-+$/g, ''); // remove leading/trailing dashes
            slugInput.value = slug;
        });
    });

    const customerSelect = document.getElementById('customerSelect');
    const guestDetails = document.getElementById('guestDetails');

    customerSelect.addEventListener('change', function() {
        const selectedValues = Array.from(customerSelect.selectedOptions).map(opt => opt.value);
        if (selectedValues.includes('guest')) {
            guestDetails.classList.remove('hidden');
            guestDetails.classList.add('grid');
        } else {
            guestDetails.classList.add('hidden');
            guestDetails.classList.remove('grid');
        }
    });

    // date picker
    document.addEventListener("DOMContentLoaded", function() {
        const dateInput = document.getElementById("dob");
        const today = new Date();

        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');

        const minDate = `${yyyy}-${mm}-${dd}`;
        dateInput.min = minDate;
    });

    // time picker
    document.addEventListener("DOMContentLoaded", function() {
        const timeInput = document.getElementById("time");

        if (timeInput) {
            timeInput.addEventListener("input", function() {
                const value = timeInput.value;
                if (value < "09:00") {
                    timeInput.value = "09:00";
                } else if (value > "18:00") {
                    timeInput.value = "18:00";
                }
            });
        }
    });
</script>

<!-- //guest script  -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('guestForm');
        const guestDetails = document.getElementById('guestDetails');
        const select = document.getElementById('customerSelect');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(form);

            try {
                const response = await fetch("{{ route('guests.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    console.log('Guest Name:', result.full_name);

                    // Show success message
                    document.getElementById('successMessage').classList.remove('hidden');
                    form.reset();
                    guestDetails.classList.add('hidden');

                    // Create and append new option
                    const newOption = new Option(result.full_name, result.id, true, true);
                    select.appendChild(newOption);

                    // Remove 'hidden' class to show the select
                    select.classList.remove('hidden');

                    // If using HS Select library, reinitialize it
                    if (window.HSSelect) {
                        const hsSelectInstance = HSSelect.getInstance(select);
                        if (hsSelectInstance) {
                            hsSelectInstance.destroy();
                        }
                        new HSSelect(select, {
                            // Your HS Select configuration here
                            "hasSearch": true,
                            "searchPlaceholder": "Search...",
                            // ... rest of your config
                        });
                    }

                    // Trigger change event if needed
                    select.dispatchEvent(new Event('change'));

                } else {
                    alert(result.message || 'Validation error.');
                }

            } catch (error) {
                console.error('Submission error:', error);
                alert('Something went wrong!');
            }
        });
    });
</script>

<!-- for datepicker booking  -->
<script>
    flatpickr("#datepicker-format", {
        dateFormat: "Y-m-d",
        minDate: "today",
        maxDate: new Date().fp_incr(7)
    });
</script>



@endsection




@endsection