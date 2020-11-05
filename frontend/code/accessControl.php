<?php

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['special-callback'],
                'rules' => [
                    [
                        'actions' => ['special-callback'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return date('d-m') === '31-10';
                        },
                        'denyCallback' => function ($rule, $action) {
                            throw new \Exception('No tienes los suficientes permisos para acceder a esta página');
                        }
                    ],
                ],
            ],
        ];
    }

    // Callback coincidente llamado! Esta página sólo puede ser accedida cada 31 de Octubre
    public function actionSpecialCallback()
    {
        return $this->render('happy-halloween');
    }
}

?>
