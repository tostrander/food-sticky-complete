<?php

/* Validate the form
 * @return boolean
 */
function validForm()
{
    global $f3;
    $isValid = true;

    if (!validFood($f3->get('food'))) {

        $isValid = false;
        $f3->set("errors['food']", "Please enter a food item");
    }

    if (!validQty($f3->get('qty'))) {

        $isValid = false;
        $f3->set("errors['qty']", "Please enter 1 or more");
    }

    if (!validMeal($f3->get('meal'))) {

        $isValid = false;
        $f3->set("errors['meal']", "Please select a meal");
    }

    if (!validCondiments($f3->get('cond'))) {

        $isValid = false;
        $f3->set("errors['cond']", "Invalid selection");
    }

    return $isValid;
}

/* Validate a food
 * Food must not be empty and may only consist
 * of alphabetic characters.
 *
 * @param String food
 * @return boolean
 */
function validFood($food)
{
    return !empty($food) && ctype_alpha($food);
}

/* Validate quantity
 * Quantity must not be empty and must be a number
 * greater than 1.
 *
 * @param String qty
 * @return boolean
 */
function validQty($qty)
{
    return !empty($qty) && ctype_digit($qty) && (int)$qty > 1;
}

/* Validate a meal
 *
 * @param String meal
 * @return boolean
 */
function validMeal($meal)
{
    global $f3;
    return in_array($meal, $f3->get('meals'));
}

/* Validate condiments
 *
 * @param String cond
 * @return boolean
 */
function validCondiments($cond)
{
    global $f3;

    //Condiments are optional
    if (empty($cond)) {
        return true;
    }

    //But if there are condiments, we need to make sure they're valid
    foreach ($cond as $condiment) {
        if (!in_array($condiment, $f3->get('condiments'))) {
            return false;
        }
    }

    //If we're still here, then we have valid condiments
    return true;
}