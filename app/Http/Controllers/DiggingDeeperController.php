<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateCatalog\GenerateCatalogMainJob;
use App\Jobs\ProcessVideoJob;
use App\Models\BlogPost;
use Carbon\Carbon;

class DiggingDeeperController extends Controller
{
    /**
     * Базовая информация:
     * @url https://laravel.com/docs/5.8/collections
     *
     * Справочная информация:
     * @url https://laravel.com/api/5.8/Illuminate/Support/Collections.html
     *
     * Вариант коллекций для моделей Eloquent:
     * @url https://laravel.com/api/5.8/Illuminate/Database/Eloquent/Collections.html
     *
     * Билдер запросов - то, с чем можно перепутать коллекции:
     * @url https://laravel.com/docs/5.8/queries
     */
    public function collections()
    {
        $result = [];

        /**
         * @var \Illuminate\Database\Eloquent\Collection $eloquentCollection
         */
        $eloquentCollection = BlogPost::withTrashed()->get();

        //dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());
        /**
         * @var \Illuminate\Support\Collection $collection
         */
        $collection = collect($eloquentCollection->toArray());
        /*dd(
            get_class($eloquentCollection),
            get_class($collection),
            $collection
        );*/
//        $result['first'] = $collection->first();
//        $result['last'] = $collection->last();

//        $result['where']['data'] = $collection
//            ->where('category_id', 10)
//            ->values()
//            ->keyBy('id')
//            ;
//
//        $result['where']['count'] = $result['where']['data']->count();
//        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
//        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();

//        // Не очень "красиво"
//        if ($result['where']['count']) {
//            //...
//        }
//        // "красивее"
//        if($result['where']['data']->isNotEmpty()){
//            //...
//        }

//        // Базовая переменная не измениться. Просто вернется измененная версия.
//        $result['where_first'] = $collection
//            ->firstWhere('created_at', '>', '2023-12-01 00:00:00');
//        $result['map']['all'] = $collection->map(function ($item) {
//           $newItem = new \stdClass();
//           $newItem->item_id = $item['id'];
//           $newItem->item_name = $item['title'];
//           $newItem->exists = is_null($item['deleted_at']);
//
//           return $newItem;
//        });
//
//        $result['map']['not_exists'] = $result['map']['all']->where('exists', '=', false);

        // Базовая переменная измениться (трансформируется).
        $collection->transform(function ($item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);
            return $newItem;
        });

//        $newItem = new \stdClass();
//        $newItem->id = 9999;
//
//        $newItem2 = new \stdClass();
//        $newItem2->id = 888;

//        // Установить элемент в начало коллекции
//        $newItemFirst = $collection->prepend($newItem)->first();
//        $newItemLast = $collection->push($newItem2)->last();
//        $pulledItem = $collection->pull(1);

//       dd(compact('collection', 'newItemFirst', 'newItemLast', 'pulledItem'));

        // Фильтрация. Замена orWhere()
//        $filtered = $collection->filter(function ($item) {
//            $byDay = $item->created_at->isFriday();
//            $byDate = $item->created_at->day == 1;
//
//            //$result = $item->created_at->isFriday() && ($item->created_at->day == 13);
//            $result = $byDay && $byDate;
//
//            return $result;
//        });
//
//        dd(compact('filtered'));

//        $sortedSimpleCollections = collect([5, 3, 1, 2, 4])->sort()->values();
//        $sortedAscCollection = $collection->sortBy('created_at');
//        $sortedDescCollection = $collection->sortByDesc('item_id');
//
//        dd(compact( 'sortedSimpleCollections', 'sortedAscCollection', 'sortedDescCollection'));
    }

    public function processVideo()
    {
        ProcessVideoJob::dispatch()
            // Отсрочка выполнения от момента помещения в очередь.
            // Не влияет на паузу между попытками выполнять задачу
            //->delay(10)
            //->onQueue('name_of_queue')
        ;
    }

    /**
     * @link http://laravel.net/digging_deeper/prepare-catalog
     *
     * php artisan queue:listen --queue=generate-catalog --tries=3 --delay=10
     */
    public function prepareCatalog()
    {
        GenerateCatalogMainJob::dispatch();
    }
}
