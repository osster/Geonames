<?php

namespace MichaelDrennen\Geonames\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use MichaelDrennen\Geonames\Models\AlternateName;


class AlternateNameRepository {

    /**
     * @var string|null The database connection name
     */
    protected ?string $connectionName;

    /**
     * AlternateNameRepository constructor.
     * @param string|null $connectionName
     */
    public function __construct(?string $connectionName = null) {
        $this->connectionName = $connectionName ?? config('database.default');
    }

    /**
     * @param int $geonameId
     * @return Collection
     */
    public function getByGeonameId(int $geonameId): Collection {
        return AlternateName::on($this->connectionName)
                           ->where('geonameid', $geonameId)
                           ->get();
    }


}