@php
  $isEn = app()->getLocale() === 'en';
  $storeName = system_setting_locale('store_name') ?? 'Shunchung';
  $phone = system_setting('telephone');
  $email = system_setting('email');
  $localePrefix = '/'.front_locale_code();
@endphp
<footer class="footer-box shunchung-footer">
  <div class="container">
    <div class="footer-main">
      <div class="row g-4">
        <div class="col-12 col-lg-4">
          <div class="footer-logo shunchung-logo"><img src="{{ image_origin('images/shunchung-logo-en-white.svg') }}" class="shunchung-logo__img shunchung-logo__img--white" style="filter:none !important; -webkit-filter:none !important; opacity:1 !important;" alt="Shunchung"></div>
          <div class="footer-social" aria-label="Social media">
            <a href="https://www.linkedin.com/" target="_blank" rel="noopener" aria-label="LinkedIn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="https://www.facebook.com/" target="_blank" rel="noopener" aria-label="Facebook" title="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.youtube.com/" target="_blank" rel="noopener" aria-label="YouTube" title="YouTube"><i class="bi bi-youtube"></i></a>
            @if($email)<a href="mailto:{{ $email }}" aria-label="Email" title="Email"><i class="bi bi-envelope-fill"></i></a>@endif
          </div>
        </div>
        <div class="col-6 col-lg-2"><div class="footer-title">@if($isEn) SHAPED PRODUCTS @else 异形产品 @endif</div><ul class="footer-links">
          <li><a href="{{ $localePrefix }}/products">@if($isEn) Precision Copper Coil &amp; Strip @else 精密异形铜卷 / 带材 @endif</a></li>
          <li><a href="{{ $localePrefix }}/products">@if($isEn) Custom Copper Busbar @else 定制异形铜排 @endif</a></li>
        </ul></div>
        <div class="col-6 col-lg-2"><div class="footer-title">@if($isEn) SOLUTIONS @else 解决方案 @endif</div><ul class="footer-links">
          <li><a href="{{ $localePrefix }}/articles">@if($isEn) Semiconductor &amp; Power @else 半导体与功率电子 @endif</a></li>
          <li><a href="{{ $localePrefix }}/articles">@if($isEn) New Energy @else 新能源与电力 @endif</a></li>
          <li><a href="{{ $localePrefix }}/articles">@if($isEn) Connectors &amp; Relays @else 连接器与继电器 @endif</a></li>
          <li><a href="{{ $localePrefix }}/articles">@if($isEn) Thermal Management @else 热管理与消费电子 @endif</a></li>
        </ul></div>
        <div class="col-6 col-lg-2"><div class="footer-title">@if($isEn) COMPANY NEWS @else 公司动态 @endif</div><ul class="footer-links">
          <li><a href="{{ $localePrefix }}/articles">@if($isEn) News &amp; Insights @else 新闻与行业资讯 @endif</a></li>
          <li><a href="{{ $localePrefix }}/page-about">@if($isEn) About Shunchung @else 关于双张新材 @endif</a></li>
          <li><a href="{{ $localePrefix }}/contact">@if($isEn) Contact Us @else 联系我们 @endif</a></li>
        </ul></div>
        <div class="col-6 col-lg-2"><div class="footer-title">@if($isEn) CONTACT @else 联系我们 @endif</div><ul class="footer-contact">
          @if($phone)<li><i class="bi bi-telephone-fill"></i><a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}">{{ $phone }}</a></li>@endif
          @if($email)<li><i class="bi bi-envelope-fill"></i><a href="mailto:{{ $email }}">{{ $email }}</a></li>@endif
        </ul></div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="footer-bottom__row footer-bottom__row--legal">
        <div class="copyright-text">版权所有 © 2005 - 2025 上海双张新材料科技有限公司 设计&amp;技术支持：Borderx</div>
      </div>
    </div>
  </div>
</footer>

{{-- 一键置顶 --}}
<button type="button" class="back-to-top" id="backToTop" aria-label="{{ $isEn ? 'Back to top' : '回到顶部' }}" title="{{ $isEn ? 'Back to top' : '回到顶部' }}">
  <i class="bi bi-arrow-up" aria-hidden="true"></i>
</button>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var btt = document.getElementById('backToTop');
  if (!btt) return;
  var onScroll = function () {
    btt.classList.toggle('is-visible', window.scrollY > 600);
  };
  window.addEventListener('scroll', onScroll, { passive: true });
  btt.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
  onScroll();

  var header = document.querySelector('.site-header');
  if (header) {
    var lastY = window.scrollY;
    var ticking = false;
    var updateHeader = function () {
      var y = window.scrollY;
      if (y <= 16 || y < lastY - 2) {
        header.classList.remove('header-hidden');
      } else if (y > lastY + 2 && y > 220) {
        header.classList.add('header-hidden');
      }
      lastY = y;
      ticking = false;
    };
    window.addEventListener('scroll', function () {
      if (!ticking) { window.requestAnimationFrame(updateHeader); ticking = true; }
    }, { passive: true });
  }
});
</script>
