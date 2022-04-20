<?php

namespace App\Http\Controllers\Front;

use App\Models\FaqQuestion;
use App\Models\FaqCategory;
use App\Models\ArticleCategory;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\NewsCategoryPivot;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KnowledgeBaseController extends Controller
{
    public function getFaqs()
    {
        $categories = FaqCategory::with('faqQuestions')
            ->paginate(10);

        return view('front.pages.knowledge_base.faq', compact('categories'));
    }
	
	public function getArticleCategories()
    {
        $categories = ArticleCategory::withCount('articles')
            ->with(['articles' => function($query) {
                $query->orderBy('id', 'desc');
            }])
            ->paginate(10);

        return view('front.pages.knowledge_base.article_categories', compact('categories'));
    }
	
	public function getArticleByCategory($category_id)
    {
		$categories = ArticleCategory::withCount('articles')
            ->with(['articles' => function($query) {
                $query->orderBy('id', 'desc');
            }])
			->where('id', $category_id)
            ->get();
			
        return view('front.pages.knowledge_base.articles_list', compact(['categories']));
    }
	
	public function showArticle($article_id)
    {
		$article = Article::where('id', $article_id)
            ->first();
			
        return view('front.pages.knowledge_base.article_show', compact(['article']));
    }

}
