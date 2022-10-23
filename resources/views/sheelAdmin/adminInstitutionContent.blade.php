<link rel="stylesheet" href="/css/institutionContent.css">
<div class="wrapper">
    <div class="institutionContent">
        <button class="institutionsName"
            onclick="location.href='{{ route('adminInstitution') }}?id={{ $institution['id'] }}'">{{ $institution['name'] }}</button>
        <div class="address">
            {{ $institution['address'] }}
        </div>
    </div>
</div>
