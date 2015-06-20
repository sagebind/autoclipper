# AutoClipper
An automatic Evernote article clipper that accepts an article URL and sends the formatted article to an Evernote notebook.

This is a really simple script that allows you to clip an article to your Evernote by simply making an HTTP GET request to the script. The script uses the [Readablity article parser](https://www.readability.com/developers/api/parser) to extract the content from the article and your [Evernote email address](https://blog.evernote.com/blog/2010/03/16/emailing-into-evernote-just-got-better/) to save to Evernote. This is useful for hooking up with other automated systems, like [IFTTT](http://ifttt.com).

## Getting started
First, you will need to copy the scripts to some public webserver you have access to. You can download the latest script version under the releases tab on GitHub. You may also need the `autoclipper.php` file in the repo as well.

To use the Readablity API, you need to get an API key first. Visit [the docs](https://www.readability.com/developers/api/parser) and click "Grab Your Keys" to get started.

## Usage
To run the autoclipper, make a GET request to the script's URL. Below are the various parameters:

| Parameter | Description |
|-----------|-------------|
| `token`   | Your Readablity API token. Required. |
| `email`   | Your Evernote email address. Required. |
| `url`     | The URL of the article to clip. Required. |
| `notebook` | The name of an Evernote notebook to send the clip to. Default is your default Evernote notebook. Optional. |
| `tags`    | A comma-separated list of tags to apply to the clip. Optional. |

For example, a request might look like this:

```
GET /autoclipper.php?token=1b830931777ac7c2ac954e9f0d67df437175e66e&email=username.12345@m.evernote.com&url=http://blog.ifttt.com/post/121786069098/introducing-the-maker-channel&notebook=Clippings&tags=ifttt,autoclipper
```
