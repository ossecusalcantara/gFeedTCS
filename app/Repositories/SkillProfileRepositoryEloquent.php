<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SkillProfileRepository;
use App\Entities\SkillProfile;
use App\Validators\SkillProfileValidator;

/**
 * Class SkillProfileRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SkillProfileRepositoryEloquent extends BaseRepository implements SkillProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SkillProfile::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SkillProfileValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function getDadosSkillMedia($idUser) {

        $itens = $this->model->where('user_id', $idUser)->orderBy('skill_id', 'asc')->get();

        $skillData  = [];

        foreach ($itens as $item) {

           $skill = $item->skill->name;
           if(!isset($skillData[$skill])) {
                $skillData[$skill] = [
                    'total' => 0,
                    'count' => 0
                ];
           }
           
           $skillData[$skill]['total'] += $item->pontuation;
           $skillData[$skill]['count'] += 1;
        }

        $averagePontuations = [];
        $skillDescriptions = [];
        foreach ($skillData as $skill => $data) {
           $average = round($data['total'] / $data['count'], 1);
           
           array_push($skillDescriptions, $skill);
           array_push($averagePontuations, $average);
        }

        return [$averagePontuations, $skillDescriptions];

    }
}
