# Site API Module

## Features

1. As an administrative user of a Drupal 8 site.
You can setup a site api key in admin site information page.

2. As Anonymous or Authenticated user you can access `page` content in JSON
format on your site if you have the below details:

 - Site API Key
 - Node ID of the content.

## How to install Site API Module?

1. Download siteapi module from github.
2. Copy in modules folder.
3. Enable the siteapi module using via drush command `drush en siteapi`

## How to configure site api key?

1. Login as a administrator,
2. Goto `/admin/config/system/site-information`
4. Enter the Site API key for Example : `FOOBAR12345` and Save the Form.
5. Create page type content in your drupal 8 site.
6. Go to the link of the format `http://localhost/page_json/{api_key}/{nid}`

  Example: `http://localhost/page_json/FOOBAR12345/2`

## Return JSON Output

1. If API Key is correct and Node ID of a `Page` content.

`{
  "Node ID": "1",
  "title": "Page type content",
  "body": [
    {
      "value": "<p>Lorem Lipsum</p>\r\n",
      "summary": "",
      "format": "basic_html"
    }
  ],
  "Node Type": null,
  "Node Access": "Success"
}`

2. If API key is wrong.

`[
  "Access Denied",
  "Reason : API Key Invalid"
]`



### References

- [Drupal 8 Form API](https://www.drupal.org/docs/8/api/form-api/introduction-to-form-api)
- [Drupal 8 Configuration API](https://www.drupal.org/docs/8/api/configuration-api/configuration-api-overview)
- [Drupal 8 Configuration API to set value](https://www.drupal.org/docs/8/api/configuration-api/simple-configuration-api)
- [Drupal 8 Form Id alter](https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Form%21form.api.php/function/hook_form_FORM_ID_alter/8.4.x)
- [Drupal 8 JsonResponse](https://drupal-up.com/blog/custom-drupal-8-module-json-response)
- [Drupal 8 comment standards](https://www.drupal.org/docs/develop/standards/api-documentation-and-comment-standards)

Total Coding Time - 3 Hours
