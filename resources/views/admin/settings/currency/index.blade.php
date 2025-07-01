@extends('layouts.dashboard')

@section('content')

<main>
   <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
      <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

      <div class="mx-auto  p-4 md:p-6 dark:border-gray-800 dark:text-white/90">
         <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-[26px] font-bold">Currency Converter</h2>
         </div>
      </div>

      <div
         x-data="currencyConverter()"
         class="mt-10 p-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90">

         <!-- Currency Selection and Input -->
         <div class="grid grid-cols-3 gap-4 items-center mb-4">
            <label class="col-span-1 font-medium">Convert to:</label>
            <select
               x-model="currency"
               @change="convert"
               class="col-span-2 border rounded px-3 py-2">
               <template x-for="(rate, code) in rates" :key="code">
                  <option :value="code" x-text="code" class="dark:text-black"></option>
               </template>
            </select>
         </div>

         <div class="grid grid-cols-3 gap-4 items-center mb-4">
            <label class="col-span-1 font-medium">Amount (USD):</label>
            <input
               type="number"
               x-model="usdAmount"
               @input="convert"
               class="col-span-2 border rounded px-3 py-2"
               placeholder="Enter USD amount">
         </div>

         <!-- Result -->
         <div class="text-center mt-4 text-lg font-semibold">
            <template x-if="convertedAmount !== null">
               <p>
                  <span x-text="usdAmount"></span> USD =
                  <span x-text="convertedAmount"></span>
                  <span x-text="currency"></span>
               </p>
            </template>
         </div>

         <!-- Note -->
         <div class="text-center text-xs text-gray-500 mt-2">
            <p>Exchange rates are for demonstration purposes only</p>
         </div>
      </div>

      <script>
         function currencyConverter() {
            return {
               rates: {
                  USD: 1,
                  EUR: 0.92,
                  GBP: 0.79,
                  JPY: 153.75,
                  CAD: 1.36,
                  AUD: 1.52,
                  CNY: 7.23,
                  INR: 83.42,
                  AED: 3.67
               },
               currency: 'EUR',
               usdAmount: '1',
               convertedAmount: null,

               init() {
                  this.convert();
               },

               convert() {
                  const amount = parseFloat(this.usdAmount);
                  if (!isNaN(amount)) {
                     const rate = this.rates[this.currency];
                     this.convertedAmount = (amount * rate).toFixed(2);
                  } else {
                     this.convertedAmount = null;
                  }
               }
            }
         }
      </script>

   </div>
</main>

@endsection