<?php
/**
 * Copyright (c) Since 2024 InnoCMS - All Rights Reserved
 *
 * @link       https://www.innocms.com
 * @author     InnoCMS <team@innoshop.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace InnoCMS\Front\Controllers;

use Illuminate\Http\JsonResponse;
use InnoCMS\Common\Repositories\ContactRepo;
use InnoCMS\Front\Requests\ContactRequest;

class ContactController
{
    /**
     * Show the contact page with contact info and message form.
     */
    public function index(): mixed
    {
        return inno_view('contacts.index', [
            'telephone'      => system_setting('telephone'),
            'email'          => system_setting('email'),
            'address'        => system_setting_locale('address'),
            'business_hours' => system_setting_locale('business_hours'),
        ]);
    }

    /**
     * Submit a contact message.
     */
    public function store(ContactRequest $request): JsonResponse
    {
        try {
            $data = $request->only(['name', 'email', 'phone', 'company', 'content', 'attachment']);
            $data['ip']          = $request->ip();
            $data['ip_location'] = $this->lookupIpLocation($data['ip']);

            ContactRepo::getInstance()->create($data);

            return json_success('提交成功，我们将尽快联系您');
        } catch (\Exception $e) {
            return json_fail($e->getMessage());
        }
    }

    /**
     * 查询 IP 归属地（国家/地区/城市）。
     */
    protected function lookupIpLocation(?string $ip): string
    {
        if (! $ip || in_array($ip, ['127.0.0.1', '::1'], true)) {
            return '';
        }

        try {
            $resp = \Illuminate\Support\Facades\Http::timeout(5)->get('http://ip-api.com/json/'.$ip, [
                'lang'   => 'zh-CN',
                'fields' => 'status,country,regionName,city',
            ]);
            $data = $resp->json();

            if (($data['status'] ?? '') === 'success') {
                $parts = array_filter([$data['country'] ?? '', $data['regionName'] ?? '', $data['city'] ?? '']);

                return implode(' ', $parts);
            }
        } catch (\Exception $e) {
            // 查询失败则留空，不影响提交
        }

        return '';
    }
}
