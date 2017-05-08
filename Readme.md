## REST Filter Response Fields

Provide interface to include or exclude specific fields from response JSON. See https://core.trac.wordpress.org/ticket/38131.

Use by specifying the fields you want as part of the request as an array or comma delimited list: `?fields[]=title&fields[]=excerpt` or `?fields=title,excerpt`.