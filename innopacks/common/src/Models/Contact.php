<?php
/**
 * Copyright (c) Since 2024 InnoCMS - All Rights Reserved
 *
 * @link       https://www.innocms.com
 * @author     InnoCMS <team@innoshop.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace InnoCMS\Common\Models;

class Contact extends BaseModel
{
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'content', 'attachment', 'status', 'country', 'address', 'follow_status', 'follow_at', 'ip', 'ip_location',
    ];

    protected $casts = [
        'status' => 'boolean',
        'follow_at' => 'datetime',
    ];
}
