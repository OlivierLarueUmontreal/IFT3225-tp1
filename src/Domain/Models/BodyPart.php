<?php
namespace src\Domain\Models;

enum BodyPart: string
{
    case Chest = 'chest';
    case Back = 'back';
    case Quadriceps = 'quadriceps';
    case Hamstrings = 'hamstrings';
    case Glutes = 'glutes';
    case Calves = 'calves';
    case Shoulders = 'shoulders';
    case Biceps = 'biceps';
    case Triceps = 'triceps';
    case Abdominals = 'abdominals';
}