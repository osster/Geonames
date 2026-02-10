<?php

namespace MichaelDrennen\Geonames\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use MichaelDrennen\Geonames\Models\PostalCode;


class PostalCodeRepository {

    /**
     * @var string|null The database connection name
     */
    protected ?string $connectionName;

    /**
     * PostalCodeRepository constructor.
     * @param string|null $connectionName
     */
    public function __construct(?string $connectionName = null) {
        $this->connectionName = $connectionName ?? config('database.default');
    }

    /**
     * @param string $postalCode
     * @param string $countryCode
     * @return Collection
     */
    public function getByCountry(string $postalCode, string $countryCode = ''): Collection {
        return PostalCode::on($this->connectionName)
                        ->where('country_code', '=', $countryCode)
                        ->where('postal_code', '=', $postalCode)
                        ->orderBy('country_code', 'ASC')
                        ->get();
    }


}
