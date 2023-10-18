<?php

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

    function calculatePercentageChange($model, $dateField = 'created_at') {
        $lastMonthCount = $model::whereMonth($dateField, Carbon::now()->subMonth()->month)->count();
        $currentMonthCount = $model::whereMonth($dateField, Carbon::now()->month)->count();
        return $lastMonthCount != 0 ? (($currentMonthCount - $lastMonthCount) / $lastMonthCount) * 100 : 0;
    }
    function calculatePercentageChangeDate($model, $dateField = 'created_at',$month) {
        $lastMonthCount = $model::whereMonth($dateField, $month - 1)->count();
        $currentMonthCount = $model::whereMonth($dateField, $month)->count();
        return $lastMonthCount != 0 ? (($currentMonthCount - $lastMonthCount) / $lastMonthCount) * 100 : 0;
    }
    function getUserName($var) {
        return User::where('id', $var)->first()->name;
    }
    function getChart(Model $model, $id, Carbon $start_of_week, Carbon $end_of_week, string $day_name, string $day_name_column): array
    {
        $datas = $model
            ->where('id', $id)
            ->whereBetween($day_name_column, [$start_of_week, $end_of_week])
            ->select(DB::raw("COUNT(*) as count"), DB::raw("{$day_name}({$day_name_column}) as day_name"))
            ->groupBy(DB::raw("{$day_name_column}"))
            ->orderBy("{$day_name}")
            ->pluck('count', "{$day_name}");

        return [
            'labels' => $datas->keys()->toArray(),
            'data' => $datas->values()->toArray(),
        ];
    }

    function getAge($date)
    {
        // return Carbon::parse($date)->age;
        return Carbon::now()->diff($date)->y;
    }
    function imageExists($path) {
        // dd($path);
        return file_exists($path) && is_readable($path);
        // dd(file_exists($path) && is_readable($path));
    }

    function translate($content, $nativeLang,$path, array $fields) {
        if($content != null) {
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            $placeholders = [];
            $i = 0;
            foreach ($images as $img) {
                $placeholder = "img_placeholder_" . $i++;
                $placeholders[$placeholder] = $dom->saveHTML($img);
                $newNode = $dom->createTextNode($placeholder);
                $img->parentNode->replaceChild($newNode, $img);
            }
            $content = $dom->saveHTML();
        }
        if($nativeLang == 'en') {
            $transaltedLang = 'ar';
        }else {
            $transaltedLang = 'en';
        }

        $translatedFields = [];
        foreach ($fields as $field => $text) {
            $translatedFields[$field] = GoogleTranslate::trans($text, $transaltedLang, $nativeLang);
        }

        if($content != null) {
            $translatedContent = GoogleTranslate::trans($content, $transaltedLang, $nativeLang);
            foreach ($placeholders as $placeholder => $imgTag) {
                $translatedContent = str_replace($placeholder, $imgTag, $translatedContent);
            }
            $translatedFields['content'] = $translatedContent;
        }

        $translatedFields['lang'] = $transaltedLang;

        return $translatedFields;
    }

    function google_translate($key, $sourceLanguage, $targetLanguage) {
        $cacheKey = 'translation.'.$key;

        return Cache::remember($cacheKey, 60, function () use ($key, $sourceLanguage, $targetLanguage) {
            return  Stichoza\GoogleTranslate\GoogleTranslate::trans($key, $sourceLanguage, $targetLanguage);
        });
    }
