@extends('layouts.app')

@section('body-class', 'page-home')

@php
  $isEn = app()->getLocale() === 'en';
  $office = system_setting_locale('address');
  $factory = system_setting_locale('factory_address');
  $ceo = system_setting_locale('ceo');
@endphp

@push('header')
<script type="module" src="https://cdn.jsdelivr.net/npm/@google/model-viewer/dist/model-viewer.min.js"></script>
@endpush


@section('content')

{{-- ===== 1. HERO ===== --}}
{{-- ===== 1. 全屏 HERO（背景图 + 3D + 标题按钮） ===== --}}

<section class="sc-hero-new" id="heroTop">
  <div class="sc-hero-new__bg" style="background-image: url('{{ asset('images/bg-hero-copper.jpg') }}');"></div>
  <div class="sc-hero-new__veil"></div>

  {{-- 底层：超大主标题 --}}
  <h1 class="sc-hero-new__title">
    @if($isEn)
      Professional Manufacturer of <br><span class="sc-hero-new__title-accent">Precision Shaped Copper</span>
    @else
      专业生产<br><span class="sc-hero-new__title-accent">精密异型铜材</span>
    @endif
  </h1>

  {{-- 中层：3D 产品展示（多模型切换 + 自动轮播） --}}
  @php
    $heroModels = [
      ['src' => asset('models/t2-u-strip.glb'),  'zh' => 'T2 U型铜带',       'en' => 'T2 U-Shaped Copper Strip'],
      ['src' => asset('models/to220-0.38.glb'),  'zh' => 'TO220 引线框架 · 0.38短', 'en' => 'TO220 Leadframe · 0.38'],
      ['src' => asset('models/to220-stairs.glb'),'zh' => 'TO220 引线框架 · 楼梯',   'en' => 'TO220 Leadframe · Stair'],
      ['src' => asset('models/to220-w.glb'),     'zh' => 'TO220 引线框架 · W带',    'en' => 'TO220 Leadframe · W-Band'],
    ];
  @endphp
  <div class="sc-hero-new__3d">
    <model-viewer
      id="hero-model"
      src="{{ $heroModels[0]['src'] }}"
      alt="@if($isEn) Shaped copper product 3D @else 异型铜材产品 3D @endif"
      class="sc-hero-new__mv"
      camera-controls
      auto-rotate
      auto-rotate-delay="0"
      rotation-per-second="14deg"
      exposure="1.1"
      shadow-intensity="0"
      environment-image="legacy"
      loading="eager"
      camera-orbit="60deg 65deg 82%"
      field-of-view="26deg"
      interaction-prompt="none"

    ></model-viewer>

    <button type="button" class="sc-hero-arrow sc-hero-arrow--prev" aria-label="@if($isEn) Previous model @else 上一个模型 @endif"><i class="bi bi-chevron-left"></i></button>
    <button type="button" class="sc-hero-arrow sc-hero-arrow--next" aria-label="@if($isEn) Next model @else 下一个模型 @endif"><i class="bi bi-chevron-right"></i></button>
  </div>

  {{-- 上层：副标题 + icon 按钮 --}}
  <div class="sc-hero-new__overlay">
    <p class="sc-hero-new__sub">
      @if($isEn)
        Specialized in high-precision, multi-spec shaped copper solutions<br>for semiconductor, power electronics, EV &amp; thermal management applications.
      @else
        专注高精度、多规格铜异型材解决方案<br>为半导体、功率电子、新能源汽车及热管理等高要求应用提供定制化铜材产品。
      @endif
    </p>
    <a href="/solutions" class="btn-copper-shine sc-hero-new__cta">
      <span><i class="bi bi-compass me-1" aria-hidden="true"></i>@if($isEn) Explore More @else 探索更多 @endif</span>
    </a>
  </div>

  <div class="sc-hero-new__scroll">
    <span>@if($isEn) Scroll @else 向下滚动 @endif</span>
    <i class="bi bi-chevron-down"></i>
  </div>
</section>

