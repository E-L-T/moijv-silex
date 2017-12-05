<?php

namespace App;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomApp
 *
 * @author eric
 */

class CustomApp extends \Silex\Application
{
    use \Silex\Application\SecurityTrait;
    use \Silex\Application\FormTrait;
    use \Silex\Application\MonologTrait;
    use \Silex\Application\TranslationTrait;
    use \Silex\Application\TwigTrait;
    use \Silex\Application\UrlGeneratorTrait;
}
