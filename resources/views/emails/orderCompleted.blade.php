@component('mail::message')
@component('mail::panel')
{{ $subject }}
@endcomponent
@component('mail::table')
| {{ __('Продукт') }}  | {{ __('Количество') }}                                                                      | {{ __('Сумма') }}                                              |
|:-------------------- | -------------------------------------------------------------------------------------------:| --------------------------------------------------------------:|
@foreach($order->products as $product)
| {{ $product->name }} | {{ $product->pivot->quantity }} {{ __('шт.') }} &times; {{ $product->pivot->price }}&#8381; | {{ $product->pivot->quantity*$product->pivot->price }} &#8381; |
@endforeach
@endcomponent
@component('mail::panel')
{{ __('Общая сумма заказа') }}: {{ $order->total }} &#8381;
@endcomponent
{{ __('Thanks') }},<br>
{{ config('app.name') }}
@endcomponent
