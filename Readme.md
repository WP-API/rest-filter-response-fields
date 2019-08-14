**NOTE:** This plugin was created to test a feature which has since landed in WordPress core. To request specific fields with your REST API response, you may use the `_fields` query parameter introduced in WordPress 4.9.

Usage:

 Example Query | Result
-------------- | -------
`/wp/v2/posts?_fields=id,title` | Return a posts collection where each post includes only the `id` property and `title` object.
`/wp/v2/media?_fields=source_url` | Return a media collection where each object includes only the `source_url`.
`/wp/v2/tags?_fields[]=slug&_fields[]=id` | Return tag objects with only the `id` and `slug` properties.

As noted in the above examples, the core implementation supports using query parameter array syntax or a comma-separated list.

Legacy plugin README below, for posterity.

--------------

## REST Filter Response Fields

Specify fields for the response JSON. See https://core.trac.wordpress.org/ticket/38131.

Use by specifying the fields you want as part of the request as a comma delimited list: `?fields=title,excerpt`.
