@component('mail::message')
# New Message From: {{ $data->name }}

## :The body of your message

> ***{{ $data->message }}***

## :User details

**Name** **:** {{ $data->name }}

**Email** **:** {{ $data->email }}

**Subject** **:** {{ $data->subject }}

**,Thanks**

**{{ config('app.name') }}**

@endcomponent
