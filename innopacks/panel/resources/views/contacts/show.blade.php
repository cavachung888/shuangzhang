@extends('panel::layouts.app')
@section('body-class', 'page-contacts')

@section('title', __('panel/contacts.detail'))

@section('page-title-right')
  <a href="{{ panel_route('contacts.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left"></i> {{ __('panel/common.list') }}
  </a>
@endsection

@section('content')
<div class="row g-3">
  {{-- ① 留言详情 --}}
  <div class="col-lg-6">
    <div class="card h-100">
      <div class="card-header fw-semibold">留言详情</div>
      <div class="card-body">
        <table class="table table-borderless align-middle">
          <tr>
            <td class="fw-semibold text-nowrap" style="width: 110px;">{{ __('panel/common.email') }}</td>
            <td>{{ $contact->email }}</td>
          </tr>
          <tr>
            <td class="fw-semibold">附件</td>
            <td>
              @if($contact->attachment)
                <a href="{{ storage_url($contact->attachment) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-paperclip"></i> 下载附件</a>
              @else
                -
              @endif
            </td>
          </tr>
          <tr>
            <td class="fw-semibold">{{ __('panel/common.status') }}</td>
            <td>
              @if($contact->status)
                <span class="badge bg-success">{{ __('panel/contacts.read') }}</span>
              @else
                <span class="badge bg-warning text-dark">{{ __('panel/contacts.unread') }}</span>
              @endif
            </td>
          </tr>
          <tr>
            <td class="fw-semibold">{{ __('panel/common.created_at') }}</td>
            <td>{{ $contact->created_at->format('Y-m-d H:i:s') }}</td>
          </tr>
          <tr>
            <td class="fw-semibold">填表人 IP</td>
            <td>{{ $contact->ip ?: '-' }}</td>
          </tr>
          <tr>
            <td class="fw-semibold">IP 归属地</td>
            <td>{{ $contact->ip_location ?: '-' }}</td>
          </tr>
        </table>
        <div class="mb-2 fw-semibold">{{ __('panel/contacts.content') }}</div>
        <div class="p-3 bg-light rounded" style="white-space: pre-wrap;">{{ $contact->content }}</div>
      </div>
    </div>
  </div>

  {{-- ② 客服跟进状态 --}}
  <div class="col-lg-6">
    <div class="card h-100">
      <div class="card-header fw-semibold">客服跟进状态</div>
      <div class="card-body">
        <form action="{{ panel_route('contacts.update', [$contact->id]) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label fw-semibold mb-1">修改时间</label>
              <input type="datetime-local" name="follow_at" class="form-control" value="{{ $contact->follow_at ? $contact->follow_at->format('Y-m-d\TH:i') : '' }}">
            </div>
            <div class="col-12">
              <label class="form-label fw-semibold mb-1">{{ __('panel/contacts.contact_name') }}</label>
              <input type="text" name="name" class="form-control" value="{{ $contact->name }}">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold mb-1">{{ __('panel/contacts.phone') }}</label>
              <input type="text" name="phone" class="form-control" value="{{ $contact->phone }}">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold mb-1">{{ __('panel/contacts.company') }}</label>
              <input type="text" name="company" class="form-control" value="{{ $contact->company }}">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold mb-1">国家</label>
              <select name="country" class="form-select">
                <option value="">请选择</option>
                @foreach(['中国','美国','日本','韩国','德国','英国','法国','意大利','印度','越南','泰国','马来西亚','新加坡','墨西哥','巴西','其他'] as $c)
                  <option value="{{ $c }}" @if($contact->country === $c) selected @endif>{{ $c }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold mb-1">地址</label>
              <input type="text" name="address" class="form-control" value="{{ $contact->address }}">
            </div>
            <div class="col-12">
              <label class="form-label fw-semibold mb-1">跟进状态</label>
              <select name="follow_status" class="form-select">
                <option value="">请选择</option>
                @foreach(['pending' => '待跟进', 'following' => '跟进中', 'quoted' => '已报价', 'negotiating' => '待签约', 'deal' => '已成交', 'lost' => '无意向'] as $val => $label)
                  <option value="{{ $val }}" @if($contact->follow_status === $val) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">保存修改</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
