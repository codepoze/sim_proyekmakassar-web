@foreach ($menu_head_role as $row)

@php
$url_menu_head = get_uri_segment(url($row->path))[1] ?? null;
@endphp

<li class="nav-item {{ ($row->jenis === 'multi' && Request::segment(2) == $url_menu_head ? 'open' : (Request::segment(2) == $url_menu_head ? 'active' : '')) }}">
    <a href="{{ URL::to($row->jenis === 'multi' ? '#' : session()->get('roles') . $row->path) }}" class="d-flex align-items-center" data-id_menu_head="{{ $row->id_menu_head }}">
        <i data-feather="{{ (!empty($row->icon)) ? $row->icon : 'circle'; }}"></i>{{ $row->nama }}
        @if ($row->jenis == 'multi')
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        @endif
    </a>

    @if ($row->jenis == 'multi')
    <ul class="menu-content">
        @foreach ($menu_body_role as $row3)

        @php
        $url_menu_body = get_uri_segment(url($row3->path))[1] ?? null;
        @endphp

        @if ($row->id_menu_head == $row3->id_menu_head)
        <li>
            <a href="{{ URL::to(session()->get('roles') . $row->path . $row3->path) }}" class="{{ (Request::segment(2) == $url_menu_head && Request::segment(3) == $url_menu_body) ? 'active' : '' }}">
                <i data-feather="{{ (!empty($row3->icon)) ? $row3->icon : 'circle'; }}"></i>{{ $row3->nama }}
            </a>
        </li>
        @endif

        @endforeach
    </ul>
    @endif
</li>
@endforeach