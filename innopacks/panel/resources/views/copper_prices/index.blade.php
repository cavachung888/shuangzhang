@extends('panel::layouts.app')
@section('body-class', 'page-copper-prices')

@section('title', '铜价管理')

@section('page-title-right')
  <a href="{{ panel_route('copper_prices.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-square"></i> 新增铜价
  </a>
@endsection

@section('content')
<div class="card h-min-600">
  <div class="card-body">

    <form class="row g-2 mb-3" method="GET" action="{{ panel_route('copper_prices.index') }}">
      <div class="col-auto">
        <select name="market" class="form-select form-select-sm">
          <option value="">全部市场</option>
          @foreach($markets as $code => $label)
            <option value="{{ $code }}" {{ request('market') === $code ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-auto">
        <input type="date" name="price_date" class="form-control form-control-sm" value="{{ request('price_date') }}">
      </div>
      <div class="col-auto">
        <button class="btn btn-sm btn-primary">查询</button>
        <a href="{{ panel_route('copper_prices.index') }}" class="btn btn-sm btn-outline-secondary">重置</a>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
        <tr>
          <td>ID</td>
          <td>日期</td>
          <td>市场</td>
          <td>1号电解铜均价</td>
          <td>货币</td>
          <td>{{ __('panel/common.actions') }}</td>
        </tr>
        </thead>
        @if ($copperPrices->count())
          <tbody>
          @foreach($copperPrices as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->price_date->format('Y-m-d') }}</td>
              <td>{{ \InnoCMS\Common\Models\CopperPrice::marketLabel($item->market) }}</td>
              <td>{{ number_format($item->copper_price, 2) }}</td>
              <td>{{ \InnoCMS\Common\Models\CopperPrice::currencyLabel($item->currency) }}</td>
              <td>
                <div class="d-flex gap-1">
                  <a href="{{ panel_route('copper_prices.edit', [$item->id]) }}" class="btn btn-sm btn-outline-primary">{{ __('panel/common.edit') }}</a>
                  <form action="{{ panel_route('copper_prices.destroy', [$item->id]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete">{{ __('panel/common.delete') }}</button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
          </tbody>
        @else
          <tbody>
          <tr>
            <td colspan="6">
              <x-common-no-data :width="200" />
            </td>
          </tr>
          </tbody>
        @endif
      </table>
    </div>
    {{ $copperPrices->withQueryString()->links('panel::vendor/pagination/bootstrap-4') }}
  </div>
</div>
@endsection

@push('footer')
<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    const form = this.closest('form');
    layer.confirm('{{ __("common/base.hint_delete") }}', {
      btn: ['{{ __("common/base.confirm") }}', '{{ __("common/base.cancel") }}'],
      title: false,
    }, function(index) {
      form.submit();
      layer.close(index);
    });
  });
});
</script>
@endpush
