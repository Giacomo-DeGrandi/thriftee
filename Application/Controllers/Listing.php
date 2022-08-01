<?php

namespace Application\Controllers\Listing;

require_once('Application/Models/Listing.php');

use Application\Controllers\Controller\Controller;
use Application\Models\Listing\Listing as ListingModel;
use Application\Controllers\User\User;

class Listing extends Controller
{

    public function validateListing(mixed $title, mixed $price, mixed $category, mixed $subCat, mixed $description, mixed $year, array $errors): bool|array
    {
        // check for errors in user inputs and count them
        if (empty($title)) {
            $errors[] = "Title is required";
        }
        if (!preg_match('/^[a-zA-ZÀ-ÿ0-9 ]*$/', $title)) {
            $errors[] = "You can't use special characters in title field";
        }
        if (strlen($title) < 3 || strlen($title) > 30) {
            $errors[] = "Title must be in between 3 and 30 characters";
        }
        if (empty($price)) {
            $errors[] = "Price is required";
        }
        if (!preg_match('/^[0-9.,]*$/', $price)||$price === '0'|| $price === 0) {
            $errors[] = "Price can't be neither negative nor 0";
        }
        if (empty($category)) {
            $errors[] = "Category is required";
        }
        if (empty($subCat)) {
            $errors[] = "Sub-Category is required";
        }
        if (empty($description)) {
            $errors[] = "Description is required";
        }
        if (!preg_match('/^[a-zA-ZÀ-ÿ0-9.,_ \'?!-]*$/', $description)) {
            $errors[] = "You can't use special characters but .,_ \'?!- in description field";
        }
        if (strlen($description) < 0 || strlen($description) > 5000) {
            $errors[] = "Description must be in between 0 and 5000 characters";
        }

        $ytest = intval(date("Y"));

        if (!preg_match('/^[0-9]*$/', intval($year) > $ytest )) {
            $errors[] = "Year is invalid";
        }

        if (empty($errors)) {


            unset($_SESSION["token"]);
            unset($_SESSION["token-expire"]);
            return  [$errors, true];

        } else {
            return  [$errors, false];
        }

    }


    public function validateCondition(mixed $used, mixed $good, mixed $mint, array $errors): array
    {

        if ($used === 'false' && $good === 'false' && $mint === 'false') {
            $errors [] = 'You have to chose at one condition for this offer';
        }
        if ($mint === 'true' && $good === 'true' && $used === 'true') {
            $errors [] = 'You can chose at max one condition for this offer.';
        }
        if ($mint === 'true' && $good === 'true') {
            $errors [] = 'You can chose at max one condition for this offer.';
        }
        if ($mint === 'true' && $used === 'true') {
            $errors [] = 'You can chose at max one condition for this offer.';
        }
        if ($good === 'true' && $used === 'true') {
            $errors [] = 'You can chose at max one condition for this offer.';
        }
        if($good === 'false' && $used === 'true' && $mint === 'false'){
            $cond = 2;  // used
        }
        if($good === 'true' && $used === 'false' && $mint === 'false'){
            $cond = 1; // good
        }
        if($good === 'false' && $used === 'false' && $mint === 'true'){
            $cond = 3;  // mint
        }
        return [$errors, $cond];
    }

    public function validateShipping(mixed $hands, mixed $delivery, array $errors): array
    {
        if ($hands == 'false' && $delivery == 'false') {
            $errors [] = 'You have to chose at least one shipping method';
        }
        if ($hands !== 'true' && $delivery !== 'true') {
            $errors [] = 'You can chose at max one shipping method.';
        }
        if($hands === 'false' && $delivery === 'true'){
            $ship = 2;
        }
        if($hands === 'true' && $delivery === 'false'){
            $ship = 1;
        }
        return [$errors, $ship];

    }

    public function registerListing(mixed $id, mixed $title, mixed $price, mixed $category, mixed $subCat, mixed $description, mixed $cond, mixed $ship, mixed $year, mixed $newFilepath1, mixed $newFilepath2, mixed $newFilepath3, mixed $newFilepath4): bool|array
    {
        return (new ListingModel)->registerListing($id,$title,$price,$category,$subCat,$description,$cond,$ship,$year,$newFilepath1,$newFilepath2,$newFilepath3,$newFilepath4);
    }

    public function getAllListingByUser(mixed $id): bool|array
    {
        return (new ListingModel)->getAllListingByUser($id);
    }

    public function getListingsByUserAndState(mixed $id, int $state): bool|array
    {
        return (new ListingModel)->getListingsByUserAndState($id,$state);
    }

    public function getMostViewd(): bool|array
    {
        return (new ListingModel)->getMostViewd();

    }

    public function getListInfo(string $id_listing): bool|array
    {
        return (new ListingModel)->getListInfo($id_listing);

    }

    public function getAllListingByCat(mixed $id_categories): bool|array
    {
        return (new ListingModel)->getListInfoByCat($id_categories);
    }

    public function getAllPrices(): bool|array
    {
        return (new ListingModel)->getAllPrices();

    }


}