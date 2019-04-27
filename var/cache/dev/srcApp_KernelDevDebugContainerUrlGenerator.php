<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = [
        '_twig_error_test' => [['code', '_format'], ['_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], []],
        '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], []],
        '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], []],
        '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], []],
        '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], []],
        '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], []],
        '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], []],
        '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception::showAction'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception::cssAction'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        'school-list' => [[], ['_controller' => 'App\\Controller\\SchoolController::list'], [], [['text', '/api/v1/school']], [], []],
        'school-needs' => [['id'], ['_controller' => 'App\\Controller\\SchoolController::getNeeds'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/school']], [], []],
        'user-auth' => [[], ['_controller' => 'App\\Controller\\UserController::Auth'], [], [['text', '/api/v1/user/auth']], [], []],
        'user-info' => [[], ['_controller' => 'App\\Controller\\UserController::info'], [], [['text', '/api/v1/user']], [], []],
        'user-info-change' => [[], ['_controller' => 'App\\Controller\\UserController::updateInfo'], [], [['text', '/api/v1/user']], [], []],
        'user-info-others' => [['id'], ['_controller' => 'App\\Controller\\UserController::othersInfo'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/user']], [], []],
        'user-follow-list' => [[], ['_controller' => 'App\\Controller\\FollowUserController::list'], [], [['text', '/api/v1/user/follow/']], [], []],
        'user-follow-number' => [[], ['_controller' => 'App\\Controller\\FollowUserController::number'], [], [['text', '/api/v1/user/follow/number']], [], []],
        'user-follow-number-others' => [['id'], ['_controller' => 'App\\Controller\\FollowUserController::othersNumber'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/user/follow/number']], [], []],
        'column-list' => [[], ['_controller' => 'App\\Controller\\ColumnController::list'], [], [['text', '/api/v1/column/']], [], []],
        'column-info' => [['id'], ['_controller' => 'App\\Controller\\ColumnController::info'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/column']], [], []],
        'column-apply' => [[], ['_controller' => 'App\\Controller\\ColumnController::apply'], [], [['text', '/api/v1/column/']], [], []],
        'column-info-update' => [[], ['_controller' => 'App\\Controller\\ColumnController::updateInfo'], [], [['text', '/api/v1/column/']], [], []],
        'column-follow' => [[], ['_controller' => 'App\\Controller\\FollowColumnController::follow'], [], [['text', '/api/v1/column/follow']], [], []],
        'column-follow-list' => [[], ['_controller' => 'App\\Controller\\FollowColumnController::followList'], [], [['text', '/api/v1/column/follow']], [], []],
        'page-list' => [[], ['_controller' => 'App\\Controller\\PageController::list'], [], [['text', '/api/v1/page/']], [], []],
        'page-publish' => [[], ['_controller' => 'App\\Controller\\PageController::publish'], [], [['text', '/api/v1/page/']], [], []],
        'page-like' => [['id'], ['_controller' => 'App\\Controller\\PageLikeController::like'], [], [['text', '/like/'], ['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/page']], [], []],
        'page-unlike' => [['id'], ['_controller' => 'App\\Controller\\PageLikeController::unlike'], [], [['text', '/like/'], ['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/page']], [], []],
        'page-comment' => [['id'], ['_controller' => 'App\\Controller\\PageCommentController::publish'], [], [['text', '/comment/'], ['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/page']], [], []],
        'page-comment-like' => [['id'], ['_controller' => 'App\\Controller\\CommentLikeController::like'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/comment']], [], []],
        'page-comment-unlike' => [['id'], ['_controller' => 'App\\Controller\\CommentLikeController::unlike'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/comment']], [], []],
        'page-collect-list' => [['id'], ['_controller' => 'App\\Controller\\PageCollectController::list'], [], [['text', '/collect/'], ['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/page']], [], []],
        'page-collect' => [['id'], ['_controller' => 'App\\Controller\\PageCollectController::collect'], [], [['text', '/collect/'], ['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/page']], [], []],
        'page-uncollect' => [['id'], ['_controller' => 'App\\Controller\\PageCollectController::uncollect'], [], [['text', '/collect/'], ['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/page']], [], []],
        'page-report' => [['id'], ['_controller' => 'App\\Controller\\PageReportController::report'], [], [['text', '/report/'], ['variable', '/', '[^/]++', 'id', true], ['text', '/api/v1/page']], [], []],
        'message-list' => [[], ['_controller' => 'App\\Controller\\MessageController::list'], [], [['text', '/api/v1/message/']], [], []],
        'message-send' => [[], ['_controller' => 'App\\Controller\\MessageController::send'], [], [['text', '/api/v1/message/']], [], []],
        'menu' => [[], ['_controller' => 'App\\Controller\\MenuController::index'], [], [['text', '/api/v1/menu/']], [], []],
        'menu-update' => [[], ['_controller' => 'App\\Controller\\MenuController::updateMenu'], [], [['text', '/api/v1/menu/']], [], []],
        'score' => [[], ['_controller' => 'App\\Controller\\ScoreController::index'], [], [['text', '/api/v1/score/']], [], []],
        'lesson' => [[], ['_controller' => 'App\\Controller\\LessonController::index'], [], [['text', '/api/v1/lesson/']], [], []],
        'exam' => [[], ['_controller' => 'App\\Controller\\ExamController::index'], [], [['text', '/api/v1/exam/']], [], []],
        'cet' => [[], ['_controller' => 'App\\Controller\\CetController::index'], [], [['text', '/api/v1/cet/']], [], []],
    ];
        }
    }

    public function generate($name, $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && null !== $name) {
            do {
                if ((self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
                    unset($parameters['_locale']);
                    $name .= '.'.$locale;
                    break;
                }
            } while (false !== $locale = strstr($locale, '_', true));
        }

        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
