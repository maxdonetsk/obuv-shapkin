<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {
    
    public function init() {
        parent::init();
        Yii::$app->language = 'ru';
        #add your logic: read the cookie and then set the language
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $this->view->params['header'] = 'Интернет-магазин обуви Obuv.CO. Новые поступления (на 26 мая 2014).';
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays contacts page.
     *
     * @return string
     */
    public function actionContacts() {
        $this->view->params['header'] = '<a href="/">' . Yii::$app->name .'</a>' . '\ Контакты';
        return $this->render('contacts');
    }

    /**
     * Displays brands page.
     *
     * @return string
     */
    public function actionBrands() {
        $this->view->params['header'] = '<a href="/">' . Yii::$app->name .'</a>' . '\ Торговые марки';
        return $this->render('brands');
    }

    /**
     * Displays tips page.
     *
     * @return string
     */
    public function actionTips() {
        $this->view->params['header'] = '<a href="/">' . Yii::$app->name .'</a>' . '\ Советы покупателю';
        return $this->render('tips');
    }

    /**
     * Displays sizes page.
     *
     * @return string
     */
    public function actionSizes() {
        $this->view->params['header'] = '<a href="/">' . Yii::$app->name .'</a>' . '\ Таблица размеров';
        return $this->render('sizes');
    }

    /**
     * Displays how-to-order page.
     *
     * @return string
     */
    public function actionHowToOrder() {
        $this->view->params['header'] = '<a href="/">' . Yii::$app->name .'</a>' . '\ Как сделать заказ';
        return $this->render('how-to-order');
    }

    /**
     * Displays cart page.
     *
     * @return string
     */
    public function actionCart() {
        $this->view->params['header'] = '<a href="/">' . Yii::$app->name .'</a>' . '\ Корзина';
        return $this->render('cart');
    }

    /**
     * Displays confirmation page.
     *
     * @return string
     */
    public function actionConfirmation() {
        $this->view->params['header'] = '<a href="/">' . Yii::$app->name .'</a>' . '\ Спасибо!';
        return $this->render('confirmation');
    }

}
