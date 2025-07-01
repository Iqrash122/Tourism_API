@extends('layouts.dashboard')

@section('content')

@section('styles')
@endsection

{{-- Page Title --}}

{{-- Edit  Book Tour Main Section --}}
<main>

   <!-- Breadcrum Start -->

   <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 dark:border-gray-800  dark:text-white/90">
      <div class=" flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
         <h2 class="text-[26px] font-bold ">
            Edit Tour
         </h2>
         <nav>
            <ol class="flex items-center gap-2">
               <li>
                  <a class="font-medium" href="{{ route('book_tour.index') }}">Dashboard /</a>
               </li>
               <li class="font-medium text-success capitalize"> Edit Tour</li>
            </ol>
         </nav>
      </div>
   </div>
   <!-- Breadcrum End -->

   <form id="BOOKINGForm" class="tour-form mx-auto max-w-screen-2xl p-6 my-8" action="{{ route('book_tour.update', $booking->id) }}"
      method="POST">
      @csrf
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
         <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
               <div class="space-y-6 border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                  <!-- Customer Dropdown -->
                  <div class="w-full ">




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
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('booking_customer', $booking->booking_customer) == $customer->id ? 'selected' : '' }}>
                           {{ $customer->user->first_name }} {{ $customer->user->last_name }}
                        </option>
                        @endforeach

                     </select>

                  </div>





                  <!-- Booking Persons -->
                  <div>
                     <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Number of
                        Persons</label>
                     <input name="booking_person" type="number" min="1" placeholder="e.g., 2" value="{{ $booking->booking_person }}"
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
         <div class="space-y-6"

            x-data="tourBooking({
                  selectedTour: '{{ $booking->booking_tour }}',
                  selectedPackage: '{{ $booking->booking_price }}',
                  selectedTime: '{{ $booking->booking_time }}'
               })"
            x-init="init()">


            <div class="flex flex-col gap-6 p-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

               <!-- Tour and Package Selection -->
               <div class="flex flex-row gap-4">
                  <!-- Select Tour -->
                  <div class="w-1/2">
                     <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Select Tour</label>
                     <select x-model="selectedTour" @change="handleTourChange($event)" name="booking_tour" class="dark:bg-dark-900 shadow-theme-xs  focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <option value="">Select Tour</option>
                        @foreach ($tours as $tour)
                        <option value="{{ $tour->id }}"
                           data-packages='@json($tour->packages)'
                           data-times='@json($tour->times)'
                           {{ $booking->booking_tour == $tour->id ? 'selected' : '' }}>
                           {{ $tour->activity_title }}
                        </option>
                        @endforeach
                     </select>
                  </div>

                  <!-- Select Package -->
                  <div class="w-1/2">
                     <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Select Package</label>
                     <select
                        x-model="selectedPackage"
                        name="booking_price"
                        x-ref="packageSelect"
                        class="dark:bg-dark-900 shadow-theme-xs  focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <option value="">Select Package</option>
                        <template x-for="(pkg, index) in availablePackages" :key="index">
                           <option
                              :value="normalizePrice(pkg.price)"
                              x-text="`${pkg.package_title} ($${pkg.price})`"
                              :selected="normalizePrice(pkg.price) === normalizePrice(selectedPackage)"></option>
                        </template>
                     </select>
                  </div>
               </div>

               <!-- Booking Date and Time -->
               <div class="flex flex-row gap-4">
                  <div class="w-1/2">
                     <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Booking Date</label>
                     <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                           <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                              xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                           </svg>
                        </div>
                        <input type="date" id="dob" name="booking_date"
                           class="dark:bg-dark-900 shadow-theme-xs indent-6 focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                           placeholder="Select date" value="{{ old('booking_date', $booking->booking_date ?? '') }}">
                     </div>
                  </div>

                  <!-- Select Time -->
                  <div class="w-1/2">
                     <label class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">Select Time</label>
                     <select
                        x-model="selectedTime"
                        name="booking_time"
                        x-ref="timeSelect"
                        class="dark:bg-dark-900 shadow-theme-xs  focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <option value="">Select available time</option>
                        <template x-for="(time, index) in availableTimes" :key="index">
                           <option
                              :value="normalizeTime(time.activity_start_time || time.start)"
                              x-text="time.label"
                              :selected="normalizeTime(time.activity_start_time || time.start) === normalizeTime(selectedTime)"></option>
                        </template>
                     </select>
                  </div>
               </div>

            </div>
         </div>





      </div>
   </form>



</main>



