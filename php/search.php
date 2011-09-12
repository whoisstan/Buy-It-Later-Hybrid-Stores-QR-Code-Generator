<?php

include 'settings.php';

defined('AWS_API_KEY') or define('AWS_API_KEY', 'API KEY');
defined('AWS_API_SECRET_KEY') or define('AWS_API_SECRET_KEY', 'SECRET KEY');
defined('AWS_ASSOCIATE_TAG') or define('AWS_ASSOCIATE_TAG', 'ASSOCIATE TAG');

require '../lib/AmazonECS.class.php';

try
{
    $amazonEcs = new AmazonECS(AWS_API_KEY, AWS_API_SECRET_KEY, 'com', $_GET['affiliate_id']);
    $amazonEcs->associateTag($_GET['affiliate_id']);

    // from now on you want to have pure arrays as response
    $amazonEcs->returnType(AmazonECS::RETURN_TYPE_ARRAY);

    // changing the category to DVD and the response to only images and looking for some matrix stuff.
    $response = $amazonEcs->category('Book')->responseGroup('Large')->category('Books')->search($_GET['term']);
 	echo(json_encode($response['Items']['Item']));

}
catch(Exception $e)
{
  echo $e->getMessage();
}

