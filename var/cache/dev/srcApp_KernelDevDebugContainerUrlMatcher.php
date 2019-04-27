<?php

use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherTrait;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    use PhpMatcherTrait;

    public function __construct(RequestContext $context)
    {
        $this->context = $context;
        $this->staticRoutes = [
            '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
            '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
            '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
            '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
            '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
            '/api/v1/school' => [[['_route' => 'school-list', '_controller' => 'App\\Controller\\SchoolController::list'], null, ['GET' => 0], null, false, false, null]],
            '/api/v1/user/auth' => [[['_route' => 'user-auth', '_controller' => 'App\\Controller\\UserController::Auth'], null, ['POST' => 0], null, false, false, null]],
            '/api/v1/user' => [
                [['_route' => 'user-info', '_controller' => 'App\\Controller\\UserController::info'], null, ['GET' => 0], null, false, false, null],
                [['_route' => 'user-info-change', '_controller' => 'App\\Controller\\UserController::updateInfo'], null, ['PUT' => 0], null, false, false, null],
            ],
            '/api/v1/user/follow/number' => [[['_route' => 'user-follow-number', '_controller' => 'App\\Controller\\FollowUserController::number'], null, ['GET' => 0], null, false, false, null]],
            '/api/v1/column' => [
                [['_route' => 'column-list', '_controller' => 'App\\Controller\\ColumnController::list'], null, ['GET' => 0], null, true, false, null],
                [['_route' => 'column-apply', '_controller' => 'App\\Controller\\ColumnController::apply'], null, ['POST' => 0], null, true, false, null],
                [['_route' => 'column-info-update', '_controller' => 'App\\Controller\\ColumnController::updateInfo'], null, ['PUT' => 0], null, true, false, null],
            ],
            '/api/v1/page' => [
                [['_route' => 'page-list', '_controller' => 'App\\Controller\\PageController::list'], null, ['GET' => 0], null, true, false, null],
                [['_route' => 'page-publish', '_controller' => 'App\\Controller\\PageController::publish'], null, ['POST' => 0], null, true, false, null],
            ],
            '/api/v1/message' => [
                [['_route' => 'message-list', '_controller' => 'App\\Controller\\MessageController::list'], null, ['GET' => 0], null, true, false, null],
                [['_route' => 'message-send', '_controller' => 'App\\Controller\\MessageController::send'], null, ['POST' => 0], null, true, false, null],
            ],
            '/api/v1/menu' => [
                [['_route' => 'menu', '_controller' => 'App\\Controller\\MenuController::index'], null, ['GET' => 0], null, true, false, null],
                [['_route' => 'menu-update', '_controller' => 'App\\Controller\\MenuController::updateMenu'], null, ['PUT' => 0], null, true, false, null],
            ],
            '/api/v1/score' => [[['_route' => 'score', '_controller' => 'App\\Controller\\ScoreController::index'], null, ['GET' => 0], null, true, false, null]],
            '/api/v1/lesson' => [[['_route' => 'lesson', '_controller' => 'App\\Controller\\LessonController::index'], null, ['GET' => 0], null, true, false, null]],
            '/api/v1/exam' => [[['_route' => 'exam', '_controller' => 'App\\Controller\\ExamController::index'], null, ['GET' => 0], null, true, false, null]],
            '/api/v1/cet' => [[['_route' => 'cet', '_controller' => 'App\\Controller\\CetController::index'], null, ['GET' => 0], null, true, false, null]],
        ];
        $this->regexpList = [
            0 => '{^(?'
                    .'|/_(?'
                        .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                        .'|wdt/([^/]++)(*:57)'
                        .'|profiler/([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:102)'
                                .'|router(*:116)'
                                .'|exception(?'
                                    .'|(*:136)'
                                    .'|\\.css(*:149)'
                                .')'
                            .')'
                            .'|(*:159)'
                        .')'
                    .')'
                    .'|/api/v1/(?'
                        .'|school/([^/]++)(*:195)'
                        .'|user/(?'
                            .'|([^/]++)(*:219)'
                            .'|follow(?'
                                .'|(*:236)'
                                .'|/number/([^/]++)(*:260)'
                            .')'
                        .')'
                        .'|co(?'
                            .'|lumn/(?'
                                .'|([^/]++)(*:291)'
                                .'|follow(?'
                                    .'|(*:308)'
                                .')'
                            .')'
                            .'|mment/([^/]++)(?'
                                .'|(*:335)'
                            .')'
                        .')'
                        .'|page/([^/]++)/(?'
                            .'|like(?'
                                .'|(*:369)'
                            .')'
                            .'|co(?'
                                .'|mment(*:388)'
                                .'|llect(?'
                                    .'|(*:404)'
                                .')'
                            .')'
                            .'|report(*:420)'
                        .')'
                    .')'
                .')/?$}sDu',
        ];
        $this->dynamicRoutes = [
            38 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
            57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
            102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
            116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
            136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'], ['token'], null, null, false, false, null]],
            149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'], ['token'], null, null, false, false, null]],
            159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
            195 => [[['_route' => 'school-needs', '_controller' => 'App\\Controller\\SchoolController::getNeeds'], ['id'], ['GET' => 0], null, false, true, null]],
            219 => [[['_route' => 'user-info-others', '_controller' => 'App\\Controller\\UserController::othersInfo'], ['id'], ['GET' => 0], null, false, true, null]],
            236 => [[['_route' => 'user-follow-list', '_controller' => 'App\\Controller\\FollowUserController::list'], [], ['GET' => 0], null, true, false, null]],
            260 => [[['_route' => 'user-follow-number-others', '_controller' => 'App\\Controller\\FollowUserController::othersNumber'], ['id'], ['GET' => 0], null, false, true, null]],
            291 => [[['_route' => 'column-info', '_controller' => 'App\\Controller\\ColumnController::info'], ['id'], ['GET' => 0], null, false, true, null]],
            308 => [
                [['_route' => 'column-follow', '_controller' => 'App\\Controller\\FollowColumnController::follow'], [], ['POST' => 0], null, false, false, null],
                [['_route' => 'column-follow-list', '_controller' => 'App\\Controller\\FollowColumnController::followList'], [], ['GET' => 0], null, false, false, null],
            ],
            335 => [
                [['_route' => 'page-comment-like', '_controller' => 'App\\Controller\\CommentLikeController::like'], ['id'], ['POST' => 0], null, false, true, null],
                [['_route' => 'page-comment-unlike', '_controller' => 'App\\Controller\\CommentLikeController::unlike'], ['id'], ['DELETE' => 0], null, false, true, null],
            ],
            369 => [
                [['_route' => 'page-like', '_controller' => 'App\\Controller\\PageLikeController::like'], ['id'], ['POST' => 0], null, true, false, null],
                [['_route' => 'page-unlike', '_controller' => 'App\\Controller\\PageLikeController::unlike'], ['id'], ['DELETE' => 0], null, true, false, null],
            ],
            388 => [[['_route' => 'page-comment', '_controller' => 'App\\Controller\\PageCommentController::publish'], ['id'], ['POST' => 0], null, true, false, null]],
            404 => [
                [['_route' => 'page-collect-list', '_controller' => 'App\\Controller\\PageCollectController::list'], ['id'], ['GET' => 0], null, true, false, null],
                [['_route' => 'page-collect', '_controller' => 'App\\Controller\\PageCollectController::collect'], ['id'], ['POST' => 0], null, true, false, null],
                [['_route' => 'page-uncollect', '_controller' => 'App\\Controller\\PageCollectController::uncollect'], ['id'], ['DELETE' => 0], null, true, false, null],
            ],
            420 => [[['_route' => 'page-report', '_controller' => 'App\\Controller\\PageReportController::report'], ['id'], ['POST' => 0], null, true, false, null]],
        ];
    }
}
