<?php

abstract class Animal{
    abstract function eat(Food $food);
}

class Cat extends Animal{


    function eat(Food $food)
    {
        return "Cat has eaten " . $food->toString();
    }
}

class Dog extends Animal{


    function eat(Food $food)
    {
        return "Dog has eaten " . $food->toString();
    }
}

class Mouse extends Animal{


    function eat(Food $food)
    {
        return "Mouse has eaten " . $food->toString();
    }
}

abstract class Food {
    abstract function toString();
}

class Cheese extends Food{
    function toString(){
        return "Cheese";
    }
}

class Bacon extends Food{
    function toString(){
        return "Bacon";
    }
}

$cat = new Cat();
$dog = new Dog();
$mouse = new Mouse();

$cheese = new Cheese();
$bacon = new Bacon();

function eating(Animal $animal, Food $food){
    return $animal ->eat($food);
}

echo eating($mouse,$bacon);
