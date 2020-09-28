<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
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

        $result['first'] = $collection->first();
        $result['last'] = $collection->last();
        // dd($result);

        $result['where']['data'] = $collection
            ->where('category_id', 10)
            ->values()
            ->keyBy('id');
        // dd($result);
    }
}
