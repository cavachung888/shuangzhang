@extends('layouts.app')

@section('body-class', 'page-about')

@php
  $isEn = app()->getLocale() === 'en';

  $faqs = [
    ['q_zh' => '你们的异型材料怎么样？', 'q_en' => 'How is your shaped copper material?',
     'a_zh' => '我们专注高精度异型铜材二十余年，截面精度可达微米级，尺寸一致性与表面质量稳定，已广泛用于半导体引线框架、功率模块、连接器、散热器件等严苛场景。',
     'a_en' => 'We have focused on high-precision shaped copper for over 20 years, with cross-section accuracy down to the micron level and stable dimensional consistency, widely used in semiconductor lead frames, power modules, connectors and thermal devices.'],
    ['q_zh' => '能按我们的图纸定制吗？', 'q_en' => 'Can you customize to our drawings?',
     'a_zh' => '完全可以。我们支持来图定制，从截面设计、模具开发到打样、量产全程配合，工程师还会针对可制造性给出优化建议。',
     'a_en' => 'Absolutely. We support drawing-based customization, cooperating through cross-section design, tooling development, sampling and mass production, with manufacturability advice from our engineers.'],
    ['q_zh' => '最小起订量是多少？', 'q_en' => 'What is the minimum order quantity?',
     'a_zh' => '我们支持小批量试产，具体起订量依规格、牌号与工艺而定。欢迎提供图纸，我们评估后给出方案。',
     'a_en' => 'We support small-batch trial production; the exact MOQ depends on specification, alloy and process. Send us your drawing and we will propose a plan.'],
    ['q_zh' => '交货周期大概多久？', 'q_en' => 'What is the lead time?',
     'a_zh' => '常规规格约 2–4 周，涉及定制模具需额外增加开发周期。下单后我们会明确排产交期并全程跟进。',
     'a_en' => 'Standard specifications take about 2–4 weeks; custom tooling adds development time. We confirm the delivery schedule after ordering and track it throughout.'],
    ['q_zh' => '铜带最薄能做到多少？', 'q_en' => 'How thin can the strip go?',
     'a_zh' => '冷轧铜带最薄可做到 0.05mm 以下，具体取决于材料牌号与宽度，欢迎提供规格评估。',
     'a_en' => 'Cold-rolled copper strip can go below 0.05mm, depending on alloy and width. Share your spec and we will evaluate.'],
    ['q_zh' => '你们用什么铜材原料？', 'q_en' => 'What raw material do you use?',
     'a_zh' => '主要采用 C19210、C11000 等高纯度电解铜及铜合金，原料可追溯，并可随货提供材质证明。',
     'a_en' => 'We mainly use high-purity electrolytic copper and alloys such as C19210 and C11000, fully traceable, with material certificates shipped together.'],
    ['q_zh' => '质量如何保证？', 'q_en' => 'How is quality assured?',
     'a_zh' => '我们拥有完善的检测设备与流程，从化学成分、力学性能到尺寸公差进行全流程控制，出厂附检测报告。',
     'a_en' => 'We have complete testing equipment and processes, controlling chemical composition, mechanical properties and dimensional tolerance end to end, with inspection reports on delivery.'],
    ['q_zh' => '如何获取报价？', 'q_en' => 'How do I get a quotation?',
     'a_zh' => '您可在线提交需求或图纸，工程师会在 1–2 个工作日内回复报价与方案。',
     'a_en' => 'Submit your requirements or drawing online and our engineers will reply with a quotation and plan within 1–2 business days.'],
  ];

  $sustain = [
    ['icon' => 'bi-recycle', 'title_zh' => '100% 可回收', 'title_en' => '100% Recyclable',
     'desc_zh' => '铜是可无限循环的金属，回收后性能不衰减。我们最大限度让铜材循环利用，减少原生资源消耗。',
     'desc_en' => 'Copper is infinitely recyclable without performance loss. We maximize material recycling to reduce primary resource consumption.'],
    ['icon' => 'bi-arrow-repeat', 'title_zh' => '边角料回收', 'title_en' => 'Scrap Recovery',
     'desc_zh' => '生产过程中的边角料与切屑实现 100% 回收再利用，从源头减少浪费，让每一克铜都被善用。',
     'desc_en' => 'Edge scrap and chips are 100% recovered and reused, reducing waste at the source so every gram of copper is well used.'],
    ['icon' => 'bi-lightning-charge', 'title_zh' => '节能工艺', 'title_en' => 'Energy Efficiency',
     'desc_zh' => '持续优化轧制与热处理工艺，降低单位能耗与排放，推动绿色制造与低碳生产。',
     'desc_en' => 'We continuously optimize rolling and heat-treatment processes to cut energy and emissions, advancing green, low-carbon manufacturing.'],
    ['icon' => 'bi-globe2', 'title_zh' => '循环经济', 'title_en' => 'Circular Economy',
     'desc_zh' => '从原料采购到生产交付，全程关注环境影响，携手客户与供应商共建可持续的铜材供应链。',
     'desc_en' => 'From sourcing to delivery, we consider environmental impact throughout and build a sustainable copper supply chain with partners.'],
  ];

  $testimonials = [
    ['logo' => 'CJ', 'name_zh' => '陈建国', 'role_zh' => '采购经理 · 功率半导体企业', 'name_en' => 'Chen Jianguo', 'role_en' => 'Procurement Manager · Power Semiconductor',
     'quote_zh' => '双张的异型铜带尺寸一致性非常好，替换进口后我们的封装良率明显提升，交货也一直很稳定。',
     'quote_en' => 'Shunchung\'s shaped copper strip is highly consistent. After replacing imports, our packaging yield improved noticeably and delivery stayed reliable.'],
    ['logo' => 'LH', 'name_zh' => '李海峰', 'role_zh' => '技术总监 · 连接器制造企业', 'name_en' => 'Li Haifeng', 'role_en' => 'Technical Director · Connector Manufacturer',
     'quote_zh' => '从打样到量产响应很快，工程师给的可制造性建议非常专业，帮我们省下了大量开发时间。',
     'quote_en' => 'Fast response from sampling to production, and the manufacturability advice from engineers is highly professional, saving us a lot of development time.'],
    ['logo' => 'ZM', 'name_zh' => '张明', 'role_zh' => '质量经理 · 引线框架企业', 'name_en' => 'Zhang Ming', 'role_en' => 'Quality Manager · Lead Frame Maker',
     'quote_zh' => '材质证明和检测报告齐全，来料检验长期稳定，是我们信得过的长期供应商。',
     'quote_en' => 'Complete material certificates and inspection reports with consistently stable incoming inspection. A long-term supplier we trust.'],
    ['logo' => 'WK', 'name_zh' => '王凯', 'role_zh' => '总经理 · 散热器件企业', 'name_en' => 'Wang Kai', 'role_en' => 'General Manager · Thermal Device Maker',
     'quote_zh' => '合作五年了，双张始终把质量放在第一位，遇到问题响应及时，是值得信赖的伙伴。',
     'quote_en' => 'Five years of cooperation. Shunchung always puts quality first and responds promptly, a partner worth trusting.'],
  ];
