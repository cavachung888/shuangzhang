@php
  $allLocales = locales();
  $currentLocaleCode = front_locale_code();
  $currentLocale = $allLocales->firstWhere('code', $currentLocaleCode);
  $currentLocaleName = $currentLocale?->name ?? $currentLocaleCode;
  $contactUrl = has_front_route('contacts.index') ? front_route('contacts.index') : null;
  $isEn = app()->getLocale() === 'en';
  $phone = system_setting('telephone');
  $email = system_setting('email');
  $localizeNavUrl = static function (string $url): string {
    if ($url === '' || preg_match('#^(https?:|mailto:|tel:|javascript:|/)#i', $url) && preg_match('#^/(zh-cn|en)(/|$)#i', $url)) {
      return $url;
    }
    if (preg_match('#^(https?:|mailto:|tel:|javascript:)#i', $url)) {
      return $url;
    }
    return url('/' . front_locale_code() . '/' . ltrim($url, '/'));
  };

  // 6 大导航（硬编码，中英双语）
  $navMenus = [
    [
      'code' => 'solutions',
      'name_zh' => '解决方案', 'name_en' => 'Solutions',
      'children' => [
        ['name_zh' => '半导体与功率电子', 'icon' => 'bi-cpu', 'name_en' => 'Semiconductor & Power Electronics', 'url' => '/articles'],
        ['name_zh' => '新能源与电力', 'icon' => 'bi-lightning-charge',     'name_en' => 'New Energy & Power',                'url' => '/articles'],
        ['name_zh' => '连接器与继电器', 'icon' => 'bi-plug',   'name_en' => 'Connectors & Relays',               'url' => '/articles'],
        ['name_zh' => '散热与消费电子', 'icon' => 'bi-fan',   'name_en' => 'Thermal & Consumer Electronics',    'url' => '/articles'],
      ],
    ],
    [
      'code' => 'products',
      'name_zh' => '铜材产品', 'name_en' => 'Products',
      'children' => [
        ['name_zh' => '精密异型铜卷/带材', 'icon' => 'bi-arrow-repeat', 'name_en' => 'Precision Shaped Copper Coil & Strip', 'url' => '/products'],
        ['name_zh' => '定制异形铜排', 'icon' => 'bi-bezier2',     'name_en' => 'Custom Shaped Copper Busbar',          'url' => '/products'],
      ],
    ],
    [
      'code' => 'tech',
      'name_zh' => '生产技术', 'name_en' => 'Technology',
      'children' => [
        ['name_zh' => '精密冷轧制', 'icon' => 'bi-arrows-collapse',     'name_en' => 'Precision Cold Rolling',     'url' => '/articles'],
        ['name_zh' => '无应力力切', 'icon' => 'bi-scissors',     'name_en' => 'Stress-Free Slitting',       'url' => '/articles'],
        ['name_zh' => '渐进式控轧', 'icon' => 'bi-sliders',     'name_en' => 'Progressive Controlled Rolling','url' => '/articles'],
        ['name_zh' => '工程设计与优化', 'icon' => 'bi-pencil-square', 'name_en' => 'Engineering Design & Optimization','url' => '/articles'],
        ['name_zh' => '质量保证', 'icon' => 'bi-patch-check',       'name_en' => 'Quality Assurance',          'url' => '/articles'],
      ],
    ],
    [
      'code' => 'about',
      'name_zh' => '关于我们', 'name_en' => 'About',
      'children' => [
        ['name_zh' => '公司简介', 'icon' => 'bi-building',     'name_en' => 'Company Profile',     'url' => '/page-about'],
        ['name_zh' => '发展历程', 'icon' => 'bi-clock-history',     'name_en' => 'Our Journey',         'url' => '/page-about'],
        ['name_zh' => '制造能力', 'icon' => 'bi-gear',     'name_en' => 'Manufacturing',      'url' => '/page-about'],
        ['name_zh' => '资质与认证', 'icon' => 'bi-award',   'name_en' => 'Certifications',      'url' => '/page-about'],
        ['name_zh' => '选择双张', 'icon' => 'bi-hand-thumbs-up',     'name_en' => 'Why Shunchung',       'url' => '/page-about'],
      ],
    ],
    [
      'code' => 'resources',
      'name_zh' => '资源中心', 'name_en' => 'Resources',
      'children' => [
        ['name_zh' => '技术资料', 'icon' => 'bi-file-earmark-text', 'name_en' => 'Technical Docs',  'url' => '/articles'],
        ['name_zh' => '应用案例', 'icon' => 'bi-box', 'name_en' => 'Case Studies',    'url' => '/articles'],
        ['name_zh' => '行业资讯', 'icon' => 'bi-newspaper', 'name_en' => 'Industry News',   'url' => '/articles'],
      ],
    ],
    [
      'code' => 'contact',
      'name_zh' => '联系我们', 'name_en' => 'Contact',
      'children' => [
        ['name_zh' => '获取报价', 'icon' => 'bi-calculator', 'name_en' => 'Request Quote',  'url' => $contactUrl ?: '/contact'],
        ['name_zh' => '提交图纸', 'icon' => 'bi-upload', 'name_en' => 'Submit Drawing', 'url' => $contactUrl ?: '/contact'],
        ['name_zh' => '联系方式', 'icon' => 'bi-telephone', 'name_en' => 'Contact Info',   'url' => $contactUrl ?: '/contact'],
      ],
    ],
  ];
