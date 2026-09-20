<?php

namespace InnoCMS\Common\Models;

use Illuminate\Database\Eloquent\Model;

class CopperPrice extends Model
{
    protected $fillable = ['price_date', 'market', 'copper_price', 'currency'];

    protected $casts = [
        'price_date'   => 'date',
        'copper_price' => 'float',
    ];

    public const MARKETS = [
        'ccmn' => '长江有色',
        'smm'  => '上海有色',
        'lme'  => 'LME伦敦',
    ];

    public const CURRENCIES = [
        'cny' => '人民币',
        'usd' => '美金',
    ];

    public static function marketLabel(?string $code): string
    {
        return self::MARKETS[$code] ?? (string) $code;
    }

    public static function currencyLabel(?string $code): string
    {
        return self::CURRENCIES[$code] ?? (string) $code;
    }

    public static function currencyUnit(?string $code): string
    {
        return $code === 'usd' ? '美元 / 吨' : '元 / 吨';
    }
}
