<?php

namespace Ferry\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;

class StudentRespository extends EntityRepository
{
    public function studentsPhonesAndCourses(): array
    {
        return $this->createQueryBuilder('student')
                    ->addSelect('phone', 'course')
                    ->leftJoin('student.phones', 'phone')
                    ->leftJoin('student.courses', 'course')
                    ->getQuery()->getResult();
    }
}