{{-- ===== 2. Trust Metrics ===== --}}
<section class="sc-stats" aria-label="Trust Metrics">
  <div class="container">
    <div class="sc-section-heading sc-stats__heading">
      <h2 class="module-title">
        @if($isEn)
          <span class="module-title__plain">Strength Proven by </span><span class="gradient-text">Numbers</span>
        @else
          <span class="module-title__plain">实力用</span><span class="gradient-text">数字见证</span>
        @endif
      </h2>
      <p class="module-sub-title">@if($isEn) Decades of focused manufacturing have built a scalable delivery system defined by precision, consistency and reliability. @else 二十余年持续深耕，以规模化制造兑现每一次精密、稳定、可靠的交付。 @endif</p>
    </div>
    <div class="sc-stats__grid">
      <div class="sc-stats__card">
        <div class="sc-stats__num"><span class="sc-stats__value" data-target="25">0</span></div>
        <div class="sc-stats__label">@if($isEn) Years of Manufacturing Excellence @else 建厂至今25年 @endif</div>
      </div>
      <div class="sc-stats__card">
        <div class="sc-stats__num"><span class="sc-stats__value" data-target="300">0</span><span class="sc-stats__plus">+</span></div>
        <div class="sc-stats__label">@if($isEn) Custom Cross-Sections @else 300+ 定制截面 @endif</div>
      </div>
      <div class="sc-stats__card">
        <div class="sc-stats__num"><span class="sc-stats__value" data-target="60">0</span><span class="sc-stats__plus">+</span></div>
        <div class="sc-stats__label">@if($isEn) Global Industry Leaders @else 60+ 全球行业龙头 @endif</div>
      </div>
      <div class="sc-stats__card">
        <div class="sc-stats__num"><span class="sc-stats__value" data-target="25">0</span><span class="sc-stats__plus">+</span></div>
        <div class="sc-stats__label">@if($isEn) Core Technology Patents @else 25+ 核心工艺专利 @endif</div>
      </div>
    </div>
  </div>
</section>

{{-- ===== 3. 异形铜材产品 ===== --}}
<section class="sc-section sc-products-showcase">
  <div class="container">
    <h2 class="module-title"><span class="gradient-text">@if($isEn) Shaped Copper Products @else 异形铜材产品 @endif</span></h2>
    <p class="module-sub-title">@if($isEn) From precision shaped copper coils to custom busbars, fully tailored to your dimensions. @else 从精密异型铜卷到定制铜排，完全按您的尺寸定制 @endif</p>
    <div class="sc-products-showcase__grid">
      <a href="/products/precision-strip" class="sc-product-tile sc-product-tile--coil">
        <img src="{{ system_setting('product_image_1') ?: asset('images/product-coil.jpg') }}" alt="@if($isEn) Precision Shaped Copper Strip & Coil @else 精密异形铜带/铜卷 @endif">
        <span class="sc-product-tile__veil"></span>
        <span class="sc-product-tile__content">
          <span class="sc-product-tile__title">@if($isEn) Precision Shaped Copper Strip &amp; Coil @else 精密异形铜带/铜卷 @endif</span>
          <span class="sc-product-tile__desc">@if($isEn) Guided by your application and specification needs, we shape high-precision custom cross-section copper profiles through cold rolling, planing and roll-forming technologies. @else 以客户的应用场景和规格需求为导向，通过冷轧、刨切、挫轧等精密成型技术，为您打造高精度的异型截面铜材。 @endif</span>
        </span>
      </a>
      <a href="/products/custom-busbar" class="sc-product-tile sc-product-tile--busbar">
        <img src="{{ system_setting('product_image_2') ?: asset('images/product-busbar.jpg') }}" alt="@if($isEn) Custom Shaped Copper Busbar @else 定制异形铜排 @endif">
        <span class="sc-product-tile__veil"></span>
        <span class="sc-product-tile__content">
          <span class="sc-product-tile__title">@if($isEn) Custom Shaped Copper Busbar @else 定制异形铜排 @endif</span>
          <span class="sc-product-tile__desc">@if($isEn) Using large-tonnage extruders, continuous extruders and drawing machines, we precisely form and machine copper bars of all kinds, with flexible lengths up to 12 meters. @else 通过大吨位挤压机、连续挤压机及拉拔机等先进设备，为您精密成型并加工各类异型铜段，支持最长12米的灵活定制。 @endif</span>
        </span>
      </a>
    </div>
    <div class="sc-products-showcase__more">
      <a href="/products" class="btn-copper-shine"><span><i class="bi bi-grid me-1" aria-hidden="true"></i>@if($isEn) View All Products @else 查看全部产品 @endif</span></a>
    </div>
  </div>
</section>

