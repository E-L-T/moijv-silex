<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\ValidatorServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});


$app['users.dao'] = function ($app) {
    return new \DAO\UserDAO($app['pdo']);
};

$app['categories.dao'] = function ($app) {
    return new \DAO\CategoryDAO($app['pdo']);
};

$app['games.dao'] = function ($app) {
    return new \DAO\GameDAO($app['pdo']);
};

$app['loanings.dao'] = function ($app) {
    return new \DAO\LoaningDAO($app['pdo']);
};

$app['pdo'] = function($app) {
    $options = $app['pdo.options'];

    return new \PDO("{$options['dbms']}://host={$options['host']};dbname={$options['dbname']};charset={$options['charset']}", $options['username'], $options['password'], array(
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ));
};
$app->register(new Silex\Provider\SessionServiceProvider());

//on crée un firewall pour notre site (front-office)
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => [
        'front' => array(
            'pattern' => '^/', //ce firewall concerne ttes les uri
            'http' => true, //connexion classique, http
            'anonymous' => true, //les connexions anonymes sont autorisées
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'logout' => array('logout_path' => '/logout', 'invalidate_session' => true),
            'users' => function () use ($app) { //quel est l'objet qui permet de savoir quels sont les utilisateurs dans la bdd. c'est notre dao
                return $app['users.dao']; //equivalent de return new UserProvider($app['db'])
            }
        ),
        'admin' => array(
            'pattern' => '^/admin/',
            'form' => array('login_path' => '/loginadmin', 'check_path' => '/admin/login_check'),
            'http' => true, //connexion classique, http
            'users' => function () use ($app) {
                return $app['admins.dao'];
             }
        ),
    ]
));

$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('fr'),
    'translator.domains' => [
        'messages' => [
            'fr' => [
                'The credentials were changed from another session.' => 'Les identifiants ont été changés dans une autre session.',
                'The presented password cannot be empty.' => 'Le mot de passe ne peut pas être vide.',
                'The presented password is invalid.' => 'Le mot de passe entré est invalide.',
                'Bad credentials.' => 'Les identifiants sont incorrects'
            ]
        ]
    ]
));
$app->register(new FormServiceProvider());

$app->register(new ValidatorServiceProvider());

$app['admins.dao'] = function ($app) {
    
    return new DAO\AdminDAO($app['pdo']);
    
};

return $app;
