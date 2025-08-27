<?php

use Livewire\Volt\Component;

new class extends Component {

    public $selectedOption = '';
    public $isOpen = false;
    public $searchTerm = '';

    // Dynamic properties
    public $options = [];
    public $label = 'Pilih Opsi';
    public $placeholder = 'Cari atau pilih...';
    public $emptyMessage = 'Tidak ada hasil ditemukan';
    public $selectedLabel = 'Item yang dipilih:';
    public $showIcons = false;
    public $multiple = false;
    public $required = false;
    public $disabled = false;
    public $searchable = true;
    public $iconColors = [];

    public function mount($options = [], $label = null, $placeholder = null, $emptyMessage = null,
                         $selectedLabel = null, $showIcons = false, $multiple = false,
                         $required = false, $disabled = false, $searchable = true, $selected = null,
                         $iconColors = [])
    {
        $this->options = $options ?: [
            'option1' => 'Option 1',
            'option2' => 'Option 2',
            'option3' => 'Option 3'
        ];

        $this->label = $label ?? $this->label;
        $this->placeholder = $placeholder ?? $this->placeholder;
        $this->emptyMessage = $emptyMessage ?? $this->emptyMessage;
        $this->selectedLabel = $selectedLabel ?? $this->selectedLabel;
        $this->showIcons = $showIcons;
        $this->multiple = $multiple;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->searchable = $searchable;
        $this->iconColors = $iconColors;

        if ($selected) {
            $this->selectedOption = $selected;
        }
    }

    public function getFilteredOptionsProperty()
    {
        if (empty($this->searchTerm)) {
            return $this->options;
        }

        return collect($this->options)
            ->filter(fn($label, $value) =>
                str_contains(strtolower($label), strtolower($this->searchTerm)) ||
                str_contains(strtolower($value), strtolower($this->searchTerm))
            )
            ->toArray();
    }

    public function selectOption($value)
    {
        $this->selectedOption = $value;
        $this->searchTerm = $this->options[$value] ?? '';
        $this->isOpen = false;
    }

    public function clearSelection()
    {
        $this->selectedOption = '';
        $this->searchTerm = '';
        $this->isOpen = false;
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen) {
            $this->searchTerm = '';
        }
    }

    public function updatedSearchTerm()
    {
        $this->isOpen = true;
    }

    public function getSelectedLabelProperty()
    {
        return $this->options[$this->selectedOption] ?? '';
    }
};

?>

<div
    class="relative w-full max-w-md mx-auto"
    x-data="{ open: @entangle('isOpen') }"
    @click.away="open = false"
    >
    <!-- Main Select Container -->
    <div class="relative">
        <label class="block text-sm font-medium text-gray-700 mb-2">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>

        <!-- Select Input -->
        <div class="relative">
            @if($searchable)
                <input
                    type="text"
                    wire:model.live="searchTerm"
                    wire:click="toggleDropdown"
                    placeholder="{{ $selectedOption ? $this->getSelectedLabelProperty() : $placeholder }}"
                    class="w-full px-4 py-3 pr-10 text-left bg-white border border-gray-300 rounded-lg shadow-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 {{ $disabled ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                    autocomplete="off"
                    {{ $disabled ? 'disabled' : '' }}
                />
            @else
                <div
                    wire:click="{{ !$disabled ? 'toggleDropdown' : '' }}"
                    class="w-full px-4 py-3 pr-10 text-left bg-white border border-gray-300 rounded-lg shadow-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 {{ $disabled ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                >
                    {{ $selectedOption ? $this->getSelectedLabelProperty() : $placeholder }}
                </div>
            @endif

            <!-- Dropdown Arrow -->
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400 transition-transform duration-200"
                     :class="{ 'rotate-180': open }"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>

            <!-- Clear Button -->
            @if($selectedOption)
                <button
                    wire:click="clearSelection"
                    class="absolute inset-y-0 right-8 flex items-center pr-2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
                >
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            @endif
        </div>
    </div>

    <!-- Dropdown Options -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-1"
         class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-auto">

        @if(count($this->filteredOptions) > 0)
            @foreach($this->filteredOptions as $value => $label)
                <div wire:click="selectOption('{{ $value }}')"
                     class="flex items-center px-4 py-3 cursor-pointer hover:bg-blue-50 transition-colors duration-150
                            {{ $selectedOption === $value ? 'bg-blue-100 text-blue-900' : 'text-gray-900' }}">

                    @if($showIcons)
                        <!-- Dynamic Icon -->
                        <div class="flex-shrink-0 w-6 h-6 mr-3">
                            @if(isset($iconColors[$value]))
                                <div class="w-full h-full {{ $iconColors[$value] }} rounded flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">
                                        {{ strtoupper(substr($value, 0, 1)) }}
                                    </span>
                                </div>
                            @else
                                <div class="w-full h-full bg-gray-400 rounded flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">
                                        {{ strtoupper(substr($value, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Label -->
                    <span class="flex-1 font-medium">{{ $label }}</span>

                    <!-- Selected Check -->
                    @if($selectedOption === $value)
                        <svg class="w-5 h-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    @endif
                </div>
            @endforeach
        @else
            <div class="px-4 py-3 text-gray-500 text-center">
                {{ $emptyMessage }}
            </div>
        @endif
    </div>

    <!-- Selected Value Display -->
    @if($selectedOption)
        <div class="mt-4 p-4 bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 rounded-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">{{ $selectedLabel }}</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $this->getSelectedLabelProperty() }}</p>
                </div>
                @if($showIcons)
                    <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $iconColors[$selectedOption] ?? 'bg-gray-400' }}">
                        <span class="text-white text-xs font-bold">
                            {{ strtoupper(substr($selectedOption, 0, 2)) }}
                        </span>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