{{-- ===== 4. 行业应用解决方案 ===== --}}
<section class="sc-section sc-solutions-showcase">
  <div class="container">
    <h2 class="module-title"><span class="gradient-text">@if($isEn) Industry Application Solutions @else 行业应用解决方案 @endif</span></h2>
    <p class="module-sub-title">@if($isEn) High-performance copper materials engineered for demanding industries and diverse applications. @else 为严苛行业场景所研发的高性能铜材，适配不同应用领域。 @endif</p>
    @php
      $solutions = [
        ['icon' => 'bi-cpu-fill', 'title_en' => 'Semiconductor & Power Electronics', 'title_zh' => '半导体与功率电子', 'desc_en' => 'High-purity copper for IC substrates, IGBT and power module packaging.', 'desc_zh' => '高纯度铜材，用于 IC 基板、IGBT 与功率模块封装。'],
        ['icon' => 'bi-lightning-charge-fill', 'title_en' => 'New Energy & Power', 'title_zh' => '新能源与电力', 'desc_en' => 'Copper solutions for EV connectors, charging systems and photovoltaics.', 'desc_zh' => '应用于新能源汽车连接器、充电系统与光伏领域。'],
        ['icon' => 'bi-plug-fill', 'title_en' => 'Connectors & Relays', 'title_zh' => '连接器与继电器', 'desc_en' => 'High conductivity and fatigue resistance for reliable signal connection.', 'desc_zh' => '高导电、抗疲劳，满足可靠信号连接需求。'],
        ['icon' => 'bi-fan', 'title_en' => 'Thermal & Consumer Electronics', 'title_zh' => '散热与消费电子', 'desc_en' => 'Precision copper materials for heat dissipation and electronics.', 'desc_zh' => '精密铜材用于散热及消费电子产品。'],
      ];
    @endphp
    <div class="sc-solutions-list">
      @foreach($solutions as $s)
        <a href="/articles" class="sc-solution-item">
          <span class="sc-solution-item__icon"><i class="bi {{ $s['icon'] }}" aria-hidden="true"></i></span>
          <span class="sc-solution-item__content">
            <span class="sc-solution-item__title">{{ $isEn ? $s['title_en'] : $s['title_zh'] }}</span>
            <span class="sc-solution-item__desc">{{ $isEn ? $s['desc_en'] : $s['desc_zh'] }}</span>
          </span>
          <i class="bi bi-arrow-up-right sc-solution-item__arrow" aria-hidden="true"></i>
        </a>
      @endforeach
    </div>
  </div>
</section>

{{-- ===== 5. 铜材价格行情 ===== --}}
@php
  $copperMarkets = [
    'ccmn' => ['zh' => '长江有色', 'en' => 'Yangtze Nonferrous', 'unit' => '元 / 吨'],
    'smm'  => ['zh' => '上海有色', 'en' => 'SMM Shanghai Nonferrous', 'unit' => '元 / 吨'],
    'lme'  => ['zh' => 'LME伦敦', 'en' => 'LME London', 'unit' => '美元 / 吨'],
  ];
  $copperRows = \InnoCMS\Common\Models\CopperPrice::query()
      ->where('price_date', '>=', now()->subYear()->toDateString())
      ->orderBy('price_date')
      ->get(['price_date', 'market', 'copper_price', 'currency']);
  $copperSeries = [];
  foreach ($copperRows as $row) {
      $copperSeries[$row->market][] = ['d' => $row->price_date->format('Y-m-d'), 'v' => $row->copper_price, 'c' => $row->currency];
  }
  $copperLatest = [];
  foreach ($copperMarkets as $code => $m) {
      $arr = $copperSeries[$code] ?? [];
      $copperLatest[$code] = $arr ? end($arr) : null;
  }
  $copperMinDate = $copperRows->first() ? $copperRows->first()->price_date->format('Y-m-d') : '';
  $copperMaxDate = $copperRows->last() ? $copperRows->last()->price_date->format('Y-m-d') : '';