@endphp

@section('content')

{{-- 1. 视频 Banner --}}
<section class="sc-about-hero">
  <video class="sc-about-hero__video" autoplay muted loop playsinline preload="metadata" poster="{{ asset('images/bg-hero-copper.jpg') }}">
    <source src="{{ asset('videos/about-banner.mp4') }}" type="video/mp4">
  </video>
  <div class="sc-about-hero__veil"></div>
  <div class="sc-about-hero__content">
    <span class="sc-about-hero__eyebrow">@if($isEn) About Shunchung @else 关于双张新材 @endif</span>
    <h1 class="sc-about-hero__title">@if($isEn) Forged by Craft, Refined in Precision @else 源于匠心，淬炼精密 @endif</h1>
    <p class="sc-about-hero__sub">@if($isEn) From smelting to final rolling, consistency controlled at every step. @else 从冶炼到最终轧制，步步严控一致性 @endif</p>
  </div>
</section>

{{-- 2. 我们专注于 --}}
<section class="sc-about-focus">
  <div class="container">
    <div class="sc-about-focus__inner">
      <h2 class="sc-about-focus__title">@if($isEn) What We Focus On @else 我们专注于 @endif</h2>
      <div class="sc-about-focus__body">
        @if($isEn)
          <p>We focus on manufacturing high-precision shaped copper strip. Since its founding in 2001, Shanghai Shunchung New Materials Technology Co., Ltd. (formerly Shanghai Zhengfeng Metal Materials Factory) has devoted over two decades to a single pursuit — pushing the precision of shaped copper to the limit.</p>
          <p>Guided by our customers' applications and specifications, we shape copper and copper alloys into profiles with micron-level accuracy through precision cold rolling, planing, roll-forming and continuous extrusion, serving lead frames, power modules, connectors and thermal devices across the semiconductor and power-electronics industries.</p>
          <p>From quality control at the smelting stage to dimensional consistency in final rolling, we operate a full-process quality system that keeps every coil traceable in composition, performance and dimension. Whether it is a small trial run or full-scale production, we treat every meter with the same craftsmanship and standard, so that every coil stands up to the most demanding applications.</p>
        @else
          <p>我们专注于生产高精度异型铜带。上海双张新材料科技有限公司（前身上海正丰金属材料厂）自 2001 年创立以来，二十余年只专注一件事——把异型铜材的精度做到极致。</p>
          <p>我们以客户的应用场景与规格需求为导向，依托精密冷轧、刨切、挫轧、连续挤压等成型工艺，将铜及铜合金加工成截面精度达微米级的异型铜带、铜排与铜段，广泛服务于引线框架、功率模块、连接器、散热器件等半导体与功率电子领域。</p>
          <p>从原料冶炼环节的品质把控，到最终轧制的尺寸一致性，我们建立了覆盖全流程的质量控制体系，确保每一卷铜材的成分、性能与尺寸都稳定可追溯。无论是小批量试制还是规模化量产，我们都以同样的匠心与标准对待，让每一米铜带都经得起严苛应用场景的检验。</p>
        @endif
      </div>
    </div>
  </div>
