<?

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Arr;

class AppSettings
{
    static public function set(): array
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        cache()->put('app.settings', json_encode($settings));

        return $settings;
    }
    static public function boot(): array
    {
        return cache()->has('app.settings') ?
            json_decode(cache()->get('app.settings'), true) :
            self::set();
    }

    static public function get(array|string $options = null): array|string|null
    {
        $settings = self::boot();

        if (is_null($options)) {
            return $settings;
        } else if (is_array($options)) {
            return Arr::only($settings, $options);
        } else {
            return $settings[$options] ?? null;
        }
    }
}