@endphp
<section class="sc-section sc-price-market" aria-label="Copper Market Prices">
  <div class="container">
    <div class="sc-section-heading">
      <h2 class="module-title"><span class="gradient-text">@if($isEn) Copper Market Prices @else 铜材价格行情 @endif</span></h2>
      <p class="module-sub-title">@if($isEn) Focus on price movements across major markets to support your copper sourcing decisions.<br>Subscribe by clicking <button type="button" class="sc-price-market__subscribe sc-price-market__subscribe--inline" id="copper-subscribe"><i class="bi bi-bell"></i> Price Alert</button> below, and we'll push daily prices via WeChat, so you can review historical trends anytime. @else 聚焦主要市场价格变化，为铜材采购与方案决策提供参考。<br>如需订阅，点击下方 <button type="button" class="sc-price-market__subscribe sc-price-market__subscribe--inline" id="copper-subscribe"><i class="bi bi-bell"></i> 铜价订阅</button>，我们将每天通过微信公众号为您推送当日铜价，助您随时回顾历史行情。 @endif</p>
    </div>

    <div class="sc-price-market__panel">
      <div class="sc-price-market__topline">
        <div>
          <span class="sc-price-market__eyebrow">@if($isEn) Market Reference · Based on Yangtze Nonferrous &amp; LME London prices @else 市场参考 · 基于长江有色金属网与伦敦 LME 市场价格 @endif</span>
        </div>
      </div>

      <div class="sc-price-market__body">
        <div class="sc-price-market__cards" id="copper-cards">
          @foreach($copperMarkets as $code => $m)
            <div class="sc-price-market__card sc-price-market__card--{{ $code }}" data-market="{{ $code }}">
              <strong>{{ $isEn ? $m['en'] : $m['zh'] }}</strong>
              <b class="sc-price-market__card-value" data-target="0">0</b>
              <i class="sc-price-market__card-unit">{{ $m['unit'] }}</i>
            </div>
          @endforeach
        </div>

        <div class="sc-price-market__right">
          <div class="sc-price-market__filters">
            <div class="sc-price-market__markets" id="copper-market-filter">
              @foreach($copperMarkets as $code => $m)
                <span data-market="{{ $code }}" class="{{ $code === 'ccmn' ? 'is-active' : '' }}">{{ $m['zh'] }}</span>
              @endforeach
            </div>
            <div class="sc-price-market__ranges" id="copper-range-filter">
              <div class="sc-price-market__daterange" id="copper-date-filter">
                <span class="sc-price-market__date-toggle" id="copper-date-toggle"><i class="bi bi-calendar3"></i>@if($isEn) Date @else 日期 @endif</span>
                <div class="sc-price-market__date-panel" id="copper-date-panel">
                  <div class="sc-price-market__date-field"><label>@if($isEn) From @else 开始日期 @endif</label><input type="date" id="copper-date-start" min="{{ $copperMinDate }}" max="{{ $copperMaxDate }}"></div>
                  <div class="sc-price-market__date-field"><label>@if($isEn) To @else 结束日期 @endif</label><input type="date" id="copper-date-end" min="{{ $copperMinDate }}" max="{{ $copperMaxDate }}"></div>
                  <div class="sc-price-market__date-actions">
                    <button type="button" id="copper-date-apply">@if($isEn) Apply @else 应用 @endif</button>
                    <button type="button" id="copper-date-clear">@if($isEn) Clear @else 清除 @endif</button>
                  </div>
                </div>
              </div>
              <span data-days="7" class="is-active">@if($isEn) 7 Days @else 近七天 @endif</span>
              <span data-days="15">@if($isEn) 15 Days @else 近15天 @endif</span>
              <span data-days="30">@if($isEn) Month @else 月 @endif</span>
              <span data-days="90">@if($isEn) Quarter @else 季度 @endif</span>
              <span data-days="365">@if($isEn) Year @else 年 @endif</span>
            </div>
          </div>

          <div class="sc-price-market__chart" id="copper-chart" aria-label="Copper price trend chart"></div>
        </div>
      </div>

      <p class="sc-price-market__note">@if($isEn) Reference data for communication only; final settlement follows the confirmed quotation. @else 数据仅供沟通参考，最终结算以双方确认的报价为准。 @endif</p>
    </div>
  </div>
