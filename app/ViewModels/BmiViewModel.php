<?php

namespace App\ViewModels;

class BmiViewModel
{
    private const DEFAULT_FORM = [
        'system' => 'metric',
        'weight' => null,
        'height' => null,
    ];

    private const ALERT_MAP = [
        'error' => 'alert-error',
        'warning' => 'alert-warning',
        'success' => 'alert-success',
        'info' => 'alert-info',
    ];


    public static function make(array $baseData, array $oldInput = []): array
    {
        $form = array_merge(self::DEFAULT_FORM, $baseData['form'] ?? []);

        $selectedSystem = self::resolveFieldValue('system', $oldInput, $form, self::DEFAULT_FORM['system']);
        $weightValue = self::resolveFieldValue('weight', $oldInput, $form);
        $heightValue = self::resolveFieldValue('height', $oldInput, $form);

        $result = $baseData['result'] ?? null;
        $message = $baseData['message'] ?? ($result['message'] ?? null);
        $messageLevel = $baseData['message_level'] ?? ($result['message_level'] ?? 'info');
        $alertClass = self::ALERT_MAP[$messageLevel] ?? self::ALERT_MAP['info'];

        $sourceKey = 'local';
        if ($result) {
            $sourceKey = !empty($result['fallback'])
                ? 'local_fallback'
                : ($result['source'] ?? 'local');
        }

        return array_replace_recursive($baseData, [
            'form' => array_merge($form, [
                'system' => $selectedSystem,
                'weight' => $weightValue,
                'height' => $heightValue,
            ]),
            'selected_system' => $selectedSystem,
            'weight_value' => $weightValue,
            'height_value' => $heightValue,
            'message' => $message,
            'message_level' => $messageLevel,
            'alert_class' => $message ? $alertClass : null,
            'result_source_key' => $sourceKey,
        ]);
    }

    private static function resolveFieldValue(string $key, array $oldInput, array $form, mixed $default = null): mixed
    {
        if (array_key_exists($key, $oldInput)) {
            return $oldInput[$key];
        }

        if (array_key_exists($key, $form)) {
            return $form[$key];
        }

        return $default;
    }
}
