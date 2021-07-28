<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleBasicRequest;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ArticleController extends Controller
{
    protected $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View|JsonResponse
     */
    public function index(){

        return view("admin.article.index");
    }

    /**
     * @return Application|Factory|View
     */
    public function create(){

        $article = new Article();

        return view("admin.article.create",[
            "article" => $article
        ]);
    }

    /**
     * @param ArticleBasicRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(ArticleBasicRequest $request){

        $article = $this->service->store($request->validated());

        return redirect()->route('admin.article.index',["article" => $article])->withFlashSuccess(__('Article created.'));
    }


    /**
     * @param Article $article
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(Article $article)
    {
        return view('admin.article.edit', [
            'article'=> $article
        ]);
    }

    /**
     * @param ArticleBasicRequest $request
     * @param Article $article
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(ArticleBasicRequest $request, Article $article){

        $this->service->update($article, $request->validated());

        return redirect()->route('admin.article.index', $article)->withFlashSuccess(__('Article updated.'));
    }


    /**
     * @param Article $article
     * @return mixed
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.article.index')->withFlashSuccess(__('Article deleted.'));
    }


}
