<?php

namespace App\View\Components\Utils;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class MediaLibrary
 * @package App\View\Components\Utils
 */
class MediaLibrary extends Component
{

    /**
     *
     * @var HasMedia|mixed
     */
    public $model;

    /**
     * @var Media[]|Collection|mixed
     */
    public $items = [];

    public string $collection;

    public string $storeUrl;

    public string $updateUrl;

    public string $destroyUrl;

    public string $orderUrl;

    public string $accept;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        HasMedia $model = null,
        $items = null,
        $storeUrl = null,
        $updateUrl = null,
        $destroyUrl = null,
        $orderUrl = null,
        $collection = 'default',
        $accept = 'image/jpeg,image/png'
    ) {
        $this->model = $model;
        $this->collection = $collection;
        $this->items = $items ?: $model->getMedia($collection)->map->asAlpineData();
        $this->storeUrl = $storeUrl ?: route('admin.media.store', ['model_type' => get_class($model), 'model_id' => $model->id]);
        $this->destroyUrl = $destroyUrl ?: route('admin.media.destroy', 0);
        $this->updateUrl = $updateUrl ?: route('admin.media.update', 0);
        $this->orderUrl = $orderUrl ?: route('admin.media.order');
        $this->accept = $accept;


        if ($model !== null && $items === null) {
            $this->items = $model->getMedia($collection)->map->asAlpineData();
        }

        if ($model !== null && empty($storeUrl)) {
            $this->storeUrl = route('admin.media.store', ['model_type' => get_class($model), 'model_id' => $model->id]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.utils.media-library');
    }
}
