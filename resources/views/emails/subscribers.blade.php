@component('mail::message')
# You have Subscribed to our blog!

Dear {{$email}},

You have subscribed to our clinic blog and you will be receiving notifications whenever a new post is published. We are excited to have you in our website and you can interact with posts too. Our doctors will create post on the latest health, wellness trends, etc. For more information visit our blog.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/blog'])
Blog
@endcomponent

Thanks,<br>
{{ _('ProClinic Medical Center') }}
@endcomponent