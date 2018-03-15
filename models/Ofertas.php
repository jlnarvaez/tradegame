<?php

namespace app\models;

/**
 * This is the model class for table "ofertas".
 *
 * @property int $id
 * @property int $videojuego_publicado_id
 * @property int $videojuego_ofrecido_id
 * @property int $contraoferta_de
 * @property string $created_at
 * @property bool $aceptada
 *
 * @property Ofertas $contraofertaDe
 * @property Ofertas[] $ofertas
 * @property VideojuegosUsuarios $videojuegoPublicado
 * @property VideojuegosUsuarios $videojuegoOfrecido
 */
class Ofertas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ofertas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['videojuego_publicado_id', 'videojuego_ofrecido_id'], 'required'],
            [['videojuego_publicado_id', 'videojuego_ofrecido_id', 'contraoferta_de'], 'default', 'value' => null],
            [['videojuego_publicado_id', 'videojuego_ofrecido_id', 'contraoferta_de'], 'integer'],
            [['created_at'], 'safe'],
            [['aceptada'], 'boolean'],
            [
                ['videojuego_publicado_id', 'videojuego_ofrecido_id'], 'unique',
                'targetAttribute' => [
                    'videojuego_publicado_id',
                    'videojuego_ofrecido_id',
                ],
                'message' => 'Ya has realizado esta misma oferta anteriormente',
            ],
            [['contraoferta_de'], 'exist', 'skipOnError' => true, 'targetClass' => self::className(), 'targetAttribute' => ['contraoferta_de' => 'id']],
            [['videojuego_ofrecido_id'], 'exist', 'skipOnError' => true, 'targetClass' => VideojuegosUsuarios::className(), 'targetAttribute' => ['videojuego_ofrecido_id' => 'id']],
            [['videojuego_publicado_id'], 'exist', 'skipOnError' => true, 'targetClass' => VideojuegosUsuarios::className(), 'targetAttribute' => ['videojuego_publicado_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'videojuego_publicado_id' => 'Videojuego Publicado ID',
            'videojuego_ofrecido_id' => 'Videojuego ofrecido',
            'contraoferta_de' => 'Contraoferta De',
            'created_at' => 'Created At',
            'aceptada' => 'Aceptada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContraofertaDe()
    {
        return $this->hasOne(self::className(), ['id' => 'contraoferta_de']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfertas()
    {
        return $this->hasMany(self::className(), ['contraoferta_de' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideojuegoPublicado()
    {
        return $this->hasOne(VideojuegosUsuarios::className(), ['id' => 'videojuego_publicado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideojuegoOfrecido()
    {
        return $this->hasOne(VideojuegosUsuarios::className(), ['id' => 'videojuego_ofrecido_id']);
    }
}