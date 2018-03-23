<?php

use app\helpers\Utiles;

use yii\grid\ActionColumn;

use yii\helpers\Html;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ValoracionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mis valoraciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valoraciones-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '<span class="text-warning">Pendiente de valorar</span>'
        ],
        'columns' => [
            'usuarioValorado.usuario:text:Usuario a valorar',
            'comentario',
            [
                'header' => 'Valoración',
                'class' => ActionColumn::className(),
                'template' => '{valorar}',
                'headerOptions' => ['style' => 'width:20%'],
                'buttons' => [
                    'valorar' => function ($url, $model, $key) {
                        if ($model->num_estrellas === null) {
                            return Html::a('Valorar ' . Utiles::FA('star'), [
                                'valoraciones/valorar', 'id' => $model->id
                            ], ['class' => 'btn btn-sm btn-warning']);
                        } else {
                            return Utiles::pintarEstrellas($model->num_estrellas);
                        }
                    }
                ]
            ]
        ],
    ]); ?>
</div>
