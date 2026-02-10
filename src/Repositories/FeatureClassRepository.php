<?php

namespace MichaelDrennen\Geonames\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use MichaelDrennen\Geonames\Models\FeatureClass;

class FeatureClassRepository {

    /**
     * @var string|null The database connection name
     */
    protected ?string $connectionName;

    /**
     * FeatureClassRepository constructor.
     * @param string|null $connectionName
     */
    public function __construct(?string $connectionName = null) {
        $this->connectionName = $connectionName ?? config('database.default');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|FeatureClass[]
     */
    public function all() {
        return FeatureClass::on($this->connectionName)->get();
    }

    /**
     * @param string $id
     * @return FeatureClass
     */
    public function getById(string $id): FeatureClass {
        $featureClass = FeatureClass::on($this->connectionName)->find($id);

        if (is_null($featureClass)) {
            throw new ModelNotFoundException("Unable to find a feature class with id of $id");
        }

        return $featureClass;
    }

}