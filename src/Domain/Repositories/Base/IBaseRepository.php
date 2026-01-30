<?php 

interface IBaseRepository {
    public function findAll();
    public function findById(int $id): BaseEntity;
    public function save($entity);
    public function delete($entity);
}