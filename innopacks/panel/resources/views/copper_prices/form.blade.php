@extends('panel::layouts.app')
@section('body-class', 'page-copper-price-form')
@section('title', '铜价录入')

@section('content')
@php
  $marketOptions = collect(\InnoCMS\Common\Models\CopperPrice::MARKETS)
      ->map(fn($label, $code) => ['value' => $code, 'label' => $label])
      ->values()->all();
  $currencyOptions = collect(\InnoCMS\Common\Models\CopperPrice::CURRENCIES)
      ->map(fn($label, $code) => ['value' => $code, 'label' => $label])
      ->values()->all();
@endphp
<div class="card h-min-600">
  <div class="card-header">
    <h5 class="card-title mb-0">{{ $copperPrice->id ? '编辑铜价' : '新增铜价' }}</h5>
  </div>
  <div class="card-body">
    <form class="needs-validation mt-3" novalidate
      action="{{ $copperPrice->id ? panel_route('copper_prices.update', [$copperPrice->id]) : panel_route('copper_prices.store') }}"
      method="POST">
      @csrf
      @method($copperPrice->id ? 'PUT' : 'POST')

      <x-panel-form-date title="日期" name="price_date"
        :value="old('price_date', $copperPrice->price_date ? $copperPrice->price_date->format('Y-m-d') : now()->format('Y-m-d'))"
        required placeholder="选择日期" />

      <x-panel-form-select title="选择市场" name="market"
        :value="old('market', $copperPrice->market ?? '')"
        :options="$marketOptions" required />

      <x-panel-form-input title="1号电解铜均价" name="copper_price"
        :value="old('copper_price', $copperPrice->copper_price ?? '')"
        required type="number" step="0.01" placeholder="请输入均价" />

      <x-panel-form-select title="货币" name="currency"
        :value="old('currency', $copperPrice->currency ?? 'cny')"
        :options="$currencyOptions" required />

      <div class="form-row mt-5 d-flex">
        <div class="wp-200 pe-2"></div>
        <button class="btn btn-primary" type="submit">保存</button>
      </div>
    </form>
  </div>
</div>
@endsection
