<?php

namespace App\Services;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportService {
    // Métodos que fazem comunicação do reposítório com os controlers
    public function __construct(protected SupportRepositoryInterface $repository) {
        // Inversão de dependência
    }

    // GET ALL DATA
    public function getAll(string $filter = null): array {
        return $this->repository->getAll($filter);
    }

    // GET SINGLE DATA
    public function findOne(string $id): stdClass | null {
        return $this->repository->findOne($id);
    }

    // CREATE
    public function new(CreateSupportDTO $dto): stdClass {
        return $this->repository->new($dto);
    }

    // UPDATE
    public function update(UpdateSupportDTO $dto): stdClass | null {
        return $this->repository->update($dto);
    }

    // DELETE
    public function delete(string $id): void {
        $this->repository->delete($id);
    }
}