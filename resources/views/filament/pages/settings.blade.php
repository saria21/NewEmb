<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}
        
        <div class="mt-6">
            {{ $this->getFormActions()[0] }}
        </div>
    </form>
</x-filament-panels::page>
protected static ?int $navigationSort = 100; // 🟢 رقم كبير جداً لضمان نزولها آخر شيء بالأسفل
