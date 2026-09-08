<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth'; // أيقونة الترس النظامية العالمية
    protected static ?string $navigationLabel = 'Settings'; // الاسم الظاهر بالقائمة الجانبية
    protected static ?string $title = 'Account Settings'; // العنوان بأعلى الصفحة
    protected static string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        // ملء الحقول تلقائياً ببيانات الموظف المسجل دخوله حالياً
        $this->form->fill([
            'full_name' => auth()->user()->full_name,
            'email' => auth()->user()->email,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profile Information')
                    ->description('Update your account\'s profile details.')
                    ->schema([
                        TextInput::make('full_name')
                            ->label('Full Name')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->unique('staff', 'email', ignorable: auth()->user()),
                    ])->columns(2),

                Section::make('Update Password')
                    ->description('Ensure your account is using a long, secure password.')
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Current Password')
                            ->password()
                            ->currentPassword(),
                        TextInput::make('new_password')
                            ->label('New Password')
                            ->password(),
                        TextInput::make('new_password_confirmation')
                            ->label('Confirm New Password')
                            ->password()
                            ->same('new_password'),
                    ])->columns(3),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Settings')
                ->submit('save')
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();
        $user = auth()->user();

        // تحديث الاسم والإيميل
        $user->update([
            'full_name' => $state['full_name'],
            'email' => $state['email'],
        ]);

        // تحديث الباسورد في حال كتابة باسورد جديد
        if (!empty($state['new_password'])) {
            $user->update([
                'password' => Hash::make($state['new_password']),
            ]);
        }

        Notification::make()
            ->title('Settings saved successfully!')
            ->success()
            ->send();
    }
}
