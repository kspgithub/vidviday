<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsBasicRequest;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $service;

    public function __construct(NewsService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View|JsonResponse
     */
    public function index(){

        return view("admin.news.index");
    }

    /**
     * @return Application|Factory|View
     */
    public function create(){

        $news = new News();

        return view("admin.news.create",[
            "news" => $news
        ]);
    }

    /**
     * @param NewsBasicRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(NewsBasicRequest $request){

        $news = $this->service->store($request->validated());

        return redirect()->route('admin.news.index',["news" => $news])->withFlashSuccess(__('News created.'));
    }


    /**
     * @param News $news
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', [
            'news'=> $news
        ]);
    }

    /**
     * @param NewsBasicRequest $request
     * @param News $news
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(NewsBasicRequest $request, News $news){

        $this->service->update($news, $request->validated());

        return redirect()->route('admin.news.index', $news)->withFlashSuccess(__('News updated.'));
    }


    /**
     * @param News $news
     * @return mixed
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index')->withFlashSuccess(__('News deleted.'));
    }

}
