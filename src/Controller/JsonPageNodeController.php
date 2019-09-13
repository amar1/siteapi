<?php

namespace Drupal\siteapi\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Implements JsonPageNodeController for the siteapi module.
 */
class JsonPageNodeController extends ControllerBase {

  /**
   * Function to render JSON output for page node type.
   *
   * @param string $api_key
   *   A String passed from the request URL.
   * @param int $nid
   *   A integer passed from the request URL.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *
   *   A Json Response return Node detail or error Message.
   */
  public function renderJson($api_key, $nid) {

    // Get the Site API key from configuration.
    $site_api_key = \Drupal::config('siteapi.settings')->get('siteapikey');

    // Check if the API Key entered in the URL is Valid.
    if ($api_key === $site_api_key) {

      // Check if the node id is numeric and greater then 0.
      if (is_numeric($nid) && $nid > 0) {

        $node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);

        // Check if the node is loaded and it is of type 'page'.
        if (!empty($node) && $node->getType() === 'page') {

          // Get node title, body, type.
          $title = $node->getTitle();
          $body = $node->get('body')->getValue();
          $type = $node->getType();

          // Build the JSON response.
          $json_response = [
            'Node ID' => $nid,
            'title' => $title,
            'body' => $body,
            'Node Type' => $type,
            'Node Access' => 'Success',
          ];

          // Return the JSON Response.
          return new JsonResponse($json_response);
        }
        else {
          // If content type page or numerice value is not there.
          // then JSON response.
          $json_response = [
            'Access Denied',
            'Reason : Node is not existing or not content type of `page`',
          ];
          // Return the JSON Response.
          return new JsonResponse($json_response);
        }

      }

      // Generate appropriate Response as Node ID is not Numeric.
      else {
        // Build appropriate JSON response.
        $json_response = [
          'Access Denied',
          'Reason : Invalid Node ID. Please enter numeric Node ID value only',
        ];
        // Return the JSON Response.
        return new JsonResponse($json_response);

      }

    }

    // Generate appropriate Response as API Key is not Valid.
    else {
      // Build appropriate JSON response.
      $json_response = [
        'Access Denied',
        'Reason : API Key Invalid',
      ];
      // Return the JSON Response.
      return new JsonResponse($json_response);
    }

  }

}
