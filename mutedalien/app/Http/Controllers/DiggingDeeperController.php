<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiggingDeeperController extends Controller
{
    /**
     * Базовая информация
     * @url https://laravel.com/docs/5.8/collections
     *
     * справочная информация:
     * https://laravel.com/api/5.8/Illuminate/Support/Collection.html
     *
     * вариант коллекции для моделей eloquent:
     * https://laravel.com/api/5.8/Illuminate/Database/Eloquent/Collection.html
     *
     * Билдер запросов - то, с чем можно перепутать коллекции:
     * https://laravel.com/docs/5.8/queries
     */
    public function collections()
    {
        $result = [];

        /**
         * @var \Illuminate\Database\Eloquent\Collection $eloquentCollection
         */
        $eloquentCollection = BlogPost::withoutTrashed()->get();

        // dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());
        /**
         * @var \Illuminate\Support\Collection $collection
         */
        $collection = collect($eloquentCollection->toArray());

//        dd(
//            get_class($eloquentCollection),
//            get_class($collection),
//            $collection
//        );

//        $result['first'] = $collection->first();
//        $result['last'] = $collection->last();
        // dd($result);

        $result['where']['data'] = $collection
            ->where('category_id', 10)
            ->values()
            ->keyBy('id');
        // dd($result);

//        $result['where']['count'] = $result['where']['data']->count();
//        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
//        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();
        // dd($result);

        // не красиво
//        if ($result['where']['count']) {
//            //
//        }

        // так лучше
//        if ($result['where']['data']->isNotEmpty()) {
//            //
//        }

//        $result['where_first'] = $collection
//            ->firstWhere('created_at', '>', '2020-09-29 22:26:16');
//        dd($result);

        // Базовая переменная не изменится. Просто вернется измененная версия
//        $result['map']['all'] = $collection->map(function (array $item) {
//            $newsItem = new \stdClass();
//            $newsItem -> item_id = $item['id'];
//            $newsItem -> item_name = $item['title'];
//            $newsItem -> exists = is_null($item['deleted_at']);
//
//            return $newsItem;
//        });
//        dd($result);
//
//        $result['map']['not_exists'] = $result['map']['all']
//            ->where('exists', '=', false)
//            ->values()
//            ->keyBy('item_id');
//        dd($result);

        // Базовая переменная изменится (трансформируется)
        $collection->transform(function (array $item) {
            $newsItem = new \stdClass();
            $newsItem -> item_id = $item['id'];
            $newsItem -> item_name = $item['title'];
            $newsItem -> exists = is_null($item['deleted_at']);
            $newsItem -> created_at = Carbon::parse($item['created_at']);

            return $newsItem;
        });
        // dd($collection);
        $newsItem = new \stdClass();
        $newsItem -> id = 9999;

        $newsItem2 = new \stdClass();
        $newsItem2 -> id = 8888;
        // dd($newsItem, $newsItem2);

        // Установить элемент в начало коллекции
//        $newsItemFirst = $collection->prepend($newsItem)->first();
//        $newsItemLast = $collection->push($newsItem2)->last();
//        $pulleditItem = $collection->push(1);
//
//        dd(compact('collection', 'newsItemFirst', 'newsItemLast', 'pulleditItem'));

        // Фильтрация. Замена orWhere()
        $filtered = $collection-filter(function ($item) {
            $byDay = $item->created_at->isFriday();
            $byDate = $item->created_at->day == 11;

            $result = $item->created_at->isFriday() && ($item->created_at->day == 11);
            $result = $byDay && $byDate;

            return $result;
        });

        dd(compact('filtered'));
    }
}