</section>
<link rel="stylesheet" href="{{ asset('css/apexcharts.css') }}">
<script src="{{ asset('js/apexcharts.min.js') }}"></script>
<script>
(function () {
  var COPPER_SERIES = @json($copperSeries);
  var COPPER_LATEST = @json($copperLatest);
  var COPPER_MARKETS = @json($copperMarkets);
  var currentMarket = 'ccmn';
  var currentDays = 7;
  var customStart = null;
  var customEnd = null;
  var copperChart = null;

  function fmt(v) {
    return Number(v).toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
  }

  function animateNumber(el, target) {
    if (!el) return;
    var duration = 1100;
    var start = performance.now();
    function step(now) {
      var p = Math.min((now - start) / duration, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = fmt(target * eased);
      if (p < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }

  function renderCards() {
    Object.keys(COPPER_MARKETS).forEach(function (code) {
      var arr = COPPER_SERIES[code] || [];
      var last = arr[arr.length - 1];
      var card = document.querySelector('.sc-price-market__card[data-market="' + code + '"]');
      if (!card) return;
      var valEl = card.querySelector('.sc-price-market__card-value');
      var unitEl = card.querySelector('.sc-price-market__card-unit');
      if (last) {
        animateNumber(valEl, last.v);
        unitEl.textContent = last.d + '丨' + (last.c === 'usd' ? '美元/吨' : '元/吨');
      } else {
        valEl.textContent = '--';
        unitEl.textContent = '--';
      }
    });
  }

  function seriesFor(code) {
    var arr = COPPER_SERIES[code] || [];
    if (customStart || customEnd) {
      var s = customStart ? new Date(customStart + 'T00:00:00').getTime() : -Infinity;
      var e = customEnd ? new Date(customEnd + 'T00:00:00').getTime() : Infinity;
      return arr.filter(function (p) {
        var t = new Date(p.d + 'T00:00:00').getTime();
        return t >= s && t <= e;
      }).map(function (p) { return [new Date(p.d + 'T00:00:00').getTime(), p.v]; });
    }
    var cutoff = Date.now() - currentDays * 86400000;
    return arr.filter(function (p) { return new Date(p.d + 'T00:00:00').getTime() >= cutoff; })
              .map(function (p) { return [new Date(p.d + 'T00:00:00').getTime(), p.v]; });
  }

  function buildChart() {
    var codes = currentMarket === 'all' ? ['ccmn', 'smm', 'lme'] : [currentMarket];
    var hasLme = codes.indexOf('lme') !== -1;
    var hasOthers = codes.some(function (c) { return c !== 'lme'; });

    var series = codes.map(function (code) {
      var meta = COPPER_MARKETS[code] || {};
      var s = { name: meta.zh || code, data: seriesFor(code) };
      if (hasLme && hasOthers && code === 'lme') s.yAxisIndex = 1;
      return s;
    });

    // Y 轴最大值 = 全量数据最高点 + 500（元）/ +50（美元），固定不随筛选变化
    var maxCny = 0;
    var maxUsd = 0;
    ['ccmn', 'smm', 'lme'].forEach(function (code) {
      var arr = COPPER_SERIES[code] || [];
      arr.forEach(function (p) {
        if (code === 'lme') { maxUsd = Math.max(maxUsd, p.v); }
        else { maxCny = Math.max(maxCny, p.v); }
      });
    });
    var fmtLabel = function (v) { return fmt(v); };

    var yaxis;
    if (hasLme && hasOthers) {
      yaxis = [
        { max: maxCny > 0 ? maxCny + 500 : undefined, labels: { formatter: fmtLabel } },
        { opposite: true, max: maxUsd > 0 ? maxUsd + 50 : undefined, labels: { formatter: fmtLabel } },
      ];
    } else if (hasLme) {
      yaxis = [{ max: maxUsd > 0 ? maxUsd + 50 : undefined, labels: { formatter: fmtLabel } }];
    } else {
      yaxis = [{ max: maxCny > 0 ? maxCny + 500 : undefined, labels: { formatter: fmtLabel } }];
    }

    var options = {
      series: series,
      chart: {
        type: 'area',
        height: 360,
        fontFamily: 'inherit',
        toolbar: { show: true, tools: { zoom: true, zoomin: true, zoomout: true, pan: false, reset: true } },
        zoom: { enabled: true, type: 'x', autoScaleYaxis: true },
      },
      colors: ['#c52c29', '#1a73e8', '#f39800'],
      dataLabels: { enabled: false },
      stroke: { curve: 'smooth', width: 2 },
      fill: {
        type: 'gradient',
        gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0, stops: [0, 90, 100] },
      },
      markers: { size: 0 },
      xaxis: { type: 'datetime' },
      yaxis: yaxis,
      tooltip: {
        enabled: true,
        shared: hasOthers && hasLme,
        intersect: false,
        x: { format: 'yyyy-MM-dd' },
        y: { formatter: function (v) { return fmt(v); } },
      },
      grid: { borderColor: '#eef0f3', strokeDashArray: 4 },
      legend: { position: 'top', horizontalAlign: 'center', showForSingleSeries: true },
    };

    if (copperChart) { copperChart.destroy(); copperChart = null; }
    copperChart = new ApexCharts(document.querySelector('#copper-chart'), options);
    copperChart.render();
  }

  function bindFilters() {
    document.querySelectorAll('#copper-market-filter span').forEach(function (el) {
      el.addEventListener('click', function () {
        document.querySelectorAll('#copper-market-filter span').forEach(function (s) { s.classList.remove('is-active'); });
        el.classList.add('is-active');
        currentMarket = el.getAttribute('data-market');
        buildChart();
      });
    });
    document.querySelectorAll('#copper-range-filter span[data-days]').forEach(function (el) {
      el.addEventListener('click', function () {
        document.querySelectorAll('#copper-range-filter span[data-days]').forEach(function (s) { s.classList.remove('is-active'); });
        el.classList.add('is-active');
        currentDays = parseInt(el.getAttribute('data-days'), 10);
        customStart = null;
        customEnd = null;
        buildChart();
      });
    });

    var dateToggle = document.getElementById('copper-date-toggle');
    var datePanel = document.getElementById('copper-date-panel');
    var dateStart = document.getElementById('copper-date-start');
    var dateEnd = document.getElementById('copper-date-end');
    var dateApply = document.getElementById('copper-date-apply');
    var dateClear = document.getElementById('copper-date-clear');
    if (dateToggle && datePanel) {
      dateToggle.addEventListener('click', function (e) {
        e.stopPropagation();
        datePanel.classList.toggle('is-open');
      });
      document.addEventListener('click', function (e) {
        if (!datePanel.contains(e.target) && e.target !== dateToggle) {
          datePanel.classList.remove('is-open');
        }
      });
    }
    if (dateApply) {
      dateApply.addEventListener('click', function () {
        var s = dateStart.value;
        var e = dateEnd.value;
        if (s && !e) e = s;
        if (e && !s) s = e;
        customStart = s || null;
        customEnd = e || null;
        document.querySelectorAll('#copper-range-filter span[data-days]').forEach(function (x) { x.classList.remove('is-active'); });
        datePanel.classList.remove('is-open');
        buildChart();
      });
    }
    if (dateClear) {
      dateClear.addEventListener('click', function () {
        customStart = null;
        customEnd = null;
        dateStart.value = '';
        dateEnd.value = '';
        currentDays = 7;
        document.querySelectorAll('#copper-range-filter span[data-days]').forEach(function (x) { x.classList.remove('is-active'); });
        var d7 = document.querySelector('#copper-range-filter span[data-days="7"]');
        if (d7) d7.classList.add('is-active');
        datePanel.classList.remove('is-open');
        buildChart();
      });
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    renderCards();
    if (typeof ApexCharts !== 'undefined' && document.getElementById('copper-chart')) {
      buildChart();
    }
    bindFilters();
    var sub = document.getElementById('copper-subscribe');
    if (sub) {
      sub.addEventListener('click', function () {
        var old = sub.innerHTML;
        sub.innerHTML = '<i class="bi bi-bell"></i> 即将上线';
        setTimeout(function () { sub.innerHTML = old; }, 2000);
      });
    }
  });
})();
</script>

{{-- ===== 6. 关于双张新材 ===== --}}
<section class="sc-section sc-about-copy" aria-label="About Shunchung New Materials">
  <div class="container">
    <div class="sc-about-copy__inner">
      <span class="sc-about-copy__eyebrow">@if($isEn) SINCE 2001 @else SINCE 2001 @endif</span>
      <h2 class="module-title"><span class="gradient-text">@if($isEn) Tracing the steps of our journey @else 回望来时路，每一步都作数 @endif</span></h2>
      <p class="module-sub-title">@if($isEn) Since 2001, advancing the high-precision shaped copper industry through focused expertise and continuous innovation. @else 自2001年起，深耕高精度异形铜材，持续推动行业技术与制造能力进步。 @endif</p>
      <div class="sc-about-copy__grid">
        <div class="sc-about-copy__media">
          <div class="sc-about-copy__collage">
            <img src="{{ asset('images/about-2001-02.jpg') }}" alt="@if($isEn) Shunchung factory @else 双张工厂 @endif 1" class="sc-about-copy__img sc-about-copy__img--tall">
            <img src="{{ asset('images/about-2001-01.jpg') }}" alt="@if($isEn) Shunchung factory @else 双张工厂 @endif 2" class="sc-about-copy__img">
            <img src="{{ asset('images/about-2001-03.jpg') }}" alt="@if($isEn) Shunchung factory @else 双张工厂 @endif 3" class="sc-about-copy__img">
            <img src="{{ asset('images/about-2001-04.jpg') }}" alt="@if($isEn) Shunchung factory @else 双张工厂 @endif 4" class="sc-about-copy__img sc-about-copy__img--wide">
          </div>
        </div>
        <div class="sc-about-copy__body">
          @if($isEn)
            <p>Shanghai Shunchung New Materials Technology Co., Ltd. (formerly Shanghai Zhengfeng Metal Materials Factory) laid its foundation in 2001. Founded in Fengxian, Shanghai by Mr. Zhang Xiuming and Ms. Zhang Meifang, Shunchung is among the earliest private pioneers in China's high-precision, multi-gauge copper alloy industry.</p>
            <p>After over two decades of relentless R&amp;D investment, Shunchung has grown from early technical exploration to rapid development, transforming into a certified National High-Tech Enterprise. Our pursuit of excellence was formalized as early as 2007 through ISO 9001 quality management system certification, and has been upheld at every stage of the company's development.</p>
            <p>From the transformation of the home appliance and smartphone eras to the surge of New Energy Vehicles (NEV) and the dawn of Artificial Intelligence (AI), Shunchung has always been a witness and key contributor to technological progress in China and worldwide. We are committed to delivering core conductive and thermal solutions that power the technologies of tomorrow.</p>
            <p>Looking ahead, Shunchung will stay focused on professional shaped materials as its core business, uphold the "small but beautiful" philosophy, and forge the spirit of Chinese craftsmanship with a relentless pursuit of precision, delivering the finest precision copper solutions to global customers.</p>
          @else
            <p>上海双张新材料科技有限公司（前身为上海正枫金属材料厂）的企业根基奠基于2001年。公司由张秀明先生与张美芳女士在上海奉贤创立，是中国高精度多规格铜合金行业中最早崛起的民营先驱之一。</p>
            <p>经过二十余年坚持不懈的研发投入，双张从初期的技术摸索到如今的快速成长，已成功蜕变为"国家高新技术企业"。我们对卓越品质的追求，早在2007年便通过ISO 9001质量管理体系认证得以确立，并始终贯穿于企业发展的每一个阶段。</p>
            <p>从传统家电与智能手机时代的变革，到新能源汽车（NEV）产业的爆发与人工智能（AI）时代的曙光，双张始终是中国乃至全球技术进步的见证者与重要贡献者。我们致力于提供核心的导电与散热解决方案，为驱动未来的科技发展贡献力量。</p>
            <p>展望未来，双张将始终坚持以专业异形材料为核心主业，秉持"小而美"的发展理念，以精益求精的态度铸造中国工匠精神，为全球客户提供极致的精密铜材解决方案。</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===== 7. 客户 Logo 跑马灯 ===== --}}
