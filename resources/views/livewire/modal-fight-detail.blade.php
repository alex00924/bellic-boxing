<div x-data="{ modelOpen: @entangle('show') }">
    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak @click="modelOpen = false" x-show="modelOpen" 
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0" 
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100" 
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
            ></div>

            <div x-cloak x-show="modelOpen" 
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300  rounded-md shadow-sm"
            >
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium">Fight Details</h1>

                    <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>
                @if(!empty($fight))
                    <h3 class="mt-5">
                        {{$fight->divisionDetail->name}}weight - NYC
                        <br/>
                        Created by 
                        <a href="/" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{$fight->createrDetail->name}}</a>
                    </h3>
                    <div class="grid grid-cols-2 mt-5">
                        <p>
                            <strong class="font-medium text-gray-500">Location:</strong>
                            {{ $fight->countryDetail->name . " " . $fight->stateDetail->name }}
                        </p>
                        <p>
                            <strong class="font-medium text-gray-500">Date:</strong>
                            {{ $fight->date }}
                        </p>
                        
                        <p class="mt-3">
                            <strong class="font-medium text-gray-500">Promoter:</strong>
                            Bellic Boxing
                        </p>
                        <p class="mt-3">
                            <strong class="font-medium text-gray-500">Oponent:</strong>
                            {{ $fight->oponent }}
                        </p>
                        <p class="mt-3">
                            <strong class="font-medium text-gray-500">Rounds:</strong>
                            {{ $fight->round . " Rounds" }}
                        </p>
                        
                        <p class="mt-3">
                            <strong class="font-medium text-gray-500">US Visa:</strong>
                            {{ $fight->visa ? "Yes" : "No" }}
                            &ensp;
                            <strong class="font-medium text-gray-500">Passport:</strong>
                            {{ $fight->passport ? "Yes" : "No" }}
                        </p>
                        
                        <p class="mt-3">
                            <strong class="font-medium text-gray-500">Notes:</strong>
                            {{ $fight->notes }}
                        </p>
                    </div>

                    @if (empty($fight->applyerDetail))
                        @can('boxer')
                            <form class="mt-5" wire:submit.prevent="applyFight">
                                @if(empty(auth()->user()->boxrec_id))
                                    <!-- Boxrec ID -->
                                    <div class="mt-4">
                                        <x-input-label class="dark:text-gray-500" for="boxrec_id" :value="__('Boxrec ID')" />
                                        <x-text-input id="boxrec_id" class="block mt-1 w-full" type="text" name="boxrec_id" wire:model.lazy="boxrec_id" required autocomplete="boxrec_id" />
                                        <x-input-error :messages="$errors->get('boxrec_id')" class="mt-2" />
                                    </div>
                                @endif
                                
                                <div class="flex justify-end mt-6">
                                    <x-primary-button>
                                        {{ __('Apply') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        @endcan
                    @else
                        @if ($fight->applied_by == auth()->user()->id)
                        <div class="flex justify-end mt-6">
                            <x-primary-button>
                                {{ __('Applied') }}
                            </x-primary-button>
                        </div>
                        @else
                            <div class="flex justify-end mt-6">
                                <p>
                                    <strong class="font-medium text-gray-500">Applyer: </strong>
                                    {{ $fight->applyerDetail->name }}
                                </p>
                            </div>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
