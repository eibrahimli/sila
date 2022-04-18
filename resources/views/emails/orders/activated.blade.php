@component('mail::message')
# Yeni sifariş təyin edildi

Yeni sifarişiniz var. Admin panelə daxil olub sifarişi görüntüləyə bilərsiniz

@component('mail::button', ['url' => route('admin.loginView')])
Sifarişi gör
@endcomponent

Təşəkkürlər,<br>
{{ config('app.name') }}
@endcomponent
