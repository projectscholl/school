<li class="menu-item {{ $active }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="Account Settings">{{ $slot1 }}</div>
    </a>
    <ul class="menu-sub">
        {{ $slot2 }}
    </ul>
</li>
