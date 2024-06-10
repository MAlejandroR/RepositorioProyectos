@props(['url'])
@php
    $url ="https://cpilosenlaces.com/";
@endphp
<tr>
    <td style="background-color: white;display: flex; flex-direction: row; justify-content:center;align-items: center">
        <a href="{{ $url }}">
            @if (trim($slot) === 'Laravel')
                <img class="logo"
                     src="https://cpilosenlaces.com/wp-content/uploads/2023/03/cpifp-los-enlaces-2x.png" class="logo"
                     alt="CPIFP Los Enlaces"
                     alt="CPIFP Los Enlaces">

            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
