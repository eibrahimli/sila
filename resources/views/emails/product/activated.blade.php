@component('mail::message')
# Məhsulunuz saytımız tərəfindən aktiv olundu.

Əziz istifadəçi məhsulunuz artıq saytımızda yayındadır.

@component('mail::button', ['url' => ''])
Məhsulu görüntülə
@endcomponent

Təşəkkürlər,<br>
{{ config('app.name') }}
@endcomponent
