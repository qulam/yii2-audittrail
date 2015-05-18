<?php
namespace asinfotrack\yii2\audittrail\models;

/**
 * Query class for audit trail entries
 * 
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class AuditTrailEntryQuery extends \yii\db\ActiveQuery
{
	
	/**
	 * Named scope to get entries for a certain model
	 * 
	 * @param \yii\db\ActiveRecord $model the model to get the audit trail for
	 * @throws InvalidConfigException if the pk is null
	 */
	public function subject($model)
	{
		//fetch the objects pk
		$pk = $model->primaryKey;
		if ($pk === null) {
			throw new InvalidConfigException('pk NULL received: please provide a pk-definition for table ' . $model->tableName());
		}
		//create array if it is not already
		if (!is_array($pk)) $pk = [$pk=>$this->owner->{$pk}];
		
		$this->andWhere(['foreign_pk'=>Json::encode($pk)]);
	}
	
}