@section('scripts')
<script>
   function tourBooking(initialData = {}) {
      return {
         selectedTour: initialData.selectedTour || '',
         selectedPackage: initialData.selectedPackage || '',
         selectedTime: initialData.selectedTime || '',
         availablePackages: [],
         availableTimes: [],

         // Helper to normalize price values (handles strings, numbers, decimals)
         normalizePrice(price) {
            if (!price) return '';
            // Convert to string, remove any currency symbols, trim whitespace
            return parseFloat(String(price).replace(/[^\d.]/g, '')).toFixed(2);
         },

         // Helper to normalize time values
         normalizeTime(timeStr) {
            if (!timeStr) return '';
            // Convert to HH:MM:SS format consistently
            const time = String(timeStr).trim();
            if (time.match(/^\d{1,2}:\d{2}$/)) return time + ':00';
            if (time.match(/^\d{1,2}:\d{2}:\d{2}$/)) return time;
            return ''; // or handle other formats as needed
         },

         init() {
            console.log('Initializing with:', {
               tour: this.selectedTour,
               package: this.selectedPackage,
               time: this.selectedTime
            });

            if (this.selectedTour) {
               const tourSelect = document.querySelector('[name="booking_tour"]');
               if (tourSelect) {
                  const selectedOption = tourSelect.querySelector(`option[value="${this.selectedTour}"]`);
                  if (selectedOption) {
                     // Load and normalize packages
                     this.availablePackages = JSON.parse(selectedOption.dataset.packages || '[]').map(pkg => ({
                        ...pkg,
                        price: this.normalizePrice(pkg.price)
                     }));

                     // Load and normalize times
                     this.availableTimes = JSON.parse(selectedOption.dataset.times || '[]').map(time => ({
                        ...time,
                        activity_start_time: this.normalizeTime(time.activity_start_time),
                        start: this.normalizeTime(time.start)
                     }));

                     // Normalize selected values
                     this.selectedPackage = this.normalizePrice(this.selectedPackage);
                     this.selectedTime = this.normalizeTime(this.selectedTime);

                     console.log('Loaded data:', {
                        packages: this.availablePackages,
                        times: this.availableTimes,
                        selectedPackage: this.selectedPackage,
                        selectedTime: this.selectedTime
                     });

                     // Ensure selections are applied after DOM renders
                     this.$nextTick(() => {
                        if (this.$refs.packageSelect) {
                           this.$refs.packageSelect.value = this.selectedPackage;
                           console.log('Package select value set to:', this.$refs.packageSelect.value);
                        }
                        if (this.$refs.timeSelect) {
                           this.$refs.timeSelect.value = this.selectedTime;
                           console.log('Time select value set to:', this.$refs.timeSelect.value);
                        }
                     });
                  }
               }
            }
         },

         handleTourChange(event) {
            const selectedOption = event.target.selectedOptions[0];
            if (selectedOption) {
               this.availablePackages = JSON.parse(selectedOption.dataset.packages || '[]');
               this.availableTimes = JSON.parse(selectedOption.dataset.times || '[]');
               this.selectedPackage = '';
               this.selectedTime = '';
            } else {
               this.availablePackages = [];
               this.availableTimes = [];
            }
         }
      }
   }
   //modal for adding new customer

   document.addEventListener('DOMContentLoaded', function() {
      const csrfToken = document.querySelector('meta[name="csrf-token"]');
      const modal = document.getElementById('customerModal');
      const openModalBtn = document.getElementById('openCustomerModal');
      const cancelModalBtn = document.getElementById('cancelModalBtn');
      const addCustomerForm = document.getElementById('addCustomerForm');
      const customerSelect = document.getElementById('customerSelect');

      if (!csrfToken) {
         console.error('CSRF token not found!');
         return;
      }

      openModalBtn?.addEventListener('click', function() {
         modal?.classList.remove('hidden');
         modal?.classList.add('flex');
      });

      cancelModalBtn?.addEventListener('click', function() {
         modal?.classList.add('hidden');
         modal?.classList.remove('flex');
         addCustomerForm?.reset();
      });

      addCustomerForm?.addEventListener('submit', function(e) {
         e.preventDefault();
         const formData = new FormData(this);

         fetch("{{ route('customers.store') }}", {
               method: 'POST',
               headers: {
                  'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
               },
               body: formData
            })
            .then(async response => {
               if (!response.ok) {
                  const text = await response.text();
                  throw new Error(`Server error: ${response.status}\n${text}`);
               }
               return response.json();
            })
            .then(data => {
               if (data.status === 'success') {
                  alert('Customer created successfully!');

                  const fullName = `${data.customer.first_name} ${data.customer.last_name}`;

                  // ✅ Append new option to the select
                  const option = document.createElement('option');
                  option.value = data.customer.id;
                  option.text = fullName;
                  option.selected = true;
                  customerSelect.appendChild(option);
                  customerSelect.value = data.customer.id;

                  // ✅ Rebuild HSSelect
                  if (window.HSSelect) {
                     const instance = HSSelect.getInstance(customerSelect);
                     if (instance) {
                        instance.destroy(); // Remove old instance
                     }
                     HSSelect.init(customerSelect); // Re-initialize
                  }

                  // ✅ Hide modal and reset form
                  modal.classList.add('hidden');
                  modal.classList.remove('flex');
                  addCustomerForm.reset();
               } else {
                  alert('Error: ' + data.message);
               }
            })

            .catch(error => {
               console.error("Error:", error);
               alert("Something went wrong while adding the customer.");
            });
      });
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



   //package and time selection
</script>
@endsection




@endsection