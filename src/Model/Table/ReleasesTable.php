<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Releases Model
 *
 * @property \App\Model\Table\PartnersTable|\Cake\ORM\Association\BelongsTo $Partners
 * @property \App\Model\Table\GraphicsTable|\Cake\ORM\Association\HasMany $Graphics
 * @property \App\Model\Table\AuthorsTable|\Cake\ORM\Association\BelongsToMany $Authors
 * @property \App\Model\Table\TagsTable|\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \App\Model\Entity\Release get($primaryKey, $options = [])
 * @method \App\Model\Entity\Release newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Release[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Release|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Release patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Release[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Release findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReleasesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('releases');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Partners', [
            'foreignKey' => 'partner_id'
        ]);
        $this->hasMany('Graphics', [
            'foreignKey' => 'release_id'
        ]);
        $this->belongsToMany('Authors', [
            'foreignKey' => 'release_id',
            'targetForeignKey' => 'author_id',
            'joinTable' => 'authors_releases'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'release_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'releases_tags'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 200)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 100)
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->date('released')
            ->requirePresence('released', 'create')
            ->notEmpty('released');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['partner_id'], 'Partners'));

        return $rules;
    }
}
