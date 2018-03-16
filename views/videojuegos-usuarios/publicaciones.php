<?php
use yii\widgets\ListView;


$this->title = 'Mis publicaciones';
$label = 'Mi perfil';
if (Yii::$app->user->id !== $model->id) {
    $this->title = 'Publicaciones de ' . "'$model->usuario'";
    $label = 'Perfil de ' . "'$model->usuario'";
}

$this->params['breadcrumbs'][] = [
    'label' => $label,
    'url' => ['usuarios/perfil', 'usuario' => $model->usuario]
];

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-offset-1 col-md-10">
    <?= ListView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'itemView' => 'view',
        'separator' => '<hr class="separador">'
    ]) ?>
</div>