@endphp

<div class="site-header shunchung-header is-fixed-top">
  {{-- 主导航（白底 + 红橙渐变 logo + 6 大菜单） --}}
  <div class="header-box">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="logo shunchung-logo">
        <a href="{{ front_route('home.index') }}" class="shunchung-logo__link">
          <img src="{{ image_origin('images/shunchung-logo-en.svg') }}" class="shunchung-logo__img" style="filter:none !important; -webkit-filter:none !important; opacity:1 !important;" alt="Shunchung">
        </a>
      </div>

      <div class="header-menu d-flex align-items-center">
        <nav class="navbar navbar-expand-md navbar-light">
          <ul class="navbar-nav shunchung-nav">
            @foreach($navMenus as $menu)
              @php($hasDropdown = in_array($menu['code'], ['solutions', 'products', 'resources']))
              <li class="nav-item{{ $hasDropdown ? ' has-mega' : '' }}">
                @php($menuUrl = $hasDropdown ? 'javascript:void(0)' : $localizeNavUrl($menu['children'][0]['url']))
              <a class="nav-link" href="{{ $menuUrl }}" @if($hasDropdown) aria-haspopup="true" aria-expanded="false" @endif>
                  {{ $isEn ? $menu['name_en'] : $menu['name_zh'] }}
                  @if($hasDropdown)
                    <i class="bi bi-chevron-down has-mega__caret" aria-hidden="true"></i>
                  @endif
                </a>
                @if($hasDropdown)
                  <ul class="mega-panel">
                    @foreach($menu['children'] as $child)
                      <li>
                        <a class="mega-panel__item" href="{{ $localizeNavUrl($child['url']) }}">
                          <i class="bi {{ $child['icon'] }} mega-panel__icon" aria-hidden="true"></i>
                          {{ $isEn ? $child['name_en'] : $child['name_zh'] }}
                        </a>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </li>
            @endforeach
          </ul>
        </nav>

        @if($contactUrl)
          <a href="{{ $contactUrl }}" class="btn btn-accent d-none d-lg-inline-flex align-items-center ms-3">
            <span><i class="bi bi-clipboard2-check-fill me-1"></i>{{ $isEn ? 'GET QUOTE' : '获取报价' }}</span>
          </a>
        @endif

        @if($allLocales->count() > 1)
          <div class="header-lang dropdown">
            <button type="button" class="header-lang__btn" aria-label="{{ $isEn ? 'Select language' : '选择语言' }}" aria-expanded="false">
              <i class="bi bi-globe2" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end header-lang__menu">
              @foreach($allLocales as $locale)
                @php($flagIcon = match($locale->code) { 'zh-cn', 'zh' => 'flag-cn.svg', 'en', 'en-us' => 'flag-us.svg', default => 'flag-cn.svg' })
                <li>
                  <a class="dropdown-item header-lang__item {{ $locale->code === $currentLocaleCode ? 'is-active' : '' }}"
                     href="{{ front_route('locales.switch', ['code' => $locale->code]) }}">
                    <span class="header-lang__flag" aria-hidden="true"><img src="{{ image_origin('images/' . $flagIcon) }}" alt=""></span>
                    <span>{{ $locale->name }}</span>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- 移动端菜单（同样 6 大） --}}
        <div class="offcanvas offcanvas-start" tabindex="-1" id="mobile-menu-offcanvas">
          <div class="offcanvas-header">
            <div class="mb-logo shunchung-logo">
              <img src="{{ image_origin('images/shunchung-logo-en.svg') }}" class="shunchung-logo__img" style="filter:none !important; -webkit-filter:none !important; opacity:1 !important;" alt="Shunchung">
            </div>
          </div>
          <div class="close-offcanvas" data-bs-dismiss="offcanvas"><i class="bi bi-chevron-compact-left"></i></div>
          <ul class="navbar-nav">
            @foreach($navMenus as $menu)
              <li class="nav-item has-children">
                <a class="nav-link" href="javascript:void(0)">
                  {{ $isEn ? $menu['name_en'] : $menu['name_zh'] }}
                </a>
                <ul class="sub-menu">
                  @foreach($menu['children'] as $child)
                    <li><a class="nav-link" href="{{ $localizeNavUrl($child['url']) }}"><i class="bi {{ $child['icon'] }} me-2" aria-hidden="true"></i>{{ $isEn ? $child['name_en'] : $child['name_zh'] }}</a></li>
                  @endforeach
                </ul>
              </li>
            @endforeach
            @if($contactUrl)
              <li class="nav-item p-3">
                <a href="{{ $contactUrl }}" class="btn btn-accent w-100">
                  <span>{{ $isEn ? 'GET QUOTE' : '获取报价' }}</span>
                </a>
              </li>
            @endif
          </ul>
        </div>
        <div class="mb-icon" data-bs-toggle="offcanvas" data-bs-target="#mobile-menu-offcanvas"
             aria-controls="mobile-menu-offcanvas"><i class="bi bi-list"></i></div>
      </div>
    </div>
  </div>
</div>