<section class="sc-section sc-clients-showcase" aria-label="Trusted Customers">
  <div class="container">
    <div class="sc-section-heading">
      <h2 class="module-title"><span class="gradient-text">@if($isEn) Trusted by Global Manufacturers @else 服务全球高端制造客户 @endif</span></h2>
      <p class="module-sub-title">@if($isEn) Long-term partnerships across semiconductor, new energy, connectors, thermal management and consumer electronics. @else 长期合作伙伴遍及半导体、新能源、连接器、热管理与消费电子行业。 @endif</p>
    </div>
  </div>
  <div class="sc-clients-marquee">
    <div class="sc-clients-marquee__track">
      @for($round = 0; $round < 2; $round++)
        @for($i = 1; $i <= 12; $i++)
          <div class="sc-client-logo"><img src="{{ asset('images/customer-logos/customer-logo-'.str_pad($i, 2, '0', STR_PAD_LEFT).'.jpg') }}" alt="@if($isEn) Customer partner @else 客户合作伙伴 @endif {{ $i }}"></div>
        @endfor
      @endfor
    </div>
  </div>
</section>

{{-- ===== 8. 定制铜材方案 ===== --}}
<section class="sc-cta sc-custom-quote">
  <div class="container sc-cta__inner">
    <span class="sc-custom-quote__eyebrow">@if($isEn) ENGINEERED FOR YOUR APPLICATION @else 为您的需求量身定制 @endif</span>
    <h2>@if($isEn) Need a Custom Copper Solution? @else 需要定制铜材方案？ @endif</h2>
    <p>@if($isEn) Share your email, drawing or specification. Our engineering team will respond within 24 hours. @else 留下您的邮箱并上传图纸或规格，我们的工程师团队将在 24 小时内回复。 @endif</p>
    <form id="home-quote-form" class="sc-quote-form">
      @csrf
      <div class="sc-quote-form__body">
        <label class="sc-quote-form__message">
          <textarea name="content" required rows="4" placeholder="@if($isEn) Tell us about your copper material needs... @else 请描述您的铜材需求、规格或应用场景... @endif"></textarea>
        </label>
        <div class="sc-quote-form__bottom">
          <label class="sc-quote-form__email">
            <input type="email" name="email" required placeholder="@if($isEn) Your business email @else 您的工作邮箱 @endif">
          </label>
          <label class="sc-quote-form__file" title="{{ $isEn ? 'Attach drawing or specification' : '上传图纸或规格附件' }}">
            <i class="bi bi-paperclip"></i>
            <span class="sc-quote-form__file-label" data-default="{{ $isEn ? 'Upload' : '上传图纸' }}">{{ $isEn ? 'Upload' : '上传图纸' }}</span>
            <input type="file" id="home-quote-file" accept=".jpg,.jpeg,.png,.gif,.webp,.zip,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf,.mp4">
          </label>
          <button type="submit" id="home-quote-submit" class="btn btn-light"><span><i class="bi bi-envelope me-2"></i>@if($isEn) SEND NOW @else 立即发送 @endif</span></button>
        </div>
      </div>
      <div id="home-quote-alert" class="sc-quote-form__alert" role="status" aria-live="polite"></div>
    </form>
  </div>
