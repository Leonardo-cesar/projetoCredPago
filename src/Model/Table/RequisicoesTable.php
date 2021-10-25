<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Requisicoes Model
 *
 * @property \App\Model\Table\UrlsTable&\Cake\ORM\Association\BelongsTo $Urls
 *
 * @method \App\Model\Entity\Requisico newEmptyEntity()
 * @method \App\Model\Entity\Requisico newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Requisico[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Requisico get($primaryKey, $options = [])
 * @method \App\Model\Entity\Requisico findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Requisico patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Requisico[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Requisico|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Requisico saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Requisico[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Requisico[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Requisico[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Requisico[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RequisicoesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('requisicoes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Urls', [
            'foreignKey' => 'url_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->dateTime('data_requisicao')
            ->allowEmptyDateTime('data_requisicao');

        $validator
            ->scalar('http')
            ->maxLength('http', 200)
            ->allowEmptyString('http');

        $validator
            ->scalar('corpo')
            ->allowEmptyString('corpo');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('url_id', 'Urls'), ['errorField' => 'url_id']);

        return $rules;
    }
}
