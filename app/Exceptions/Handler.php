<?php

namespace App\Exceptions;

use App\Http\Controllers\Main\SiteController;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (HttpException $e, Request $request) {
            $obj = new SiteController();
            $menu = $obj->getMenu();
            $navigation = view('main.navigation')->with('menu', $menu);
            if ($e->getStatusCode() === 404) {

                $title = 'Ошибка ' . $e->getStatusCode();
                $slug = 'Свежее и органическое';
                $breadcrumbs = view('main.breadcrumbs')->with(['slug' => $slug, 'title' => $title]);
                return response()->view('errors.404', compact('navigation', 'title', 'breadcrumbs'));
            }

        });
    }
}
