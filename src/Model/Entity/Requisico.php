<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Requisico Entity
 *
 * @property int $id
 * @property int|null $url_id
 * @property \Cake\I18n\FrozenTime|null $data_requisicao
 * @property string|null $http
 * @property string|null $corpo
 *
 * @property \App\Model\Entity\Url $url
 */
class Requisico extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'url_id' => true,
        'data_requisicao' => true,
        'http' => true,
        'corpo' => true,
        'url' => true,
    ];
}
