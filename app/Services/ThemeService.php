<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\AppSetting;

class ThemeService
{
    /**
     * Preset color palettes — full 50–950 shade scale in hex.
     *
     * @var array<string, array{name: string, shades: array<string, string>}>
     */
    public const PRESETS = [
        'indigo' => [
            'name' => 'Indigo',
            'shades' => [
                '50' => '#eef2ff', '100' => '#e0e7ff', '200' => '#c7d2fe',
                '300' => '#a5b4fc', '400' => '#818cf8', '500' => '#6366f1',
                '600' => '#4f46e5', '700' => '#4338ca', '800' => '#3730a3',
                '900' => '#312e81', '950' => '#1e1b4b',
            ],
        ],
        'blue' => [
            'name' => 'Blue',
            'shades' => [
                '50' => '#eff6ff', '100' => '#dbeafe', '200' => '#bfdbfe',
                '300' => '#93c5fd', '400' => '#60a5fa', '500' => '#3b82f6',
                '600' => '#2563eb', '700' => '#1d4ed8', '800' => '#1e40af',
                '900' => '#1e3a8a', '950' => '#172554',
            ],
        ],
        'violet' => [
            'name' => 'Violet',
            'shades' => [
                '50' => '#f5f3ff', '100' => '#ede9fe', '200' => '#ddd6fe',
                '300' => '#c4b5fd', '400' => '#a78bfa', '500' => '#8b5cf6',
                '600' => '#7c3aed', '700' => '#6d28d9', '800' => '#5b21b6',
                '900' => '#4c1d95', '950' => '#2e1065',
            ],
        ],
        'rose' => [
            'name' => 'Rose',
            'shades' => [
                '50' => '#fff1f2', '100' => '#ffe4e6', '200' => '#fecdd3',
                '300' => '#fda4af', '400' => '#fb7185', '500' => '#f43f5e',
                '600' => '#e11d48', '700' => '#be123c', '800' => '#9f1239',
                '900' => '#881337', '950' => '#4c0519',
            ],
        ],
        'emerald' => [
            'name' => 'Emerald',
            'shades' => [
                '50' => '#ecfdf5', '100' => '#d1fae5', '200' => '#a7f3d0',
                '300' => '#6ee7b7', '400' => '#34d399', '500' => '#10b981',
                '600' => '#059669', '700' => '#047857', '800' => '#065f46',
                '900' => '#064e3b', '950' => '#022c22',
            ],
        ],
    ];

    /**
     * Retrieve the current theme CSS override string for injection into <head>.
     */
    public function themeCss(): string
    {
        $preset = AppSetting::get('theme_preset', 'indigo');
        $customHex = AppSetting::get('theme_custom_hex');

        $shades = $customHex
            ? $this->generateShades($customHex)
            : (self::PRESETS[$preset]['shades'] ?? self::PRESETS['indigo']['shades']);

        return $this->buildCss($shades);
    }

    /**
     * Generate approximate shades from a single hex color using HSL interpolation.
     *
     * @return array<string, string>
     */
    public function generateShades(string $hex): array
    {
        [$h, $s] = $this->hexToHs($hex);

        $lightnesses = [
            '50' => 97, '100' => 94, '200' => 89, '300' => 82,
            '400' => 70, '500' => 60, '600' => 52, '700' => 44,
            '800' => 37, '900' => 30, '950' => 22,
        ];

        $shades = [];
        foreach ($lightnesses as $key => $l) {
            $shades[$key] = $this->hslToHex($h, $s, $l);
        }

        return $shades;
    }

    /**
     * Build a CSS :root block overriding --color-primary-* variables.
     *
     * @param  array<string, string>  $shades
     */
    private function buildCss(array $shades): string
    {
        $props = '';
        foreach ($shades as $shade => $hex) {
            $props .= "    --color-primary-{$shade}: {$hex};\n";
        }

        return ":root {\n{$props}}";
    }

    /**
     * Convert hex to [hue, saturation%].
     *
     * @return array{float, float}
     */
    private function hexToHs(string $hex): array
    {
        $hex = ltrim($hex, '#');
        $r = hexdec(substr($hex, 0, 2)) / 255;
        $g = hexdec(substr($hex, 2, 2)) / 255;
        $b = hexdec(substr($hex, 4, 2)) / 255;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $delta = $max - $min;

        if ($delta == 0) {
            $h = 0.0;
        } elseif ($max === $r) {
            $h = fmod(($g - $b) / $delta, 6);
        } elseif ($max === $g) {
            $h = ($b - $r) / $delta + 2;
        } else {
            $h = ($r - $g) / $delta + 4;
        }

        $h = round($h * 60);
        if ($h < 0) {
            $h += 360;
        }

        $l = ($max + $min) / 2;
        $s = $delta == 0 ? 0 : $delta / (1 - abs(2 * $l - 1));

        return [$h, round($s * 100)];
    }

    /**
     * Convert HSL to hex string.
     */
    private function hslToHex(float $h, float $s, float $l): string
    {
        $s /= 100;
        $l /= 100;

        $c = (1 - abs(2 * $l - 1)) * $s;
        $x = $c * (1 - abs(fmod($h / 60, 2) - 1));
        $m = $l - $c / 2;

        if ($h < 60) {
            [$r, $g, $b] = [$c, $x, 0];
        } elseif ($h < 120) {
            [$r, $g, $b] = [$x, $c, 0];
        } elseif ($h < 180) {
            [$r, $g, $b] = [0, $c, $x];
        } elseif ($h < 240) {
            [$r, $g, $b] = [0, $x, $c];
        } elseif ($h < 300) {
            [$r, $g, $b] = [$x, 0, $c];
        } else {
            [$r, $g, $b] = [$c, 0, $x];
        }

        return sprintf('#%02x%02x%02x',
            (int) round(($r + $m) * 255),
            (int) round(($g + $m) * 255),
            (int) round(($b + $m) * 255),
        );
    }
}