</section>

{{-- 提交成功弹窗 --}}
<div id="home-quote-modal" class="sc-quote-modal" role="dialog" aria-modal="true" aria-hidden="true">
  <div class="sc-quote-modal__mask" data-close></div>
  <div class="sc-quote-modal__dialog">
    <div class="sc-quote-modal__icon"><i class="bi bi-check-lg"></i></div>
    <h3 class="sc-quote-modal__title">@if($isEn) Submitted Successfully @else 提交成功 @endif</h3>
    <p class="sc-quote-modal__text">@if($isEn) We will contact you shortly. @else 我们将尽快联系您。 @endif</p>
    <button type="button" class="sc-quote-modal__btn" data-close>@if($isEn) OK @else 知道了 @endif</button>
  </div>
</div>

@endsection

@push('footer')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const stats = document.querySelector('.sc-stats');
  const values = document.querySelectorAll('.sc-stats__value');
  if (!stats || !values.length) return;

  const animate = function () {
    if (stats.dataset.animated) return;
    stats.dataset.animated = 'true';
    values.forEach(function (value) {
      const target = Number(value.dataset.target || 0);
      const start = performance.now();
      const duration = 1500;
      const step = function (now) {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        value.textContent = Math.floor(target * eased).toLocaleString();
        if (progress < 1) window.requestAnimationFrame(step);
      };
      window.requestAnimationFrame(step);
    });
  };

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(function (entries) {
      if (entries.some(function (entry) { return entry.isIntersecting; })) {
        animate();
        observer.disconnect();
      }
    }, { threshold: 0.2 });
    observer.observe(stats);
  } else {
    animate();
  }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var form = document.getElementById('home-quote-form');
  if (!form) return;
  var fileInput = document.getElementById('home-quote-file');
  var fileWrap = document.querySelector('.sc-quote-form__file');
  var fileLabel = document.querySelector('.sc-quote-form__file-label');
  var fileLabelDefault = fileLabel ? (fileLabel.getAttribute('data-default') || '上传图纸') : '上传图纸';
  var alertEl = document.getElementById('home-quote-alert');
  var submit = document.getElementById('home-quote-submit');
  var uploadUrl = '{{ front_route('upload.files') }}';
  var submitUrl = '{{ front_route('contacts.store') }}';

  var modal = document.getElementById('home-quote-modal');
  function showQuoteModal() {
    if (!modal) return;
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
  }
  function closeQuoteModal() {
    if (!modal) return;
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
  }
  if (modal) {
    modal.querySelectorAll('[data-close]').forEach(function (el) {
      el.addEventListener('click', closeQuoteModal);
    });
  }

  fileInput.addEventListener('change', function () {
    if (fileInput.files[0]) {
      fileWrap.classList.add('has-file');
      fileLabel.textContent = fileInput.files[0].name;
    } else {
      fileWrap.classList.remove('has-file');
      fileLabel.textContent = fileLabelDefault;
    }
  });
  form.addEventListener('submit', function (event) {
    event.preventDefault();
    alertEl.textContent = '';
    submit.disabled = true;
    var payload = new FormData(form);
    var uploadPromise = Promise.resolve(null);
    if (fileInput.files[0]) {
      var upload = new FormData();
      upload.append('file', fileInput.files[0]);
      upload.append('type', 'contact-attachments');
      uploadPromise = axios.post(uploadUrl, upload).then(function (response) {
        var data = response.data.data || response.data;
        payload.set('attachment', data.value || data.url || data.origin_url || fileInput.files[0].name);
        return data;
      });
    }
    uploadPromise.then(function () { return axios.post(submitUrl, payload); })
      .then(function (response) {
        var data = response.data;
        if (!data.success) throw new Error(data.message || 'submit failed');
        showQuoteModal();
        form.reset();
        fileWrap.classList.remove('has-file');
        fileLabel.textContent = fileLabelDefault;
      })
      .catch(function (error) {
        alertEl.className = 'sc-quote-form__alert is-error';
        alertEl.textContent = error.message || '@if($isEn) Submission failed. Please try again. @else 提交失败，请稍后重试。 @endif';
      })
      .then(function () { submit.disabled = false; });
  });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var viewer = document.getElementById('hero-model');
  if (!viewer) return;

  var models = @json($heroModels);
  var current = 0;
  var timer = null;

  var prevBtn = document.querySelector('.sc-hero-arrow--prev');
  var nextBtn = document.querySelector('.sc-hero-arrow--next');
  var box = document.querySelector('.sc-hero-new__3d');

  function render() {
    viewer.setAttribute('src', models[current].src);
  }

  function go(i) {
    current = (i + models.length) % models.length;
    render();
    startTimer();
  }

  function next() { go(current + 1); }
  function prev() { go(current - 1); }

  if (prevBtn) prevBtn.addEventListener('click', prev);
  if (nextBtn) nextBtn.addEventListener('click', next);

  // 转完一圈再切换：rotation-per-second=14deg，一圈 360/14 ≈ 25.7 秒
  function startTimer() {
    stopTimer();
    timer = setInterval(next, 25700);
  }
  function stopTimer() {
    if (timer) { clearInterval(timer); timer = null; }
  }

  if (box) {
    box.addEventListener('mouseenter', stopTimer);
    box.addEventListener('mouseleave', startTimer);
  }

  render();
  startTimer();
});
</script>
@endpush
