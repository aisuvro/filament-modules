<?php

namespace Coolsam\Modules;


abstract class Resource extends \Filament\Resources\Resource
{

    public static function getCurrentModuleName(): string
    {
        $provider = static::class;
        $provider = explode('\\', $provider);
        $provider = strtolower($provider[1]);
        return $provider;
    }

    public static function canAccess(): bool
    {
        $isModuleEnabled = \Nwidart\Modules\Facades\Module::find(
            static::getCurrentModuleName()
        )?->isEnabled();
        $parentAccess = parent::canAccess();

        if ($isModuleEnabled && $parentAccess) {
            return true;
        }
        return false;
    }
}