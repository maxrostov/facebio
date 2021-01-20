<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Org]].
 *
 * @see Org
 */
class OrgQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Org[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Org|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
