@component('mail::message')

# @lang('messages.confirmation.title')

@lang('messages.confirmation.greeting')

@lang('messages.confirmation.body')

- **@lang('Date'):** {{$day}}
- **@lang('Hour'):** {{$hour}}
- **@lang('Patient'):** {{$patient}}
- **@lang('Doctor'):** {{$doctor}}

@component('mail::button', ['url' => $url, 'color' => 'success'])
    @lang('messages.confirmation.button')
@endcomponent

@lang('messages.confirmation.thanks'),<br>
{{ config('app.name') }}
@endcomponent
