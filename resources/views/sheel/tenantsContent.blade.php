<link rel="stylesheet" href="/css/careTenantContent.css">
@if ($tenant->check == 0)
    <div class="cont">
        <div class="tenantContent">
            <button class="tenantName"
                onclick="location.href='{{ route('tenant') }}?id={{ $tenant->id }}'">{{ $tenant->name }}</button>
            <div class="emergency_contact">緊急連絡先<br>{{ $tenant->emergency_contact }}<br>{{ $tenant->contact_name }}</div>
        </div>
    </div>
@else
    <div class="cont">
        <div class="tenantContent-b">
            <div class="up">
                <button class="tenantName"
                    onclick="location.href='{{ route('tenant') }}?id={{ $tenant->id }}'">{{ $tenant->name }}</button>
                <img class="check"src="{{ asset('img/sumi-1.svg') }}">
            </div>
            <div class="emergency_contact">緊急連絡先<br>{{ $tenant->emergency_contact }}<br>{{ $tenant->contact_name }}
            </div>
        </div>
    </div>
@endif
