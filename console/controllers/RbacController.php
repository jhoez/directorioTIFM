<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * @class RbacController
 */
class RbacController extends Controller
{
    // ejecutar el comando php yii rbac/init
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        // CREACIÓN DE PERMISOS
        $permisoadministrador = $auth->createPermission('permisoAdministrador');
        $auth->add($permisoadministrador);

        //CREACION PERMISO DE RUTAS
        $pathadmin = $auth->createPermission('/admin/*');//ADMIN
        $auth->add($pathadmin);
        $pathusuario = $auth->createPermission('/usuario/*');//USUARIO
        $auth->add($pathusuario);
        $pathsite = $auth->createPermission('/site/*');//SITE
        $auth->add($pathsite);

        //AÑADIR RUTA A PERMISO
        $auth->addChild($permisoadministrador,$pathadmin);
        $auth->addChild($permisoadministrador,$pathusuario);
        $auth->addChild($permisoadministrador,$pathsite);

        // CREACIÓN DE ROLES
        // ROLE "administrador" y le asigna el permiso "permisoAdministrador"
        $administrador = $auth->createRole('administrador');
        $auth->add($administrador);
        $auth->addChild($administrador, $permisoadministrador);

        // ASIGNACION DE ROLES POR IDs devuelto por IdentityInterface::getId()
        $auth->assign($administrador, 1);
    }
}


?>
