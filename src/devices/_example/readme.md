*(this file will be replaced when you build the methods, using the command line tool)*

# How to quickly create a new device API

First, learn by examining the code from other devices, then...


## Duplicate the '_example' folder

- name it as 'brand' : if the Api works with most device of this brand
- name it as 'brand_family' : if the Api works with most devices of this products family
- name it as 'brand_model' : if the Api ONLY applies to a single device


## Fill the main.php file

You mostly have to:

- Create the **ApiLogin** method, 
- Create methods to be called by endpoints definitions . ie *CallApiPost, CallApiGet, CallApi*
- Format the answer to return either **TRUE**, **FALSE**, or an **Array** (without any nesting if not absolutely required).The array is either:
	- a single object, as an array of fields
	- an array of objects (for lists)
- Handle errors by filling the api_error properties, and parsing the API call result.

### Non-JSON bodies (CSV, images, …)

Keep `CallApiGet` / `CallApiPost` **JSON-only** (decode + array). For downloads that are not JSON:

- Implement `CallApiGetRaw` / `CallApiPostRaw` (device) that call transport then `MakeRawResultEnvelope($body)` from the base class — returns `{ok, http_code, content_type, encoding, body}` with **opaque** `body` (no `json_decode`).
- Optional `CallApiGetCsv`: Raw + `ParseCsvBody($env['body'])` → same envelope plus `rows`.
- Base defaults: `$csv_delimiter=','`, `$csv_eol="\n"`, `$csv_enclosure='"'`. Override on the **device** class when the vendor dialect differs (e.g. OPNsense uses `';`).
- Do **not** sniff delimiters from the body. `ParseCsvBody` accepts optional explicit delimiter/eol/enclosure args.
- In `template.php` `$p['calls']`, map `get_raw` → `CallApiGetRaw`, `get_csv` → `CallApiGetCsv`, and set `METHOD_I` accordingly on those endpoints.


## Fill the template.php file

Here you'll mainly set your definitions describing all the API endoints and call methods to be used to reach those endpoints.

You may now, use the `/src/tools/build_api_methods.php` command to automatically build all your APi 'Get' and 'Set' methods directly into the `trait.php` file. This command also build the `readme.md` file.


## Use tools to debug

You can use various command line tools in the `/src/tools/` folder to debug and test your newly created methods.


## Submit a PR
Contribute back, by submitting a nice PullRequest with you brand new API client!


Enjoy