</section>

{{-- 3. 为什么选择双张（问答） --}}
<section class="sc-about-faq">
  <div class="container">
    <h2 class="sc-about-faq__title">@if($isEn) Why Choose Shunchung @else 为什么选择双张 @endif</h2>
    <p class="sc-about-faq__sub">@if($isEn) Answers to the questions our customers ask most. @else 关于我们最常被问到的问题，为您一一解答。 @endif</p>
    <div class="sc-about-faq__list">
      @foreach($faqs as $faq)
        <details class="sc-about-faq__item">
          <summary class="sc-about-faq__q">
            <span class="sc-about-faq__num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
            <span>{{ $isEn ? $faq['q_en'] : $faq['q_zh'] }}</span>
            <i class="bi bi-plus-lg sc-about-faq__icon" aria-hidden="true"></i>
          </summary>
          <div class="sc-about-faq__a">{{ $isEn ? $faq['a_en'] : $faq['a_zh'] }}</div>
        </details>
      @endforeach
    </div>
  </div>
</section>

{{-- 4. 可持续性 --}}
<section class="sc-about-sustain">
  <div class="container">
    <h2 class="sc-about-sustain__title">@if($isEn) Sustainability @else 可持续性 @endif</h2>
    <p class="sc-about-sustain__sub">@if($isEn) Recycling and environmental responsibility are built into everything we make. @else 回收与环保，融入我们制造的每一个环节。 @endif</p>
    <div class="sc-about-sustain__grid">
      @foreach($sustain as $s)
        <div class="sc-about-sustain__card">
          <span class="sc-about-sustain__icon"><i class="bi {{ $s['icon'] }}"></i></span>
          <h3>{{ $isEn ? $s['title_en'] : $s['title_zh'] }}</h3>
          <p>{{ $isEn ? $s['desc_en'] : $s['desc_zh'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- 5. 客户评价 --}}
<section class="sc-about-testimonials">
  <div class="container">
    <h2 class="sc-about-testimonials__title">@if($isEn) What Our Clients Say @else 客户评价 @endif</h2>
    <p class="sc-about-testimonials__sub">@if($isEn) Trusted by customers across semiconductors, power electronics and more. @else 来自半导体、功率电子等领域的客户信赖之选。 @endif</p>
    <div class="sc-about-testimonials__grid">
      @foreach($testimonials as $t)
        <figure class="sc-about-tcard">
          <div class="sc-about-tcard__head">
            <span class="sc-about-tcard__logo">{{ $t['logo'] }}</span>
            <div>
              <figcaption class="sc-about-tcard__name">{{ $isEn ? $t['name_en'] : $t['name_zh'] }}</figcaption>
              <span class="sc-about-tcard__role">{{ $isEn ? $t['role_en'] : $t['role_zh'] }}</span>
            </div>
          </div>
          <blockquote class="sc-about-tcard__quote">&ldquo;{{ $isEn ? $t['quote_en'] : $t['quote_zh'] }}&rdquo;</blockquote>
        </figure>
      @endforeach
    </div>
  </div>
</section>

@endsection
